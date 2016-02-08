@extends('layouts.app')

@section('content')


    @if(Session::has('flash_mess'))
        <div class="alert alert-success">{{Session::get('flash_mess')}}</div>
    @endif

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading"><span class="glyphicon glyphicon-cog"></span> {{$title}}</div>

        @yield('table_view')



        <!--Pagination of results-->
    @yield('pagination')
    </div>

@endsection