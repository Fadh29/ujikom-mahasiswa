@extends('../themes/base')

@section('head')
    <title>Login - Midone - Tailwind Admin Dashboard Template</title>
    {{-- @turnstileScripts() --}}
@endsection

@section('content')
    <div @class([
        'p-3 sm:px-8 relative h-screen lg:overflow-hidden bg-primary xl:bg-white dark:bg-darkmode-800 xl:dark:bg-darkmode-600',
        'before:hidden before:xl:block before:content-[\'\'] before:w-[60%] before:-mt-[28%] before:-mb-[16%] before:-ml-[13%] before:absolute before:inset-y-0 before:left-0 before:transform before:rotate-[-30.5deg] before:bg-primary/20 before:rounded-[100%] before:dark:bg-darkmode-400',
        'after:hidden after:xl:block after:content-[\'\'] after:w-[60%] after:-mt-[20%] after:-mb-[18%] after:-ml-[18%] after:absolute after:inset-y-0 after:left-0 after:transform after:rotate-[-30.5deg] after:bg-primary after:rounded-[100%] after:dark:bg-darkmode-700',
    ])>
        <div class="container relative z-10 sm:px-10">
            <div class="block grid-cols-2 gap-4 xl:grid">
                <!-- BEGIN: Login Info -->
                <div class="hidden min-h-screen flex-col xl:flex">
                    <a class="-intro-x flex items-center pt-5" href="">
                        <img class="w-8" src="{{ Vite::asset('resources/images/lambang.png') }}"
                            alt="Midone - Tailwind Admin Dashboard Template" />
                        <span class="ml-3 text-3xl text-white break-words font-roboto font-bold"> Manajemen Web </span>
                    </a>
                    <div class="my-auto">
                        <img class="-intro-x -mt-16 w-1/2" src="{{ Vite::asset('resources/images/bg.png') }}"
                            alt="Midone - Tailwind Admin Dashboard Template" />
                        <div class="-intro-x mt-10 text-4xl font-medium leading-tight text-white break-words">
                            Manajemen Website <br />
                            Pemerintah Kabupaten Bogor
                        </div>
                        <div
                            class="-intro-x mt-5 text-base 2xl:text-lg text-white text-opacity-70 dark:text-slate-400 break-words">
                            E-ticketing dan monitoring website pemerintah Kabupaten Bogor
                        </div>
                    </div>
                </div>

                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="my-10 flex h-screen py-5 xl:my-0 xl:h-auto xl:py-0">
                    <div
                        class="mx-auto my-auto w-full rounded-md bg-white px-5 py-8 shadow-md dark:bg-darkmode-600 sm:w-3/4 sm:px-8 lg:w-2/4 xl:ml-20 xl:w-auto xl:bg-transparent xl:p-0 xl:shadow-none">
                        <h2 class="intro-x text-center text-2xl font-bold xl:text-left xl:text-3xl">
                            Login
                        </h2>
                        <x-base.tab.group class="mt-8">
                            {{-- <x-base.tab.list variant="tabs">
                                <x-base.tab id="example-1-tab" selected>
                                    <x-base.tab.button class="w-full py-2" as="button">
                                        SKPD
                                    </x-base.tab.button>
                                </x-base.tab>
                                <x-base.tab id="example-2-tab">
                                    <x-base.tab.button class="w-full py-2" as="button">
                                        Kec
                                    </x-base.tab.button>
                                </x-base.tab>
                                <x-base.tab id="example-3-tab">
                                    <x-base.tab.button class="w-full py-2" as="button">
                                        Desa
                                    </x-base.tab.button>
                                </x-base.tab>
                                <x-base.tab id="example-4-tab">
                                    <x-base.tab.button class="w-full py-2" as="button">
                                        Admin
                                    </x-base.tab.button>
                                </x-base.tab>
                            </x-base.tab.list> --}}
                            <x-base.tab.panels class="border-b border-l border-r">
                                <form action="{{ route('login.user') }}" method="POST">
                                    @csrf
                                    <div class="intro-x mt-8">
                                        <x-base.form-input class="intro-x block min-w-full px-4 py-3 xl:min-w-[350px]"
                                            type="text" placeholder="Masukkan Email " name="email_akun" />
                                        <x-base.form-input class="intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]"
                                            type="password" placeholder="Password" name="password" />
                                    </div>
                                    <div class="intro-x mt-5 text-center xl:mt-8">
                                        <x-base.button class="w-full px-4 py-3 align-top xl:mr-3" variant="primary"
                                            type="submit">
                                            Login
                                        </x-base.button>
                                    </div>
                                </form>
                            </x-base.tab.panels>
                        </x-base.tab.group>
                        {{-- {!! NoCaptcha::renderJs() !!} --}}
                        {{-- <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script> --}}
                    </div>
                </div>

                {{-- <div class="my-10 flex h-screen py-5 xl:my-0 xl:h-auto xl:py-0">
                    <div
                        class="mx-auto my-auto w-full rounded-md bg-white px-5 py-8 shadow-md dark:bg-darkmode-600 sm:w-3/4 sm:px-8 lg:w-2/4 xl:ml-20 xl:w-auto xl:bg-transparent xl:p-0 xl:shadow-none">
                        <h2 class="intro-x text-center text-2xl font-bold xl:text-left xl:text-3xl">
                            Login
                        </h2>
                        <div class="intro-x mt-2 text-center text-slate-400 xl:hidden">
                            A few more clicks to Login to your account. Manage all your
                            e-commerce accounts in one place
                        </div>
                        <form action="{{ route('loginsuperadmin') }}" method="POST">
                            @csrf
                            <div class="intro-x mt-8">
                                <x-base.form-input class="intro-x block min-w-full px-4 py-3 xl:min-w-[350px]"
                                    type="text" placeholder="Email" name="name_instansi"/>
                                <x-base.form-input class="intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]"
                                    type="password" placeholder="Password" name="password" />
                            </div>
                            <div class="intro-x mt-4 flex text-xs text-slate-600 dark:text-slate-500 sm:text-sm">
                                <div class="mr-auto flex items-center">
                                    <x-base.form-check.input class="mr-2 border" id="remember-me" type="checkbox" />
                                    <label class="cursor-pointer select-none" for="remember-me">
                                        Remember me
                                    </label>
                                </div>
                                <a href="">Lupa Password?</a>
                            </div>
                            <div class="intro-x mt-5 text-center xl:mt-8 xl:text-left">
                                <x-base.button class="w-full px-4 py-3 align-top xl:mr-3 xl:w-32" variant="primary"
                                    type="submit">
                                    Login
                                </x-base.button>
                                <x-base.button class="mt-3 w-full px-4 py-3 align-top xl:mt-0 xl:w-32"
                                    variant="outline-secondary">
                                    Register
                                </x-base.button>
                            </div>
                        </form>
                    </div>
                </div> --}}
                <!-- END: Login Form -->
            </div>
        </div>
    </div>
@endsection
