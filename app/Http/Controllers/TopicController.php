<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Thread;
use Illuminate\Http\Request;
use Auth;


class TopicController extends Controller
{
    
    //Retutn all topics
    public function index()
    {
        $topics = Topic::all();
        return view('topics.index',['topics' => $topics]);
    }

    //Like a topic
    public function like($topic_id)
    {
         $user = Auth::user();
         $topic = Topic::findOrFail($topic_id);

         $user->likedTopics()->attach($topic);

         return redirect()->route('topics.index');
    }

    //Get all liked topics by user
    public function liked()
    {
         $user = Auth::user();
         $likedTopics = $user->likedTopics;

         return view('topics.likes',['likedTopics' => $likedTopics]);
    }

    //Create a new topic
    public function create()
    {
        return view('topics.create');
    }

    //Store a new topic
    public function store(Request $request)
    {
        $validData = $request->validate([
            'user_id' => 'required|integer',
            'title'=> 'required|max:255',
            'description'=> 'required|max:255',
        ]);

        $newTopic = new Topic;

        
        $newTopic -> creator_id = $validData['user_id'];
        $newTopic -> title = $validData['title'];
        $newTopic -> description = $validData['description'];


        $newTopic->save();


        return redirect()->route('topics.index');

    }

    //Store a new topic using AJAX
    public function apiStore(Request $request)
    {

        $request->validate([
            'title'=> 'required|max:255',
            'description'=> 'required|max:255',
        ]);


        

        $newTopic = new Topic;

            
        $newTopic -> creator_id = 1;
        $newTopic -> title = $request ->title;
        $newTopic -> description =  $request ->description;


        $newTopic->save();

        return $newTopic;
    }

    //Get all topics using AJAX
    public function apiIndex()
    {
        $topics = Topic::all();
        return $topics;
    }

}
