@extends('layouts.view')

@section('table_view')
    @include('errors.list')
    {!! Form::open(['action' => ['CategoryController@postNew'], 'method'=>'post', 'class'=>'form-horizontal']) !!}


    <div class="form-group">
        {!! Form::label('name', 'Name of category', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-10">
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('status', 'Active', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-10">
            {!! Form::checkbox('status') !!}
        </div>
    </div>
    {!! Form::token() !!}

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {!! Form::submit('Create category', ['class'=>'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}


@endsection

