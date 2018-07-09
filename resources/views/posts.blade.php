@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-2"></div> 
        <div class="col-8">
            <h1 class="text-center mt-3">Blog Page</h1>
            <br>
            @foreach($posts as $post)
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">{{$post->title}}</h2>
                        <hr>
                        <img src="/storage/post_images/{{$post->post_image}}" style="width:100%">
                        <p class="card-text">{!! $post->body !!}</p>
                        <a href="/blog/{{$post->id}}" class="btn btn-primary">Read More &rarr;</a>
                    </div>
                    <div class="card-footer text-muted">
                        Posted on {{ \Carbon\Carbon::parse($post->created_at)->format('d.m.Y') }}
                        by <a href="#">{{$post->user->name}}</a>
                    </div>
                </div>
            @endforeach
            {{ $posts->links() }}
        </div>  
        <div class="col-2"></div> 
    </div>
@endsection