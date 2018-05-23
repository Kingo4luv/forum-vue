<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;
use App\Reply;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store(Reply $reply){

         $reply->favorite();
         return back();

//        Favourite::create([
//           'user_id' => auth()-id(),
//            'favourited_id' => $reply->id,
//            'favourited_type' => get_class($reply)
//        ]);
    }

    public function destroy(Reply $reply){
        $reply->unfavorite();
    }
}
