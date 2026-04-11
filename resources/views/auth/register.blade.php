<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center p-6 bg-slate-50">
        <div class="w-full max-w-[440px]">

            {{-- Header --}}
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('images/logosketsu-removebg-preview.png') }}" alt="Logo Sketsu" class="h-16 w-auto">
                </div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">
                    SAPA <span class="text-indigo-600">Sketsu</span>
                </h2>
                <p class="text-xs font-semibold text-slate-400 mt-1 tracking-wide">
                    Daftarkan akun untuk mulai melapor
                </p>
            </div>

            {{-- Card --}}
            <div class="bg-white px-8 py-9 rounded-[2rem] shadow-2xl shadow-slate-200/50 border border-slate-100">

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    {{-- Nama Lengkap --}}
                    <div>
                        <label for="name" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2 px-1">
                            Nama Lengkap
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-300 pointer-events-none">
                                <i class="fa-solid fa-user text-xs"></i>
                            </span>
                            <input id="name"
                                type="text"
                                name="name"
                                :value="old('name')"
                                required
                                autofocus
                                placeholder="Masukkan nama anda"
                                class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-transparent rounded-2xl text-sm text-slate-800 placeholder:text-slate-300 focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-500/10 transition-all outline-none" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2 px-1">
                            Alamat Email
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-300 pointer-events-none">
                                <i class="fa-solid fa-envelope text-xs"></i>
                            </span>
                            <input id="email"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required
                                placeholder="contoh@sekolah.com"
                                class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-transparent rounded-2xl text-sm text-slate-800 placeholder:text-slate-300 focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-500/10 transition-all outline-none" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2 px-1">
                            Kata Sandi
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-300 pointer-events-none">
                                <i class="fa-solid fa-lock text-xs"></i>
                            </span>
                            <input id="password"
                                type="password"
                                name="password"
                                required
                                placeholder="••••••••"
                                class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-transparent rounded-2xl text-sm text-slate-800 placeholder:text-slate-300 focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-500/10 transition-all outline-none" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2 px-1">
                            Konfirmasi Sandi
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-300 pointer-events-none">
                                <i class="fa-solid fa-shield-halved text-xs"></i>
                            </span>
                            <input id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                placeholder="Ulangi kata sandi"
                                class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-transparent rounded-2xl text-sm text-slate-800 placeholder:text-slate-300 focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-500/10 transition-all outline-none" />
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    {{-- Submit --}}
                    <div class="pt-1">
                        <button type="submit"
                            class="w-full flex justify-center items-center py-3.5 px-4 bg-indigo-600 hover:bg-indigo-700 active:scale-[0.98] text-white text-xs font-black uppercase tracking-[0.18em] rounded-2xl shadow-lg shadow-indigo-500/25 transition-all">
                            Buat Akun Sekarang
                        </button>
                    </div>

                </form>

                {{-- Login Link --}}
                <div class="mt-7 pt-7 border-t border-slate-100 text-center">
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 ml-1 underline underline-offset-4 transition-colors">
                            Masuk disini
                        </a>
                    </p>
                </div>

            </div>

            {{-- Footer --}}
            <p class="text-center mt-6 text-[9px] font-black text-slate-300 uppercase tracking-[0.25em]">
                SAPA SKETSU V2.0 &bull; 2026
            </p>

        </div>
    </div>
</x-guest-layout>