<?php

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\JoinGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
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
        $data = Group::has('hasGroup')->get();

        $more = Group::doesntHave('hasGroup')->get();

        return view('group', compact('data', 'more'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.nhom.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $data = Group::with('users', 'user', 'posts')->find($id);

        $join = Group::has('hasGroup')->find($id);

        $pd = Group::has('pheDuyetGroup')->find($id);

        return view('group-detail', compact('data', 'pd', 'join'));
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

    public function join(Request $request, $id)
    {
        try {

            JoinGroup::create(['group_id' => $id, 'user_id' => $request->user_id, 'status' => 0]);

            return redirect(route('nhom.detail', $id))->with(['message' => "Đã gửi yêu cầu tham gia."]);
        } catch (\Exception $e) {
            return redirect(route('nhom.detail', $id))->with(['error' => 'Thất bại, vui lòng thử lại.']);
        }
    }
}
