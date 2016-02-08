@extends('layouts.view')

@section('table_view')
    <div class="row">
        <div class="col-md-offset-1 col-md-7">
            <h3>Subject name: {{$subject->name}}</h3>
            <h3>Category: {{$subject->category->name}}</h3>
            <h3>Duration: {{$subject->duration}} minutes</h3>

        </div>

    </div>
    <br>
    <button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left"></span> Back to subjects</button>
    <button type="button" class="btn btn-primary" id="btn-add-new-question"><span class="glyphicon glyphicon-plus"></span> Add new question</button>
<br><br><br>

    @include('errors.list')

    {!! Form::open(['action'=>['SubjectController@postNewQuestion', $subject->id], 'method'=>'POST', 'class'=>'form-horizontal', 'id'=>'add-new-question'])!!}
    @yield('form')

    @if(!$questions->isEmpty())
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading"><span class="glyphicon glyphicon-cog"></span> Questions added</div>

        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        @foreach($questions as $question)


                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Question #{{$question->id}}
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            {!! Form::model($question, ['action'=>['SubjectController@postEditQuestion', $question->id], 'method'=>'POST', 'class'=>'form-horizontal', 'id'=>'add-new-question'])!!}
                            @include('subject.formquestion')

                        </div>
                    </div>
                </div>



        </div>
        @endforeach
    </div>
    @endif
@stop