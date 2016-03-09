@extends('layouts.view')

@section('table_view')
   @include('errors.list')
    {!! Form::model($subject, ['action' => ['SubjectController@patchEdit', $subject->id], 'method'=>'PATCH', 'class'=>'form-horizontal']) !!}


   <div class="form-group">
       {!! Form::label('name', 'Name of subject', ['class'=>'col-md-2 control-label']) !!}
       <div class="col-md-7">
           {!! Form::text('name', null, ['class'=>'form-control']) !!}
       </div>
   </div>
   <div class="form-group">
       {!! Form::label('categories', 'Categories', ['class'=>'col-md-2 control-label']) !!}
       <div class="col-md-5">
           {!! Form::select('categories',$categories, $selectedCategoryId,  [ 'class'=>'form-control']) !!}
       </div>
   </div>
   <div class="form-group">
       {!! Form::label('duration', 'Duration', ['class'=>'col-md-2 control-label']) !!}
       <div class="col-md-4">
           <div class="input-group">
               {!! Form::text('duration', null, ['class'=>'form-control']) !!}
               <span class="input-group-addon">MINUTES</span>
           </div>
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
            {!! Form::submit('Update subject', ['class'=>'btn btn-primary']) !!}
       </div>
   </div>
    {!! Form::close() !!}
@endsection

