@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        @if(count($posts) > 0)
            <div class="card mt-4 mb-4">
                <h2 class="card-header">My Posts</h2>
            </div>
            @foreach($posts as $post)
                <div class="card mt-4 mb-4">
                    <div class="card-body">
                        <h2 class="card-title">{{$post->title}}</h2>
                        <hr>
                        <img src="/storage/post_images/{{$post->post_image}}" style="width:100%">
                        <p class="card-text">{!! $post->body !!}</p>
                        <a href="/blog/{{$post->id}}" class="btn btn-primary">View Post</a>

                        {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return  confirm('Do you want to delete the post?')"])}}
                        {!!Form::close()!!}
                        <a href="/blog/{{$post->id}}/edit" class="btn btn-info float-right mr-1">Edit</a>
                    </div>
                    <div class="card-footer text-muted">
                        Posted on {{ \Carbon\Carbon::parse($post->created_at)->format('d.m.Y') }}
                        by <a href="/blog/user/{{$post->user->id}}">{{$post->user->name}}</a>
                    </div>
                </div>
            @endforeach
        @else 
                <h2>You have no posts yet!</h2>
        @endif
    </div>

    @include('inc.sidebar')

</div>
@endsection
