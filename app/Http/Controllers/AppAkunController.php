<?php

namespace App\Http\Controllers;

use App\Models\AppAkun;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppAkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function loginUser(Request $request)
    {
        session([
            'activeLayout' => 'top-menu'
        ]);
        $form_email = $request->input('email_akun');
        $form_password = $request->input('password');

        if (auth()->guard('admin')->attempt(['email_akun' => $form_email, 'password' => $form_password]) && Auth::guard('admin')->user()->status_akun == 1) {
            $request->session()->regenerate();
            $levelUser = AppAkun::where('status_akun', auth()->guard('admin')->user()->status_akun)->first();
            auth()->guard('admin')->user()->level = $levelUser;
            return redirect()->route('dashboard-overview-2')->with('success', 'Berhasil Login!');
        } else if (auth()->guard('mahasiswa')->attempt(['email_akun' => $form_email, 'password' => $form_password]) && Auth::guard('mahasiswa')->user()->status_akun == 2) {
            $request->session()->regenerate();
            $levelUser = AppAkun::where('status_akun', auth()->guard('mahasiswa')->user()->status_akun)->first();
            auth()->guard('mahasiswa')->user()->level = $levelUser;
            return redirect()->route('dashboard-overview-3')->with('success', 'Berhasil Login!');
        } else {
            return redirect()->back()->with('error', 'Email atau Password Salah');
        }
    }

    public function logout(Request $request)
    {
        $guards = ['admin', 'mahasiswa'];
        $viewRedirects = [
            'admin' => 'login',
            'mahasiswa' => 'login',
        ];

        foreach ($viewRedirects as $key => $value) {
            Auth::guard($key)->logout();
        };

        $request->session()->regenerate();
        return redirect()->intended(route('login'))->with('success', 'Berhasil Logout');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AppAkun $appAkun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AppAkun $appAkun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AppAkun $appAkun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AppAkun $appAkun)
    {
        //
    }
}
