<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Subject;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Answer;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\SubjectRequest;
use App\Http\Requests\QuestionRequest;
use App\Question;
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
        $title = "Manage questions";
        $answer = ['1'=>1, '2'=>2,'3'=> 3,'4'=> 4];
        $questions = $subject->questions;
        //dd($questions);
        return view('subject.questions', compact('subject', 'title', 'answer', 'questions'));
    }


    public function postNewQuestion($id, QuestionRequest $req){
        $subj = Subject::find($id);
        $quest = new Question($req->all());
        //dd($quest);
        $subj->questions()->save($quest);
        session()->flash('flash_mess', 'Question was added successfully.');
        return redirect(action('SubjectController@getQuestions', ['id'=>$subj->id]));
    }

    public function postEditQuestion($id, QuestionRequest $req){
        $question = Question::findOrFail($id);
        $question->update($req->all());

        session()->flash('flash_mess', 'Question #'.$question->id.' was changed completely');
        return redirect(action('SubjectController@getQuestions', $question->subject->id));
    }

    public function getDeleteQuestion($id){
        $subj_id = Question::find($id)->subject->id;
        Question::destroy($id);
        session()->flash('flash_mess', 'Question #'.$id.' was deleted');
        return redirect(action('SubjectController@getQuestions',$subj_id));

    }

    public function getBeforeStartTest($id){
        $subject = Subject::find($id);
        return view('subject.start', compact('subject'));
    }

    public function getStartTest($id){
        $subject = Subject::find($id);
        $questions = $subject->questions()->get();
        $first_question_id = $subject->questions()->min('id');


        if(session('next_question_id')){
            $current_question_id = session('next_question_id');
        }
        else{
            $current_question_id = $first_question_id;
            session(['next_question_id'=>$current_question_id]);
        }
        return view('subject.test', compact('subject', 'questions', 'current_question_id', 'first_question_id'));
    }


    public function postSaveQuestionResult($id, Request $req){
        //save result
        $subject = Subject::find($id);
        $question = Question::find($req->get('question_id'));
       // dd($question);
        //dd($req->all());
        if($req->get('option') != null){
            //dd(Auth::user()->id);
            //dd($id);
            //dd();
            //save the answer into table
            Answer::create([
                'subject_id' => $id,
                'user_answer'=>$req->get('option'),
                'question' => $question->question,
                'option1' => $question->option1,
            'option2' => $question->option2,
            'option3' => $question->option3,
            'option4' => $question->option4,
            'right_answer'=>$question->answer
            ]);
        }

        $previous_question_id = $subject->questions()->where('id','<',$req->get('question_id'))->max('id');
        $next_question_id = $subject->questions()->where('id','>',$req->get('question_id'))->min('id');
        return [/*'previous_question_id'=>$previous_question_id,*/'next_question_id'=>$next_question_id];
    }

    public function getUpdateQuestionResult(){

    }

    public function postUpdateQuestionResult(){

    }
}
