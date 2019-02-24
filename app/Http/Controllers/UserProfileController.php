<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show($key){
        $user = \App\user::find(2);
        /*if (is_null($user)){
            return "user not found";
        }*/
        /*if(is_null($user->profile)){
            return "profile is not found"; 
        }*/
        $profile = optional($user->profile->image_link);
        $img = $profile->image_link;
        return "<img src='{$img}' />"; 

    }
    public function create(){
        $user = \App\user::find(2);
        $user->profile()->create([
            'image_link'=>'https://www.pexels.com/photo/4k-wallpaper-4x4-auto-automobile-1149140/'
        ]);
    }
}
