<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Cities;
use App\Models\Company;
use App\Models\Countries;
use App\Models\FundingCampaigns;
use App\Models\InvestorInvestments;
use App\Models\Project;
use App\Models\ProjectDocuments;
use App\Models\ProjectFundings;
use App\Models\ProjectImages;
use App\Models\ProjectSponsors;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProjectsController extends BaseController
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Project::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('funding_required', function ($row) {
                    return !empty($row->projectFunding->funding_required) ? $row->projectFunding->funding_required : '';
                })
                ->addColumn('investment_period', function ($row) {
                    return !empty($row->projectFunding->investment_period) ? $row->projectFunding->investment_period . ' Year' : '';
                })
                ->addColumn('no_of_shares', function ($row) {
                    return !empty($row->projectFunding->no_of_shares) ? $row->projectFunding->no_of_shares : '';
                })
                ->addColumn('created_at', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at));
                })
                ->addColumn('marked_as', function ($row) {
                    if ($row->is_sold == 0) {
                        $div = '<div class="group-buttons categories-progress-view text-left">
                                    <a href="javascript:;" class="new-campaign-button-view" onclick="markAsSold(' . $row->id . ',1)">Mark As Sold</a>
                                </div>';
                    } else {
                        $div = '<div class="group-buttons categories-progress-view text-left">
                                    <a href="javascript:;" class="new-campaign-button-active">Sold</a>
                                </div>';
                    }
                    return $div;
                })
                ->addColumn('sold_at', function ($row) {
                    return !empty($row->sold_at) ? date('d-M-Y', strtotime($row->sold_at)) : '-';
                })
                ->addColumn('action', function ($row) {
                    $class = $row->status == 1 ? 'new-campaign-button-active' : 'new-campaign-button-view';
                    $status = $row->status == 1 ? 'Active' : 'Not Active';
                    $statuschange = $row->status == 1 ? 0 : 1;
                    $div = '<div class="group-buttons categories-progress-view text-left">
                            <a href="' . route('admin.projects.view', $row->id) . '" class="new-campaign-button-view">View</a>
                            <a href="' . route('admin.projects.edit', $row->id) . '" class="new-campaign-button-view">Edit</a>
                            <a href="javascript:;" onclick="changeStatus(' . $row->id . ',' . $statuschange . ')" class="' . $class . '">' . $status . '</a>
                            </div>';
                    return $div;
                })
                ->rawColumns(['funding_required', 'investment_period', 'no_of_shares', 'created_at', 'action', 'marked_as'])
                ->make(true);
        }
    }

    public function getCities(Request $request)
    {
        $option = '';
        $cities = Cities::select('id', 'name')->where('country_id', $request->country_id)->get();
        foreach ($cities as $city) {
            $option .= '<option value="' . $city->id . '">' . $city->name . '</option>';
        }
        return response()->json([
            'status' => true,
            'data' => $option,
        ]);
    }

    public function projectsList()
    {
        return view('admin.projects.projects');
    }

    public function addProjects()
    {
        $countries = Countries::all();
        $categories = Category::all();
        $companies = Company::whereStatus(1)->get();
        $cities = Cities::wherecountry_id(194)->get();
        return view('admin.projects.addProjects')->with('countries', $countries)
            ->with('categories', $categories)
            ->with('companies', $companies)
            ->with('cities', $cities);
    }

    public function addProjectInfo(Request $request)
    {
        $validate_data = [
            'project_name_en' => 'required',
            'project_name_ar' => 'required',
            'country' => 'required',
            'company_id' => 'required',
            'city' => 'required',
            'category' => 'required',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        } else {
            $project = new Project();
            $project->project_name_en = $request->project_name_en;
            $project->project_name_ar = $request->project_name_ar;
            $project->company_id = $request->company_id;
            $project->country = $request->country;
            $project->city = $request->city;
            $project->category_id = $request->category;
            $project->save();
            return response()->json([
                'status' => true,
                'error' => "Project Saved Successfully",
                'data' => $project->id
            ], 200);
            Session::flash('success', "Project Added Successfully!");
            return redirect()->back();
        }
    }

    public function editProjectInfo(Request $request)
    {
        $validate_data = [
            'project_name_en' => 'required',
            'project_name_ar' => 'required',
            'country' => 'required',
            'company_id' => 'required',
            'city' => 'required',
            'category' => 'required',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        } else {
            $project = Project::find($request->project_id);
            $project->project_name_en = $request->project_name_en;
            $project->project_name_ar = $request->project_name_ar;
            $project->company_id = $request->company_id;
            $project->country = $request->country;
            $project->city = $request->city;
            $project->category_id = $request->category;
            $project->save();
            return response()->json([
                'status' => true,
                'error' => "Project Saved Successfully",
                'data' => $project->id
            ], 200);
            Session::flash('success', "Project Added Successfully!");
            return redirect()->back();
        }
    }

    public function addProjectDetails(Request $request)
    {
        $validate_data = [
            'proj_type_en' => 'required',
            'proj_type_ar' => 'required',
            'asset_type_en' => 'required',
            'asset_type_ar' => 'required',
            'proj_intro_en' => 'required',
            'proj_intro_ar' => 'required',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        } else {
            $project = Project::find($request->project_id);
            $project->project_type_en = $request->proj_type_en;
            $project->project_type_ar = $request->proj_type_ar;
            $project->asset_type_en = $request->asset_type_en;
            $project->asset_type_ar = $request->asset_type_ar;
            $project->project_intro_en = $request->proj_intro_en;
            $project->project_intro_ar = $request->proj_intro_ar;
            $project->save();
            return response()->json([
                'status' => true,
                'error' => "Project Details Saved Successfully",
            ], 200);
            Session::flash('success', "Project Details Added Successfully!");
            return redirect()->back();
        }
    }

    public function editProjectDetails(Request $request)
    {
        $validate_data = [
            'proj_type_en' => 'required',
            'proj_type_ar' => 'required',
            'asset_type_en' => 'required',
            'asset_type_ar' => 'required',
            'proj_intro_en' => 'required',
            'proj_intro_ar' => 'required',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        } else {
            $project = Project::find($request->project_id);
            $project->project_type_en = $request->proj_type_en;
            $project->project_type_ar = $request->proj_type_ar;
            $project->asset_type_en = $request->asset_type_en;
            $project->asset_type_ar = $request->asset_type_ar;
            $project->project_intro_en = $request->proj_intro_en;
            $project->project_intro_ar = $request->proj_intro_ar;
            $project->save();
            return response()->json([
                'status' => true,
                'error' => "Project Details Saved Successfully",
            ], 200);
            Session::flash('success', "Project Details Added Successfully!");
            return redirect()->back();
        }
    }

    public function addProjectLocation(Request $request)
    {
        $validate_data = [
            'location' => 'required',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        } else {
            $project = Project::find($request->project_id);
            $project->project_location = $request->location;
            $project->save();
            return response()->json([
                'status' => true,
                'error' => "Project Location Saved Successfully",
                'data' => $project->id
            ], 200);
            Session::flash('success', "Project Location Saved Successfully!");
            return redirect()->back();
        }
    }

    public function addProjectFunding(Request $request)
    {
        $data = $request->all();
        $validate_data = [
            'funding_required' => 'required',
            'min_investment' => [
                'required',
                function ($attribute, $value, $fail) use ($data) {
                    if ($value > $data['funding_required']) {
                        return $fail("Minimum investment should not be greater than funding required.");
                    }
                }
            ],
            'no_of_shares' => 'required',
            'price_per_share' => 'required',
            'projected_roi' => 'required|integer',
            'investment_period' => 'required',
            'structure' => 'required',
            'subscription_fee' => 'required',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        } else {
            $project_funding = new ProjectFundings();
            $project_funding->project_id = $request->project_id;
            $project_funding->funding_required = $request->funding_required;
            $project_funding->min_investment = $request->min_investment;
            $project_funding->no_of_shares = $request->no_of_shares;
            $project_funding->price_per_share = $request->price_per_share;
            $project_funding->project_roi = $request->projected_roi;
            $project_funding->investment_period = $request->investment_period;
            $project_funding->structure = $request->structure;
            $project_funding->subscription_fee = $request->subscription_fee;
            $project_funding->dividend_frequency = $request->dividend_frequency;
            $project_funding->dividend_yield = $request->dividend_yield;
            $project_funding->save();
            return response()->json([
                'status' => true,
                'error' => "Project Funding Saved Successfully",
                'data' => $project_funding->id
            ], 200);
            Session::flash('success', "Project Location Saved Successfully!");
            return redirect()->back();
        }
    }

    public function editProjectFunding(Request $request)
    {
        $data = $request->all();
        $validate_data = [
            'funding_required' => 'required',
            'min_investment' => [
                'required',
                function ($attribute, $value, $fail) use ($data) {
                    if ($value > $data['funding_required']) {
                        return $fail("Minimum investment should not be greater than funding required.");
                    }
                }
            ],
            'no_of_shares' => 'required',
            'price_per_share' => 'required',
            'projected_roi' => 'required|integer',
            'investment_period' => 'required',
            'structure' => 'required',
            'subscription_fee' => 'required',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        } else {
            $project_funding = ProjectFundings::where('project_id', $request->project_id)->first();
            if (empty($project_funding)) {
                $project_funding = new ProjectFundings();
            }
            $project_funding->project_id = $request->project_id;
            $project_funding->funding_required = $request->funding_required;
            $project_funding->min_investment = $request->min_investment;
            $project_funding->no_of_shares = $request->no_of_shares;
            $project_funding->price_per_share = $request->price_per_share;
            $project_funding->project_roi = $request->projected_roi;
            $project_funding->investment_period = $request->investment_period;
            $project_funding->structure = $request->structure;
            $project_funding->subscription_fee = $request->subscription_fee;
            $project_funding->dividend_frequency = $request->dividend_frequency;
            $project_funding->dividend_yield = $request->dividend_yield;
            $project_funding->save();
            return response()->json([
                'status' => true,
                'error' => "Project Funding Updated Successfully",
                'data' => $project_funding->id
            ], 200);
            Session::flash('success', "Project Funding Updated Successfully!");
            return redirect()->back();
        }
    }

    public function addProjectSponsor(Request $request)
    {
        $all_data = $request->all();
        $validate_data = [
            'company_name.*' => 'required',
            'company_title.*' => 'required',
            'company_info.*' => 'required',
            'sponsor_upload.*' => 'required|mimes:jpg,png,jpeg',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        } else {
            foreach ($request->company_name as $key => $name) {
                if ($request->hasFile('sponsor_upload')) {
                    $fileName = time() . rand(1, 50) . '.' . $request->sponsor_upload[$key]->extension();
                    $request->sponsor_upload[$key]->move(public_path('project-sponsors'), $fileName);
                }
                $sponsor[] = [
                    'project_id' => $request->project_id,
                    'company_name' => $name,
                    'title' => $request->company_title[$key],
                    'desc' => $request->company_info[$key],
                    'filename' => $fileName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            ProjectSponsors::insert($sponsor);
            return response()->json([
                'status' => true,
                'error' => "Project Sponsors Saved Successfully",
            ], 200);
            Session::flash('success', "Project Sponsors Saved Successfully!");
            return redirect()->back();
        }
    }

    public function editProjectSponsor(Request $request)
    {
        $all_data = $request->all();
        $validate_data = [
            'company_name.*' => 'required',
            'company_title.*' => 'required',
            'company_info.*' => 'required',
            'sponsor_upload.*' => 'required|mimes:jpg,png,jpeg',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        } else {
//            dd($all_data);
            if (isset($request->company_name_old)) {
                foreach ($request->company_name_old as $key => $name) {
                    $sponsor = ProjectSponsors::where('id', $request->sponsor_id[$key])->first();
                    if (!empty($request->sponsor_upload_old[$key])) {
                        $fileName = time() . rand(1, 50) . '.' . $request->sponsor_upload_old[$key]->extension();
                        $request->sponsor_upload_old[$key]->move(public_path('project-sponsors'), $fileName);
                        $sponsor->filename = $fileName;
                    }
                    $sponsor->project_id = $request->project_id;
                    $sponsor->company_name = $name;
                    $sponsor->title = $request->company_title_old[$key];
                    $sponsor->desc = $request->company_info_old[$key];
                    $sponsor->created_at = now();
                    $sponsor->updated_at = now();
                    $sponsor->save();
                }
            }
            if ($request->hasFile('sponsor_upload')) {
                foreach ($request->company_name as $key => $name_old) {
                    $fileName = time() . rand(1, 50) . '.' . $request->sponsor_upload[$key]->extension();
                    $request->sponsor_upload[$key]->move(public_path('project-sponsors'), $fileName);
                    $sponsor_new[] = [
                        'project_id' => $request->project_id,
                        'company_name' => $name_old,
                        'title' => $request->company_title[$key],
                        'desc' => $request->company_info[$key],
                        'filename' => $fileName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                ProjectSponsors::insert($sponsor_new);
            }
            return response()->json([
                'status' => true,
                'error' => "Project Sponsors Saved Successfully",
            ], 200);
            Session::flash('success', "Project Sponsors Saved Successfully!");
            return redirect()->back();
        }
    }

    public function removeProjectSponsor(Request $request)
    {
        ProjectSponsors::find($request->id)->delete();
        return response()->json([
            'status' => true,
            'error' => "Project Sponsor Removed Successfully"
        ], 200);
    }

    public function addProjectDoc(Request $request)
    {
        $all_data = $request->all();
        $validate_data = [
            'doc_name.*' => 'required',
            'doc_upload.*' => 'required',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        } else {
            foreach ($request->doc_name as $key => $name) {
                if ($request->hasFile('doc_upload')) {
//                    $fileName = $name . '.' . $request->doc_upload[$key]->extension();
                    $fileName = $name;
                    $request->doc_upload[$key]->move(public_path('project-doc'), $fileName);
                }
                $doc[] = [
                    'project_id' => $request->project_id,
                    'doc_name' => $fileName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            ProjectDocuments::insert($doc);
            return response()->json([
                'status' => true,
                'error' => "Project Documents Saved Successfully",
                'redirect' => route('admin.projects'),
            ], 200);
            Session::flash('success', "Project Documents Saved Successfully!");
            return redirect()->back();
        }
    }

    public function editProjectDoc(Request $request)
    {
        $all_data = $request->all();
        $validate_data = [
            'doc_name.*' => 'required',
            'doc_upload.*' => 'required',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        } else {
            if ($request->hasFile('doc_upload_old')) {
                foreach ($request->doc_upload_old as $key => $file) {
//                    $fileName = $request->doc_name_old[$key] . '.' . $request->doc_upload_old[$key]->extension();
                    $fileName = $request->doc_name_old[$key];
                    $request->doc_upload_old[$key]->move(public_path('project-doc'), $fileName);
                    $doc_old = [
                        'project_id' => $request->project_id,
                        'doc_name' => $fileName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    ProjectDocuments::where('id', $request->doc_id[$key])->update($doc_old);
                }
            }
            if ($request->hasFile('doc_upload')) {
                foreach ($request->doc_name as $key => $name) {
//                    $fileName = $name . '.' . $request->doc_upload[$key]->extension();
                    $fileName = $name;
                    $request->doc_upload[$key]->move(public_path('project-doc'), $fileName);
                }
                $doc[] = [
                    'project_id' => $request->project_id,
                    'doc_name' => $fileName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                ProjectDocuments::insert($doc);
            }
            return response()->json([
                'status' => true,
                'error' => "Project Documents Saved Successfully",
            ], 200);
            Session::flash('success', "Project Documents Saved Successfully!");
            return redirect()->back();
        }
    }

    public function removeProjectDoc(Request $request)
    {
        ProjectDocuments::find($request->id)->delete();
        return response()->json([
            'status' => true,
            'error' => "Project Document Removed Successfully"
        ], 200);
    }

    public function addProjectUploads(Request $request)
    {
        $all_data = $request->all();
        $validate_data = [
            'file_name.*' => 'required',
            'visual_upload.*' => 'required|mimes:jpg,png,jpeg',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        } else {
            foreach ($request->file_name as $key => $name) {
                if ($request->hasFile('visual_upload')) {
                    $fileName = $name . '.' . $request->visual_upload[$key]->extension();
                    $request->visual_upload[$key]->move(public_path('project-visual-uploads'), $fileName);
                }
                $doc[] = [
                    'project_id' => $request->project_id,
                    'filename' => $fileName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            ProjectImages::insert($doc);
            return response()->json([
                'status' => true,
                'error' => "Project Uploads Saved Successfully",
            ], 200);
            Session::flash('success', "Project Uploads Saved Successfully!");
            return redirect()->back();
        }
    }

    public function editProjectUploads(Request $request)
    {
        $validate_data = [
            'file_name.*' => 'required',
            'visual_upload.*' => 'required|mimes:jpg,png,jpeg',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        } else {
            if ($request->hasFile('visual_upload_old')) {
                foreach ($request->visual_upload_old as $key => $file) {
                    $fileName = $request->file_name_old[$key] . '.' . $request->visual_upload_old[$key]->extension();
                    $request->visual_upload_old[$key]->move(public_path('project-visual-uploads'), $fileName);
                    $doc = [
                        'project_id' => $request->project_id,
                        'filename' => $fileName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    ProjectImages::where('id', $request->uploads_id[$key])->update($doc);
                }
            }
            if ($request->hasFile('visual_upload')) {
                foreach ($request->file_name as $key => $name) {
                    $fileName = $name . '.' . $request->visual_upload[$key]->extension();
                    $request->visual_upload[$key]->move(public_path('project-visual-uploads'), $fileName);
                    $doc[] = [
                        'project_id' => $request->project_id,
                        'filename' => $fileName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                ProjectImages::insert($doc);
            }
            return response()->json([
                'status' => true,
                'error' => "Project Uploads Saved Successfully",
            ], 200);
            Session::flash('success', "Project Uploads Saved Successfully!");
            return redirect()->back();
        }
    }

    public function removeProjectUploads(Request $request)
    {
        ProjectImages::find($request->id)->delete();
        return response()->json([
            'status' => true,
            'error' => "Project Uploads Removed Successfully"
        ], 200);
    }

    public function editProjects(Project $projects)
    {
        $countries = Countries::all();
        $categories = Category::all();
        $cities = Cities::where('country_id', $projects->country)->get();
        $companies = Company::whereStatus(1)->get();
        if (Route::currentRouteName() !== 'admin.projects.view') {
            $campaign = FundingCampaigns::where(['project_id' => $projects->id, 'status' => 1])->first();
            if($campaign){
                if ($campaign->starting_period <= date('Y-m-d')) {
                    Session::flash('alert', "You cannot edit the project once the campaign is live.");
                    return redirect()->back();;
                }
            } else{
                return view('admin.projects.editProjects')
                    ->with('countries', $countries)
                    ->with('cities', $cities)
                    ->with('categories', $categories)
                    ->with('projects', $projects)
                    ->with('companies', $companies);
            }
        }
        return view('admin.projects.editProjects')
            ->with('countries', $countries)
            ->with('cities', $cities)
            ->with('categories', $categories)
            ->with('projects', $projects)
            ->with('companies', $companies);
    }

    public function postEditProjects(Request $request)
    {
        $validate_data = [
            'name_en' => 'required',
            'name_ar' => 'required',
            'company_type_en' => 'required',
            'company_type_ar' => 'required',
            'location' => 'required',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $slug = Str::slug($request->name_en, '-');
            $category = Company::find($request->company_id);
            $category->name_en = $request->name_en;
            $category->name_ar = $request->name_ar;
            $category->slug = $slug;
            $category->company_type_en = $request->company_type_en;
            $category->company_type_ar = $request->company_type_ar;
            $category->location = $request->location;
            $category->added_on = now();
            $category->added_by = auth::user()->id;
            $category->save();
            Session::flash('success', "Company Updated Successfully!");
            return redirect()->back();
        }
    }

    public function deleteProjects($id)
    {
        Company::findorfail($id)->delete();
        Session::flash('success', "Company Deleted!");
        return redirect()->back();
    }

    public function changeStatusProject(Request $request)
    {
        $project = Project::find($request->id);
        $project->status = $request->status;
        $project->save();
        return response()->json([
            'status' => true,
            'error' => 'Status Change Successfully.'
        ], 200);
    }

    public function projectSold(Request $request)
    {
        $project = Project::find($request->id);
        $total_shares = $project->projectFunding->no_of_shares;
        $sold_shares = InvestorInvestments::select('*')
            ->addSelect(DB::raw("sum(investor_investments.no_of_shares - investor_investments.sold_shares) as total_shares"))
            ->where(['project_id' => $request->id])
            ->groupBy('project_id')
            ->get();
        if (count($sold_shares) == 0 && @$sold_shares[0]->total_shares < $total_shares) {
            return response()->json([
                'status' => false,
                'error' => 'Project shares is not fully sold.',
            ], 200);
        }
        $project->is_sold = $request->status;
        $project->sold_at = Carbon::now();
        $project->save();
        $data[] = [
            'to' => 0,
            'subject' => 'Project Sold',
            'purpose' => 'Project sold by admin',
            'desc' => 'Admin has sold the project "' . $project->proj_name_en . '"',
            'type' => 'project_sold'
        ];
        $this->notification($data);
        return response()->json([
            'status' => true,
            'error' => 'Project marked as sold successfully.',
            'redirect' => route('admin.create-new-report')
        ], 200);

    }
}
