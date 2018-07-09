@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-2"></div> 
        <div class="col-8">
            <h1>{{$post->title}}</h1>
            <img src="/storage/post_images/{{$post->post_image}}" style="width:100%">
            <p>{!!$post->body!!}</p>
            <p>
                <small>Post created at {{ \Carbon\Carbon::parse($post->created_at)->format('d.m.Y') }}
                    by <a href="/blog/user/{{$post->user->id}}">{{$post->user->name}}</a></small>
            </p>
            <hr>
            @if(!Auth::guest())
                @if(Auth::user()->id == $post->user->id)
                    <a href="/blog/{{$post->id}}/edit" class="btn btn-info">Edit</a>
                    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => ' float-right'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return  confirm('Do you want to delete the post?')"])}}
                    {!!Form::close()!!}
                @endif
            @endif
        <div class="col-2"></div>
    </div>
@endsection