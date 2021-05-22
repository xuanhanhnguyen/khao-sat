<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TaiKhoanController extends Controller
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
            $users = User::with('role')->get();
        } else {
            return $this->show(Auth::id());
        }
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);

            $data = collect($request->all())->merge([
                'password' => Hash::make($request->password),
            ])->toArray();

            User::create($data);
            return redirect(route('tai-khoan.index'))->with(['message' => "Thêm tài khoản thành công"]);
        } catch (\Exception $e) {
            return redirect(route('tai-khoan.index'))->with(['error' => 'Thêm mới thất bại, vui lòng kiểm tra lại.']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
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

            if (isset($request->password)) {
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'password' => ['required', 'string', 'min:6', 'confirmed'],
                ]);

                $data = collect($request->all())->merge([
                    'password' => Hash::make($request->password),
                ])->toArray();

                User::findOrFail($id)->update($data);
            } else {
                $request->validate([
                    'name' => ['required', 'string', 'max:255']
                ]);

                User::findOrFail($id)->update(['name' => $request->name, 'role_id' => $request->role_id, 'status' => $request->status]);
            }
            return redirect(route('tai-khoan.index'))->with(['message' => "Cập nhật tài khoản thành công"]);
        } catch (\Exception $e) {
            return redirect(route('tai-khoan.index'))->with(['error' => 'Cập nhật thất bại, vui lòng kiểm tra lại.']);
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

            $user = User::findOrFail($id);
            if ($user->results->count() > 0 || $user->posts->count() > 0) {
                return redirect(route('tai-khoan.index'))->with(['error' => "Thất bại, tài khoản đang chứa dữ liệu khảo sát."]);
            }

            $user->delete();
            return redirect(route('tai-khoan.index'))->with(['message' => "Xoá tài khoản thành công"]);

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Xóa thất bại, vui lòng kiểm tra lại.']);
        }
    }
}
