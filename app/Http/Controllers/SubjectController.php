<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Subject;
use App\Category;
use App\Http\Requests\SubjectRequest;
class SubjectController extends Controller
{
    public function getIndex(){

        $subjects = Subject::paginate(5);
        $title = "Subjects Listing";

        return view('subject.index', compact('subjects', 'title', 'categories'));
    }

    public function getNew(){
        $title = "Create New Subject";
        $categories = Category::lists('name', 'id');

        return view('subject.new', compact('title', 'categories'));
    }

    public function postNew(SubjectRequest $req){

        $subject = new Subject($req->all());
        $category = Category::find($req->input('categories'));
        $category->subjects()->save($subject);

        session()->flash('flash_mess', 'Subject was created completely');
        return redirect(action('SubjectController@getIndex'));
    }

    public function getEdit($id){
        $subject = Subject::findOrFail($id);
        $title = "Edit subject '{$subject->name}'";
        $selectedCategoryId = $subject->category()->lists('id')->all();
        //dd($selectedCategoryId);
        $categories = Category::lists('name', 'id');
        return view('subject.edit', compact('subject', 'title', 'categories','selectedCategoryId'));
    }

    public function patchEdit($id, SubjectRequest $req){
        if($req->get('status') == null)
            $req['status'] = 0;

       // dd($req);
        $subject = Subject::findOrFail($id);
        //dd($subject);
        $subject->category_id = $req->input('categories');
        $subject->update($req->all());
        /*$cat = $req->input('categories');
        $subject->category()->sync($cat);
        */

        session()->flash('flash_mess', 'Subject was changed completely');
        return redirect(action('SubjectController@getEdit', $subject->id));
    }

    public function getDelete($id){
        $subject = Subject::findOrFail($id);
        Subject::destroy($id);
        session()->flash('flash_mess', 'Subject  was deleted');
        return redirect(action('SubjectController@getIndex'));
    }

    public function getQuestions($id){
        $subject = Subject::findOrFail($id);
        $title = "Manage questions for '".$subject->name."' subject (Category: ".$subject->category->name.") ".$subject->duration." min ";
        $answers = [1, 2, 3, 4];
        $questions = Question::all();
        return view('subject.questions', compact('subject', 'title', 'answers', 'questions'));
    }


    public function postNewQuestion(){

    }
}
