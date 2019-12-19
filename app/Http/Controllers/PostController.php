<?php

namespace App\Http\Controllers;

use App\Thread;
use Auth;
use App\Post;
use App\Topic;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;




class PostController extends Controller
{


    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);

        $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

        return $file;
    }

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
        $newPost -> user_id = Auth::user()->id;
        $newPost -> thread_id = $parentPost->thread->id;
        $newPost -> content = $validData['content'];
        $newPost -> upvotes = 0;
        $newPost -> downvotes = 0;

        if ($request->has('image')) {
            // Get image file
            $image = $request->file('image');
            // Make a image name based on user name and current timestamp
            $name = Str::slug($request->input('name')).'_'.time();
            // Define folder path
            $folder = '/uploads/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.jpg';
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $newPost->image = $filePath;
        }
        else{
            $newPost -> image = null;
        }
        
        $newPost -> solution = null;

        $newPost->save();


        return redirect()->route('posts.index',['thread_id' => $parentPost->thread->id , 'thread_title' => $parentPost->thread->topic->title]);

    }


    public function createAdmin()
    {
        $users = User::all();
        return view('admin.create',['users'=>$users]);
    }

    public function storeAdmin(Request $request)
    {
        $validData = $request->validate([
            'user_id' => 'required|integer',
        ]);
        $selectedUser = User::findOrFail($validData['user_id']);

        $selectedUser->account_type = 'admin';
        $selectedUser->save();

        return redirect()->route('topics.index');
    }


}
