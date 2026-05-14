@extends('layouts.layout')
@section('title','Dashboard Guru')

@section('content')
<div class="relative w-full" x-data={}>
    <x-sidenav></x-sidenav>

    <div class="lg:ml-64 min-h-screen bg-slate-50">
        
        <div class="p-4 sm:p-6 lg:p-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-8 w-full">
                <div class="flex-1 min-w-0">
                    <h2 class="text-slate-400 font-bold text-[10px] uppercase tracking-[0.2em]">Sistem Informasi SAPjA</h2>
                    <h1 class="text-slate-900 font-black text-xl sm:text-2xl lg:text-3xl mt-1 truncate">Halo, {{ Auth::user()->name }} </h1>
                </div>
                <div class="flex-shrink-0">
                    <a href="{{ route('admin.reports') }}" 
                        class="inline-flex items-center gap-2 bg-slate-900 hover:bg-indigo-600 text-white px-4 sm:px-6 py-3 sm:py-3.5 rounded-2xl font-black shadow-lg shadow-slate-200 transition-all hover:-translate-y-1 text-[10px] uppercase tracking-widest">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        <span class="hidden xs:inline">Eksplor Semua Laporan</span>
                        <span class="xs:hidden">Laporan</span>
                    </a>
                </div>
            </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6 sm:mb-8">
            <div class="bg-white p-3 sm:p-5 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-2 sm:gap-3">
                <div class="bg-indigo-50 text-indigo-600 w-9 h-9 sm:w-11 sm:h-11 rounded-xl flex-shrink-0 flex items-center justify-center text-base sm:text-lg shadow-inner">
                    <i class="fa-regular fa-file-lines"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-[8px] sm:text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none">Total</p>
                    <h3 class="text-lg sm:text-2xl font-black text-slate-900 mt-0.5">{{ $total }}</h3>
                </div>
            </div>

            <div class="bg-white p-3 sm:p-5 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-2 sm:gap-3">
                <div class="bg-amber-50 text-amber-500 w-9 h-9 sm:w-11 sm:h-11 rounded-xl flex-shrink-0 flex items-center justify-center text-base sm:text-lg shadow-inner">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-[8px] sm:text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none">Menunggu</p>
                    <h3 class="text-lg sm:text-2xl font-black text-slate-900 mt-0.5">{{ $totalPending }}</h3>
                </div>
            </div>

            <div class="bg-white p-3 sm:p-5 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-2 sm:gap-3">
                <div class="bg-blue-50 text-blue-600 w-9 h-9 sm:w-11 sm:h-11 rounded-xl flex-shrink-0 flex items-center justify-center text-base sm:text-lg shadow-inner">
                    <i class="fa-solid fa-spinner"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-[8px] sm:text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none">Proses</p>
                    <h3 class="text-lg sm:text-2xl font-black text-slate-900 mt-0.5">{{ $totalprocess }}</h3>
                </div>
            </div>

            <div class="bg-white p-3 sm:p-5 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-2 sm:gap-3">
                <div class="bg-emerald-50 text-emerald-600 w-9 h-9 sm:w-11 sm:h-11 rounded-xl flex-shrink-0 flex items-center justify-center text-base sm:text-lg shadow-inner">
                    <i class="fa-solid fa-check-double"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-[8px] sm:text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none">Selesai</p>
                    <h3 class="text-lg sm:text-2xl font-black text-slate-900 mt-0.5">{{ $totalresolved }}</h3>
                </div>
            </div>
        </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
                <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-200 shadow-md overflow-hidden">
                    <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-slate-100 flex justify-between items-center bg-white">
                        <div>
                            <h3 class="font-black text-slate-800 text-sm uppercase tracking-wider">Laporan Masuk Terbaru</h3>
                            <p class="text-[10px] text-slate-400 font-bold uppercase mt-0.5 tracking-tight italic hidden sm:block">Segera tindaklanjuti laporan yang tertunda</p>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-slate-50/50 text-slate-400 border-b border-slate-100">
                                <tr>
                                    <th class="px-4 sm:px-6 py-3 sm:py-4 text-[9px] font-black uppercase tracking-[0.1em]">Laporan</th>
                                    <th class="px-4 sm:px-6 py-3 sm:py-4 text-[9px] font-black uppercase tracking-[0.1em] text-center hidden sm:table-cell">Status</th>
                                    <th class="px-4 sm:px-6 py-3 sm:py-4 text-[9px] font-black uppercase tracking-[0.1em] text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($complaints as $item)
                                <tr class="hover:bg-slate-50/50 transition-all group">
                                    <td class="px-4 sm:px-6 py-4 sm:py-5">
                                        <p class="font-bold text-slate-800 text-sm group-hover:text-indigo-600 transition-colors leading-snug line-clamp-2">
                                            {{ $item->title }}
                                        </p>
                                        <div class="flex flex-wrap items-center gap-1.5 mt-1.5">
                                            <span class="text-[9px] font-black text-indigo-500 uppercase px-2 py-0.5 bg-indigo-50 rounded-md border border-indigo-100">
                                                {{ $item->category }}
                                            </span>
                                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">
                                                {{ $item->created_at->diffForHumans() }}
                                            </span>
                                            <span class="sm:hidden px-2 py-0.5 rounded-lg text-[9px] font-black uppercase tracking-widest
                                                @if($item->status == 'pending') bg-amber-50 text-amber-600 border border-amber-100 
                                                @elseif($item->status == 'process') bg-blue-50 text-blue-600 border border-blue-100
                                                @elseif($item->status == 'resolved') bg-emerald-50 text-emerald-600 border border-emerald-100
                                                @else bg-red-50 text-red-600 border border-red-100 @endif">
                                                {{ $item->status }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 sm:py-5 text-center hidden sm:table-cell">
                                        <span class="px-3 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest
                                            @if($item->status == 'pending') bg-amber-50 text-amber-600 border border-amber-100 
                                            @elseif($item->status == 'process') bg-blue-50 text-blue-600 border border-blue-100
                                            @elseif($item->status == 'resolved') bg-emerald-50 text-emerald-600 border border-emerald-100
                                            @else bg-red-50 text-red-600 border border-red-100 @endif">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 sm:py-5 text-right">
                                        < href="{{ route('admin.reports', $item->id) }}" 
                                           class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-slate-100 text-slate-600 hover:bg-indigo-600 hover:text-white transition-all shadow-sm">
                                            <i class="fa-solid fa-chevron-right text-xs"></i>
                                    </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-16 sm:py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <i class="fa-solid fa-inbox text-4xl sm:text-5xl text-slate-100 mb-4"></i>
                                            <p class="text-slate-400 font-black text-[10px] uppercase tracking-[0.2em]">Belum Ada Laporan Masuk</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="lg:col-span-1 flex flex-col gap-6">
                    <x-fastaction></x-fastaction>
                    
                    <div class="p-5 sm:p-6 bg-indigo-600 rounded-3xl text-white shadow-xl shadow-indigo-200 relative overflow-hidden">
                        <i class="fa-solid fa-lightbulb absolute -right-4 -bottom-4 text-7xl sm:text-8xl text-white/10 -rotate-12"></i>
                        <h4 class="font-black text-xs uppercase tracking-widest mb-2 italic">Tips Guru</h4>
                        <p class="text-[11px] leading-relaxed font-medium text-indigo-50">
                            Lakukan update status ke "Diproses" segera setelah membaca laporan agar siswa tahu keluhan mereka didengar.
                        </p>
                    </div>
                </div>
            </div>

            <div x-data="{ isModalOpen: false, selectedId: '', selectedStatus: '' }" 
                 @open-modal.window="isModalOpen = true" 
                 class="relative z-[999]">
                
                <div x-show="isModalOpen" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

                <div x-show="isModalOpen" class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="flex min-h-full items-end sm:items-center justify-center p-0 sm:p-4">
                        <div @click.away="isModalOpen = false" 
                             class="relative w-full sm:max-w-md transform overflow-hidden rounded-t-[2.5rem] sm:rounded-[2.5rem] bg-white p-6 sm:p-8 shadow-2xl transition-all border border-slate-100">
                            
                            <div class="w-10 h-1 bg-slate-200 rounded-full mx-auto mb-6 sm:hidden"></div>

                            <div class="text-center mb-6 sm:mb-8">
                                <div class="w-14 h-14 sm:w-16 sm:h-16 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-3 sm:mb-4 shadow-inner">
                                    <i class="fa-solid fa-bolt-lightning text-xl sm:text-2xl"></i>
                                </div>
                                <h3 class="text-lg sm:text-xl font-black text-slate-900 uppercase tracking-tight">Update Status Instan</h3>
                                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-2 italic">Ubah progres laporan tanpa ribet</p>
                            </div>

                            <form action="{{ route('admin.quik-update-status') }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PATCH')
                                
                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2 mb-2 block">Pilih Nomor Tiket</label>
                                    <select name="complaint_id" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 sm:px-5 py-3.5 sm:py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-indigo-500 outline-none transition-all appearance-none cursor-pointer">
                                        <option value="" disabled selected>Pilih Laporan...</option>
                                        @foreach($complaints as $complaint)
                                            @if($complaint->status != 'resolved')
                                                <option value="{{ $complaint->id }}">#{{ $complaint->ticket_number }} - {{ Str::limit($complaint->title, 20) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2 mb-2 block">Status Baru</label>
                                    <div class="grid grid-cols-3 gap-2 sm:gap-3">
                                        @foreach(['process' => 'Blue', 'resolved' => 'Emerald', 'rejected' => 'Red'] as $val => $color)
                                        <label class="relative">
                                            <input type="radio" name="status" value="{{ $val }}" class="peer hidden" required>
                                            <div class="cursor-pointer p-2.5 sm:p-3 rounded-xl border-2 border-slate-50 bg-slate-50 text-center peer-checked:border-indigo-600 peer-checked:bg-indigo-50 transition-all">
                                                <p class="text-[9px] sm:text-[10px] font-black uppercase tracking-widest text-slate-600 peer-checked:text-indigo-600">{{ $val }}</p>
                                            </div>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="flex gap-3 pt-4">
                                    <button type="button" @click="isModalOpen = false" class="flex-1 px-4 sm:px-6 py-3.5 sm:py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest text-slate-400 hover:text-slate-600 transition-all">
                                        Batal
                                    </button>
                                    <button type="submit" class="flex-1 bg-slate-900 hover:bg-indigo-600 text-white px-4 sm:px-6 py-3.5 sm:py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-lg transition-all hover:-translate-y-1">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
           
            <div x-data="{ isExportModalOpen: false }" 
                 @open-export-modal.window="isExportModalOpen = true" 
                 class="relative z-[999]">
                
                <div x-show="isExportModalOpen" x-transition class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

                <div x-show="isExportModalOpen" class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="flex min-h-full items-end sm:items-center justify-center p-0 sm:p-4">
                        <div @click.away="isExportModalOpen = false" 
                             class="relative w-full sm:max-w-sm transform overflow-hidden rounded-t-[2.5rem] sm:rounded-[2.5rem] bg-white p-6 sm:p-8 shadow-2xl border border-slate-100">
                            
                            <div class="w-10 h-1 bg-slate-200 rounded-full mx-auto mb-6 sm:hidden"></div>

                            <div class="text-center mb-5 sm:mb-6">
                                <h3 class="text-lg sm:text-xl font-black text-slate-900 uppercase tracking-tight">Pilih Periode Rekap</h3>
                                <p class="text-[10px] text-slate-400 font-bold uppercase mt-2">Pilih bulan dan tahun laporan</p>
                            </div>

                            <form id="formExport" method="GET" target="_blank" class="space-y-4">
                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase mb-2 block ml-2">Bulan</label>
                                    <select name="month" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 sm:px-5 py-3 text-sm font-bold text-slate-700 outline-none focus:ring-2 focus:ring-emerald-500 appearance-none">
                                        @foreach(range(1, 12) as $m)
                                            <option value="{{ $m }}" {{ date('n') == $m ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::now()->month((int)$m)->isoFormat('MMMM') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase mb-2 block ml-2">Tahun</label>
                                    <select name="year" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 sm:px-5 py-3 text-sm font-bold text-slate-700 outline-none focus:ring-2 focus:ring-emerald-500 appearance-none">
                                        @for($y = date('Y'); $y >= 2024; $y--)
                                            <option value="{{ $y }}">{{ $y }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="grid grid-cols-2 gap-3 pt-4">
                                    <button type="submit" 
                                            onclick="this.form.action='{{ route('admin.export-pdf') }}'"
                                            class="bg-rose-600 hover:bg-rose-700 text-white py-3.5 sm:py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-lg transition-all hover:-translate-y-1">
                                        <i class="fa-solid fa-file-pdf mr-1"></i> PDF
                                    </button>
                                    <button type="submit" 
                                            onclick="this.form.action='{{ route('admin.export-excel') }}'"
                                            class="bg-emerald-600 hover:bg-emerald-700 text-white py-3.5 sm:py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-lg transition-all hover:-translate-y-1">
                                        <i class="fa-solid fa-file-excel mr-1"></i> Excel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection