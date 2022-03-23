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
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Type\Collection;

class SubjectController extends Controller
{
    public function index(){
        $subjects = Subject::paginate(5);
        $title = "Subjects Listing";

        return view('subject.index', compact('subjects', 'title', 'categories'));
    }

    public function getNew(){

        $title = "Create New Subject";
        $categories = Category::lists('name', 'id');

        return view('subject.new', compact('title', 'categories'));
    }

    public function postNewSubject(SubjectRequest $req){
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
        $categories = Category::lists('name', 'id');
        return view('subject.edit', compact('subject', 'title', 'categories','selectedCategoryId'));
    }

    public function patchEdit($id, SubjectRequest $req){
        if($req->get('status') == null)
            $req['status'] = 0;
        $subject = Subject::findOrFail($id);
        $subject->category_id = $req->input('categories');
        $subject->update($req->all());
        session()->flash('flash_mess', 'Subject was changed completely');
        return redirect(action('SubjectController@getEdit', $subject->id));
    }

    public function getDelete($id){
        Subject::destroy($id);
        session()->flash('flash_mess', 'Subject  was deleted');
        return redirect(action('SubjectController@getIndex'));
    }

    public function getQuestions($id){
        $subject = Subject::findOrFail($id);
        $title = "Manage questions";
        $answer = ['1'=>1, '2'=>2,'3'=> 3,'4'=> 4];
        $questions = $subject->questions;
        $title_button = "Save question";
        return view('subject.questions', compact('subject', 'title', 'answer', 'questions', 'title_button'));
    }

    public function postNewQuestion($id, QuestionRequest $req){
        $subj = Subject::find($id);
        $quest = new Question($req->all());
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
        session()->forget('next_question_id');
        return view('subject.start', compact('subject'));
    }

    public function getStartTest($id){
        $subject = Subject::find($id);
        $questions = $subject->questions()->get();
        $first_question_id = $subject->questions()->min('id');
        $last_question_id = $subject->questions()->max('id');
        $duration = $subject->duration;
        if(session('next_question_id')){
            $current_question_id = session('next_question_id');
        }
        else{
            $current_question_id = $first_question_id;
            session(['next_question_id'=>$current_question_id]);
        }
        return view('subject.test', compact('subject', 'questions', 'current_question_id', 'first_question_id', 'last_question_id', 'duration'));
    }

    public function postSaveQuestionResult($id, Request $req){
        $subject = Subject::find($id);
        $question = Question::find($req->get('question_id'));
        if($req->get('option') != null){
            //save the answer to the table
            $duration = $subject->duration*60;
            $time_taken = ((int)$req->get('time_taken'.$question->id));
            $time_per_question = $duration - $time_taken;
            Answer::create([
                'user_id'=>Auth::user()->id,
                'question_id'=>$req->get('question_id'),
                'subject_id' => $id,
                'user_answer'=>$req->get('option'),
                'question' => $question->question,
                'option1' => $question->option1,
            'option2' => $question->option2,
            'option3' => $question->option3,
            'option4' => $question->option4,
            'right_answer'=>$question->answer,
                'time_taken'=>$time_per_question
            ]);
        }
        $next_question_id = $subject->questions()->where('id','>',$req->get('question_id'))->min('id');
        if($next_question_id != null) {
            return Response::json(['next_question_id' => $next_question_id]);
        }
        return redirect()->route('result',[$id]);
    }

    public function getShowResultOfSubjectForGuest($id){
        $subject = Subject::findOrFail($id);
        $answers = Answer::whereSubjectId($id)->get();
        if($answers->count()) {
            $cnt = $answers->count();
            $cnt_right_answ = 0;
            foreach ($answers as $a) {
                if ($a->user_answer == $a->right_answer)
                    $cnt_right_answ++;
            }
            $persetnages = ceil($cnt_right_answ * 100 / $cnt);
            $time_taken = date("H:i:s", strtotime(Answer::whereSubjectId($id)->orderBy('id', 'desc')->first()->time_taken));
            $title = 'Results of test';
            session()->flash('flash_mess', 'Your Exam data has been saved successfully');
            return view('subject.result', compact('subject', 'title', 'cnt', 'cnt_right_answ', 'persetnages', 'time_taken'));
        }
        else{
            return redirect('/');
        }
    }

    public function getAllSubjectsResults(){
        $title = 'Exams Results';
        $answers = DB::table('answers as t1')->
        select(DB::raw('
                t1.*, t2.*,t3.*,
                t2.name as username, t2.email as useremail, t3.name as subjectname,
                SUM(IF(t1.user_answer=t1.right_answer,1,0))/(
                SELECT COUNT(DISTINCT id) 
                FROM answers t1 GROUP BY subject_id)*100 AS porcent,
                max(time_taken) as time
            '))
           ->leftJoin('users as t2', function($join){
                $join->on('t1.user_id', '=','t2.id');
            })
            ->leftJoin('subjects as t3', function($join){
                $join->on('t1.subject_id', '=','t3.id');
           })->groupBy('t1.subject_id')->get();

        return view("subject.results", compact('title', 'answers'));
    }
}

