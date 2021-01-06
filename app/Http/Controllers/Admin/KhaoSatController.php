<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KhaoSatController extends Controller
{

    public function index()
    {
        $posts = Post::with('user')->orderByDesc('created_at')->paginate(10);
        return view('admin.khao_sat.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.khao_sat.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|Request|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'unique:posts'],
            'description' => ['required'],
            'respondent' => ['required'],
        ]);

        $data = collect($request->all())->merge([
            'respondent' => implode(",", $request->respondent),
            'slug' => $this->str_to_slug($request->title),
            'author' => Auth::id()
        ])->toArray();

        Post::create($data);
        return redirect(route('khao-sat.index'))->with(['message' => 'Thêm bài khảo sát thành công.']);
    }

    private function str_to_slug($str)
    {
        $slug = mb_strtolower($str);
        $slug = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $slug);
        $slug = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $slug);
        $slug = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $slug);
        $slug = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $slug);
        $slug = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $slug);
        $slug = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $slug);
        $slug = preg_replace("/(đ)/", 'd', $slug);
        $slug = preg_replace("/([^a-z0-9]+)/", '-', $slug);
        $slug = preg_replace("/(^-+|-+$)/", "", $slug);
        return $slug;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.khao_sat.edit', compact('post'));
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

        $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'respondent' => ['required'],
        ]);

        $data = collect($request->all())->merge([
            'respondent' => implode(",", $request->respondent),
        ])->toArray();

        Post::findOrFail($id)->update($data);
        return redirect(route('khao-sat.index'))->with(['message' => 'Sửa thông tin bài khảo sát thành công.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->results()->count() <= 0) {
            $post->questions()->delete();
            $post->delete();
            return redirect(route('khao-sat.index'))->with(['message' => 'Xoá bài khảo sát thành công.']);
        }

        return redirect(route('khao-sat.index'))->with(['error' => 'Đã thực hiện khảo sát, không thế xoá bài khảo sát.']);
    }
}
