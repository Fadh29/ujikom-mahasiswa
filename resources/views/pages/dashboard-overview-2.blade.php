@extends('../../themes/' . $activeTheme . '/' . $activeLayout)

@section('subhead')
    <title>List Daftar Mahasiswa</title>
@endsection

@section('subcontent')
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <!-- Search Bar and Title -->
        <div class="flex justify-between items-center mb-6"> <!-- Increased margin-bottom -->
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Daftar Akun</h2>

            <div class="hidden sm:block relative">
                <form method="GET" action="{{ route('dashboard-overview-2') }}">
                    <x-base.form-input name="search" value="{{ request('search') }}"
                        class="w-56 rounded-full border-transparent bg-slate-200 pr-8 shadow-none transition-[width] duration-300 ease-in-out focus:w-72 focus:border-transparent dark:bg-darkmode-400/70"
                        type="text" placeholder="Search..." />
                    <button type="submit"
                        class="absolute inset-y-0 right-0 my-auto mr-3 h-5 w-5 text-slate-600 dark:text-slate-500">
                        <x-base.lucide icon="Search" />
                    </button>
                </form>
            </div>
        </div>

        <!-- Table -->
        @if ($akunList->isEmpty())
            <p class="text-center text-gray-600 dark:text-gray-400">Mahasiswa Tidak Ada Di Database</p>
        @else
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama Akun</th>
                        <th scope="col" class="px-6 py-3">Email Akun</th>
                        <th scope="col" class="px-6 py-3">Nomor Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($akunList as $akun)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $akun->nama_akun }}
                            </th>
                            <td class="px-6 py-4">{{ $akun->email_akun }}</td>
                            <td class="px-6 py-4">{{ $akun->nomortelepon_akun }}</td>
                            <td class="px-6 py-4 text-right">
                                <x-base.button
                                    type="button"
                                    variant="primary"
                                    class="mt-4"
                                    onclick="window.location.href='{{ route('detailMahasiswa', ['uid' => $akun->uid_akun]) }}'">
                                    Detail
                                </x-base.button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-600 dark:text-gray-400">Mahasiswa Tidak Ada Di
                                Database</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endif
    </div>
@endsection

{{-- @section('custom-script')
    <script>
        let selectedFormOld = null

        function showLayananForm() {


            var selectedLayanan = document.getElementsByName("select_name_layanan")[0].value;
            console.log(selectedLayanan, 'selectedLayanan')
            var selectedForm = document.getElementById(selectedLayanan);
            if (selectedForm) {
                selectedForm.style.display = "";
                console.log(selectedFormOld)
                if (selectedFormOld != null) {

                    selectedFormOld.style.display = "none";
                }
                selectedFormOld = selectedForm
            }
        }

        function onVisible(element, callback) {
            new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.intersectionRatio > 0) {
                        callback(element);
                    }
                });
            }).observe(element);
            if (!callback) return new Promise(r => callback = r);
        }

        function onCallbackVisible() {
            let elementsFormLayanan = document.getElementsByClassName('forms_name_layanan')
            console.log(elementsFormLayanan)

            let valSelectNameLayanan = document.getElementsByName('select_name_layanan')[0].value

            for (let i = 0; i < elementsFormLayanan.length; i++) {
                elementsFormLayanan[i].setAttribute('value', valSelectNameLayanan.toString().replaceAll('form', ''))
            }

        }

        // perbanytak sebanyak form
        onVisible(document.querySelector("#form1"), onCallbackVisible);
        onVisible(document.querySelector("#form2"), onCallbackVisible);
        onVisible(document.querySelector("#form3"), onCallbackVisible);
        onVisible(document.querySelector("#form4"), onCallbackVisible);
        onVisible(document.querySelector("#form5"), onCallbackVisible);
        onVisible(document.querySelector("#form6"), onCallbackVisible);
        onVisible(document.querySelector("#form13"), onCallbackVisible);
    </script>
    <script>
        $('#keteranganlayananpembuatanaplikasi').summernote({
            placeholder: 'Masukkan Pertanyaan',
            tabsize: 2,
            height: 300,
        });
    </script>
    <script>
        function formSubmit(formId) {
            var form = document.getElementById(formId);
            var isValid = true;
            var requiredFields = form.querySelectorAll('[required]');
            requiredFields.forEach(function(field) {
                if (field.value.trim() === '') {
                    isValid = false;
                    var label = form.querySelector(`[for=${field.id}]`);
                    var labelText = label.innerText.trim();

                    alert(`Kolom ${labelText} harus diisi!`);
                    field.classList.add('border', 'border-red-500');
                }
            });

            if (isValid) {
                form.submit();
            }
        }
    </script>
@endsection --}}
