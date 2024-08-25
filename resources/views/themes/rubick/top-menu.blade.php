@extends('../themes/base')

@section('head')
    @yield('subhead')
@endsection

@section('content')
    <div @class([
        'rubick px-5 sm:px-8 py-5',
        "before:content-[''] before:bg-gradient-to-b before:from-theme-1 before:to-theme-2 dark:before:from-darkmode-800 dark:before:to-darkmode-800 before:fixed before:inset-0 before:z-[-1]",
    ])>
        <x-mobile-menu />
        <!-- BEGIN: Top Bar -->
        <div class="-mx-5 mb-10 mt-[2.2rem] border-b border-white/[0.08] px-3 pt-3 sm:-mx-8 sm:px-8 md:-mt-5 md:pt-0">
            <div class="relative z-[51] flex h-[70px] items-center">
                <!-- BEGIN: Logo -->
                <a class="-intro-x hidden md:flex" href="">
                    <div class="flex items-center justify-center h-full">
                        <span class="text-2xl text-white font-bold">
                            Selamat Datang, {{ auth()->guard('admin')->user()->nama_akun }}
                        </span>
                    </div>

                </a>
                <!-- END: Logo -->
                <!-- BEGIN: Breadcrumb -->
                <x-base.breadcrumb class="-intro-x mr-auto h-full border-white/[0.08] md:ml-10 md:border-l md:pl-10" light>

                </x-base.breadcrumb>
                <!-- END: Breadcrumb -->
                <!-- BEGIN: Search -->
                <div class="search intro-x relative mr-3 sm:mr-6">

                    <a class="relative text-white/70 sm:hidden" href="">
                        <x-base.lucide class="h-5 w-5 dark:text-slate-500" icon="Search" />
                    </a>
                    <x-base.transition class="search-result absolute right-0 z-10 mt-[3px] hidden" selector=".show"
                        enter="transition-all ease-linear duration-150" enterFrom="mt-5 invisible opacity-0 translate-y-1"
                        enterTo="mt-[3px] visible opacity-100 translate-y-0" leave="transition-all ease-linear duration-150"
                        leaveFrom="mt-[3px] visible opacity-100 translate-y-0"
                        leaveTo="mt-5 invisible opacity-0 translate-y-1">
                        <div class="box w-[450px] p-5">
                            <div class="mb-2 font-medium">Pages</div>
                            <div class="mb-5">
                                <a class="flex items-center" href="">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-success/20 text-success dark:bg-success/10">
                                        <x-base.lucide class="h-4 w-4" icon="Inbox" />
                                    </div>
                                    <div class="ml-3">Mail Settings</div>
                                </a>
                                <a class="mt-2 flex items-center" href="">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-pending/10 text-pending">
                                        <x-base.lucide class="h-4 w-4" icon="Users" />
                                    </div>
                                    <div class="ml-3">Users & Permissions</div>
                                </a>
                                <a class="mt-2 flex items-center" href="">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-primary/10 text-primary/80 dark:bg-primary/20">
                                        <x-base.lucide class="h-4 w-4" icon="CreditCard" />
                                    </div>
                                    <div class="ml-3">Transactions Report</div>
                                </a>
                            </div>
                            <div class="mb-2 font-medium">Users</div>
                            <div class="mb-5">
                                @foreach (array_slice($fakers, 0, 4) as $faker)
                                    <a class="mt-2 flex items-center" href="">
                                        <div class="image-fit h-8 w-8">
                                            <img class="rounded-full" src="{{ Vite::asset($faker['photos'][0]) }}"
                                                alt="Midone - Tailwind Admin Dashboard Template" />
                                        </div>
                                        <div class="ml-3">{{ $faker['users'][0]['name'] }}</div>
                                        <div class="ml-auto w-48 truncate text-right text-xs text-slate-500">
                                            {{ $faker['users'][0]['email'] }}
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="mb-2 font-medium">Products</div>
                            @foreach (array_slice($fakers, 0, 4) as $faker)
                                <a class="mt-2 flex items-center" href="">
                                    <div class="image-fit h-8 w-8">
                                        <img class="rounded-full" src="{{ Vite::asset($faker['images'][0]) }}"
                                            alt="Midone - Tailwind Admin Dashboard Template" />
                                    </div>
                                    <div class="ml-3">{{ $faker['products'][0]['name'] }}</div>
                                    <div class="ml-auto w-48 truncate text-right text-xs text-slate-500">
                                        {{ $faker['products'][0]['category'] }}
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </x-base.transition>
                </div>
                <!-- END: Search -->
                <!-- BEGIN: Notifications -->

                <!-- END: Notifications -->
                <!-- BEGIN: Account Menu -->
                <x-base.menu>
                    <x-base.menu.button
                        class="image-fit zoom-in intro-x block h-8 w-8 scale-110 overflow-hidden rounded-full shadow-lg">
                        <img src="{{ Vite::asset('resources/images/images.png') }}"
                            alt="Midone - Tailwind Admin Dashboard Template" />
                    </x-base.menu.button>
                    <x-base.menu.items
                        class="relative mt-px w-56 bg-theme-1/80 text-white before:absolute before:inset-0 before:z-[-1] before:block before:rounded-md before:bg-black">
                        <x-base.menu.item class="hover:bg-white/5" data-tw-merge data-tw-toggle="modal"
                            data-tw-target="#logout-modal-preview">
                            <x-base.lucide class="mr-2 h-4 w-4" icon="ToggleRight" />
                            Logout
                        </x-base.menu.item>
                    </x-base.menu.items>
                </x-base.menu>
                <!-- END: Account Menu -->
            </div>
        </div>
        <div data-tw-backdrop="" aria-hidden="true" tabindex="-1" id="logout-modal-preview"
            class="modal group bg-black/60 transition-[visibility,opacity] w-screen h-screen fixed left-0 top-0 [&amp;:not(.show)]:duration-[0s,0.2s] [&amp;:not(.show)]:delay-[0.2s,0s] [&amp;:not(.show)]:invisible [&amp;:not(.show)]:opacity-0 [&amp;.show]:visible [&amp;.show]:opacity-100 [&amp;.show]:duration-[0s,0.4s]">
            <div data-tw-merge
                class="w-[90%] mx-auto bg-white relative rounded-md shadow-md transition-[margin-top,transform] duration-[0.4s,0.3s] -mt-16 group-[.show]:mt-16 group-[.modal-static]:scale-[1.05] dark:bg-darkmode-600 sm:w-[460px]">
                <div class="p-5 text-center">
                    <i data-tw-merge data-lucide="log-out" class="stroke-1.5 text-danger mx-auto mt-3 h-10 w-10"></i>
                    <div class="mt-5 text-3xl">Anda yakin ingin logout?</div>
                    {{-- <div class="mt-2 text-slate-500">
                    Do you really want to delete these records? <br />
                    This process cannot be undone.
                </div> --}}
                </div>
                <div class="px-5 pb-8 text-center flex justify-evenly">
                    <div class="col text-center">
                        <button data-tw-merge data-tw-dismiss="modal" type="button"
                            class="hover:bg-primary hover:bg-opacity-30 hover:border-primary justify-center hover:text-primary py-2 dark:text-white shadow-sm inline-flex dark:bg-slate-700 w-24 rounded-md">Cancel</button>
                    </div>
                    <div class="col">
                        <a data-tw-merge type="button" href="{{ route('logout') }}"
                            class="transition duration-200 border flex-fill shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-danger border-danger text-white dark:border-danger w-24">Logout</a>
                    </div>
                </div>

            </div>
        </div>
        <!-- END: Top Bar -->
        <!-- BEGIN: Top Menu -->
        <nav class="top-nav relative z-50 hidden md:block">
            <ul class="flex flex-wrap pb-3 xl:px-[50px] xl:pb-0">
                @foreach ($mainMenu as $menuKey => $menu)
                    <li>
                        <a href="{{ isset($menu['route_name']) ? route($menu['route_name'], isset($menu['params']) ? $menu['params'] : []) : 'javascript:;' }}"
                            @class([
                                $firstLevelActiveIndex == $menuKey
                                    ? 'top-menu top-menu--active'
                                    : 'top-menu',
                            ])>
                            <div class="top-menu__icon">
                                <x-base.lucide icon="{{ $menu['icon'] }}" />
                            </div>
                            <div class="top-menu__title">
                                {{ $menu['title'] }}
                                @if (isset($menu['sub_menu']))
                                    <x-base.lucide class="top-menu__sub-icon" icon="chevron-down" />
                                @endif
                            </div>
                        </a>
                        @if (isset($menu['sub_menu']))
                            <ul class="{{ $firstLevelActiveIndex == $menuKey ? 'top-menu__sub-open' : '' }}">
                                @foreach ($menu['sub_menu'] as $subMenuKey => $subMenu)
                                    <li>
                                        <a class="top-menu"
                                            href="{{ isset($subMenu['route_name']) ? route($subMenu['route_name'], isset($subMenu['params']) ? $subMenu['params'] : []) : 'javascript:;' }}">
                                            <div class="top-menu__icon">
                                                <x-base.lucide icon="{{ $subMenu['icon'] }}" />
                                            </div>
                                            <div class="top-menu__title">
                                                {{ $subMenu['title'] }}
                                                @if (isset($subMenu['sub_menu']))
                                                    <x-base.lucide class="top-menu__sub-icon" icon="chevron-down" />
                                                @endif
                                            </div>
                                        </a>
                                        @if (isset($subMenu['sub_menu']))
                                            <ul
                                                class="{{ $secondLevelActiveIndex == $subMenuKey ? 'top-menu__sub-open' : '' }}">
                                                @foreach ($subMenu['sub_menu'] as $lastSubMenuKey => $lastSubMenu)
                                                    <li>
                                                        <a class="top-menu"
                                                            href="{{ isset($lastSubMenu['route_name']) ? route($lastSubMenu['route_name'], isset($lastSubMenu['params']) ? $lastSubMenu['params'] : []) : 'javascript:;' }}">
                                                            <div class="top-menu__icon">
                                                                <x-base.lucide icon="{{ $lastSubMenu['icon'] }}" />
                                                            </div>
                                                            <div class="top-menu__title">{{ $lastSubMenu['title'] }}</div>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>
        <!-- END: Top Menu -->
        <!-- BEGIN: Content -->
        <div
            class="md:max-w-auto min-h-screen min-w-0 max-w-full flex-1 rounded-[30px] bg-slate-100 px-4 pb-10 before:block before:h-px before:w-full before:content-[''] dark:bg-darkmode-700 md:px-[22px]">
            @yield('subcontent')
        </div>
        <!-- END: Content -->
    </div>
@endsection

@pushOnce('styles')
    @vite('resources/css/themes/rubick/top-nav.css')
@endPushOnce

@pushOnce('scripts')
    @vite('resources/js/components/themes/rubick/top-bar.js')
@endPushOnce
