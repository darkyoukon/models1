<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //protected $table = 'posts';
    //protected $fillable = ['content'];

    /**Method that links tables posts:users in relationship n:1*/
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**Method that links tables posts:views in relationship n:n*/
    public function views() {
        return $this->hasMany(View::class);
    }

    /**Method that links tables posts:views in relationship n:n*/
    public function hashtags() {
        return $this->belongsToMany(Hashtag::class);
    }

    public static function find_id($post_id) {
        return Post::all()->get($post_id-1);
    }

    public static function new_post($post_content) {
        $post = new Post;
        $post->content = $post_content;
        $post->user_id = auth()->id();
        $post->save();
        return $post->id;
    }
}
