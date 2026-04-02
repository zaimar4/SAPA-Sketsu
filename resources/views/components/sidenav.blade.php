<div x-data="{ sideBarOpen: false }">
    {{-- Hamburger button (mobile only) --}}
    <button @click="sideBarOpen = true"
        class="lg:hidden fixed top-4 left-4 z-40 bg-slate-900 text-white p-3 rounded-xl shadow-lg">
        <i class="fa-solid fa-bars-staggered"></i>
    </button>

    {{-- Overlay backdrop (mobile) --}}
    <div x-show="sideBarOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="sideBarOpen = false"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[45] lg:hidden"
        x-cloak>
    </div>

    {{-- Sidebar --}}
    <div :class="sideBarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="w-64 bg-slate-900 text-white h-screen flex flex-col shadow-xl fixed left-0 top-0 z-[50] transition-transform duration-300 ease-in-out">

        {{-- Logo --}}
        <div class="p-5 flex items-center justify-between border-b border-slate-800">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logosketsu-removebg-preview.png') }}" alt="Logo Sketsu" class="h-8 w-auto">
                <span class="font-bold text-lg tracking-tight">SAPA <span class="text-indigo-500">Sketsu</span></span>
            </div>
            <button @click="sideBarOpen = false" class="lg:hidden text-slate-400 hover:text-white transition">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest px-3 pb-3">Menu Utama</p>

            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group
                    {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-indigo-600 hover:text-white' }}">
                <i class="fa-solid fa-house w-5 text-center
                    {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                <span class="font-semibold text-sm">Dashboard</span>
            </a>

            <a href="{{ route('user.reports-all') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group
                    {{ request()->routeIs('user.reports-all') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-indigo-600 hover:text-white' }}">
                <i class="fa-solid fa-file-lines w-5 text-center
                    {{ request()->routeIs('user.reports-all') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                <span class="font-semibold text-sm">Laporan Saya</span>
            </a>
        </nav>

        {{-- Logout --}}
        <div class="p-4 border-t border-slate-800">
            <div class="flex items-center gap-3 px-3 mb-4">
                <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="truncate">
                    <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-slate-500 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="flex items-center gap-3 w-full px-3 py-2.5 text-rose-400 hover:bg-rose-500/10 rounded-xl transition-all group">
                    <i class="fa-solid fa-right-from-bracket w-5 text-center transition-transform group-hover:translate-x-1"></i>
                    <span class="font-semibold text-sm">Keluar</span>
                </button>
            </form>
        </div>
    </div>
</div>