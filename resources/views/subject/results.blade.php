@extends('layouts.view')

@section('table_view')
    @if($answers)
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>User Name</th>
                    <th>E-mail</th>
                    <th>Test name</th>
                    <th>Total Marks(%)</th>
                    <th>Time taken</th>
                    <th>Exam Date</th>
                </tr>
                </thead>
                @foreach($answers as $ans)
                    <tr>
                        <td>{{$ans->username}}</td>
                        <td>{{$ans->useremail}}</td>
                        <td>{{$ans->subjectname}}</td>
                        <td>{{ceil($ans->porcent)}}%</td>
                        <td>{{$ans->time}}</td>
                        <td>{{$ans->created_at}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
@stop


@section('pagination')

@endsection