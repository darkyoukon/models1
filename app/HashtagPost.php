<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HashtagPost extends Model
{
    protected $table = 'hashtag_post';

    public static function new_entrie($hashtag_id, $post_id) {
        $entrie = new HashtagPost;
        $entrie->hashtag_id = $hashtag_id;
        $entrie->post_id = $post_id;
        $entrie->save();
    }
}
