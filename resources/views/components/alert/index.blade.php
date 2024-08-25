<div id="toast-success"
    class="fixed top-28 left-1/2 z-[9999] transform -translate-x-1/2 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 animate-slide-down"
    role="alert">
    @if (session('success'))
        <div
            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
    @else
        <div
            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z">
                </path>
            </svg>
            <span class="sr-only">Cross icon</span>
        </div>
    @endif
    <div class="ms-3 text-sm font-normal">{{ session('success') }} {{ session('error') }}</div>
    <button type="button"
        class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
        data-dismiss-target="#toast-success" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var toast = document.getElementById('toast-success');
        @if (session('success'))
            setTimeout(function() {
                // setTimeout(function() {
                toast.classList.add('hidden');
                // }, 2000);
            }, 2000); // 2000 milidetik = 2 detik

            // Fungsi untuk menutup toast secara manual jika diperlukan
            var closeButton = toast.querySelector('[data-dismiss-target]');
            closeButton.addEventListener('click', function() {
                toast.classList.add('hidden');
            });
        @elseif (session('error'))
            setTimeout(function() {
                // setTimeout(function() {
                toast.classList.add('hidden');
                // }, 2000);
            }, 2000); // 2000 milidetik = 2 detik

            // Fungsi untuk menutup toast secara manual jika diperlukan
            var closeButton = toast.querySelector('[data-dismiss-target]');
            closeButton.addEventListener('click', function() {
                toast.classList.add('hidden');
            });
        @else
            toast.classList.add('hidden');
        @endif
    });
</script>
