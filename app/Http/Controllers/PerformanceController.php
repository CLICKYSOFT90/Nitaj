<?php

namespace App\Http\Controllers;

use App\Models\InvestorInvestments;
use App\Models\ProjectFundings;
use App\Models\Settings;
use App\Models\Transactions;
use App\Models\UserWallets;
use App\Models\WalletLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Project;
use App\Models\Category;
use App\Models\FundingCampaigns;
use App\Models\Report;
use App\Models\ReportDocuments;
use App\Models\ReportProgress;
use App\Models\ReportProgressSummary;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Foreach_;

class PerformanceController extends Controller
{
    public function index(Request $request)
    {

        // if admin
        if (auth()->user()->is_admin) {

            if ($request->ajax()) {
                $data = Report::with('project', 'reportProgressSummary');
                return Datatables::of($data)
                    ->addColumn('action', function ($row) {
                        $btn = '<div class="group-buttons categories-progress-view">
                                    <a href="' . route('admin.view-performance', $row->id) . '" class="new-campaign-button-view">View</a>';
                        if(empty($row->reportProgressSummary)){
                            $btn .= '<a href="javascript:;" class="new-campaign-button-active" onclick="deleteReport('.$row->id.',this)">Delete</a>';
                                    }
                        $btn .= '</div>';
                        return $btn;
                    })
                    ->addColumn('project_name_en', function ($row) {
                        return $row->project->project_name_en;
                    })
                    ->addColumn('project_name_ar', function ($row) {
                        return $row->project->project_name_ar;
                    })
                    ->rawColumns(['action', 'project_name_en', 'project_name_ar'])
                    ->make(true);
            }
            return view('admin.performance.performance');
        }
        // if investor
//        $reports = InvestorInvestments::select('*')
//            ->join('reports', 'reports.project_id', '=', 'investor_investments.project_id')
//            ->join('report_documents', 'reports.id', '=', 'report_documents.report_id')
//            ->join('report_progress', 'reports.id', '=', 'report_progress.report_id')
//            ->join('report_progress_summary', 'reports.id', '=', 'report_progress_summary.report_id')
//            ->join('funding_campaigns', 'reports.project_id', '=', 'funding_campaigns.project_id')
//            ->join('funding_phases', 'funding_campaigns.id', '=', 'funding_phases.funding_campaign_id')
//            ->where('investor_investments.user_id', auth()->user()->id)
//            ->get();
        $reports = InvestorInvestments::select('*')
            ->addSelect(DB::raw("sum(investor_investments.no_of_shares - investor_investments.sold_shares) as total_shares"))
            ->join('funding_campaigns', 'funding_campaigns.project_id', '=', 'investor_investments.project_id')
            ->rightJoin('reports', 'reports.project_id', '=', 'investor_investments.project_id')
            ->where('user_id', auth()->user()->id)
            ->orderBy('reports.created_at', 'DESC')
            ->groupBy('investor_investments.project_id')
            ->get();
        return view('investor.performance.performance')->with('reports', $reports);

    }

    public function createNewReport(Request $request)
    {

        $projects = Project::with('fundingCampaigns')->has('fundingCampaigns')->get();
        return view('admin.performance.create', compact('projects'));
    }

    public function getProjectDates(Request $request)
    {

        $project_dates = FundingCampaigns::where('project_id', $request->project_id)->first();

        return response()->json([
            'status' => true,
            'data' => $project_dates
        ]);
    }

    public function viewPerformance($id)
    {

        $report = Report::with('project', 'reportProgressSummary', 'reportProgress', 'reportDocuments')->where('id', $id)->first();
        $settings = Settings::first();
        $campaign = FundingCampaigns::where('project_id', $report->project_id)->orderBy('created_at', 'DESC')->first();
        $data['status'] = date('Y-m-d', strtotime($campaign->starting_period)) < date('Y-m-d') ? __('home.LIVE') : __('home.COMING SOON');
        $data['no_of_investors'] = InvestorInvestments::where('project_id', $report->project_id)->whereRaw('no_of_shares - sold_shares > 0')->count();
        $data['funds_raised'] = getProjectFunds($report->project_id);
        $data['project_info'] = Project::find($report->project_id);
        $data['ownership'] = ($data['funds_raised'] / $data['project_info']['projectFunding']['funding_required']) * 100;
        $data['subscription_fees'] = number_format($data['project_info']['projectFunding']['subscription_fee'] + (($settings->vat / 100) * $data['project_info']['projectFunding']['subscription_fee']), 2);
        $data['capital_invested'] = $data['funds_raised'];
        $data['units_owned'] = InvestorInvestments::where('project_id', $report->project_id)->sum(\DB::raw('no_of_shares - sold_shares'));
        $data['project_id'] = $report->project_id;

        $projects = Project::all();
        return view('admin.performance.edit', compact('report', 'projects', 'data'));
    }

    public function storeReport(Request $request)
    {
        $validate_data = [
            'project_id' => 'required',
            'performance_report_type' => 'required',
//            'report_type' => 'required',
        ];

        $validator = Validator::make($request->all(), $validate_data);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        }

        $investment_required = ProjectFundings::where('project_id', $request->project_id)->pluck('funding_required')->first();
        $investror_investments = InvestorInvestments::select('*')
            ->addSelect(DB::raw("investor_investments.no_of_shares - investor_investments.sold_shares as total_shares, project_fundings.price_per_share * sum(investor_investments.no_of_shares - investor_investments.sold_shares) as total_amount"))
            ->join('project_fundings', 'investor_investments.project_id', '=', 'project_fundings.project_id')
            ->where('investor_investments.project_id', $request->project_id)
            ->get();
        if ($investror_investments[0]->total_amount < $investment_required) {
            return response()->json([
                'status' => false,
                'error' => "You cannot create the report unless all shares are sold."
            ], 200);
        }

        $report = new Report();
        $report->project_id = $request->project_id;
        $report->performance_report_type = $request->performance_report_type;
//        $report->report_type = $request->report_type;
        $report->to = date('Y-m-d', strtotime($request->perf_to));
        $report->from = date('Y-m-d', strtotime($request->perf_from));
        $report->save();

        if ($report) {

            $settings = Settings::first();
            $campaign = FundingCampaigns::where('project_id', $request->project_id)->orderBy('created_at', 'DESC')->first();
            $data['status'] = date('Y-m-d', strtotime($campaign->starting_period)) < date('Y-m-d') ? __('home.LIVE') : __('home.COMING SOON');
            $data['no_of_investors'] = InvestorInvestments::where('project_id', $request->project_id)->whereRaw('no_of_shares - sold_shares > 0')->count();
            $data['funds_raised'] = getProjectFunds($request->project_id);
            $data['project_info'] = Project::find($request->project_id);
            $data['ownership'] = ($data['funds_raised'] / $data['project_info']['projectFunding']['funding_required']) * 100;
            $data['subscription_fees'] = number_format($data['project_info']['projectFunding']['subscription_fee'] + (($settings->vat / 100) * $data['project_info']['projectFunding']['subscription_fee']), 2);
            $data['capital_invested'] = $data['funds_raised'];
            $data['units_owned'] = InvestorInvestments::where('project_id', $request->project_id)->sum(\DB::raw('no_of_shares - sold_shares'));
            $data['project_id'] = $request->project_id;

            return response()->json([
                'status' => true,
                'data' => $data,
                'report_info' => $report,
                'message' => 'Report Created Successfully.'
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }

    }

    public function storeProgress(Request $request)
    {

        $validate_data = [
            'progress_type.*' => 'required',
            'progress_percentage.*' => 'required|numeric|min:1|',
            'date.*' => 'required',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        } else {

            try {

                $count = count($request->progress_type);
                for ($i = 0; $i < $count; $i++) {
                    $progress_report = new ReportProgress();
                    $progress_report->report_id = $request->report_id;
                    $progress_report->progress_type = $request->progress_type[$i];
                    $progress_report->progress_percentage = $request->progress_percentage[$i];
                    $progress_report->date = $request->date[$i];
                    $progress_report->save();
                    if ($request->hasFile('document_image')) {
                        if (isset($request->document_image[$i])) {
                            $fileName = time() . rand(1, 50) . '.' . $request->document_image[$i]->extension();
                            $request->document_image[$i]->move(public_path('project-reports'), $fileName);

                            ReportProgress::where('id', $progress_report->id)->update(['image_name' => $request->file_name[$i], 'image_path' => $fileName]);
                        }
                    }
                }
                return response()->json([
                    'status' => true,
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'error' => $e->getMessage()
                ]);
            }
        }
    }

    public function storeProgressReportSummary(Request $request)
    {
        try {
            $data = $request->all();
//            dd($data);
            //Removing comma from the values
            foreach ($data as $key => $request) {
                $data[$key] = str_replace(',', '', $request);
            }
            $report_summary = ReportProgressSummary::create($data);
            $all_investors = InvestorInvestments::selectRaw('*,(no_of_shares - sold_shares) as total_shares')
                ->where(['project_id' => $data['project_id']])
                ->having('total_shares', '>', 0)
                ->whereAdminApproved(1)
                ->whereStatus(1)
//              ->groupBy('project_id', 'user_id')
                ->get();
            foreach ($all_investors as $key => $investor) {
                $user_wallet = UserWallets::whereUser_id($investor->user_id)->first();
                $amount_invested = $investor->total_shares * $investor->projects->projectFunding->price_per_share;
                if ($data['report_type'] == 'equity') {
                    $ownership_percentage = number_format(($amount_invested / $data['capital_invested'] ?? $data['amount_raised_debt']) * 100, 4);
                    if ($investor->projects->is_sold == 1) {
                        $total_dividends = round(($ownership_percentage / 100) * $data['total_dividends'], 0);
                        $profit_loss = round(($ownership_percentage / 100) * $data['profit_loss'], 0);
                        $amount_tobe_added = ($amount_invested) + ($total_dividends) + ($profit_loss);
                        $user_wallet->added_amount = $user_wallet->added_amount + ($amount_tobe_added);
                        $user_wallet->save();
                        $wallet_logs = new WalletLogs();
                        $wallet_logs->user_id = $investor->user_id;
                        $wallet_logs->project_id = $investor->projects->id;
                        $wallet_logs->amount = $amount_tobe_added;
                        $wallet_logs->dividends = $total_dividends;
                        $wallet_logs->sale_profit = $profit_loss;
                        $wallet_logs->realized = $total_dividends + $profit_loss;
                        $wallet_logs->unrealized = 0;
                        $wallet_logs->type = 'credit';
                        $wallet_logs->save();

                        // Logging in transactions Table
                        $transactions = new Transactions();
                        $transactions->transaction_type = 'dividends received';
                        $transactions->user_id = $investor->user_id;
                        $transactions->project_id = $investor->projects->id;
                        $transactions->amount = $total_dividends;
                        $transactions->save();
                    } else {
                        $total_dividends = round(($ownership_percentage / 100) * $data['total_dividends'], 0);
                        $realized = $data['realized'] * ($ownership_percentage / 100);
                        $unrealized = $data['unrealized'] * ($ownership_percentage / 100);
                        $amount_tobe_added = ($total_dividends);
                        $user_wallet->added_amount = $user_wallet->added_amount + ($amount_tobe_added);
                        $user_wallet->save();
                        $wallet_logs = new WalletLogs();
                        $wallet_logs->user_id = $investor->user_id;
                        $wallet_logs->project_id = $investor->projects->id;
                        $wallet_logs->amount = $amount_tobe_added;
                        $wallet_logs->dividends = $total_dividends;
                        $wallet_logs->sale_profit = 0;
                        $wallet_logs->realized = $realized;
                        $wallet_logs->unrealized = $unrealized;
                        $wallet_logs->type = 'credit';
                        $wallet_logs->save();

                        // Logging in transactions Table
                        $transactions = new Transactions();
                        $transactions->transaction_type = 'dividends received';
                        $transactions->user_id = $investor->user_id;
                        $transactions->amount = $total_dividends;
                        $transactions->project_id = $investor->projects->id;
                        $transactions->save();
                    }
                } else {
                    $ownership_percentage = number_format(($amount_invested / $data['amount_raised_debt']) * 100, 4);
                    if ($investor->projects->is_sold == 1) {
                        $muraba_rate = str_replace('%', '', $data['murabha_rate_debt']);
                        $amount_tobe_added = (($muraba_rate / 100) * $amount_invested) + $amount_invested;
                        $user_wallet->added_amount = $user_wallet->added_amount + ($amount_tobe_added);
                        $user_wallet->save();
                        $wallet_logs = new WalletLogs();
                        $wallet_logs->user_id = $investor->user_id;
                        $wallet_logs->project_id = $investor->projects->id;
                        $wallet_logs->amount = $amount_tobe_added;
                        $wallet_logs->dividends = 0;
                        $wallet_logs->sale_profit = 0;
                        $wallet_logs->realized = 0;
                        $wallet_logs->unrealized = 0;
                        $wallet_logs->interest_recieved = (($muraba_rate / 100) * $amount_invested);
                        $wallet_logs->interest_tobe_recieved = 0;
                        $wallet_logs->type = 'credit';
                        $wallet_logs->save();
                    } else {
//                        $amount_tobe_added = round($data['installment_recieved_debt'] * ($ownership_percentage / 100));
                        $amount_tobe_added = round($data['profit_amount_received_debt'] * ($ownership_percentage / 100));
                        $interest_tobe_recieved = round($data['unrealized_profit_debt'] * ($ownership_percentage / 100));
                        $user_wallet->added_amount = $user_wallet->added_amount + ($amount_tobe_added);
                        $user_wallet->save();
                        $wallet_logs = new WalletLogs();
                        $wallet_logs->user_id = $investor->user_id;
                        $wallet_logs->project_id = $investor->projects->id;
                        $wallet_logs->amount = $amount_tobe_added;
                        $wallet_logs->dividends = 0;
                        $wallet_logs->sale_profit = 0;
                        $wallet_logs->realized = 0;
                        $wallet_logs->unrealized = 0;
                        $wallet_logs->interest_recieved = $amount_tobe_added;
                        $wallet_logs->interest_tobe_recieved = $interest_tobe_recieved;
                        $wallet_logs->type = 'credit';
                        $wallet_logs->save();
                    }
                }
            }
            return response()->json([
                'status' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }

    }

    public function storeAttachedDocuments(Request $request)
    {
        try {
            // dd($request);
            foreach ($request->prospectus as $key => $prospectus) {
                $documents = new ReportDocuments();
                $documents->report_id = $request->report_id;
                $documents->prospectus = $prospectus;
                $documents->save();
                if ($request->hasFile('doc_upload')) {
                    if (isset($request->doc_upload[$key])) {
                        $fileName = time() . rand(1, 50) . '.' . $request->doc_upload[$key]->extension();
                        $request->doc_upload[$key]->move(public_path('project-documents'), $fileName);
                        ReportDocuments::where('id', $documents->id)->update(['file_name' => $request->doc_name[$key], 'file_path' => $fileName]);
                    }
                }
            }
            return response()->json([
                'status' => true,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }

    }

    public function updateAttachedDocuments(Request $request)
    {
        $all_data = $request->all();
        $validate_data = [
            'prospectus.*' => 'required',
            'doc_upload.*' => 'required|mimes:doc,docx,pdf',
            'prospectus.*' => 'required'
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        } else {

            try {
                if (isset($request->prospectus_old)) {
                    foreach ($request->prospectus_old as $key => $name) {
                        $document = ReportDocuments::where('id', $request->document_id[$key])->first();
                        if (!empty($request->doc_upload_old[$key])) {
                            $fileName = time() . rand(1, 50) . '.' . $request->doc_upload_old[$key]->extension();
                            $request->doc_upload_old[$key]->move(public_path('project-documents'), $fileName);
                            $document->file_path = $fileName;
                        }
                        $document->prospectus = $name;
                        $document->file_name = $request->doc_name_old[$key];
                        $document->created_at = now();
                        $document->updated_at = now();
                        $document->save();
                    }
                }
                if (isset($request->prospectus)) {
                    foreach ($request->prospectus as $key => $name) {
                        $document = new ReportDocuments();
                        if (!empty($request->doc_upload[$key])) {
                            $fileName = time() . rand(1, 50) . '.' . $request->doc_upload[$key]->extension();
                            $request->doc_upload[$key]->move(public_path('project-documents'), $fileName);
                            $document->file_path = $fileName;
                        }
                        $document->report_id = $request->report_id;
                        $document->prospectus = $name;
                        $document->file_name = $request->doc_name[$key];
                        $document->created_at = now();
                        $document->updated_at = now();
                        $document->save();
                    }
                }

                return response()->json([
                    'status' => true,
                    'error' => "Project Documents Saved Successfully",
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'error' => $e->getMessage(),
                ], 422);
            }

            Session::flash('success', "Project Documents Saved Successfully!");
            return redirect()->back();
        }
    }

    public function updateReport(Request $request)
    {
        try {
            Report::where('id', $request->report_id)->update($request->except(['_token', 'report_id']));
            return response()->json([
                'status' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function updateDevelopmentProgress(Request $request)
    {

        // dd($request);
        $validate_data = [
            'progress_type.*' => 'required',
            'progress_percentage.*' => 'required|numeric|max:100',
            'date.*' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        }
        try {

            if (isset($request->progress_type_old)) {
                foreach ($request->progress_type_old as $key => $progress) {
                    $report_progress = ReportProgress::where('id', $request->progress_id[$key])->first();
                    if (!empty($request->document_image_old[$key])) {
                        $imageName = time() . rand(1, 50) . '.' . $request->document_image_old[$key]->extension();
                        $request->document_image_old[$key]->move(public_path('project-reports'), $imageName);
                        $report_progress->image_path = $imageName;
                    }
                    $report_progress->progress_type = $progress;
                    $report_progress->progress_percentage = $request->progress_percentage_old[$key];
                    $report_progress->date = $request->date_old[$key];
                    $report_progress->image_name = $request->file_name_old[$key];
                    $report_progress->save();
                }
            }

            if (isset($request->progress_type)) {
                foreach ($request->progress_type as $key => $name) {
                    $document = new  ReportProgress();
                    $document->report_id = $request->report_id;
                    $document->progress_type = $request->progress_type[$key];
                    $document->progress_percentage = $request->progress_percentage[$key];
                    $document->date = $request->date[$key];
                    $document->created_at = now();
                    $document->updated_at = now();
                    $document->save();
                }
            }

            return response()->json([
                'status' => true,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 422);
        }

    }

    public function updateProgressReportSummary(Request $request)
    {

        try {

            ReportProgressSummary::where('report_id', $request->report_id)->update($request->except(['_token', '_method']));
            return response()->json([
                'status' => true,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }

    }

    public function removeDevelopmentProgress(Request $request)
    {

        ReportProgress::find($request->id)->delete();
        return response()->json([
            'status' => true,
            'error' => "Development Progress Removed Successfully"
        ], 200);

    }

    public function removeAttachedDocument(Request $request)
    {

        ReportDocuments::find($request->id)->delete();
        return response()->json([
            'status' => true,
            'error' => "Document Removed Successfully"
        ], 200);
    }

    public function generatePDF($report_id)
    {
        try {
            $report = Report::select('*')
                ->with('project', 'reportDocuments', 'reportProgress', 'reportProgressSummary')
                ->findorfail($report_id);
            $funding_campaign = FundingCampaigns::whereProjectId($report->project_id)->first();
//            dd($report, $funding_campaign);
//            return view('investor.pdf')->with('report', $report)->with('funding_campaign', $funding_campaign);
            $pdf = \PDF::loadView('investor.pdf', ['report' => $report, 'funding_campaign' => $funding_campaign]);
            $pdf->setOption('enable-javascript', true);
            $pdf->setOption('enable-smart-shrinking', true);
            $pdf->setOption('enable-local-file-access', true);
            $pdf->setOption('no-stop-slow-scripts', true);
            $pdf->setOption('encoding', 'UTF-8');
            $pdf->setOption('enable-external-links', true);
            // $pdf->setOption('user-style-sheet', 'public/css/main2.css');
            return $pdf->download('progress_report' . $report->project_id . '.pdf');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function getProjectInfo(Request $request)
    {
        try {
//            $project = Project::with('fundingCampaigns')->find($request->project_id);
            $project = Project::select('*')
                ->selectRaw('funding_campaigns.starting_period as fc_start, funding_campaigns.ending_period as fc_end')
                ->join('funding_campaigns', 'projects.id', 'funding_campaigns.project_id')
                ->join('investor_investments', 'projects.id', 'investor_investments.project_id')
                ->where('investor_investments.status', 1)
                ->where('projects.id', $request->project_id)
                ->get();
            dd($project);

            return response()->json([
                'status' => true,
                'error' => "Success",
                'data' => $project
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function performanceReportDetails(Request $request)
    {
        try {
            $total_investments = 0;
            $total_shares = 0;
            $report = Report::with('reportProgressSummary')->findorfail($request->report_id);
            $investor_investments = InvestorInvestments::where(['project_id' => $report->project_id, 'user_id' => auth()->user()->id])
                ->whereRaw('no_of_shares - sold_shares > 0')
                ->get();
            $project = Project::findorfail($report->project_id);
            foreach ($investor_investments as $investor_investment) {
                $total_investments += ($investor_investment->no_of_shares - $investor_investment->sold_shares) * $project->projectFunding->price_per_share;
                $total_shares += $investor_investment->no_of_shares - $investor_investment->sold_shares;
            }
            $data['report_type'] = ucfirst($report->reportProgressSummary->report_type);
            $data['period'] = ucfirst($report->performance_report_type);
            //Values for Equity Starts
            if ($report->reportProgressSummary->report_type == 'equity') {
                $data['fund_raised'] = getProjectFunds($report->project_id);
                $ownership_percentage = ($total_investments / $data['fund_raised']) * 100;
                $data['unit_price'] = $project->projectFunding->price_per_share;
                $data['total_units'] = $project->projectFunding->no_of_shares;
                $data['ownership_percentage'] = number_format($ownership_percentage, 4) . '%';
                $data['subscription_fee'] = $project->projectFunding->subscription_fee;
                $data['capital_invested'] = $total_investments;
                $data['units_owned'] = $total_shares;
                $data['app_depp'] = number_format($report->reportProgressSummary->app_dep, 2) . '%';
                $data['investment_value'] = number_format($data['capital_invested'] * (1 + ($report->reportProgressSummary->app_dep / 100)), 2);
                $data['unit_value'] = number_format($data['unit_price'] * (1 + ($report->reportProgressSummary->app_dep / 100)), 2);
                $data['returns'] = round(($ownership_percentage / 100) * $report->reportProgressSummary->total_dividends);
                $data['dividends_return'] = number_format(round(($data['returns'] / $total_investments) * 100, 2), 2) . '%';

                $data['sale_value'] = $report->reportProgressSummary->sale_value * ($ownership_percentage / 100);
                $data['realized_gain'] = $report->reportProgressSummary->realized_gain . '%';
                $data['profit_loss'] = $report->reportProgressSummary->profit_loss * ($ownership_percentage / 100);

                $data['realized'] = round($report->reportProgressSummary->realized * ($ownership_percentage / 100), 2);
                if ($project->is_sold == 0) {
                    $data['unrealized'] = round($report->reportProgressSummary->unrealized * ($ownership_percentage / 100), 2);
                }
            } else {
                $data['fund_value_debt'] = $report->reportProgressSummary->fund_value_debt;
                $data['amount_raised_debt'] = $report->reportProgressSummary->amount_raised_debt;
                $data['unit_price_debt'] = $report->reportProgressSummary->unit_price_debt;
                $data['total_units_debt'] = $report->reportProgressSummary->total_units_debt;
                $data['lending_amount_debt'] = $report->reportProgressSummary->lending_amount_debt;
                $data['murabha_rate_debt'] = $report->reportProgressSummary->murabha_rate_debt;
                $data['total_period_debt'] = $report->reportProgressSummary->total_period_debt;
                $data['payment_requency_debt'] = $report->reportProgressSummary->payment_requency_debt;
                $data['total_installments_debt'] = $report->reportProgressSummary->total_installments_debt;
                $data['ownership_from_fund_debt'] = ($total_investments / $report->reportProgressSummary->amount_raised_debt) * 100;
                $data['installment_recieved_debt'] = number_format($report->reportProgressSummary->installment_recieved_debt * ($data['ownership_from_fund_debt'] / 100), 0);
                $data['principle_amount_received_debt'] = number_format($report->reportProgressSummary->principle_amount_received_debt * ($data['ownership_from_fund_debt'] / 100), 0);
                $data['profit_amount_received_debt'] = number_format($report->reportProgressSummary->profit_amount_received_debt * ($data['ownership_from_fund_debt'] / 100), 0);
                $data['no_of_installments_received_debt'] = $report->reportProgressSummary->no_of_installments_received_debt;
                $data['next_installment_debt'] = $report->reportProgressSummary->next_installment_debt;
                $data['remaining_balance_debt'] = round($report->reportProgressSummary->remaining_balance_debt * ($data['ownership_from_fund_debt'] / 100));
                $data['remaining_period_debt'] = $report->reportProgressSummary->remaining_period_debt;
                $data['roi_debt'] = round($report->reportProgressSummary->roi_debt);
                $data['subscription_fees_debt'] = round($report->reportProgressSummary->subscription_fees_debt);
                $data['capital_invested_debt'] = $total_investments;
                $data['installment_received_debt'] = $data['installment_recieved_debt'];
                $data['roi_returns_debt'] = (str_replace(',', '', $data['profit_amount_received_debt']) / $total_investments) * 100;
                $data['roi_amount_debt'] = number_format($report->reportProgressSummary->roi_amount_debt * ($data['ownership_from_fund_debt'] / 100), 0);
                $data['loss_of_principle'] = $report->reportProgressSummary->loss_of_principle;
            }
            return response()->json([
                'status' => true,
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteReport(Request $request){
        try {
            $report = Report::find($request->id)->delete();
            if($report){
                return response()->json([
                    'status' => true,
                    'data' => 'Report Successfully Deleted'
                ], 200);
            } else{
                return response()->json([
                    'status' => false,
                    'data' => "Report Not Found"
                ], 402);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
