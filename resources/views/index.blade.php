@extends('layouts.app')

@section('content')
    @guest
        <div class="row">
            <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="text-center mt-3">
                        <h1 class="p-1">Welcome</h1>
                        <h3 class="p-1">This is a blog aplication made with Laravel!</h3>
                    </div>
                    <div class="text-center p-2">
                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-info">Register</a>
                    </div>
                </div>
            <div class="col-md-2"></div>
        </div>
    @else
        <div class="row">
            <div class="col-md-8">
                <div class="card mt-4 mb-4">
                    <h2 class="card-header">All Posts</h2>
                </div>
                @foreach($posts as $post)
                    <div class="card mt-4 mb-4">
                        <div class="card-body">
                            <h2 class="card-title">{{$post->title}}</h2>
                            <hr>
                            <img src="/storage/post_images/{{$post->post_image}}" style="width:100%">
                            <p class="card-text">{!! $post->body !!}</p>
                            <a href="/blog/{{$post->id}}" class="btn btn-primary">Read More &rarr;</a>
                        </div>
                        <div class="card-footer text-muted">
                            Posted on {{ \Carbon\Carbon::parse($post->created_at)->format('d.m.Y') }}
                            by <a href="/blog/user/{{$post->user->id}}">{{$post->user->name}}</a>
                        </div>
                    </div>
                @endforeach
            </div> 
            @include('inc.sidebar')
            {{ $posts->links() }}
        </div> 
    @endguest
@endsection