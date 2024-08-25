@extends('../../themes/' . $activeTheme . '/' . $activeLayout)
@section('custom-css')
    <style>
        @media print {

            .page-wrapper,
            .page-content-wrapper {
                margin: 0 !important;
            }

            .container {
                margin-top: 0 !important;
            }

            body * {
                visibility: hidden;
                font-size: 10pt;
            }

            .container-fluid,
            .row,
            .card,
            .card-body {
                margin: 12px !important;
                padding: 0 !important;
                box-sizing: border-box;
            }

            #printable-section,
            #printable-section * {
                visibility: visible;
            }

            #printable-section {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                page-break-inside: avoid;
            }
        }
    </style>
@endsection
@section('subhead')
    <title>Masukkan Data</title>
@endsection

@section('subcontent')
    <x-base.button type="button" variant="secondary" class="bg-gray-500 text-white hover:bg-gray-600 mt-4"
        onclick="printDocument()">
        Print
    </x-base.button>

    <div id="printable-section">

        <h2 class="intro-y mt-5 mb-5 text-lg font-medium text-center py-2 bg-primary"
            style="color: white; text-align: center; padding: 10px; border-radius: 5px;">
            DETAIL AKUN MAHASISWA
        </h2>
        <div class="intro-y box p-5">
            <div id="form1">
                <form action="{{ route('updateMhswAdmin', ['uid' => $mahasiswa->uid_akun]) }}" method="POST"
                    id="formMahasiswabaru" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <x-base.form-label for="namaMahasiswa"><strong>Nama Lengkap (Sesuai ijazah disertai
                                gelar)</strong></x-base.form-label>
                        <small style="color: red;">*</small>
                        <x-base.form-input class="w-full" id="namaMahasiswa" type="text"
                            placeholder="Masukkan Nama Mahasiswa" name="nama_akun"
                            value="{{ $mahasiswa->nama_akun ?? '-' }}" required />
                        <p id="namaMahasiswaError" class="text-red-500 text-sm hidden">Nama Mahasiswa harus diisi!</p>
                    </div>

                    <div class="mb-4">
                        <x-base.form-label for="emailMahasiswa"><strong>Email Mahasiswa</strong></x-base.form-label>
                        <small style="color: red;">*</small>
                        <x-base.form-input class="w-full" id="emailMahasiswa" type="text"
                            placeholder="Masukkan Email Mahasiswa" name="email_akun"
                            value="{{ $mahasiswa->email_akun ?? '-' }}" required />
                        @error('email_akun')
                            <p id="emailMahasiswaError" class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <x-base.form-label for="alamatKTPMahasiswa">Alamat Sesuai KTP</x-base.form-label>
                        <x-base.form-textarea class="w-full" id="alamatKTPMahasiswa" placeholder="Alamat Sesuai KTP"
                            name="alamatktp_akun" required>{{ $mahasiswa->alamatktp_akun ?? '' }}</x-base.form-textarea>
                        <p id="alamatKTPMahasiswaError" class="text-red-500 text-sm hidden">Alamat Sesuai KTP harus diisi!
                        </p>
                    </div>

                    <div class="mb-4">
                        <x-base.form-label for="alamatDomisili">Alamat Domisili</x-base.form-label>
                        <x-base.form-textarea class="w-full" id="alamatDomisili" placeholder="Alamat Domisili"
                            name="alamatdomisili_akun"
                            required>{{ $mahasiswa->alamatdomisili_akun ?? '' }}</x-base.form-textarea>
                        <p id="alamatDomisiliError" class="text-red-500 text-sm hidden">Alamat Lengkap/Domisili harus diisi!
                        </p>
                    </div>

                    <div class="mb-4">
                        <x-base.form-label for="provinsiMahasiswa"><strong>Provinsi</strong></x-base.form-label>
                        <small style="color: red;">*</small>
                        <x-base.form-select class="w-full" id="provinsiMahasiswa" name="id_provinsi" required>
                            <option value="">Pilih Provinsi</option>
                            @foreach ($provinsiList as $provinsi)
                                <option value="{{ $provinsi->id_provinsi }}"
                                    {{ $mahasiswa->id_provinsi == $provinsi->id_provinsi ? 'selected' : '' }}>
                                    {{ $provinsi->nama_provinsi }}
                                </option>
                            @endforeach
                        </x-base.form-select>
                        <p id="provinsiMahasiswaError" class="text-red-500 text-sm hidden">Provinsi harus diisi!</p>
                    </div>

                    <div class="mb-4">
                        <x-base.form-label for="KabKotMahasiswa"><strong>Kabkot</strong></x-base.form-label>
                        <small style="color: red;">*</small>
                        <x-base.form-select class="w-full" id="KabKotMahasiswa" name="id_kabkot" required>
                            <option value="">Pilih Kabkot</option>
                            @foreach ($kabkotList as $kabkot)
                                <option value="{{ $kabkot->id_kabkot }}"
                                    {{ $mahasiswa->id_kabkot == $kabkot->id_kabkot ? 'selected' : '' }}>
                                    {{ $kabkot->nama_kabkot }}
                                </option>
                            @endforeach
                        </x-base.form-select>
                        <p id="KabKotMahasiswaError" class="text-red-500 text-sm hidden">Kabkot harus diisi!</p>
                    </div>

                    <div class="mb-4">
                        <x-base.form-label for="kecamatanMahasiswa"><strong>Kecamatan</strong></x-base.form-label>
                        <small style="color: red;">*</small>
                        <x-base.form-select class="w-full" id="kecamatanMahasiswa" name="id_kecamatan" required>
                            <option value="">Pilih Kecamatan</option>
                            @foreach ($kecamatanList as $kecamatan)
                                <option value="{{ $kecamatan->id_kecamatan }}"
                                    {{ $mahasiswa->id_kecamatan == $kecamatan->id_kecamatan ? 'selected' : '' }}>
                                    {{ $kecamatan->nama_kecamatan }}
                                </option>
                            @endforeach
                        </x-base.form-select>
                        <p id="kecamatanMahasiswaError" class="text-red-500 text-sm hidden">Kecamatan harus diisi!</p>
                    </div>

                    <div class="mb-4 flex space-x-4">
                        <div class="w-1/2">
                            <x-base.form-label for="noHpMahasiswa"><strong>Nomor HP Aktif</strong></x-base.form-label>
                            <small style="color: red;">*</small>
                            <x-base.form-input class="w-full" id="noHpMahasiswa" type="text"
                                placeholder="Masukkan Nomor HP Aktif" name="nomorhp_akun"
                                value="{{ $mahasiswa->nomorhp_akun ?? '' }}" required />
                            <p id="noHpMahasiswaError" class="text-red-500 text-sm hidden">Nomor HP Aktif harus diisi!</p>
                        </div>
                        <div class="w-1/2">
                            <x-base.form-label for="noTeleponMahasiswa"><strong>No Telepon</strong></x-base.form-label>
                            <x-base.form-input class="w-full" id="noTeleponMahasiswa" type="text"
                                placeholder="Masukkan No Telepon" name="nomortelepon_akun"
                                value="{{ $mahasiswa->nomortelepon_akun ?? '' }}" />
                            <p id="noTeleponMahasiswaError" class="text-red-500 text-sm hidden">No Telepon harus diisi
                                Jika
                                Ada!
                            </p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <x-base.form-label for="kewarganegaraan"><strong>Kewarganegaraan</strong></x-base.form-label>
                        <small style="color: red;">*</small>
                        <div>
                            <label class="inline-flex items-center">
                                <input type="radio" name="kewarganegaraan_akun" value="WNA Asli"
                                    @if ($mahasiswa->kewarganegaraan_akun == 'WNA Asli') checked @endif required>
                                <span class="ml-2">WNA Asli</span>
                            </label>
                        </div>
                        <div>
                            <label class="inline-flex items-center">
                                <input type="radio" name="kewarganegaraan_akun" value="WNA Keturunan"
                                    @if ($mahasiswa->kewarganegaraan_akun == 'WNA Keturunan') checked @endif required>
                                <span class="ml-2">WNA Keturunan</span>
                            </label>
                        </div>
                        <div>
                            <label class="inline-flex items-center">
                                <input type="radio" name="kewarganegaraan_akun" value="WNA" id="wnaRadio"
                                    @if ($mahasiswa->kewarganegaraan_akun == 'WNA') checked @endif required>
                                <span class="ml-2">WNA</span>
                            </label>
                        </div>
                        <p id="kewarganegaraanError" class="text-red-500 text-sm hidden">Kewarganegaraan harus diisi!</p>
                    </div>

                    <div class="mb-4" id="negaraDiv" style="display: none;">
                        <x-base.form-label for="negara"><strong>Negara</strong></x-base.form-label>
                        <x-base.form-input class="w-full" id="negara" type="text" placeholder="Masukkan Negara"
                            name="wna_akun" value="{{ $mahasiswa->wna_akun ?? '' }}" />
                        <p id="negaraError" class="text-red-500 text-sm hidden">Negara harus diisi jika WNA dipilih!</p>
                    </div>

                    <div class="mb-4">
                        <x-base.form-label for="tanggalLahir"><strong>Tanggal Lahir Sesuai
                                Ijazah</strong></x-base.form-label>
                        <small style="color: red;">*</small>
                        <x-base.litepicker data-single-mode="true" class="w-full" id="tanggalLahir"
                            placeholder="Pilih Tanggal Lahir" name="tanggallahir_akun"
                            value="{{ $mahasiswa->tanggallahir_akun ?? '' }}" required />
                        <p id="tanggalLahirError" class="text-red-500 text-sm hidden">Tanggal Lahir harus diisi!</p>
                    </div>

                    <div class="mb-4">
                        <x-base.form-label for="tempatLahirMahasiswa"><strong>Tempat Lahir Sesuai
                                Ijazah</strong></x-base.form-label>
                        <small style="color: red;">*</small>
                        <x-base.form-input class="w-full" id="tempatLahirMahasiswa" type="text"
                            placeholder="Masukkan Tempat Lahir" name="tempatlahir_akun"
                            value="{{ $mahasiswa->tempatlahir_akun ?? '' }}" required />
                        <p id="tempatLahirMahasiswaError" class="text-red-500 text-sm hidden">Tempat Lahir harus diisi!
                        </p>
                    </div>

                    <div class="mb-4">
                        <x-base.form-label for="provinsilahir"><strong>Provinsi Lahir</strong></x-base.form-label>
                        <small style="color: red;">*</small>
                        <x-base.form-select class="w-full" id="provinsilahir" name="provinsilahir_akun" required>
                            <option value="">Pilih Provinsi</option>
                            @foreach ($provinsiList as $provinsi)
                                <option value="{{ $provinsi->id_provinsi }}"
                                    {{ $mahasiswa->id_provinsi == $provinsi->id_provinsi ? 'selected' : '' }}>
                                    {{ $provinsi->nama_provinsi }}
                                </option>
                            @endforeach
                        </x-base.form-select>
                        <p id="provinsilahirError" class="text-red-500 text-sm hidden">Provinsi Lahir harus diisi!</p>
                    </div>

                    <div class="mb-4">
                        <x-base.form-label for="KabKotLahir"><strong>Kabkot Lahir</strong></x-base.form-label>
                        <small style="color: red;">*</small>
                        <x-base.form-select class="w-full" id="KabKotLahir" name="kabkotlahir_akun" required>
                            <option value="">Pilih Kabkot</option>
                            @foreach ($kabkotList as $kabkot)
                                <option value="{{ $kabkot->id_kabkot }}"
                                    {{ $mahasiswa->id_kabkot == $kabkot->id_kabkot ? 'selected' : '' }}>
                                    {{ $kabkot->nama_kabkot }}
                                </option>
                            @endforeach
                        </x-base.form-select>
                        <p id="KabKotLahirError" class="text-red-500 text-sm hidden">Kabkot Lahir harus diisi!</p>
                    </div>

                    <div class="mb-4">
                        <x-base.form-label for="wnaLahir"><strong>Isi Jika Lahir Di Luar
                                Negeri</strong></x-base.form-label>
                        <x-base.form-input class="w-full" id="wnaLahir" type="text"
                            placeholder="Masukkan Negara Tempat Lahir" name="luarlahir_akun"
                            value="{{ $mahasiswa->luarlahir_akun ?? '' }}" />
                        <p id="wnaLahirError" class="text-red-500 text-sm hidden">Tempat Lahir harus diisi!</p>
                    </div>

                    <div class="mb-4">
                        <x-base.form-label for="jenisKelamin"><strong>Jenis Kelamin</strong></x-base.form-label>
                        <small style="color: red;">*</small>
                        <div>
                            <label class="inline-flex items-center">
                                <input type="radio" id="pria" name="jk_akun" value="Pria"
                                    {{ isset($mahasiswa->jk_akun) && $mahasiswa->jk_akun == 'Pria' ? 'checked' : '' }}>
                                <span class="ml-2">Pria</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="radio" id="wanita" name="jk_akun" value="Wanita"
                                    {{ isset($mahasiswa->jk_akun) && $mahasiswa->jk_akun == 'Wanita' ? 'checked' : '' }}>
                                <span class="ml-2">Wanita</span>
                            </label>
                        </div>
                        <p id="jenisKelaminError" class="text-red-500 text-sm hidden">Jenis Kelamin harus diisi!</p>
                    </div>

                    <div class="mb-4">
                        <x-base.form-label for="statusnikah"><strong>Status Nikah</strong></x-base.form-label>
                        <small style="color: red;">*</small>
                        <div>
                            <label class="inline-flex items-center">
                                <input type="radio" id="Belum Menikah" name="statusnikah_akun" value="Belum Menikah"
                                    {{ isset($mahasiswa->statusnikah_akun) && $mahasiswa->statusnikah_akun == 'Belum Menikah' ? 'checked' : '' }}>
                                <span class="ml-2">Belum Menikah</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="radio" id="Menikah" name="statusnikah_akun" value="Menikah"
                                    {{ isset($mahasiswa->statusnikah_akun) && $mahasiswa->statusnikah_akun == 'Menikah' ? 'checked' : '' }}>
                                <span class="ml-2">Menikah</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="radio" id="Lain-lain (Janda/Duda)" name="statusnikah_akun"
                                    value="Lain-lain (Janda/Duda)"
                                    {{ isset($mahasiswa->statusnikah_akun) && $mahasiswa->statusnikah_akun == 'Lain-lain (Janda/Duda)' ? 'checked' : '' }}>
                                <span class="ml-2">Lain-lain (Janda/Duda)</span>
                            </label>
                        </div>
                        <p id="statusnikahError" class="text-red-500 text-sm hidden">Jenis Kelamin harus diisi!</p>
                    </div>

                    <div class="mb-4">
                        <x-base.form-label for="agamaMahasiswa"><strong>Agama</strong></x-base.form-label>
                        <small style="color: red;">*</small>
                        <x-base.form-select class="w-full" id="agamaMahasiswa" name="id_agama" required>
                            <option value="">Pilih Agama</option>
                            @foreach ($agamaList as $agama)
                                <option value="{{ $agama->id_agama }}"
                                    {{ $mahasiswa->id_agama == $agama->id_agama ? 'selected' : '' }}>
                                    {{ $agama->nama_agama }}
                                </option>
                            @endforeach
                        </x-base.form-select>
                        <p id="agamaMahasiswaError" class="text-red-500 text-sm hidden">Agama harus diisi!</p>
                    </div>

                    <div class="mb-4">
                        <x-base.form-label for="uploadFoto"><strong>Upload Foto Formal (jpg, jpeg, png, dan
                                sejenisnya)</strong></x-base.form-label>
                        <input type="file" id="uploadFoto" name="file_akun" accept=".jpg, .jpeg, .png" />
                        <p id="fotoError" class="text-red-500 text-sm hidden">Foto harus diupload!</p>
                        @if ($mahasiswa->file_akun)
                            <p>File Foto:</p>
                            <img src="{{ $foto }}" alt="Foto Formal" class="w-32 h-32 object-cover" />
                        @else
                            <p>Belum melakukan upload file</p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <x-base.form-label for="uploadVideo"><strong>Video Perkenalan (mp4, dan
                                sejenisnya)</strong></x-base.form-label>
                        <input type="file" id="uploadVideo" name="video_akun" accept=".mp4, .mov, .avi" />
                        <p id="videoError" class="text-red-500 text-sm hidden">Video harus diupload!</p>
                        @if ($mahasiswa->video_akun)
                            <p>File Video:</p>
                            <video controls class="w-64">
                                <source src="{{ $video }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <p>Belum melakukan upload file</p>
                        @endif
                    </div>
                    <div class="flex space-x-4">
                        <!-- Update Button -->
                        <x-base.button type="button" variant="primary" data-tw-toggle="modal"
                            data-tw-target="#simpan-data-mahasiswa" class="mt-4">
                            Update
                        </x-base.button>

                        <!-- Delete Button -->
                        <x-base.button type="button" variant="danger" data-tw-toggle="modal"
                            data-tw-target="#hapus-data-mahasiswa" class="mt-4">
                            Hapus
                        </x-base.button>
                    </div>
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
        <x-base.dialog id="hapus-data-mahasiswa">
            <x-base.dialog.panel>
                <div class="p-5 text-center">
                    <x-base.lucide class="mx-auto mt-3 h-16 w-16" icon="trash-2" />
                    <div class="mt-5 text-1xl">Apakah Anda yakin ingin menghapus data ini?</div>
                </div>
                <div class="px-5 pb-8 text-center flex justify-center">
                    <div class="col text-center">
                        <button data-tw-dismiss="modal" type="button"
                            class="hover:bg-primary hover:bg-opacity-30 hover:border-primary justify-center hover:text-primary py-2 dark:text-white shadow-sm inline-flex dark:bg-slate-700 w-24 rounded-md">
                            Batal
                        </button>
                    </div>
                    <div class="col text-center">
                        <form action="{{ route('deleteMhswAdmin', ['uid' => $mahasiswa->uid_akun]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="transition duration-200 border flex-fill shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 bg-danger border-danger text-white dark:border-danger w-24">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </x-base.dialog.panel>
        </x-base.dialog>
    </div>
@endsection

<script>
    function printDocument() {
        window.print();
    }

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
        const noHp = form['nomorhp_akun'].value.trim();
        const noTelepon = form['nomortelepon_akun'].value.trim();
        const requiredFields = form.querySelectorAll('[required]');
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const numericPattern = /^[0-9]+$/;
        let isFormValid = true;

        // Check for empty required fields
        requiredFields.forEach(field => {
            const smallTag = field.parentElement.querySelector('small');
            if (!field.value.trim()) {
                isFormValid = false;
                if (smallTag) {
                    smallTag.style.display = 'inline'; // Show the red asterisk
                } else {
                    const small = document.createElement('small');
                    small.style.color = 'red';
                    small.textContent = ' *';
                    field.parentElement.appendChild(small);
                }
            } else {
                if (smallTag) {
                    smallTag.style.display = 'none'; // Hide the red asterisk if field is filled
                }
            }
        });

        if (!isFormValid) {
            alert('Kolom dengan tanda * masih ada yang belum terisi. Silahkan cek kembali.');
            return;
        }

        // Check for valid email format
        if (!emailPattern.test(email)) {
            alert('Format email salah!');
            return;
        }

        // Check for numeric only in No HP and No Telepon fields
        if (noHp !== '' && !numericPattern.test(noHp)) {
            alert('Nomor HP Aktif hanya dapat berupa angka. Contoh: 082212345567');
            return;
        }

        if (noTelepon !== '' && !numericPattern.test(noTelepon)) {
            alert('No Telepon hanya dapat berupa angka. Contoh: 0211234567');
            return;
        }

        // Submit the form if all validations pass
        form.submit();
    }

    document.addEventListener('DOMContentLoaded', function() {
        const wnaRadio = document.getElementById('wnaRadio');
        const negaraDiv = document.getElementById('negaraDiv');

        // Show the Negara input if WNA is already selected
        if (wnaRadio.checked) {
            negaraDiv.style.display = 'block';
        }

        document.querySelectorAll('input[name="kewarganegaraan_akun"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                if (wnaRadio.checked) {
                    negaraDiv.style.display = 'block';
                } else {
                    negaraDiv.style.display = 'none';
                    document.getElementById('negara').value =
                        ''; // Clear the Negara input if WNA is deselected
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Event listener for Provinsi dropdown
        document.getElementById('provinsiMahasiswa').addEventListener('change', function() {
            let provinsiId = this.value;
            if (provinsiId) {
                fetch(`/get-kabkot/${provinsiId}`)
                    .then(response => response.json())
                    .then(data => {
                        let kabkotSelect = document.getElementById('KabKotMahasiswa');
                        kabkotSelect.innerHTML = '<option value="">Pilih Kabkot</option>';
                        data.kabkot.forEach(kabkot => {
                            kabkotSelect.innerHTML +=
                                `<option value="${kabkot.id_kabkot}">${kabkot.nama_kabkot}</option>`;
                        });
                        // Reset kecamatan dropdown
                        document.getElementById('kecamatanMahasiswa').innerHTML =
                            '<option value="">Pilih Kecamatan</option>';
                    });
            } else {
                document.getElementById('KabKotMahasiswa').innerHTML =
                    '<option value="">Pilih Kabkot</option>';
                document.getElementById('kecamatanMahasiswa').innerHTML =
                    '<option value="">Pilih Kecamatan</option>';
            }
        });

        // Event listener for Kabkot dropdown
        document.getElementById('KabKotMahasiswa').addEventListener('change', function() {
            let kabkotId = this.value;
            if (kabkotId) {
                fetch(`/get-kecamatan/${kabkotId}`)
                    .then(response => response.json())
                    .then(data => {
                        let kecamatanSelect = document.getElementById('kecamatanMahasiswa');
                        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                        data.kecamatan.forEach(kecamatan => {
                            kecamatanSelect.innerHTML +=
                                `<option value="${kecamatan.id_kecamatan}">${kecamatan.nama_kecamatan}</option>`;
                        });
                    });
            } else {
                document.getElementById('kecamatanMahasiswa').innerHTML =
                    '<option value="">Pilih Kecamatan</option>';
            }
        });

        document.getElementById('provinsilahir').addEventListener('change', function() {
            let provinsiId = this.value;
            if (provinsiId) {
                fetch(`/get-kabkot/${provinsiId}`)
                    .then(response => response.json())
                    .then(data => {
                        let kabkotSelect = document.getElementById('KabKotLahir');
                        kabkotSelect.innerHTML = '<option value="">Pilih Kabkot</option>';
                        data.kabkot.forEach(kabkot => {
                            kabkotSelect.innerHTML +=
                                `<option value="${kabkot.id_kabkot}">${kabkot.nama_kabkot}</option>`;
                        });
                        // Reset kecamatan dropdown
                        document.getElementById('kecamatanMahasiswa').innerHTML =
                            '<option value="">Pilih Kecamatan</option>';
                    });
            } else {
                document.getElementById('KabKotLahir').innerHTML =
                    '<option value="">Pilih Kabkot</option>';
                document.getElementById('kecamatanMahasiswa').innerHTML =
                    '<option value="">Pilih Kecamatan</option>';
            }
        });

        // Event listener for Kabkot dropdown
        document.getElementById('KabKotLahir').addEventListener('change', function() {
            let kabkotId = this.value;
            if (kabkotId) {
                fetch(`/get-kecamatan/${kabkotId}`)
                    .then(response => response.json())
                    .then(data => {
                        let kecamatanSelect = document.getElementById('kecamatanMahasiswa');
                        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                        data.kecamatan.forEach(kecamatan => {
                            kecamatanSelect.innerHTML +=
                                `<option value="${kecamatan.id_kecamatan}">${kecamatan.nama_kecamatan}</option>`;
                        });
                    });
            } else {
                document.getElementById('kecamatanMahasiswa').innerHTML =
                    '<option value="">Pilih Kecamatan</option>';
            }
        });

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
    });
</script>
