<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Post;
use App\Thread;
use Illuminate\Http\Request;
use App\Models\Dispatch;
use Auth;


class ThreadController extends Controller
{
    

    public function delete($thread_id)
    {
        $thread = Thread::findOrFail($thread_id);
        $thread->delete();

        return redirect()->route('threads.index',['topic_id' => $thread->topic->id , 'topic_title' => $thread->topic->title]);
    }

    public function index ($id,$topic_name)
    {
        $topic = Topic::findOrFail($id);
        $threads = Thread::all();
        $threads = Topic::where('id',$id)->get()->first()->threads()->paginate(2);
        
        return view('threads.index',['topic'=>$topic,'threads'=>$threads]);
    }

    public function create($topic_id)
    {
        $topic = Topic::findOrFail($topic_id);
        return view('threads.create',['topic'=>$topic]);
    }

    public function store(Request $request, $topic_id)
    {
        $validData = $request->validate([
            'user_id' => 'required|integer',
            'title' => 'required|max:30',
            'content'=> 'required|max:255',
        ]);

        $topic = Topic::findOrFail($topic_id);

        $newThread = new Thread;

        $newThread -> creator_id = Auth::user()->id;
        $newThread -> title = $validData['title'];
        $newThread -> topic_id = $topic->id;
        $newThread -> thread_type = "question";
        $newThread -> solved_status = null;
    
        $newThread->save();

        $newPost = new Post;

        $newPost -> parent_id = null;
        $newPost -> user_id = $validData['user_id'];
        $newPost -> thread_id = $newThread->id;
        $newPost -> content = $validData['content'];
        $newPost -> upvotes = 0;
        $newPost -> downvotes = 0;
        $newPost -> image = null;
        $newPost -> solution = null;

        $newPost->save();

        return redirect()->route('threads.index',['topic_id' => $topic->id,'topic_title' => $topic->title]);

    }
}
