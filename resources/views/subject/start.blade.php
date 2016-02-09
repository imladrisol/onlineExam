@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <h3>Subject Name: <b>{{$subject->name}}</b></h3>
        <h3>Duration: <b>{{$subject->duration}}</b></h3>

        <a class="btn btn-success btn-lg" href="{{action('SubjectController@getStartTest',$subject->id)}}" role="button">START EXAM</a>
    </div>
@stop