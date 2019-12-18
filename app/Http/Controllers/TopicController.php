<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Thread;
use Illuminate\Http\Request;


class TopicController extends Controller
{
    
    public function index()
    {
        $topics = Topic::all();
        return view('topics.index',['topics' => $topics]);
    }

    public function create()
    {
        return view('topics.create');
    }

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


    public function apiIndex()
    {
        $topics = Topic::all();
        return $topics;
    }

}
