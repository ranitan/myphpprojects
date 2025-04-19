<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    //
    protected $fillable = ['title','content','img_url'];

   //to add dynamic slugs for the craeted posts
    public static function boot(){
        parent::boot();
        static::creating(function($post){
            $post->slug = Str::slug($post->title);

            //check if the slug is already exists for any post
            $slugCount = Post::where('slug',$post->title)->count();
            if($slugCount > 0){
                $post->slug .= '-' . ($slugCount+1);//append a number to make it unique
            }
    });
}
}