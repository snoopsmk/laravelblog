<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\User;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show', 'posts');
    }

    public function index() 
    {
        $posts = Post::latest()->paginate(5);
        return view('index', compact('posts'));
    }

    public function posts() 
    {
        $posts = Post::latest()->paginate(5);
        return view('index', compact('posts'));
    }

    public function user($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->post = $user->post->reverse();
        return view('posts.user')->with('posts', $user->post)->with('user', $user);
    }

    public function create() 
    {
        return view('posts.create');
    }

    public function store(Request $request) 
    {
        // Validate
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'post_image' => 'image|nullable|max:1999'
        ]);

          // Handle file upload
          if($request->hasFile('post_image')){
            // Get filename and extension
            $filenameWithExt = $request->file('post_image')->getClientOriginalName();
            // Get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('post_image')->getClientOriginalExtension();    
            //File name to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload image
            $path = $request->file('post_image')->storeAs('public/post_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'default_image.jpg';
        }

        // Create new post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->post_image = $fileNameToStore;
        $post->save();

        return redirect('/blog')->with('success', 'Post successfully created!');
    }

    public function show($id) 
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function edit($id) 
    {
        $post = Post::findOrFail($id);

        // Only the creator of the post can edit it
        if(auth()->user()->id !== $post->user->id)
            return redirect('/blog')->with('error', 'You have no access to edit the post!');

        return view('posts.edit', compact('post', 'user'));
    }

    public function update(Request $request, $id)
    {
        // Validate
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'post_image' => 'image|nullable|max:1999'
        ]);

        // Handle file upload
        if($request->hasFile('post_image')){
            // Get filename and extension
            $filenameWithExt = $request->file('post_image')->getClientOriginalName();
            // Get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('post_image')->getClientOriginalExtension();    
            //File name to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload image
            $path = $request->file('post_image')->storeAs('public/post_images', $fileNameToStore);
        }

        // Fetch the data and edit the post
        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('post_image')){
            $post->post_image = $fileNameToStore;
        }
        $post->save();

        return redirect('/blog')->with('success', 'Post successfully updated!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Only the creator of the post can delete it
        if(auth()->user()->id !== $post->user->id)
            return redirect('/blog')->with('error', 'You have no access to delete the post!');

        if($post->post_image != 'default_image') {
            // Delete image
            Storage::delete('public/post_images'.$post->post_image);
        }    

        $post->delete();

        return redirect('/blog')->with('success', 'Post successfully deleted.');
    }
}
