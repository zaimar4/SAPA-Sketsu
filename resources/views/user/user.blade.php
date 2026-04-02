@extends('layouts.layout')
@section('title','Sapa Sketsu - Dashboard')

@section('content')
<x-sidenav></x-sidenav>

{{-- Main wrapper: on mobile no left margin; on lg+ add ml-64 --}}
<div class="lg:ml-64 min-h-screen bg-slate-50" x-data="{ open: false }" @open-modal.window="open = true">

    <div class="p-4 sm:p-6 lg:p-8 pt-16 lg:pt-8">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="text-slate-400 font-medium text-xs uppercase tracking-widest">Selamat Datang</h2>
                <h1 class="text-slate-900 font-extrabold text-xl sm:text-2xl mt-0.5">{{ Auth::user()->name }}</h1>
            </div>

            <button
                @click="open = true"
                class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl font-bold shadow-sm shadow-indigo-200 transition-all hover:-translate-y-0.5 text-sm whitespace-nowrap self-start sm:self-auto">
                <i class="fa-solid fa-plus"></i>
                Buat Laporan Baru
            </button>
        </div>

        {{-- Modal --}}
        <div x-show="open" x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
            <div @click.away="open = false"
                class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden max-h-[90vh] overflow-y-auto">
                <div class="px-6 py-4 border-b flex justify-between items-center bg-slate-50 sticky top-0">
                    <h3 class="font-bold text-slate-800">Form Pengaduan Baru</h3>
                    <button @click="open = false" class="text-slate-400 hover:text-slate-600 transition">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>

                <form action="{{ route('user.reports') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Judul Laporan</label>
                        <input type="text" name="title"
                            class="w-full border-slate-200 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Contoh: Meja Kelas Rusak" required>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kategori</label>
                            <select name="category"
                                class="w-full border-slate-200 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500">
                                @foreach ($categories as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Bukti Foto</label>
                            <input type="file" name="evidence_photo"
                                class="w-full text-xs text-slate-500
                                    file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0
                                    file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700
                                    hover:file:bg-indigo-100">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi Kejadian</label>
                        <textarea name="description" rows="4"
                            class="w-full border-slate-200 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Ceritakan detail kejadiannya..." required></textarea>
                    </div>

                    <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <input type="checkbox" name="is_anonymous" id="anon" value="1"
                            class="mt-0.5 rounded text-indigo-600 focus:ring-indigo-500">
                        <label for="anon" class="text-sm text-slate-600 cursor-pointer leading-relaxed">
                            Kirim sebagai Anonim <span class="text-slate-400">(Identitas disembunyikan)</span>
                        </label>
                    </div>

                    <div class="flex justify-end gap-3 pt-2">
                        <button type="button" @click="open = false"
                            class="px-4 py-2 text-slate-500 font-semibold text-sm hover:text-slate-700 transition">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-sm transition-colors">
                            Kirim Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
                <div class="bg-indigo-50 text-indigo-600 w-11 h-11 rounded-xl flex-shrink-0 flex items-center justify-center text-lg">
                    <i class="fa-regular fa-file-lines"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total</p>
                    <h3 class="text-2xl font-black text-slate-900 leading-none mt-0.5">{{ $total }}</h3>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
                <div class="bg-amber-50 text-amber-500 w-11 h-11 rounded-xl flex-shrink-0 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Menunggu</p>
                    <h3 class="text-2xl font-black text-slate-900 leading-none mt-0.5">{{ $totalPending }}</h3>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
                <div class="bg-blue-50 text-blue-600 w-11 h-11 rounded-xl flex-shrink-0 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-spinner fa-spin-pulse"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Proses</p>
                    <h3 class="text-2xl font-black text-slate-900 leading-none mt-0.5">{{ $totalprocess }}</h3>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
                <div class="bg-emerald-50 text-emerald-600 w-11 h-11 rounded-xl flex-shrink-0 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-check-double"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Selesai</p>
                    <h3 class="text-2xl font-black text-slate-900 leading-none mt-0.5">{{ $totalresolved }}</h3>
                </div>
            </div>
        </div>

        {{-- Table + Fast Action --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

            {{-- Table --}}
            <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="font-bold text-slate-800 text-sm">Riwayat Laporan Terakhir</h3>
                    <a href="{{ route('user.reports-all') }}"
                        class="text-indigo-600 text-xs font-bold hover:underline italic whitespace-nowrap">
                        Lihat Semua →
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left min-w-[500px]">
                        <thead class="bg-slate-50 text-slate-400 border-b border-slate-100">
                            <tr>
                                <th class="px-5 py-3 text-[10px] font-bold uppercase tracking-wider">Judul</th>
                                <th class="px-5 py-3 text-[10px] font-bold uppercase tracking-wider hidden sm:table-cell">Kategori</th>
                                <th class="px-5 py-3 text-[10px] font-bold uppercase tracking-wider text-center">Status</th>
                                <th class="px-5 py-3 text-[10px] font-bold uppercase tracking-wider text-right hidden sm:table-cell">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($complaints as $item)
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <td class="px-5 py-4">
                                    <p class="font-bold text-slate-900 group-hover:text-indigo-600 transition-colors text-sm leading-tight">
                                        {{ $item->title }}
                                    </p>
                                    <p class="text-xs text-slate-400 mt-1 line-clamp-1">
                                        {{ Str::limit($item->description, 45) }}
                                    </p>
                                </td>
                                <td class="px-5 py-4 hidden sm:table-cell">
                                    <span class="px-2.5 py-1 bg-slate-100 text-slate-600 rounded-full text-[10px] font-bold uppercase tracking-tighter">
                                        {{ $item->category }}
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    @php
                                        $statusClasses = [
                                            'pending'  => 'bg-amber-100 text-amber-600',
                                            'process'  => 'bg-blue-100 text-blue-600',
                                            'resolved' => 'bg-emerald-100 text-emerald-600',
                                            'rejected' => 'bg-red-100 text-red-600',
                                        ];
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase {{ $statusClasses[$item->status] ?? 'bg-slate-100 text-slate-600' }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-right text-slate-400 text-xs font-medium whitespace-nowrap hidden sm:table-cell">
                                    {{ $item->created_at->diffForHumans() }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-16 text-center">
                                    <i class="fa-regular fa-folder-open text-4xl text-slate-200 mb-3 block"></i>
                                    <p class="text-slate-400 italic text-sm">Belum ada laporan yang Anda buat.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Fast Action --}}
            <div class="lg:col-span-1">
                <x-fastaction></x-fastaction>
            </div>

        </div>
    </div>
</div>
@endsection