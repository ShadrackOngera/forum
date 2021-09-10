<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\RedirectResponse;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Reply $reply): RedirectResponse
    {
        $reply->favorites();

        return back();
//        return new Response($reply->refresh());
//        return \Illuminate\Support\Facades\Response::json()
//        return response()->json()
    }
}
