<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KhaoSatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->role->name == "admin" || Auth::user()->role->name == "Admin") {
            $posts = Post::with('user')->orderByDesc('created_at')->get();
        } else {
            $posts = Post::with('user')->where('author', Auth::id())->orderByDesc('created_at')->get();
        }
        return view('admin.khao_sat.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::with('users')->get();
        return view('admin.khao_sat.create', compact('groups'));
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

        $post = Post::create($data);
        if ($request->has('respondent') && array_search('Nhóm', $request->respondent) !== false && $request->has('nhom')) {
            Post::find($post->id)->groups()->sync($request->nhom);
        }

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
        $post = Post::with('groups')->findOrFail($id);
        $groups = Group::all();
        return view('admin.khao_sat.edit', compact('post', 'groups'));
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

        if ($request->has('respondent') && array_search('Nhóm', $request->respondent) !== false && $request->has('nhom')) {
            Post::find($id)->groups()->sync($request->nhom);
        }else{
            Post::find($id)->groups()->detach();
        }

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
        $post->results()->delete();
        $post->questions()->delete();
        $post->groups()->detach();
        $post->delete();
        return redirect(route('khao-sat.index'))->with(['message' => 'Xoá bài khảo sát thành công.']);
    }
}
