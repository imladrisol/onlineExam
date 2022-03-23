<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\HttpResponse;
use Symfony\Component\HttpFoundation\Session\Flash;
class CategoryController extends Controller
{
    public function getIndex(){
        $categories = Category::paginate(5);
        $title = 'Categories Listing';
        return view('category.index', compact('categories', 'title'));
    }

    public  function getNew(){
        $title = "Create New Category";
        return view('category.new', compact('title'));
    }

    public function postNew(CategoryRequest $req){

        Category::create($req->all());
        session()->flash('flash_mess', 'Category was created completely');
        return redirect(action('CategoryController@getIndex'));
    }

    public function getEdit($id){
        $category = Category::findOrFail($id);
        $title = "Edit Category '{$category->name}'";
        return view('category.edit', compact('category', 'title'));
    }

    public function patchEdit($id, CategoryRequest $req){
        if($req->get('status') == null)
            $req['status'] = 0;
        $category = Category::findOrFail($id);
        $category->update($req->all());
        session()->flash('flash_mess', 'Category was changed completely');
        return redirect(action('CategoryController@getEdit', $category->id));
    }

    public function getDelete($id){
        Category::findOrFail($id)->delete();
        return redirect(action('CategoryController@getIndex'));
    }
}
