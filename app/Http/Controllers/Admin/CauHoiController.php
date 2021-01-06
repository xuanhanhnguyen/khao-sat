<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Question;
use Illuminate\Http\Request;

class CauHoiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $s = \request()->s;
        $posts = Post::orderByDesc('created_at')->get();
        if (sizeof($posts) > 0)
            $questions = Question::where('post_id', $s ?? $posts[0]->id)->paginate(10);
        else
            $questions = Question::paginate(10);

        return view('admin.cau_hoi.index', compact('posts', 'questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cau_hoi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => ['required'],
            'answers' => ['required']
        ]);

        $data = collect($request->all())->merge([
            'post_id' => 2,
            'answers' => implode(",", array_diff($request->answers, [null])),
        ])->toArray();

        Question::create($data);
        return redirect(route('cau-hoi.index'))->with(['message' => 'Thêm câu hỏi thành công.']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::findOrFail($id);
        return view('admin.cau_hoi.edit', compact('question'));
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
            'content' => ['required'],
            'answers' => ['required']
        ]);

        $data = collect($request->all())->merge([
            'answers' => implode(",", array_diff($request->answers, [null])),
        ])->toArray();

        Question::findOrFail($id)->update($data);
        return redirect(route('cau-hoi.index'))->with(['message' => 'Cập nhật câu hỏi thành công.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        if (Post::findOrFail($question->post_id)->results()->count() <= 0) {
            $question->delete();
            return redirect(route('cau-hoi.index'))->with(['message' => 'Xoá câu hỏi thành công.']);
        }
        return redirect(route('cau-hoi.index'))->with(['error' => 'Đã thực hiện khảo sát, không thể xoá câu hỏi.']);
    }
}
