@extends('layouts.view')

@section('table_view')
    @if(!$categories->isEmpty())
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>Category name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->name}}</td>
                        <td>
                            <h4>
                            @if($category->status == 1)
                                <span class="label label-success">Active
                             @else
                                        <span class="label label-warning">Inactivate
                                            @endif

                                </span>
                            </h4>
                        </td>
                        <td>
                            <a class="btn btn-warning" href="{{action('CategoryController@getEdit', [$category->id])}}">Edit</a>
                            <a class="btn btn-danger" id="btn-delete-category" href="{{action('CategoryController@getDelete', [$category->id])}}">Delete</a>
                        </td>

                    </tr>
                @endforeach

            </table>
        </div>
    @endif
@endsection

@section('pagination')
    {{$categories->links()}}
@endsection