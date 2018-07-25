@extends('layouts.app')

@section('content')
        @if(isset($tag))
        <h1 style="text-align:center">Posts about <span style="color:red">{{$tag}}</span></h1>
        @else
        <h1 style="text-align:center">POSTS</h1>
        @endif
        @if($posts->count()==0)
            <h3 style="color:red;text-align:center;margin-top:20%;">No posts found.</h3>
        @else
        @foreach($posts as $post)
            <a href="/posts/{{$post->id}}">
                <div class="post" style="width:100%;height:100px;padding:10px;cursor:pointer;transition:0.3s background-color;">
                    <div style="width:19%;height:100%;display:inline-block;vertical-align:top">
                        @if(file_exists('storage/'.$post->image))
                            <img src="{{asset('storage/'.$post->image)}}" style="width:100%;height:100%">
                        @else
                            <h3 style="text-align:center;line-height:75px;width:100%;height:100%;margin-bottom:0px;
                            border:1px solid #636b6f">NO IMAGE</h3>
                        @endif
                    </div>
                    <div style="width:80%;height:100%;display:inline-block;vertical-align:top;">
                        <h2 style="margin:0px 5px">{{$post->title}}</h2>
                        <p style="margin:5px 10px;">
                            <!--If the content of the post is bigger than 150 characters , cut it so it can fit -->
                            {{strlen($post->content)>150?substr($post->content,0,150).' ....':$post->content}}
                        </p>
                    </div>
                </div>
            </a>
        @endforeach
        @endif
@endsection