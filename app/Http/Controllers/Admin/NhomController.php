<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NhomController extends Controller
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
        if (Auth::user()->role->name == "admin" || Auth::user()->role->name == "Admin") {
            $data = Group::with('users')->get();
        } else {
            $data = Group::with('users')->where('user_id', Auth::id())->get();
        }
        return view('admin.nhom.index', compact('data'));
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


        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:groups'],
            'description' => ['nullable', 'string'],
            'limit' => ['required'],
        ]);
        $data = collect($request->all())->merge([
            'user_id' => Auth::id(),
            'limit' => $request->has('limit') ? implode(',', $request->limit) : ""
        ])->toArray();

        Group::create($data);
        return redirect(route('nhom.index'))->with(['message' => "Thêm thành công"]);

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $data = Group::with('join', 'join.user')->find($id);
        $user_join = array_column(array_column($data->join->toArray(), 'user'), 'id');
        $role = Role::with([])->whereIn('name', explode(",", $data->limit))->get()->toArray();
        $role = array_column($role, 'id');
        $users = User::with([])->whereIn('role_id', $role)->whereNotIn('id', $user_join)->get();
        return view('admin.nhom.view', compact('data', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Group::find($id);
        return view('admin.nhom.edit', compact('data'));
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'limit' => ['required'],
        ]);
        $data = collect($request->all())->merge([
            'limit' => $request->has('limit') ? implode(',', $request->limit) : ""
        ])->toArray();

        Group::findOrFail($id)->update($data);

        return redirect(route('nhom.index'))->with(['message' => "Cập nhật thành công"]);
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

            $data = Group::findOrFail($id);
            $data->users()->detach();
            $data->posts()->detach();
            $data->delete();
            return redirect(route('nhom.index'))->with(['message' => "Xoá thành công"]);

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Xóa thất bại, vui lòng kiểm tra lại.']);
        }
    }

    public function addThanhVien(Request $request, $id)
    {
        try {
            Group::find($id)->users()->sync($request->data);

            return redirect(route('nhom.show', $id))->with(['message' => "Thêm thành công"]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại, vui lòng thử lại.']);
        }
    }
}
