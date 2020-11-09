<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->items = 3;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $per_item = request()->filled('items') ? request()->items:$this->items;
        $page = isset($_GET['page']) ? $_GET['page'] : 0;

        $post = Post::where('status', 1)->simplePaginate($per_item);
        $totalpost = count(Post::where('status', 1)->get());

        return view('home',compact('page'))->withPosts($post)->withTotalpost($totalpost);
    }
}
