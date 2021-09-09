<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Response;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Reply $reply): Response
    {
        $reply->favorites();

//        Favorite::create([
//            'user_id' => auth()->id(),
//            'favorited_id' => $reply->id,
//            'favorited_type' => get_class($reply)
//        ]);

//        return \Illuminate\Support\Facades\Response::json()
        return new Response($reply->refresh());
//        return response()->json()
    }
}
