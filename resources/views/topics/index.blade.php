@extends('layouts.app')

@section('title','Topic')

@section('content')
    <h1>The topics of the forum:</h1>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <div id="root">
        <ul style="list-style: none;">
            <li v-for="topic in topics">
                
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">@{{topic.title}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">@{{topic.created_at}}</h6>
                <p class="card-text">@{{topic.description}}.</p>
                <a  v-bind:href="'/threads/view/'+topic.id+'/'+topic.title">View Topic</a>
            </div>
            </div>
            <br>
                
            </li>
        </ul>

    @if (Auth::check())
    @if (Auth::user()->account_type == "admin")
    <button class="btn btn-primary" @click="showAddTopic">Add New Topic</button>
    @endif
    @endif
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
    <button class="btn btn-primary" @click="createTopic">Create</button>
    </div>



    </div>
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