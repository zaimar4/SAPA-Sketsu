@extends('layouts.layout')
@section('title','Buat laporan')

@section('content')
<x-sidenav></x-sidenav>
<div class="p-5 flex-none ml-60"> 
        <div class="mt-10 bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
        <table class="w-full text-sm text-left">
            <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">ticket</th>
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