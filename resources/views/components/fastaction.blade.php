<div class="w-full bg-white rounded-2xl shadow-lg shadow-slate-200/60 p-6 border border-slate-100">
    <div class="mb-6">
        <h3 class="text-lg font-bold text-slate-900">Aksi Cepat</h3>
        <p class="text-slate-400 text-sm mt-0.5">Navigasi instan fitur utama</p>
    </div>

    <div class="space-y-3">
        @if (Auth::user()->role == 'admin')
            
            <button type="button" @click="$dispatch('open-modal')"
                class="w-full flex items-center gap-4 p-4 rounded-xl border border-slate-100 bg-slate-50/30 hover:bg-indigo-50 hover:border-indigo-200 transition-all group shadow-sm cursor-pointer">
                <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-xl bg-white border border-slate-100 shadow-sm text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                    <i class="fa-solid fa-bolt-lightning text-base"></i>
                </div>
                <div class="text-left">
                    <p class="font-bold text-slate-700 group-hover:text-indigo-700 text-sm leading-tight">Update Status Instan</p>
                    <p class="text-[10px] text-slate-400 font-medium mt-1 uppercase tracking-tighter">Kelola progress laporan</p>
                </div>
            </button>

            <a href="{{ route('admin.reports') }}"
                class="w-full flex items-center gap-4 p-4 rounded-xl border border-slate-100 bg-slate-50/30 hover:bg-blue-50 hover:border-blue-200 transition-all group shadow-sm">
                <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-xl bg-white border border-slate-100 shadow-sm text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all">
                    <i class="fa-solid fa-clipboard-list text-base"></i>
                </div>
                <div class="text-left">
                    <p class="font-bold text-slate-700 group-hover:text-blue-700 text-sm leading-tight">Manajemen Laporan</p>
                    <p class="text-[10px] text-slate-400 font-medium mt-1 uppercase tracking-tighter">Lihat semua data masuk</p>
                </div>
            </a>

            <button type="button" @click="$dispatch('open-export-modal')"
                class="w-full flex items-center gap-4 p-4 rounded-xl border border-slate-100 bg-slate-50/30 hover:bg-emerald-50 hover:border-emerald-200 transition-all group shadow-sm">
                <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-xl bg-white border border-slate-100 shadow-sm text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                    <i class="fa-solid fa-file-export text-base"></i>
                </div>
                <div class="text-left">
                    <p class="font-bold text-slate-700 group-hover:text-emerald-700 text-sm leading-tight">Cetak Rekap Data</p>
                    <p class="text-[10px] text-slate-400 font-medium mt-1 uppercase tracking-tighter">Bisa pilih bulan & tahun</p>
                </div>
            </button>

        @else

            
            <button type="button" @click="$dispatch('open-modal')"
                class="w-full flex items-center gap-4 p-4 rounded-xl border border-slate-100 bg-slate-50/30 hover:bg-indigo-50 hover:border-indigo-200 transition-all group shadow-sm cursor-pointer">
                <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-xl bg-white border border-slate-100 shadow-sm text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                    <i class="fa-solid fa-circle-plus text-base"></i>
                </div>
                <span class="font-bold text-slate-700 group-hover:text-indigo-700 text-sm">Buat Laporan Baru</span>
            </button>

            <a href="{{ route('user.reports-all') }}"
                class="w-full flex items-center gap-4 p-4 rounded-xl border border-slate-100 bg-slate-50/30 hover:bg-blue-50 hover:border-blue-200 transition-all group shadow-sm">
                <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-xl bg-white border border-slate-100 shadow-sm text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all">
                    <i class="fa-solid fa-clock-rotate-left text-base"></i>
                </div>
                <span class="font-bold text-slate-700 group-hover:text-blue-700 text-sm">Riwayat Laporan Saya</span>
            </a>
        @endif
    </div>
</div>