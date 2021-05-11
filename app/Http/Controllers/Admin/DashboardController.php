<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::with('results')->orderByDesc('created_at')->get();
        $post = $posts[0];
        foreach ($posts as $item) {
            if (sizeof($item->results) > 0) {
                $post = $item;
                break;
            }
        }
        $results = [0, 0, 0, 0];
        if (sizeof($post->results) > 0) {
            foreach ($post->results as $result) {
                $arr = array_values(json_decode($result->results, true));
                $count = [0, 0, 0, 0];
                foreach ($arr as $value) {
                    $results[$value] = isset($results[$value]) ? ++$results[$value] : 1;
                    $count[$value] = isset($count[$value]) ? ++$count[$value] : 1;
                }
                $result->result = $count;
            }
            $post->result = $results;
        }else $post->result = [];
        return view('admin.dashboard', compact('post'));
    }
}
