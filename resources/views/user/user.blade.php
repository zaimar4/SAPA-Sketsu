@extends('layouts.layout')
@section('title','Sapa Sketsu')

@section('content')
<x-sidenav></x-sidenav>
<div class="p-5 flex-none ml-60"> <h2 class="text-slate-500 m-2">Selamat Datang</h2>
    <h2 class="text-slate-900 font-bold m-2 text-2xl">{{ Auth::user()->name }}</h2>
    
   <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
    <div class="bg-white p-6 rounded-xl shadow-xl shadow-gray-300/40 flex items-center gap-5">
        <div class="bg-indigo-50 text-indigo-600 w-12 h-12 rounded-lg flex-shrink-0 flex items-center justify-center text-xl">
            <i class="fa-regular fa-file-lines"></i>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Laporan Anda</p>
            <h3 class="text-2xl font-bold text-slate-900 mt-1">{{ $total }}</h3>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-xl shadow-gray-300/40 flex items-center gap-5">
        <div class="bg-amber-50 text-amber-600 w-12 h-12 rounded-lg flex-shrink-0 flex items-center justify-center text-xl">
            <i class="fa-solid fa-spinner fa-spin-pulse"></i>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Sedang Diproses</p>
            <h3 class="text-2xl font-bold text-slate-900 mt-1">{{ $totalprocess }}</h3>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-xl shadow-gray-300/40 flex items-center gap-5">
        <div class="bg-emerald-50 text-emerald-600 w-12 h-12 rounded-lg flex-shrink-0 flex items-center justify-center text-xl">
            <i class="fa-solid fa-check-double"></i>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Selesai</p>
            <h3 class="text-2xl font-bold text-slate-900 mt-1">{{ $totalresolved }}</h3>
        </div>
    </div>
</div>
    
 

    <div x-data="{ open: false }" class="mt-8">
        <button @click="open = true" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Buat Laporan Baru
        </button>

        <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
            <div @click.away="open = false" class="bg-white w-full max-w-lg rounded-2xl shadow-2xl">
                <div class="px-6 py-4 border-b flex justify-between items-center bg-slate-50 rounded-t-2xl">
                    <h3 class="font-bold text-slate-800">Form Pengaduan Baru</h3>
                    <button @click="open = false" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark"></i></button>
                </div>

                <form action="{{ route('user.reports') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Judul Laporan</label>
                        <input type="text" name="title" class="w-full border-slate-200 rounded-lg focus:ring-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
                        <select name="category" class="w-full border-slate-200 rounded-lg">
                            @foreach ($categories as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Bukti Foto</label>
                        <input type="file" name="evidence_photo" class="w-full border-slate-200 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label>
                        <textarea name="description" rows="4" class="w-full border-slate-200 rounded-lg" required></textarea>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_anonymous" id="anon" value="1">
                        <label for="anon" class="text-sm text-slate-600">Kirim sebagai Anonim</label>
                    </div>
                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" @click="open = false" class="px-4 py-2 text-slate-600">Batal</button>
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-bold rounded-lg">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-10 bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
        <table class="w-full text-sm text-left">
            <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">Laporan</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($complaints as $item)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4 font-medium text-slate-900">{{ $item->title }}</td>
                    <td class="px-6 py-4"><span class="px-2 py-1 bg-slate-100 rounded text-xs">{{ ucfirst($item->category) }}</span></td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-[10px] font-bold uppercase {{ $item->status == 'pending' ? 'bg-amber-100 text-amber-600' : 'bg-emerald-100 text-emerald-600' }}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-slate-500">{{ $item->created_at->diffForHumans() }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-6 py-10 text-center text-slate-400 italic">Belum ada laporan.</td></tr>
                @endforelse
            </tbody>
        </table>

    </div>
    
</div>
@endsection