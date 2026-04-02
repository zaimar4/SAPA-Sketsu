@extends('layouts.layout')
@section('title', 'Riwayat Laporan - Sapa Sketsu')

@section('content')
<x-sidenav></x-sidenav>

<div class="p-8 ml-64 min-h-screen bg-[#f8fafc]"> 
    
    <nav class="flex mb-4 text-xs font-medium text-slate-400 uppercase tracking-widest">
        <span>Dashboard</span>
        <span class="mx-2">/</span>
        <span class="text-slate-600">Riwayat Laporan</span>
    </nav>

    <div class="flex flex-col md:flex-row md:items-end justify-between border-b border-slate-200 pb-6 mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Management Laporan</h1>
            <p class="text-sm text-slate-500 mt-1">Sistem Pemantauan dan Administrasi Keluhan Siswa (SAPA-Sketsu)</p>
        </div>

        <div class="flex items-center gap-3">
            <div class="text-right mr-3">
                <p class="text-[10px] font-bold text-slate-400 uppercase">Data Tersimpan</p>
                <p class="text-lg font-bold text-slate-800">{{ $total }} <span class="text-xs font-medium text-slate-500 uppercase">Record</span></p>
            </div>
            <div class="h-10 w-[1px] bg-slate-200"></div>
           
        </div>
    </div>

    <div class="bg-white p-4 border border-slate-200 shadow-sm mb-6 rounded">
    <form action="{{ route('user.reports-all') }}" method="GET" class="grid grid-cols-1 md:grid-cols-6 gap-4">
        
        <div class="md:col-span-2">
            <label class="block text-[11px] font-bold text-slate-500 mb-1.5 uppercase">Cari Laporan</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" 
                    class="w-full border-slate-300 rounded text-sm py-1.5 pl-9 focus:border-indigo-500 focus:ring-0 placeholder:text-slate-300" 
                    placeholder="Judul, Tiket, atau Isi...">
            </div>
        </div>

        <div>
            <label class="block text-[11px] font-bold text-slate-500 mb-1.5 uppercase">Status</label>
            <select name="status" class="w-full border-slate-300 rounded text-sm py-1.5 focus:border-indigo-500 focus:ring-0">
                <option value="">Semua</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="process" {{ request('status') == 'process' ? 'selected' : '' }}>Process</option>
                <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
            </select>
        </div>

        <div>
            <label class="block text-[11px] font-bold text-slate-500 mb-1.5 uppercase">Kategori</label>
            <select name="category" class="w-full border-slate-300 rounded text-sm py-1.5 focus:border-indigo-500 focus:ring-0">
                <option value="">Semua</option>
                @foreach($categories as $key => $value)
                    <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>

        <div class="md:col-span-2 flex items-end gap-2">
            <button type="submit" class="bg-indigo-600 text-white px-5 py-1.5 rounded text-sm font-bold hover:bg-indigo-700 transition flex-1">
                Terapkan
            </button>
            @if(request('search') || request('status') || request('category'))
                <a href="{{ route('user.reports-all') }}" class="text-slate-500 border border-slate-300 px-4 py-1.5 rounded text-sm font-semibold hover:bg-slate-50 transition">
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
            @endif
        </div>
    </form>
</div>
    <div class="bg-white border border-slate-200 shadow-sm rounded overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr class="text-slate-500 font-bold">
                    <th class="px-6 py-3 font-semibold text-[11px] uppercase tracking-wider">Timestamp</th>
                    <th class="px-6 py-3 font-semibold text-[11px] uppercase tracking-wider text-center">ID Tiket</th>
                    <th class="px-6 py-3 font-semibold text-[11px] uppercase tracking-wider">Subjek Laporan</th>
                    <th class="px-6 py-3 font-semibold text-[11px] uppercase tracking-wider">Klasifikasi</th>
                    <th class="px-6 py-3 font-semibold text-[11px] uppercase tracking-wider text-center">Status</th>
                    <th class="px-6 py-3 font-semibold text-[11px] uppercase tracking-wider text-right">Manajemen</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($complaints as $item)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <p class="text-slate-700 font-medium">{{ $item->created_at->format('d/m/Y') }}</p>
                        <p class="text-[10px] text-slate-400">{{ $item->created_at->format('H:i') }} WIB</p>
                    </td>

                    <td class="px-6 py-4 text-center">
                        <code class="text-[11px] font-bold bg-slate-100 px-2 py-1 text-slate-600 rounded">{{ $item->ticket_number }}</code>
                    </td>

                    <td class="px-6 py-4">
                        <p class="text-slate-900 font-bold">{{ $item->title }}</p>
                        <p class="text-xs text-slate-500 truncate max-w-[200px]">{{ $item->description }}</p>
                    </td>

                    <td class="px-6 py-4">
                        <span class="text-[10px] font-bold text-slate-500 border border-slate-200 px-2 py-0.5 rounded bg-slate-50">
                            {{ strtoupper($item->category) }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-center">
                        @php
                            $colors = [
                                'pending' => 'text-amber-700 bg-amber-50 border-amber-200',
                                'process' => 'text-blue-700 bg-blue-50 border-blue-200',
                                'resolved' => 'text-emerald-700 bg-emerald-50 border-emerald-200',
                                'rejected' => 'text-red-700 bg-red-50 border-red-200',
                            ];
                        @endphp
                        <span class="inline-block w-24 py-1 rounded text-[10px] font-bold border {{ $colors[$item->status] ?? 'text-slate-600' }}">
                            {{ strtoupper($item->status) }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('user.complaints-show', $item->slug) }}" class="text-indigo-600 font-bold hover:text-indigo-800 text-xs">
                            OPEN CASE →
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-400 italic text-sm">
                        No records found in database.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($complaints->hasPages())
        <div class="px-6 py-3 bg-slate-50 border-t border-slate-200 text-xs">
            {{ $complaints->links() }}
        </div>
        @endif
    </div>
</div>
@endsection