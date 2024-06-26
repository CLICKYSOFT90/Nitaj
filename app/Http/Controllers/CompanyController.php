<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Str;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends BaseController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Company::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $content = $row->status == '1' ? 'Active' : 'Deactive';
                    $status = $row->status == '1' ? 0 : 1;
                    $btn = '<div class="group-buttons categories-progress-view">
                                <a href="'.route('admin.company.edit', $row->id).'" class="new-campaign-button-view">Edit</a>
                                <a href="javascript:;" onclick="changeStatus('.$row->id.','.$status.')" class="new-campaign-button-active" >'.$content.'</a>
                              </div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function companyList()
    {
        return view('admin.company.company');
    }
    public function addCompany()
    {
        return view('admin.company.addCompany');
    }
    public function postAddCompany(Request $request)
    {
        $validate_data = [
            'name_en' => 'required',
            'name_ar' => 'required',
            'company_type_en' => 'required',
            'company_type_ar' => 'required',
            'location' => 'required',
        ];

        $validator = Validator::make($request->all(),$validate_data);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $slug = Str::slug($request->name_en, '-');
            $category = new Company();
            $category->name_en = $request->name_en;
            $category->name_ar = $request->name_ar;
            $category->slug = $slug;
            $category->company_type_en = $request->company_type_en;
            $category->company_type_ar = $request->company_type_ar;
            $category->location = $request->location;
            $category->added_on = now();
            $category->added_by = auth::user()->id;
            $category->save();
            Session::flash('success', "Company Added Successfully!");
            return redirect()->back();
        }
    }
    public function editCompany(Company $company)
    {
        return view('admin.company.editCompany')->with('cat', $company);
    }
    public function postEditCompany(Request $request)
    {
        $validate_data = [
            'name_en' => 'required',
            'name_ar' => 'required',
            'company_type_en' => 'required',
            'company_type_ar' => 'required',
            'location' => 'required',
        ];

        $validator = Validator::make($request->all(),$validate_data);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
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
            $category->status = $request->status;
            $category->save();
            Session::flash('success', "Company Updated Successfully!");
            return redirect()->back();
        }
    }

    public function statusCompany(Request $request)
    {
        $company = Company::findorfail($request->investor_id);
        if($company){
            $company->status = $request->status;
            $company->save();
            return response()->json([
                'status' => true,
                'error' => "Status Changed Successfully",
            ], 200);
        } else{
            return response()->json([
                'status' => true,
                'error' => "Oops! Something went wrong.",
            ], 200);
        }
    }
}
