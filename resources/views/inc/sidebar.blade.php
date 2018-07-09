<div class="col-md-4">
    <div class="card my-4">
        <h4 class="card-header">Howdy <strong>{{Auth::user()->name}}</strong>!</h4>
        <div class="card-body">
                <a href="/blog/create" class="btn btn-primary btn-lg btn-block">Create Post</a>
                <a href="/home" class="btn btn-info btn-lg btn-block">View My Posts</a>
        </div>
    </div>
</div> 