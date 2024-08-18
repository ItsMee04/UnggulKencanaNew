<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Professions;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function login(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib di isi !!!',
        ];

        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], $messages);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->status != 1) {
                return redirect('login')->with('errors-message', 'User Account Belum Aktif !');
            } else {
                if (Auth::user()->roles_id == 1) {
                    $employee = Employees::where('id', Auth::user()->employees_id)->first()->name;
                    $avatar   = Employees::where('id', Auth::user()->employees_id)->first()->avatar;

                    $idprofession   = Employees::where('id', Auth::user()->employees_id)->first()->professions_id;
                    $profession     = Professions::where('id', $idprofession)->first()->professions;

                    $role   = Roles::where('id', Auth::user()->roles_id)->first()->roles;

                    Session::put('name', $employee);
                    Session::put('avatar', $avatar);
                    Session::put('profession', $profession);
                    Session::put('role', $role);

                    return redirect('dashboard')->with('success-message', 'Login Berhasil');
                }
            }
        }

        return redirect('login')->with('errors-message', 'username atau password salah !');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        //mengarahkan ke halaman login
        return redirect('login')->with('success-message', 'Logout Berhasil');
    }
}
