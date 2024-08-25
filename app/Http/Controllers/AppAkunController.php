<?php

namespace App\Http\Controllers;

use App\Models\AppAkun;
use App\Models\Provinsi;
use App\Models\Kabkot;
use App\Models\Kecamatan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


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

    public function mahasiswaBaruStore(Request $request)
    {
        $uid_akun = Str::uuid();


        // Create a new instance of the AppAkun model
        $tblakun = new AppAkun();
        $tblakun->uid_akun = $uid_akun; // Assign the generated UID
        $tblakun->nama_akun = $request->nama_akun;
        $tblakun->email_akun = $request->email_akun;
        $tblakun->password = Hash::make($request->password); // Hash the password
        $tblakun->status_akun = 2;
        $tblakun->save();
        // dd($tblakun);
        return redirect()->route('dashboard-overview-2')->with('success', 'Data berhasil disimpan!');
    }

    public function getKabkotByProvinsi($provinsiId)
    {
        $kabkot = Kabkot::where('id_provinsi', $provinsiId)->get();
        return response()->json(['kabkot' => $kabkot]);
    }

    public function getKecamatanByKabkot($kabkotId)
    {
        $kecamatan = Kecamatan::where('id_kabkot', $kabkotId)->get();
        return response()->json(['kecamatan' => $kecamatan]);
    }

    public function updateMhswAdmin(Request $request, $uid)
    {
        $tblakun = AppAkun::where('uid_akun', $uid)->firstOrFail();

        $fileakun = $request->file('file_akun');
        if ($fileakun) {
            if ($tblakun->file_akun && Storage::exists($tblakun->file_akun)) {
                Storage::delete($tblakun->file_akun);
            }

            $fileakunPath = $fileakun->store('public/filefoto/');
            $fileakunhashed = str_replace('public/', 'storage/', $fileakunPath);
            $tblakun->file_akun = $fileakunhashed;
        }

        $videoakun = $request->file('video_akun');
        if ($videoakun) {
            // Delete old video if exists
            if ($tblakun->video_akun && Storage::exists($tblakun->video_akun)) {
                Storage::delete($tblakun->video_akun);
            }

            $videoakunPath = $videoakun->store('public/filevideo/');
            $videoakunhashed = str_replace('public/', 'storage/', $videoakunPath);
            $tblakun->video_akun = $videoakunhashed;
        }

        $tblakun->nama_akun = $request->input('nama_akun');
        $tblakun->email_akun = $request->input('email_akun');
        $tblakun->alamatktp_akun = $request->input('alamatktp_akun');
        $tblakun->alamatdomisili_akun = $request->input('alamatdomisili_akun');
        $tblakun->id_provinsi = $request->input('id_provinsi');
        $tblakun->id_kabkot = $request->input('id_kabkot');
        $tblakun->id_kecamatan = $request->input('id_kecamatan');
        $tblakun->nomorhp_akun = $request->input('nomorhp_akun');
        $tblakun->nomortelepon_akun = $request->input('nomortelepon_akun');
        $tblakun->kewarganegaraan_akun = $request->input('kewarganegaraan_akun');
        $tblakun->wna_akun = $request->input('wna_akun');
        $tblakun->tanggallahir_akun = $request->input('tanggallahir_akun');
        $tblakun->tempatlahir_akun = $request->input('tempatlahir_akun');
        $tblakun->provinsilahir_akun = $request->input('provinsilahir_akun');
        $tblakun->kabkotlahir_akun = $request->input('kabkotlahir_akun');
        $tblakun->luarlahir_akun = $request->input('luarlahir_akun');
        $tblakun->jk_akun = $request->input('jk_akun');
        $tblakun->statusnikah_akun = $request->input('statusnikah_akun');
        $tblakun->id_agama = $request->input('id_agama');

        $tblakun->save();

        return redirect()->back()->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function updateMhsw(Request $request, $id)
    {
        $tblakun = AppAkun::where('id_akun', $id)->firstOrFail();

        $fileakun = $request->file('file_akun');
        if ($fileakun) {
            if ($tblakun->file_akun && Storage::exists($tblakun->file_akun)) {
                Storage::delete($tblakun->file_akun);
            }

            $fileakunPath = $fileakun->store('public/filefoto/');
            $fileakunhashed = str_replace('public/', 'storage/', $fileakunPath);
            $tblakun->file_akun = $fileakunhashed;
        }

        $videoakun = $request->file('video_akun');
        if ($videoakun) {
            // Delete old video if exists
            if ($tblakun->video_akun && Storage::exists($tblakun->video_akun)) {
                Storage::delete($tblakun->video_akun);
            }

            $videoakunPath = $videoakun->store('public/filevideo/');
            $videoakunhashed = str_replace('public/', 'storage/', $videoakunPath);
            $tblakun->video_akun = $videoakunhashed;
        }

        $tblakun->nama_akun = $request->input('nama_akun');
        $tblakun->email_akun = $request->input('email_akun');
        $tblakun->alamatktp_akun = $request->input('alamatktp_akun');
        $tblakun->alamatdomisili_akun = $request->input('alamatdomisili_akun');
        $tblakun->id_provinsi = $request->input('id_provinsi');
        $tblakun->id_kabkot = $request->input('id_kabkot');
        $tblakun->id_kecamatan = $request->input('id_kecamatan');
        $tblakun->nomorhp_akun = $request->input('nomorhp_akun');
        $tblakun->nomortelepon_akun = $request->input('nomortelepon_akun');
        $tblakun->kewarganegaraan_akun = $request->input('kewarganegaraan_akun');
        $tblakun->wna_akun = $request->input('wna_akun');
        $tblakun->tanggallahir_akun = $request->input('tanggallahir_akun');
        $tblakun->tempatlahir_akun = $request->input('tempatlahir_akun');
        $tblakun->provinsilahir_akun = $request->input('provinsilahir_akun');
        $tblakun->kabkotlahir_akun = $request->input('kabkotlahir_akun');
        $tblakun->luarlahir_akun = $request->input('luarlahir_akun');
        $tblakun->jk_akun = $request->input('jk_akun');
        $tblakun->statusnikah_akun = $request->input('statusnikah_akun');
        $tblakun->id_agama = $request->input('id_agama');
        $tblakun->status_daftar = 1;

        $tblakun->save();

        return redirect()->back()->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function deleteMhswAdmin($uid)
    {
        $tblakun = AppAkun::where('uid_akun', $uid)->firstOrFail();

        if ($tblakun->file_akun && Storage::exists($tblakun->file_akun)) {
            Storage::delete($tblakun->file_akun);
        }

        if ($tblakun->video_akun && Storage::exists($tblakun->video_akun)) {
            Storage::delete($tblakun->video_akun);
        }

        $tblakun->delete();

        return redirect()->route('dashboard-overview-2')->with('success', 'Data mahasiswa berhasil dihapus.');
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
