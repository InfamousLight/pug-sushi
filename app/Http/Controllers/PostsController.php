<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index()
    {
       $posts = DB::table('posts')->orderBy('id', 'desc')->paginate(5);
       return view('welcome')->with('posts', $posts);
    }

    public function create(Request $request)
    {
        DB::table('posts')->insert([
            'user_id' =>  Auth::id(),
            'title' =>  $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return view('home');
    }
}
