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
    <a class="btn btn-warning" href="{{action('SubjectController@getIndex')}}"><span class="glyphicon glyphicon-arrow-left"></span> Back to subjects</a>

    <button type="button" class="btn btn-primary" id="btn-add-new-question"><span class="glyphicon glyphicon-plus"></span> Add new question</button>
<br><br><br>

    @include('errors.list')

    {!! Form::open(['action'=>['SubjectController@postNewQuestion', $subject->id], 'method'=>'POST', 'class'=>'form-horizontal', 'id'=>'add-new-question'])!!}
    @include('subject.formquestion')

    @if(!$questions->isEmpty())
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading"><span class="glyphicon glyphicon-cog"></span> Questions added</div>

        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?php $i=0;?>
        @foreach($questions as $question)

            <?php $i++;?>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading{{$question->id}}">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$question->id}}" aria-expanded="false" aria-controls="collapse{{$question->id}}">
                                Question #{{$i}}
                            </a>
                        </h4>
                    </div>
                    <div id="collapse{{$question->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$question->id}}">
                        <div class="panel-body">
                            {!! Form::model($question, ['action'=>['SubjectController@postEditQuestion', $question->id], 'method'=>'POST', 'class'=>'form-horizontal', 'id'=>'add-new-question'])!!}
                            @include('subject.formquestion')

                        </div>
                    </div>
                </div>

        @endforeach
        </div>
    </div>
    @endif
@stop