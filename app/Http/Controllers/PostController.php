<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Post;
use App\Topic;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index($thread_id,$thread_title)
    {
        $thread = Thread::findOrFail($thread_id);
        $topic = Topic::findOrFail($thread->topic->id);

        $posts = Post::where('parent_id',NULL)->where('thread_id',$thread_id)->get();
        return view('posts.index', compact('posts'),['thread'=>$thread]);
    }

    public function create($parent_post_id)
    {
        $post = Post::findOrFail($parent_post_id);
        return view('posts.create',['post'=>$post]);
    }

    public function edit($post_id)
    {
        $post = Post::findOrFail($post_id);
        return view('posts.edit',['post'=>$post]);
    }

    public function delete($post_id)
    {
        $post = Post::findOrFail($post_id);
        $post->delete();

        return redirect()->route('posts.index',['thread_id' => $post->thread->id , 'thread_title' => $post->thread->topic->title]);
    }

    public function update(Request $request, $post_id)
    {
        $validData = $request->validate([
            'user_id' => 'required|integer',
            'content'=> 'required|max:255',
        ]);

        $post = Post::findOrFail($post_id);

        $post->content = $request->content;
        $post->save();


        return redirect()->route('posts.index',['thread_id' => $post->thread->id , 'thread_title' => $post->thread->topic->title]);

    }

    public function store(Request $request, $post_id)
    {
        $validData = $request->validate([
            'user_id' => 'required|integer',
            'content'=> 'required|max:255',
        ]);

        

        $parentPost = Post::findOrFail($post_id);

        $newPost = new Post;

        $newPost -> parent_id = $post_id;
        $newPost -> user_id = $validData['user_id'];
        $newPost -> thread_id = $parentPost->thread->id;
        $newPost -> content = $validData['content'];
        $newPost -> upvotes = 0;
        $newPost -> downvotes = 0;
        $newPost -> image = null;
        $newPost -> solution = null;

        $newPost->save();


        return redirect()->route('posts.index',['thread_id' => $parentPost->thread->id , 'thread_title' => $parentPost->thread->topic->title]);

    }



}
