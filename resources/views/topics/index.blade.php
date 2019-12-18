@extends('layouts.app')

@section('title','Topic')

@section('content')
    <p>The topics of the forum:</p>
    <ul>
        @foreach ($topics as $topic)
            <li><a href="{{route ('threads.index', ['topic_id' => $topic->id, 'topic_title' => $topic->title]) }}">{{$topic->title}}</a></li>
        @endforeach
    </ul>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <div id="root">
        <ul>
            <li v-for="topic in topics">@{{topic.title}}, @{{topic.description}}</li>
            
        </ul>

        
    <button @click="showAddTopic">Add New Topic</button>

    <div v-if="show">
    <h2>New Topic</h2>
    <form>
    <p>Title: <input type="text" name="title"
            value="{{old('title')}}" v-model=newTopicTitle>
            <span v-if="allerros.title">@{{allerros.title[0] }}</span></p>

    <p>Desc: <input type="text" name="description"
            value="{{old('description')}}" v-model=newTopicDesc>
            <span v-if="allerros.description">@{{ allerros.description[0] }}</span></p>

       
        
    </form>
    <span v-if="success" >Record submitted successfully!</span>
    <button @click="createTopic">Create</button>
    <div>



    <div>
    <script>
        var app = new Vue({
            el: "#root",
            data: {
                topics: [],
                newTopicTitle: '',
                newTopicDesc: '',
                allerros: [],
                success : false,
                show : false,
            },

            mounted() {

                axios.get("{{route('api.topics.index')}}")
                .then(response =>{
                    this.topics = response.data;

                })
                .catch(response =>{
                    console.log(response);
                })

            }, 

            methods: {
                createTopic: function(){
                    axios.post("{{route('api.topics.store')}}",{
                        title: this.newTopicTitle,
                        description: this.newTopicDesc,
                        
                    })
                    .then(response =>{
                        this.topics.push(response.data);
                        this.newTopicTitle = '';
                        this.newTopicDesc = '';
                        this.allerros = [];
                        this.success = true;
                    })
                    .catch((error) =>{
                        this.allerros = error.response.data.errors;
                        this.success = false;
                    })
                },

                showAddTopic: function(){
                    if (this.show == true)
                    {
                        this.show = false;
                    }
                    else
                    {
                        this.show = true;
                    }
                }
            }
        });

        


    </script>
   

@endsection