<?php

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Result;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->role_id == 1) {
            return redirect('/admin');
        } else {
            $post_new = Post::has('checkQuestions')->where([
                ['status', '=', 1],
                ['respondent', 'like', '%' . Role::find(Auth::user()->role_id)->name . '%']
            ])
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();

            $post_result = Result::with('post')
                ->where('user_id', Auth::id())
                ->get();
            return view('home', compact('post_new', 'post_result'));
        }
    }
}
