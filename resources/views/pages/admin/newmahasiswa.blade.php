@extends('../../themes/' . $activeTheme . '/' . $activeLayout)

@section('subhead')
    <title>Masukkan Data</title>
@endsection

@section('subcontent')
    <h2 class="intro-y mt-5 mb-5 text-lg font-medium text-center py-2 bg-primary"
        style="color: white; text-align: center; padding: 10px; border-radius: 5px;">
        TAMBAH AKUN MAHASISWA
    </h2>
    <div class="intro-y box p-5">
        <div id="form1">
            <form action="{{ route('mahasiswaBarustore') }}" method="POST" id="formMahasiswabaru"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <x-base.form-label for="namaMahasiswa"><strong>Nama Mahasiswa</strong></x-base.form-label>
                    <small style="color: red;">*</small>
                    <x-base.form-input class="w-full" id="namaMahasiswa" type="text"
                        placeholder="Masukkan Nama Mahasiswa" name="nama_akun" required />
                    <p id="namaMahasiswaError" class="text-red-500 text-sm hidden">Nama Mahasiswa harus diisi!</p>
                </div>

                <div class="mb-4">
                    <x-base.form-label for="emailMahasiswa"><strong>Email Mahasiswa</strong></x-base.form-label>
                    <small style="color: red;">*</small>
                    <x-base.form-input class="w-full" id="emailMahasiswa" type="text"
                        placeholder="Masukkan Email Mahasiswa" name="email_akun" value="{{ old('email_akun') }}" required />
                    @error('email_akun')
                        <p id="emailMahasiswaError" class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4 relative">
                    <x-base.form-label for="passwordMahasiswa"><strong>Password Akun</strong></x-base.form-label>
                    <small style="color: red;">*</small>
                    <x-base.form-input class="w-full pr-10" id="passwordMahasiswa" type="password"
                        placeholder="Masukkan Password Akun Mahasiswa" name="password" required />
                    @error('password')
                        <p id="passwordMahasiswaError" class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                    <span id="eyeIcon" onclick="togglePassword()"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </span>
                </div>
                <x-base.button type="button" variant="primary" data-tw-toggle="modal" data-tw-target="#simpan-data-mahasiswa"
                    class="mt-4">Simpan</x-base.button>
            </form>
        </div>
    </div>
    <x-base.dialog id="simpan-data-mahasiswa">
        <x-base.dialog.panel>
            <div class="p-5 text-center">
                <x-base.lucide class="mx-auto mt-3 h-16 w-16" icon="pencil-line" />
                <div class="mt-5 text-1xl">Pastikan kolom sudah terisi semua!</div>
            </div>
            <div class="px-5 pb-8 text-center flex justify-center">
                <div class="col text-center">
                    <button data-tw-dismiss="modal" type="button"
                        class="hover:bg-primary hover:bg-opacity-30 hover:border-primary justify-center hover:text-primary py-2 dark:text-white shadow-sm inline-flex dark:bg-slate-700 w-24 rounded-md">Batal</button>
                </div>
                <div class="col text-center">
                    <button onclick="validateAndSubmit()"
                        class="transition duration-200 border flex-fill shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary w-24">Simpan</button>
                </div>
            </div>
        </x-base.dialog.panel>
    </x-base.dialog>
@endsection

<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        let valid = true;

        // Check if all fields are filled
        if (!document.getElementById('namaMahasiswa').value) {
            document.getElementById('namaMahasiswaError').classList.remove('hidden');
            valid = false;
        } else {
            document.getElementById('namaMahasiswaError').classList.add('hidden');
        }

        if (!document.getElementById('emailMahasiswa').value) {
            document.getElementById('emailMahasiswaError').classList.remove('hidden');
            valid = false;
        } else {
            document.getElementById('emailMahasiswaError').classList.add('hidden');
        }

        if (!document.getElementById('passwordMahasiswa').value) {
            document.getElementById('passwordMahasiswaError').classList.remove('hidden');
            valid = false;
        } else {
            document.getElementById('passwordMahasiswaError').classList.add('hidden');
        }

        // Email validation
        const email = document.getElementById('emailMahasiswa').value;
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (!emailPattern.test(email)) {
            document.getElementById('emailMahasiswaError').classList.remove('hidden');
            valid = false;
        } else {
            document.getElementById('emailMahasiswaError').classList.add('hidden');
        }

        if (!valid) {
            event.preventDefault();
        }
    });

    function togglePassword() {
        const passwordField = document.getElementById('passwordMahasiswa');
        const passwordIcon = document.getElementById('togglePasswordIcon');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordIcon.setAttribute('icon', 'eye-off');
        } else {
            passwordField.type = 'password';
            passwordIcon.setAttribute('icon', 'eye');
        }
    }

    function validateAndSubmit() {
        const form = document.getElementById('formMahasiswabaru');
        const nama = form['nama_akun'].value.trim();
        const email = form['email_akun'].value.trim();
        const password = form['password'].value.trim();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!nama || !email || !password) {
            alert('Semua kolom harus diisi!');
            return;
        }

        if (!emailPattern.test(email)) {
            alert('Format email salah!');
            return;
        }

        form.submit();
    }
</script>
