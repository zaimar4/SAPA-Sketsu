<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center p-6" style="background-color: #f1f5f9;">
        <div class="w-full max-w-[420px]">

            {{-- Logo & Header --}}
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('images/logosketsu-removebg-preview.png') }}"
                         alt="Logo SMKN 1 Sukorejo"
                         class="h-20 w-auto drop-shadow-sm">
                </div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">
                    SAPA <span class="text-indigo-600">Sketsu</span>
                </h1>
                <p class="text-xs font-medium text-slate-400 mt-1 tracking-wide">
                    Silakan masuk untuk akses laporan
                </p>
            </div>

            {{-- Card --}}
            <div class="bg-white rounded-[2rem] border border-slate-200/80 px-8 py-9"
                 style="box-shadow: 0 8px 40px 0 rgba(99,102,241,0.07), 0 1.5px 8px 0 rgba(0,0,0,0.04);">

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email"
                               class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2">
                            Alamat Email
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-300 pointer-events-none">
                                <i class="fa-solid fa-envelope text-xs"></i>
                            </span>
                            <input id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required autofocus
                                placeholder="Masukkan email anda"
                                class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm text-slate-800 placeholder:text-slate-300 focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-500/10 transition-all outline-none" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Password --}}
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password"
                                   class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">
                                Kata Sandi
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                   class="text-[10px] font-bold text-indigo-500 hover:text-indigo-700 uppercase tracking-wider transition-colors">
                                    Lupa Sandi?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-300 pointer-events-none">
                                <i class="fa-solid fa-lock text-xs"></i>
                            </span>
                            <input id="password"
                                type="password"
                                name="password"
                                required
                                placeholder="••••••••"
                                class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm text-slate-800 placeholder:text-slate-300 focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-500/10 transition-all outline-none" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center">
                        <input id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="w-4 h-4 rounded bg-slate-100 border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
                        <label for="remember_me"
                               class="ml-2.5 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] cursor-pointer select-none">
                            Ingat Saya
                        </label>
                    </div>

                    {{-- Submit --}}
                    <div class="pt-2">
                        <button type="submit"
                            class="w-full py-3.5 bg-indigo-600 hover:bg-indigo-700 active:scale-[0.98] text-white text-xs font-black uppercase tracking-[0.2em] rounded-2xl transition-all"
                            style="box-shadow: 0 4px 20px 0 rgba(99,102,241,0.3);">
                            Masuk Aplikasi
                        </button>
                    </div>

                </form>
            </div>

            {{-- Register Link --}}
            <div class="mt-6 text-center">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                    Belum punya akun?
                    <a href="{{ route('register') }}"
                       class="text-indigo-600 hover:text-indigo-800 ml-1 underline underline-offset-4 transition-colors">
                        Daftar Sekarang
                    </a>
                </p>
            </div>

            {{-- Footer --}}
            <p class="text-center mt-5 text-[9px] font-black text-slate-300 uppercase tracking-[0.25em]">
                &copy; 2026 SAPA Sketsu &bull; SMK Negeri 1 Sukorejo
            </p>

        </div>
    </div>
</x-guest-layout>