<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JoinGroup;
use Illuminate\Http\Request;

class JoinGroupController extends Controller
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
        //
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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $request->validate([
                'user_id' => ['required', 'exits:users'],
            ]);

            JoinGroup::create($request->all());
            return redirect(route('nhom.index'))->with(['message' => "Thêm thành công"]);
        } catch (\Exception $e) {
            return redirect(route('nhom.index'))->with(['error' => 'Thêm thất bại, vui lòng kiểm tra lại.']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //
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
        try {

            $request->validate([
                'user_id' => ['required', 'exits:users'],
            ]);

            JoinGroup::findOrFail($id)->update($request->all());

            return redirect(route('nhom.index'))->with(['message' => "Cập nhật thành công"]);
        } catch (\Exception $e) {
            return redirect(route('nhom.index'))->with(['error' => 'Cập nhật thất bại, vui lòng kiểm tra lại.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = JoinGroup::findOrFail($id);
            $data->delete();
            return redirect(route('nhom.show', $data->group_id))->with(['message' => "Xoá thành công"]);

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Xóa thất bại, thanh viên này đã thực hiện khảo sát.']);
        }
    }

    public function pheduyet($group, $id)
    {
        try {
            JoinGroup::where([
                ['user_id', $id],
                ['group_id', $group],
            ])->update(['status' => 1]);
            return redirect(route('nhom.show', $group))->with(['message' => "Đã phê duyệt"]);

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại, vui lòng thử lại.']);
        }
    }
}
