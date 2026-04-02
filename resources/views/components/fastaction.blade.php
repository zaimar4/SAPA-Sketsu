<div class="w-full bg-white rounded-2xl shadow-lg shadow-slate-200/60 p-6 border border-slate-100">
    <div class="mb-6">
        <h3 class="text-lg font-bold text-slate-900">Aksi Cepat</h3>
        <p class="text-slate-400 text-sm mt-0.5">Fitur yang sering digunakan</p>
    </div>

    <div class="space-y-3">
        {{-- Trigger modal Alpine.js --}}
        <button
            type="button"
            @click="$dispatch('open-modal')"
            class="w-full flex items-center gap-4 p-4 rounded-xl border border-slate-100 bg-slate-50/30 hover:bg-indigo-50 hover:border-indigo-200 transition-all group shadow-sm cursor-pointer">
            <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-xl bg-white border border-slate-100 shadow-sm text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                <i class="fa-solid fa-circle-plus text-base"></i>
            </div>
            <span class="font-bold text-slate-700 group-hover:text-indigo-700 text-sm text-left">
                Buat Laporan Baru
            </span>
        </button>

        <a href="{{ route('user.reports-all') }}"
            class="w-full flex items-center gap-4 p-4 rounded-xl border border-slate-100 bg-slate-50/30 hover:bg-blue-50 hover:border-blue-200 transition-all group shadow-sm">
            <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-xl bg-white border border-slate-100 shadow-sm text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all">
                <i class="fa-solid fa-file-invoice text-base"></i>
            </div>
            <span class="font-bold text-slate-700 group-hover:text-blue-700 text-sm text-left">
                Lihat Riwayat Laporan
            </span>
        </a>
    </div>
</div>