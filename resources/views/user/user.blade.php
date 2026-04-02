@extends('layouts.layout')
@section('title', 'Dashboard - SAPA Sketsu')

@section('content')
<x-sidenav></x-sidenav>

<div class="p-8 ml-64 min-h-screen bg-[#f8fafc]">
    <div class="flex flex-col md:flex-row md:items-end justify-between border-b border-slate-200 pb-6 mb-8">
        <div>
            <nav class="flex mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">
                <span>Sistem Pelaporan Digital</span>
            </nav>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Dashboard Overview</h1>
            <p class="text-sm text-slate-500 mt-1 italic">Selamat Datang,Laporkan Semua Keluhan <span class="text-indigo-600 font-semibold">{{ Auth::user()->name }}</span>.</p>
        </div>

        <div x-data="{ open: false }">
            <button @click="open = true" class="bg-slate-900 hover:bg-slate-800 text-white px-5 py-2.5 rounded text-sm font-bold flex items-center gap-2 transition-all shadow-sm">
                <i class="fa-solid fa-plus text-[10px]"></i> BUAT ADUAN BARU
            </button>

            <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-[2px]">
                <div @click.away="open = false" class="bg-white w-full max-w-lg rounded border border-slate-200 shadow-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Form Pengaduan Resmi</h3>
                        <button @click="open = false" class="text-slate-400 hover:text-slate-600 transition"><i class="fa-solid fa-xmark"></i></button>
                    </div>

                    <form action="{{ route('user.reports') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-5">
                        @csrf
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase mb-2">Subjek Laporan</label>
                            <input type="text" name="title" class="w-full border-slate-300 rounded text-sm py-2 focus:ring-0 focus:border-indigo-500 placeholder:text-slate-300" placeholder="Ringkasan singkat kejadian..." required>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-2">Klasifikasi</label>
                                <select name="category" class="w-full border-slate-300 rounded text-sm py-2 focus:ring-0 focus:border-indigo-500">
                                    @foreach ($categories as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-2">Lampiran Foto</label>
                                <input type="file" name="evidence_photo" class="w-full text-[10px] text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded file:border file:border-slate-200 file:text-[10px] file:font-bold file:bg-white file:text-slate-700 hover:file:bg-slate-50">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase mb-2">Detail Kronologi</label>
                            <textarea name="description" rows="4" class="w-full border-slate-300 rounded text-sm focus:ring-0 focus:border-indigo-500 placeholder:text-slate-300" placeholder="Tuliskan fakta kejadian secara lengkap..." required></textarea>
                        </div>

                        <div class="flex items-center gap-3 p-3 bg-slate-50 rounded border border-slate-200">
                            <input type="checkbox" name="is_anonymous" id="anon" value="1" class="rounded border-slate-300 text-indigo-600 focus:ring-0">
                            <label for="anon" class="text-xs text-slate-600 font-medium cursor-pointer">Sembunyikan Identitas (Anonim)</label>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                            <button type="button" @click="open = false" class="px-4 py-2 text-xs font-bold text-slate-400 uppercase tracking-widest">Batal</button>
                            <button type="submit" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded shadow-sm transition-all uppercase tracking-widest">Submit Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-5 border border-slate-200 rounded shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Kasus</p>
                    <h3 class="text-2xl font-bold text-slate-900 mt-1">{{ $total }}</h3>
                </div>
                <div class="text-slate-300"><i class="fa-solid fa-folder text-lg"></i></div>
            </div>
        </div>

        <div class="bg-white p-5 border border-slate-200 rounded shadow-sm border-l-4 border-l-amber-400">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest text-amber-600">Menunggu</p>
                    <h3 class="text-2xl font-bold text-slate-900 mt-1">{{ $totalPending }}</h3>
                </div>
                <div class="text-amber-200"><i class="fa-solid fa-clock text-lg"></i></div>
            </div>
        </div>

        <div class="bg-white p-5 border border-slate-200 rounded shadow-sm border-l-4 border-l-blue-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest text-blue-600">Proses</p>
                    <h3 class="text-2xl font-bold text-slate-900 mt-1">{{ $totalprocess }}</h3>
                </div>
                <div class="text-blue-200"><i class="fa-solid fa-arrows-rotate text-lg"></i></div>
            </div>
        </div>

        <div class="bg-white p-5 border border-slate-200 rounded shadow-sm border-l-4 border-l-emerald-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest text-emerald-600">Selesai</p>
                    <h3 class="text-2xl font-bold text-slate-900 mt-1">{{ $totalresolved }}</h3>
                </div>
                <div class="text-emerald-200"><i class="fa-solid fa-check-circle text-lg"></i></div>
            </div>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        <div class="lg:col-span-2 bg-white border border-slate-200 shadow-sm rounded overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-xs font-bold text-slate-700 uppercase tracking-widest">Aktivitas Laporan Terakhir</h3>
                <a href="{{ route('user.reports-all') }}" class="text-[10px] font-bold text-indigo-600 uppercase hover:text-indigo-800 transition">View All Database →</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 text-slate-500 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-3 text-[10px] font-bold uppercase tracking-wider">Subjek</th>
                            <th class="px-6 py-3 text-[10px] font-bold uppercase tracking-wider text-center">Status</th>
                            <th class="px-6 py-3 text-[10px] font-bold uppercase tracking-wider text-right">Waktu Record</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($complaints as $item)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-800 leading-tight">{{ $item->title }}</p>
                                <p class="text-[10px] text-slate-400 uppercase font-medium mt-1">{{ $item->category }}</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $statusStyle = [
                                        'pending' => 'text-amber-600 bg-amber-50 border-amber-100',
                                        'process' => 'text-blue-600 bg-blue-50 border-blue-100',
                                        'resolved' => 'text-emerald-600 bg-emerald-50 border-emerald-100',
                                        'rejected' => 'text-red-600 bg-red-50 border-red-100',
                                    ];
                                @endphp
                                <span class="px-2.5 py-1 rounded text-[9px] font-black uppercase border {{ $statusStyle[$item->status] ?? 'bg-slate-100' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="text-xs text-slate-400 font-medium">{{ $item->created_at->diffForHumans() }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-slate-400 italic text-xs">
                                Tidak ada aktivitas laporan terbaru.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="lg:col-span-1">
            <x-fastaction></x-fastaction>
        </div>
    </div>
</div>
@endsection