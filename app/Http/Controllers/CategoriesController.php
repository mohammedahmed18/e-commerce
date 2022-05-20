<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    public function getAllCategories(){
        $categories = Category::all();
        return view('pages.dashboard.categories' , ['categories' => $categories]);
    }
    public function addCategory(Request $req){
        $validated = $req->validate([
            'category_name' => 'required|unique:categories,name|min:3',
        ]);
        $cat = new Category();
        $cat->name = $req->category_name;
        $cat->description = $req->category_description;
        $cat->save();
        Session::flash('toast-info' , 'Category "'.$cat->name.'" is added successfully');
        return redirect('/dashboard/categories');
    }
    
    public function deleteCategory($id){
        $cat = Category::find($id);
        if($cat->products->count() > 0){
            Session::flash('toast-error' , 'this category can\'t be deleted');
            return redirect('/dashboard/categories');
        }
        $cat->delete();
        Session::flash('toast-info' , 'Category "'.$cat->name.'" is deleted');
        return;
    }


    public function editPage($id){
        $category = Category::find($id);
        return view('pages.dashboard.category-edit',['category' => $category]);
    }
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if(!$category){
            http_response_code(404);
            return redirect('/404');
        }
        $request->validate([
            'category_name' => 'required|min:3|unique:categories,name,'. $category->id
        ]
    );
    // valid
    $category->name = $request->input('category_name');
    $category->description = $request->category_description;
    $category->save();
    Session::flash('toast-success' , 'category is updated');
    return redirect('/dashboard/categories');        
}



}
