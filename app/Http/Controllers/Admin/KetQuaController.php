<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;

class KetQuaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('results')->get();
        foreach ($posts as $key => $post) {
            $results = [0, 0, 0, 0];
            if (sizeof($post->results) > 0) {
                foreach ($post->results as $result) {
                    $arr = array_values(json_decode($result->results, true));
                    foreach ($arr as $value) {
                        $results[$value] = isset($results[$value]) ? ++$results[$value] : 1;
                    }
                }
                $post->result = $results;
            } else {
                unset($posts[$key]);
            }
        }
        return view('admin.ket_qua.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('results')->find($id);
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
        }
        $post->result = $results;
        return view('admin.ket_qua.view', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
