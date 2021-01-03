<?php

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->role_id == 1) {
            $post_new = Post::where([
                ['status', '=', 1],
            ])
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();

            $post_student = Post::where([
                ['status', '=', 1],
                ['respondent', 'like', '%2%']
            ])
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();

            $post_teacher = Post::where([
                ['status', '=', 1],
                ['respondent', 'like', '%3%']
            ])
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();

            $post_enterprise = Post::where([
                ['status', '=', 1],
                ['respondent', 'like', '%4%']
            ])
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();

            return view('home', compact('post_new', 'post_student', 'post_teacher', 'post_enterprise'));
        } else {
            $post_new = Post::where([
                ['status', '=', 1],
                ['respondent', 'like', '%' . Auth::user()->role_id . '%']
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
