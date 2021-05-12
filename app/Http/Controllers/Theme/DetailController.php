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
        $id = \request()->user_id;

//        if (Auth::user()->role->name == "admin" || Auth::user()->role->name == "Admin") {
//            $post = Post::has('checkQuestions')->with('checkQuestions', 'results')->where([['slug', $slug], ['status', 1]])->first();
//        } else {
//            $post = Post::has('checkQuestions')->with('checkQuestions', 'results')->where([['slug', $slug], ['status', 1], ['author', Auth::id()]])->first();
//        }
        $post = Post::has('checkQuestions')->with('checkQuestions', 'results')->where([['slug', $slug], ['status', 1]])->first();

        if (is_null($post)) return redirect('/');
        $post->questions = $post->checkQuestions;
        foreach ($post->questions as $question) {
            $results = [0, 0, 0, 0];
            foreach ($post->results as $result) {
                $arr = json_decode($result->results, true);
                $results[$arr['_' . $question->id]] = isset($results[$arr['_' . $question->id]]) ? ++$results[$arr['_' . $question->id]] : 1;
            }
            $question->result = $results;
        }

        $results = [0, 0, 0, 0];
        foreach ($post->results as $result) {
            $arr = array_values(json_decode($result->results, true));
            foreach ($arr as $value) {
                $results[$value] = isset($results[$value]) ? ++$results[$value] : 1;
            }
        }
        $post->result = $results;


        $result = Result::with('post')->where([
            ['user_id', (Auth::user()->role->name != "Sinh viên" && isset($id)) ? $id : Auth::id()],
            ['post_id', $post->id]
        ])->first();

        if (!is_null($result)) {
            $result = json_decode($result->results, true);
        }

        return view('detail', compact('post', 'result'));
    }
}
