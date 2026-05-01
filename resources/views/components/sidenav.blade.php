<div x-data="{ sideBarOpen: false }">
    <button @click="sideBarOpen = true"
        class="lg:hidden fixed top-4 left-4 z-40 bg-slate-900 text-white p-3 rounded-xl shadow-lg hover:bg-indigo-600 transition-colors">
        <i class="fa-solid fa-bars-staggered"></i>
    </button>

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

    <div :class="sideBarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="w-64 bg-slate-900 text-white h-screen flex flex-col shadow-2xl fixed left-0 top-0 z-[50] transition-transform duration-300 ease-in-out border-r border-slate-800">

        <div class="p-6 flex items-center justify-between border-b border-slate-800/50">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logosketsu-removebg-preview.png') }}" alt="Logo Sketsu" class="h-9 w-auto">
                <div>
                    <h1 class="font-black text-lg leading-none tracking-tight">SAPA</h1>
                    <p class="text-[10px] font-bold text-indigo-500 uppercase tracking-[0.2em]">Sketsu</p>
                </div>
            </div>
            <button @click="sideBarOpen = false" class="lg:hidden text-slate-400 hover:text-white transition-colors">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <nav class="flex-1 p-4 space-y-7 overflow-y-auto custom-scrollbar">
            
            @if (Auth::user()->role == 'admin')
                <div>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] px-3 mb-4">Menu Utama</p>
                    <div class="space-y-1">
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group
                            {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <i class="fa-solid fa-house w-5 text-center text-sm"></i>
                            <span class="font-bold text-sm">Dashboard</span>
                        </a>

                        @php
                            $pendingCount = \App\Models\Complaint::where('status', 'pending')->count();
                        @endphp

                        <a href="{{ route('admin.reports') }}"
                            class="flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-200 group
                            {{ request()->routeIs('admin.reports') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-file-lines w-5 text-center text-sm"></i>
                                <span class="font-bold text-sm">Semua Laporan</span>
                            </div>
                            @if($pendingCount > 0)
                                <span class="bg-rose-500 text-[10px] font-black px-2 py-0.5 rounded-lg shadow-sm">
                                    {{ $pendingCount }}
                                </span>
                            @endif
                        </a>
                    </div>
                </div>

                <div>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] px-3 mb-4">Layanan Data</p>
                    <div class="space-y-1">
                        <button onclick="window.dispatchEvent(new CustomEvent('open-export-modal'))"
                            class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-emerald-500/10 hover:text-emerald-400 transition-all group text-left">
                            <i class="fa-solid fa-file-export w-5 text-center text-sm transition-transform group-hover:-translate-y-0.5"></i>
                            <span class="font-bold text-sm">Ekspor Laporan</span>
                        </button>
                        
                       
                    </div>
                </div>
            @endif

            @if (Auth::user()->role == 'user')
                <div>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] px-3 mb-4">Menu Utama</p>
                    <div class="space-y-1">
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group
                            {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <i class="fa-solid fa-house w-5 text-center text-sm"></i>
                            <span class="font-bold text-sm">Dashboard</span>
                        </a>

                        <a href="{{ route('user.reports-all') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group
                            {{ request()->routeIs('user.reports-all') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <i class="fa-solid fa-file-lines w-5 text-center text-sm"></i>
                            <span class="font-bold text-sm">Laporan Saya</span>
                        </a>
                    </div>
                </div>
            @endif

        </nav>

        <div class="p-4 bg-slate-900/50 border-t border-slate-800/50 backdrop-blur-md">
            <div class="flex items-center gap-3 px-3 mb-5 group cursor-pointer">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white shadow-lg shadow-indigo-500/20 group-hover:rotate-6 transition-transform flex-shrink-0">
                    <span class="font-black text-sm">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
                <div class="truncate">
                    <p class="text-sm font-black text-white truncate leading-none mb-1">{{ Auth::user()->name }}</p>
                    <span class="text-[9px] font-bold text-slate-500 uppercase tracking-widest">{{ Auth::user()->role }}</span>
                </div>
            </div>
            
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="flex items-center justify-center gap-2 w-full py-3 bg-rose-500/10 hover:bg-rose-500 text-rose-500 hover:text-white rounded-xl transition-all duration-300 font-bold text-xs uppercase tracking-widest group">
                    <i class="fa-solid fa-power-off transition-transform group-hover:rotate-90"></i>
                    <span>Keluar Aplikasi</span>
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #334155; }
</style>