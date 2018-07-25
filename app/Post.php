<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Post extends Model
{
    use Eloquence;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'image', 'content'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $appends = ['TagNames'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /*
     * Get the tags that belong to this post.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /*
    * Get the post's tag names.
    */
    public function getTagNamesAttribute(){
        $tags=[];
        foreach($this->tags as $tag){
            $tags[]=$tag->name;
        }

        return $tags;
    }

    /*
     * Get the comment that belong to this product.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
