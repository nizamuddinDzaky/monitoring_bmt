<?php

namespace App\Http\Controllers;

use App\Models\koperasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Exception;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = User::with('role')->where('id', Auth::user()->id)->first();
        $role = $user->role->roles;
        return view('admin.dashboard', compact('role'));
    }

    public function list_user()
    {
        $user = User::with('role')->where('id', Auth::user()->id)->first();
        $role = $user->role->roles;

        $list_user = User::where('role_id', 2)->get();
        return view('admin.list_user', compact('role', 'list_user'));
    }

    public function list_koperasi()
    {
        $user = User::with('role')->where('id', Auth::user()->id)->first();
        $role = $user->role->roles;

        $list_koperasi = koperasi::all();
        return view('admin.list_koperasi', compact('role', 'list_koperasi'));
    }

    public function add_user(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|max:255',
            ]);
                
            if ($validator->fails()){
                throw new Exception($validator->errors()->first());
            }

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = 2;
            $user->password = Hash::make('password');
            if(!$user->save()){
                throw new Exception("Gagal Menyimpan data");
            }
            DB::commit();
            return back()->with(['success' => 'Berhasil Menyimpan Data']);
        } catch (Exception $e) {
            DB::rollback();
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function add_koperasi(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'end_point' => 'required|max:255',
            ]);
                
            if ($validator->fails()){
                throw new Exception($validator->errors()->first());
            }

            $koperasi = new koperasi;
            $koperasi->name = $request->name;
            $koperasi->end_point = $request->end_point;
            if(!$koperasi->save()){
                throw new Exception("Gagal Menyimpan data");
            }
            DB::commit();
            return back()->with(['success' => 'Berhasil Menyimpan Data']);
        } catch (Exception $e) {
            DB::rollback();
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit_user(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|max:255',
                'id' => 'required|max:255',
            ]);
                
            if ($validator->fails()){
                throw new Exception($validator->errors()->first());
            }

            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = 2;
            $user->password = Hash::make('password');
            if(!$user->save()){
                throw new Exception("Gagal Menyimpan data");
            }
            DB::commit();
            return back()->with(['success' => 'Berhasil Menyimpan Data']);
        } catch (Exception $e) {
            DB::rollback();
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit_koperasi(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'end_point' => 'required|max:255',
                'id' => 'required|max:255',
            ]);
                
            if ($validator->fails()){
                throw new Exception($validator->errors()->first());
            }

            $koperasi = koperasi::find($request->id);
            $koperasi->name = $request->name;
            $koperasi->end_point = $request->end_point;
            if(!$koperasi->save()){
                throw new Exception("Gagal Menyimpan data");
            }
            DB::commit();
            return back()->with(['success' => 'Berhasil Menyimpan Data']);
        } catch (Exception $e) {
            DB::rollback();
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit_status_user($id_user, $nex_status)
    {
        DB::beginTransaction();
        try {

            $user = User::find($id_user);
            $user->is_active = $nex_status;
            if(!$user->save()){
                throw new Exception("Gagal Menyimpan data");
            }
            DB::commit();
            return back()->with(['success' => 'Berhasil Menyimpan Data']);
        } catch (Exception $e) {
            DB::rollback();
            return back()->with(['error' => $e->getMessage()]);
        }

    }

    public function edit_status_koperasi($id_koperasi, $nex_status)
    {
        DB::beginTransaction();
        try {

            $koperasi = koperasi::find($id_koperasi);
            $koperasi->is_active = $nex_status;
            if(!$koperasi->save()){
                throw new Exception("Gagal Menyimpan data");
            }
            DB::commit();
            return back()->with(['success' => 'Berhasil Menyimpan Data']);
        } catch (Exception $e) {
            DB::rollback();
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function report()
    {
        $user = User::with('role')->where('id', Auth::user()->id)->first();
        $role = $user->role->roles;

        $list_koperasi = koperasi::where('is_active' , 1)->get();
        return view('admin.report', compact('role', 'list_koperasi'));
    }
}
