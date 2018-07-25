@extends('layouts.app')

@section('content')
    <div style="width:100%;height:250px;padding:10px">
        <div style="width:39%;height:100%;display:inline-block;vertical-align:top">
            @if(file_exists('storage/'.$post->image))
                <img src="{{asset('storage/'.$post->image)}}" style="width:100%;height:100%">
            @else
                <h3 style="text-align:center;line-height:75px;width:100%;height:100%;margin-bottom:0px;
                        border:1px solid #636b6f">NO IMAGE</h3>
            @endif
        </div>
        <div style="width:60%;height:100%;display:inline-block;vertical-align:top;">
            <h1 style="margin:0px 5px">{{$post->title}}</h1>
            <div style="margin:0px 5px">
            @foreach($post->tags as $tag)
                <a href="/tags/{{$tag->id}}/posts" class="tag" style="color:dodgerblue;">{{$tag->name}}</a>
            @endforeach
            </div>
            <p style="margin:10px 5px;">{{$post->content}}</p>
        </div>
    </div>
    <hr>
    @if(\Illuminate\Support\Facades\Auth::check())
    <form action="/comments" method="post">
        @csrf
        <div style="height:150px;width:100%">
            <textarea style="width:75%;height:100%;border-color:dodgerblue;vertical-align: top" type="text" name="content"></textarea>
            <button type="submit" style="width:20%;height:30%;vertical-align: top;margin:0px 2%">Comment</button>
        </div>
        <input name="postId" type="hidden" value="{{$post->id}}">
    </form>
    @else
        <p style="color:red">Please <a href="{{ route('login') }}" style="color:dodgerblue">login</a> first to comment</p>
        <div style="height:150px;width:100%">
            <textarea style="width:75%;height:100%;border-color:dodgerblue;vertical-align: top" disabled></textarea>
            <button type="submit" style="width:20%;height:30%;vertical-align: top;margin:0px 2%" disabled>Comment</button>
        </div>
    @endif
    <div style="margin:20px 0px">
        @foreach($post->comments as $comment)
        <div style="width:100%">
            <div style="width:100%">
                <h2 style="display:inline-block;width:80%">{{$comment->user->name}}</h2>
                <span style="text-align:right;font-size:16px;margin-top:0px;width:40%">{{$comment->created_at}}</span>
            </div>
            <p style="margin:0px 0px 10px 10px">{{$comment->content}}</p>
        </div>
        <hr>
        @endforeach
    </div>
@endsection