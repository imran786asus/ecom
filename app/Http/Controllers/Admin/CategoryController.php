<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::orderByDesc('id')->paginate(10);
        return view('admin.category.index',compact('categories'));
    }

    public function create(){
        $categories = Category::where('status',1)->orderByDesc('id')->get();
        return view('admin.category.create')->with(['categories'=>$categories]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'status'=> 'required',
            'parent_id'=>'nullable|exists:categories,id'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 400, 'error' => 'Invalid parameters', 'message' => $validator->errors()->first()], 400);
        }
        $category = new Category();
        $category->name = $request->get('name');
        $category->status = $request->get('status');
        $category->parent_id = $request->get('parent_id');
        $category->save();
        return response()->json(['status' => 200,'message' => 'Category created successfully.'], 200);
    }

    public function edit($id){
        $categories = Category::where('status',1)->orderByDesc('id')->get();
        $category = Category::find($id);
        if ($category){
            return view('admin.category.edit',compact('category','categories'));
        }else{
            return view('error-404');
        }
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'id'=> 'required',
            'name'=> 'required',
            'status'=> 'required',
            'parent_id'=>'nullable|exists:categories,id'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 400, 'error' => 'Invalid parameters', 'message' => $validator->errors()->first()], 400);
        }
        $category = new Category();
        $category->name = $request->get('name');
        $category->status = $request->get('status');
        $category->parent_id = $request->get('parent_id');
        $category->save();
        return response()->json(['status' => 200,'message' => 'Category updated successfully.'], 200);
    }

    public function destroy($id){
        $category = Category::find($id);
        if ($category){
            $category->delete();
            return response()->json(['status' => 200, 'message' => 'Category deleted successfully']);
        }else{
            return response()->json(['status' => 400, 'message' => 'Category not found']);
        }
    }
}
