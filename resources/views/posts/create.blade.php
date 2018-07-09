@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-2"></div> 
    <div class="col-8">
    <h1 class="text-center">Create Post</h1>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title:')}}
            {{Form::text('title', '', ['class' => 'form-control', 'required' => 'required'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body:')}}
            {{Form::textarea('body', '', ['class' => 'form-control ckeditor', 'required' => 'required'])}}
        </div>
        <div class="form-group">  
            {{ Form::file('post_image') }}
        </div>
        <hr>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
    <div class="col-2"></div> 
</div>
@endsection