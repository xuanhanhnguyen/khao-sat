<?php

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($slug)
    {
        $post = Post::with('questions')->where([['slug', $slug], ['status', 1]])->first();
        if (is_null($post)) return redirect('/');

        $result = Result::with('post')->where([
            ['user_id', Auth::id()],
            ['post_id', $post->id]
        ])->first();

        if (!is_null($result)) {
            $result = json_decode($result->results, true);
        }

        return view('detail', compact('post', 'result'));
    }
}
