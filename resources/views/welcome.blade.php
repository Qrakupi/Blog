@extends('layouts.app')

@section('content')
    <div class="" style="width:50%;height:100%;margin-left:auto;margin-right:auto;padding-top:10%;">
        <h1 style="text-align:center">POSTS</h1>
        @foreach($posts as $post)
        <a href="/posts/{{$post->id}}">
            <div class="post" style="width:100%;height:100px;padding:10px;cursor:pointer;">
                <div style="width:19%;height:100%;display:inline-block;vertical-align:top">
                    @if(file_exists('storage/'.$post->image))
                    <img src="{{asset('storage/'.$post->image)}}" style="width:100%;height:100%">
                    @else
                    <h2 style="text-align:center;line-height:50px">NO IMAGE</h2>
                    @endif
                </div>
                <div style="width:80%;height:100%;display:inline-block;vertical-align:top;">
                    <h2 style="margin:0px 5px">{{$post->title}}</h2>
                    <p style="margin:5px;">{{$post->content}}</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>
@endsection