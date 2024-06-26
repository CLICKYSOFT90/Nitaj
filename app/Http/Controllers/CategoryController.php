<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Str;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends BaseController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<div class="group-buttons categories-progress-view">
                                <a href="'.route('admin.category.edit', $row->id).'" class="new-campaign-button-view">Edit</a>
                                <a href="javascript:;" class="new-campaign-button-active" onclick="delete_cat('.$row->id.')">Delete</a>
                              </div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function categoryList()
    {
        return view('admin.category.category');
    }
    public function addCategory()
    {
        return view('admin.category.addCategory');
    }
    public function postAddCategory(Request $request)
    {
//        $message = [
//            'nat_id.required' => 'The national id field is required.',
//            'dob.required' => 'The date of birth field is required.'
//        ];
        $validate_data = [
            'name_en' => 'required|max:50',
            'name_ar' => 'required|max:50',
            'prop_type_en' => 'required',
            'prop_type_ar' => 'required',
        ];

        $validator = Validator::make($request->all(),$validate_data);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $slug = Str::slug($request->name_en, '-');
            $category = new Category();
            $category->name_en = $request->name_en;
            $category->name_ar = $request->name_ar;
            $category->slug = $slug;
            $category->property_type_en = $request->prop_type_en;
            $category->property_type_ar = $request->prop_type_ar;
            $category->save();
            Session::flash('success', "Category Added Successfully!");
            return redirect()->route('admin.category');
        }
    }
    public function editCategory(Category $category)
    {
        return view('admin.category.editCategory')->with('cat', $category);
    }
    public function postEditCategory(Request $request)
    {
        $validate_data = [
            'name_en' => 'required',
            'name_ar' => 'required',
            'prop_type_en' => 'required',
            'prop_type_ar' => 'required',
        ];

        $validator = Validator::make($request->all(),$validate_data);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $slug = Str::slug($request->name_en, '-');
            $category = Category::find($request->cat_id);
            $category->name_en = $request->name_en;
            $category->name_ar = $request->name_ar;
            $category->slug = $slug;
            $category->property_type_en = $request->prop_type_en;
            $category->property_type_ar = $request->prop_type_ar;
            $category->save();
            Session::flash('success', "Category Updated Successfully!");
            return redirect()->route('admin.category');
        }
    }

    public function deleteCategory(Request $request)
    {
        Category::findorfail($request->cat_id)->delete();
        return response()->json([
            'status' => true,
            'error' => "Category Deleted Successfully",
        ], 200);
    }
}
