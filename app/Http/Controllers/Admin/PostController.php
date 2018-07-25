<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\PostResource;
use App\Http\Resources\TagsResource;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();

        return view('admin.pages.posts.index',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return view
     */
    public function create()
    {
        return view('admin.pages.posts.add',['edit'=>0]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|max:120',
            'content'=>'required'
        ]);


        //Attach the general attributes
        $data = $request->only('title','content');
        $post = new Post();
        $post->forceFill($data);

        $post->save();

        //Attach tags
        $tags=explode(',',$request->tags);
        foreach($tags as $tag) {
            $result=Tag::where('name', $tag)->first();

            if(!$result){
                $result=Tag::create(['name'=>$tag]);
            }

            $post->tags()->attach($result);
        }

        //Save the image
        $file=$request->file('image');
        if($file){
            $extensions=['jpg','jpeg','png'];

            $extension=pathinfo($request->file('image')->getClientOriginalName())['extension'];
            if(in_array($extension,$extensions)){
                $filename='images/'.$post->title.'-'.$post->id.'.'.$extension;
                Storage::disk('public')->put($filename,File::get($file));

                $post->image=$filename;
                $post->update();
            }
        }

        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::with('tags')->find($id);

        return view('admin.pages.posts.add',['edit'=>1,'post'=>new PostResource($post)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required|max:120',
            'content'=>'required'
        ]);
        $post = Post::find($id);

        //Find tag if it exists, otherwise create one and store their ids.
        $tags=explode(',',$request->tags);
        $ids=[];
        foreach($tags as $tag) {
            $result=Tag::where('name', $tag)->first();

            if(!$result){
                $result=Tag::create(['name'=>$tag]);
            }

            $ids[]=$result->id;
        }
        //Clean all the previous tags and attach all the new ones depending on the ids.
        $post->tags()->sync($ids);

        //Attach the general attributes
        $data = $request->only('title','content');
        $post->forceFill($data);
        $post->update();

        //Delete the old image and attach the new one(if it exists)
        $file=$request->file('image');
        if($file){
            $extensions=['jpg','jpeg','png'];

            $extension=pathinfo($request->file('image')->getClientOriginalName())['extension'];
            if(in_array($extension,$extensions)) {
                $filename = 'images/' . $post->title . '-' . $post->id . '.' . $extension;

                if (File::exists('storage/' . $post->image)) {
                    File::delete('storage/' . $post->image);
                }
                Storage::disk('public')->put($filename, File::get($file));

                $post->image = $filename;
                $post->update();
            }
        }

        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);

        if(File::exists('storage/'.$post->image)){
            File::delete('storage/'.$post->image);
        }

        $post->tags()->detach();
        $post->delete();
        return redirect('/admin/posts');
    }
}
