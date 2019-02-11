<?php ?>
@extends('admin.layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Child Categories Management 
        <a href="{{ route('childCategories.create') }}" class="btn btn-success">
            <i class="fa fa-btn fa-plus"></i> 
            &nbsp;New Child Category
        </a>
    </div>
    <div class="panel-body">
        @include('flash::message')
        <table class="table table-striped table-bordered table-condensed">
            <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            @foreach ($categories as $key => $category)

                <tr class="categories-users">
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->category->title }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('childCategories.edit',$category->id) }}"><i class="fa fa-btn fa-edit"></i> Edit</a>

                        <form action="{{ url('backend/childCategories/'.$category->id) }}" method="POST" style="display: inline-block">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" id="delete-task-{{ $category->id }}" class="btn btn-danger">
                                <i class="fa fa-btn fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
{{ $categories->links() }}
@endsection