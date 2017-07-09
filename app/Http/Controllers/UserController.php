<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use Validator;
use Hash;
use Hashids;
use Session;
use Auth;
use App\AnakSatker;

use App\User;

class UserController extends Controller
{
    //
    public function index(UserDataTable $dataTables)
    {
        return $dataTables->render('user.index');
    }

    public function create(Request $request)
    {
        $anakSatker = AnakSatker::all();
        return view('user.create', compact('anakSatker'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'name' => 'required',
            'type' => 'required|in:admin,guest,spk,pegawai'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->type = $request->type;
        $user->name = $request->name;

        if ($user->save()) {
            Session::flash('message', 'Berhasil menambah user baru');
            Session::flash('alert-class', 'alert-success');

            return redirect(url('user'));
        }

        return redirect()->back()->withInput();
    }

    public function edit($hasid)
    {
        $user = User::findOrFail(Hashids::connection('user')->decode($hasid)[0]);
        return view('user.edit', compact('user'));
    }

    public function update($hasid, Request $request)
    {
        $user = User::findOrFail(Hashids::connection('user')->decode($hasid)[0]);

        $rules = [
            'username' => 'required',
            'password' => 'sometimes',
            'name' => 'required',
            'type' => 'required|in:admin,guest,spk,pegawai'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->username = $request->username;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        $user->type = $request->type;
        $user->name = $request->name;

        if ($user->save()) {
            Session::flash('message', 'Berhasil memperbaharui user baru');
            Session::flash('alert-class', 'alert-success');

            return redirect(url('user'));
        }

        return redirect()->back()->withInput();
    }

    public function detail($hasid)
    {
        $user = User::findOrFail(Hashids::connection('user')->decode($hasid)[0]);
        return view('user.detail', compact('user'));
    }

    public function delete($hasid, Request $request)
    {
        $user = User::findOrFail(Hashids::connection('user')->decode($hasid)[0]);
        if ($user->delete()) {
            Session::flash('message', 'Berhasil menghapus user');
            Session::flash('alert-class', 'alert-success');
        }else{
            Session::flash('message', 'Gagal menghapus user');
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect()->back();
    }

    public function setting(Request $r)
    {
        $user = Auth::user();
        return view('user.setting', compact('user'));
    }

    public function settingUpdatePassword(Request $r)
    {
        $cuerrentUser = Auth::user();

        $this->validate($r, [
            'password' => 'required|confirmed|max:255',
        ]);

        $user = User::findOrFail($cuerrentUser->id);
        $user->password = Hash::make($r->password);

        if ($user->save()) {
            Session::flash('message', 'Berhasil memperbaharui password');
            Session::flash('alert-class', 'alert-success');

            return view('user.setting', compact('user')); 
        }
    }
}
