<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
//    /**Method that links tables views:users in relationship n:1*/
//    public function user() {
//        return $this->belongsTo(User::class);
//    }

    /**Method that links tables views:posts in relationship n:n*/

    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function getSum($post_id) {
        $views_count = 0;
        foreach (View::all()->where('post_id', $post_id) as $view) {
            $views_count += $view->watched;
        }
        return $views_count;
    }

    public static function update_entrie($current_user) {
        if($current_user) {
            foreach (Post::all() as $post) {
                $view = new View;
                $view->post_id = $post->id;
                $view->user_id = $current_user->id;
                $view->save();
            }
        }
    }

    public static function create_entrie($post_id) {
        foreach (User::all() as $user) {
            $view = new View;
            $view->post_id = $post_id;
            $view->user_id = $user->id;
            $view->save();
        }
    }

    public static function increments($current_user, $user_post) {
        if($current_user && $user_post) {
            $view_entrie = View::all()->where('user_id', $current_user->id);
            $view = $view_entrie->where('post_id', $user_post->id)->first();
            //error_log($view_entrie);
            $view->watched++;
            $view->save();
        } else error_log("There're no users!");
    }
}
