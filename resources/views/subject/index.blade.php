@extends('layouts.view')

@section('table_view')
    @if(!$subjects->isEmpty())
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Subject Name</th>
                        <th>Category</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach($subjects as $subject)
                    <tr>
                        <td>{{$subject->name}}</td>
                        <td>{{$subject->category->name}}</td>
                        <td>{{$subject->duration}} mins</td>
                        <td>
                            <h4>
                            @if($subject->status == 1)
                                <span class="label label-success">Active
                             @else
                                        <span class="label label-warning">Inactivate
                                            @endif

                                </span>
                            </h4>
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{action('SubjectController@getQuestions', [$subject->id])}}">Manage Questions</a>
                            <a class="btn btn-warning" href="{{action('SubjectController@getEdit', [$subject->id])}}">Edit</a>
                            <a class="btn btn-danger" id="btn-delete" href="{{action('SubjectController@getDelete', [$subject->id])}}">Delete</a>
                        </td>

                    </tr>
                @endforeach

            </table>
        </div>
    @endif
@endsection

@section('pagination')
    {{$subjects->links()}}
@endsection