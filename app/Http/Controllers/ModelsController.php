<?php

namespace App\Http\Controllers;

use App\Hashtag;
use App\HashtagPost;
use App\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Post;

class ModelsController extends Controller
{
    public function add_post() {
        $post_content = request('content', '');
        $hashtags = request('hashtags', '');
        $post_id = Post::new_post($post_content);
        View::create_entrie($post_id);
        if(stripos($hashtags, ' ')) {
            $hashtags = explode(' ', $hashtags);
            foreach($hashtags as $hashtag) {
                HashtagPost::new_entrie(Hashtag::getId($hashtag), $post_id);
            }
        } else {
            HashtagPost::new_entrie(Hashtag::getId($hashtags), $post_id);
        }
        return back();
    }
}
