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
        $post = Post::with('questions')->where([['slug', $slug], ['status', 1]])->first();
        if (is_null($post)) return redirect('/');
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
