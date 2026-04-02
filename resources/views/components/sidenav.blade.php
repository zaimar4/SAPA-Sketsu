<div class="w-54 bg-slate-900 text-white h-screen flex flex-col shadow-xl fixed r-">
    
    <div class="p-6 flex items-center gap-3 border-b border-slate-800">
        <img src="{{ asset('images/logosketsu-removebg-preview.png') }}" alt="Logo Sketsu" class="h-8 w-auto">
        <span class="font-bold text-lg tracking-tight">SAPA <span class="text-indigo-500">Sketsu</span></span>
    </div>

    <nav class="flex-1 p-4 space-y-2">
        <p class="text-xs font-semibold text-slate-500 uppercase px-3 pb-2">Menu Utama</p>
        
        <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 text-slate-300 hover:bg-indigo-600 hover:text-white rounded-lg transition-all duration-200 group">
            <i class="fa-solid fa-house w-5 h-5 mr-3 text-slate-400 group-hover:text-white"></i>
            <span class="font-medium">Dashboard</span>
        </a>
        <a href="{{ route('user.reports-all') }}" class="flex items-center px-3 py-2 text-slate-300 hover:bg-indigo-600 hover:text-white rounded-lg transition-all duration-200 group">
            <i class="fa-solid fa-house w-5 h-5 mr-3 text-slate-400 group-hover:text-white"></i>
            <span class="font-medium">Laporan Saya</span>
        </a>

       
    </nav>

    <div class="p-4 border-t border-slate-800">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="flex items-center w-full px-3 py-2 text-rose-400 hover:bg-rose-500/10 rounded-lg transition-all">
                <i class="fa-solid fa-right-from-bracket mr-3"></i>
                <span class="font-medium">Keluar</span>
            </button>
        </form>
    </div>
</div>