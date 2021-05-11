<?php

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $slug)
    {
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

        return view('survey', compact('post'));
    }

    public function save(Request $request)
    {

        $data = collect($request->all())->merge([
            'user_id' => Auth::id()
        ])->toArray();

        $result = $data;
        unset($result['_token']);
        unset($result['post_id']);
        unset($result['user_id']);
        unset($result['slug']);

        $data['results'] = json_encode($result);

        Result::create($data);

        return redirect('/' . $request->slug . '.html')->with('message', 'Cảm ơn! Bạn đã hoàn thành khảo sát.');
    }
}
