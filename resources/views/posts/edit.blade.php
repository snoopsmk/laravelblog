@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-2"></div> 
    <div class="col-8">
    <h1 class="text-center">Edit Post</h1>
    {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title:')}}
            {{Form::text('title', $post->title, ['class' => 'form-control', 'required' => 'required'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body:')}}
            {{Form::textarea('body', $post->body, ['class' => 'form-control ckeditor', 'required' => 'required'])}}
        </div>
        <div class="form-group">  
            {{Form::file('post_image')}}
        </div>
        <hr>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
    <div class="col-2"></div> 
</div>    
@endsection