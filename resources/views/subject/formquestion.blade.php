

    <div class="form-group">
        {!! Form::label('question', 'Question:', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-7">
            {!! Form::textarea('question', null, ['class'=>'form-control', 'size'=>'30x3']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('option1', 'Option #1:', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-7">
            {!! Form::textarea('option1', null, ['class'=>'form-control', 'size'=>'30x3']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('option2', 'Option #2:', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-7">
            {!! Form::textarea('option2', null, ['class'=>'form-control', 'size'=>'30x3']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('option3', 'Option #3:', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-7">
            {!! Form::textarea('option3', null, ['class'=>'form-control', 'size'=>'30x3']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('option4', 'Option #4:', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-7">
            {!! Form::textarea('option4', null, ['class'=>'form-control', 'size'=>'30x3']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('answer', 'Answers:', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-2">
            {!! Form::select('answer',$answer, null,  [ 'class'=>'form-control']) !!}
        </div>
    </div>
    {!! Form::token() !!}
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-2">
            {!! Form::submit($title_button, ['class'=>'btn btn-primary']) !!}

        </div>
        @if(isset($question))
        <div class="col-sm-offset-1 col-sm-2">
            <a class="btn btn-danger" id="btn-delete" href="{{action('SubjectController@getDeleteQuestion', [$question->id])}}">Delete</a>

        </div>
        @endif
    </div>
    {!! Form::close()!!}

