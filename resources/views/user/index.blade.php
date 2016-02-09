@extends('layouts.view')

@section('table_view')
    @if(!$users->isEmpty())
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>User Name</th>
                    <th>E-mail</th>
                    <th>Created at</th>
                </tr>
                </thead>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
@stop