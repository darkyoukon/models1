<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    public function post() {
        return $this->belongsToMany(Post::class);
    }

    public static function getId($content) {
        if(Hashtag::all()->where('hashtag', $content)->first()) {
            return Hashtag::all()->where('hashtag', $content)->first()->id;
        } else {
            $hashtag = new Hashtag;
            $hashtag->hashtag = $content;
            $hashtag->save();
            return $hashtag->id;
        }
    }
}
