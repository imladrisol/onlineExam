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
        <div class="col-sm-offset-2 col-sm-10">
            {!! Form::submit('Create question', ['class'=>'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close()!!}

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
                                Collapsible Group Item #1
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>


            {{$question->question}}
        </div>
        @endforeach
    </div>
    @endif
@stop