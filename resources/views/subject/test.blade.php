@extends('layouts.app')

@section('content')
    <div id="counter1"></div>

@section('script_clock')
        $(function() {
            var clock = $('#counter1').FlipClock(600, {
                autoStart: false,
                countdown: true,
                clockFace: 'MinuteCounter',
                callbacks: {
                 interval: function () {
                 var time = clock.getTime().time;
                 //alert(time);
                @foreach($questions as $q)
                    $('#time_taken{{$q->id}}').val(time);
                @endforeach
                }
            }
            });
        clock.start();
        });

 @stop
@foreach($questions as $question)
    <div class="jumbotron" id="jumbotron{{$question->id}}"
            @if($question->id != $current_question_id)
                style="display: none;"
            @endif
            >
        <p>Question #{{$question->id}}</p>
        <p>{{$question->question}}</p>

        {!! Form::open(['action'=>['SubjectController@postSaveQuestionResult', $subject->id], 'method'=>'post', 'id'=>'frm'.$question->id]) !!}
        <ul id="answer-radio">
            <div class="btn-group" data-toggle="buttons">

                <li>
                    <label>
                        <input type="radio" name="option" value="1" /> {{$question->option1}}
                    </label>
                </li>
                    <li>
                        <label>
                            <input type="radio" name="option" value="2" /> {{$question->option2}}
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="radio" name="option" value="3" /> {{$question->option3}}
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="radio" name="option" value="4" /> {{$question->option4}}
                        </label>
                    </li>

            </div>
        </ul>

        {!! Form::input('hidden','question_id', $question->id) !!}
        {!! Form::input('hidden','time_taken'.$question->id,null,['id'=>'time_taken'.$question->id]) !!}

        {!! Form::token() !!}


    @if($question->id != $first_question_id)
            <!--a class="btn btn-info" href="#" id="previous-btn" role="button"><span class="glyphicon glyphicon-chevron-left"></span> Previous</a-->
        @endif
        <!--a class="btn btn-info" href="{{action('SubjectController@postSaveQuestionResult',[$subject->id])}}" role="button">Next <span class="glyphicon glyphicon-chevron-right"></span></a-->

        {!! Form::submit('Next', ['class'=>'btn btn-info']) !!}
        {!! Form::close() !!}
    </div>

@section('script_form')
    $(function() {


    $('#frm{!!$question->id!!}').on('submit', function(e){

            var form = $(this);
            var $formAction = form.attr('action');
            var $userAnswer = $('input[name=option]:checked', $('#frm{{$question->id}}')).val();

            $.post($formAction, $(this).serialize(), function(data){
                $('#jumbotron{!!$question->id!!}').hide();
                $('#jumbotron'+data.next_question_id).show();
           });

            e.preventDefault();
        });
    });

    $(function() {
        /*$('#counter1').countdown({
            startTime: "10:0",
            stepTime: 1,
            image: "{{asset('digits.png')}}",
    timerEnd: function(){
                alert('end!!');
                //redirect to somewhere
            }
        });*/

    $(function(){


    });
    });
@stop
@endforeach



@stop