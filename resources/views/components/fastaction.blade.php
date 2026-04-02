<div class="w-full max-w-sm bg-white rounded-3xl shadow-xl shadow-slate-200/60 p-8 border border-slate-100">
    <div class="mb-8">
        <h3 class="text-2xl font-bold text-slate-900">Aksi Cepat</h3>
        <p class="text-slate-400 font-medium mt-1">Fitur yang sering digunakan</p>
    </div>

    <div class="space-y-4">
        
        <button class="w-full flex items-center gap-4 p-4 rounded-2xl border border-slate-100 bg-slate-50/30 hover:bg-indigo-50 hover:border-indigo-100 transition-all group">
            <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-slate-100 shadow-sm text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                <i class="fa-solid fa-circle-plus text-lg"></i>
            </div>
            <span class="font-bold text-slate-700 group-hover:text-indigo-700">Buat Laporan Baru</span>
        </button>

        <a href="{{ route('user.reports-all') }}" class="w-full flex items-center gap-4 p-4 rounded-2xl border border-slate-100 bg-slate-50/30 hover:bg-blue-50 hover:border-blue-100 transition-all group">
            <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-slate-100 shadow-sm text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all">
                <i class="fa-solid fa-file-invoice text-lg"></i>
            </div>
            <span class="font-bold text-slate-700 group-hover:text-blue-700 text-left">Lihat Riwayat Laporan</span>
        </a>

    </div>
</div>