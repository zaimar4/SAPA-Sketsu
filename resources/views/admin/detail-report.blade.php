@extends('layouts.layout')
@section('title', 'Detail Laporan - ' . $complaint->ticket_number)

@section('content')
<x-sidenav></x-sidenav>

<div class="p-4 sm:p-6 lg:p-8 ml-0 lg:ml-64 min-h-screen bg-[#f8fafc]">
    {{-- Header: Tombol Kembali & Ticket ID --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <a href="{{ Auth::user()->role === 'user' ? route('user.reports-all') : route('admin.reports') }}" 
           class="text-[10px] font-black text-slate-400 hover:text-indigo-600 transition-all uppercase tracking-[0.2em] flex items-center gap-2 w-fit">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Riwayat
        </a>
        <div class="px-4 py-2 bg-white border border-slate-200 rounded-full text-[10px] font-black text-slate-500 uppercase tracking-widest shadow-sm">
            TICKET ID: <span class="text-indigo-600">#{{ $complaint->ticket_number }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
        {{-- SISI KIRI: DETAIL LAPORAN --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                {{-- Info Pelapor --}}
                <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-white">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-full bg-indigo-600 flex items-center justify-center text-white text-sm font-black border-4 border-indigo-50 shadow-sm">
                            {{ substr($complaint->user->name ?? 'U', 0, 1) }}
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Pelapor</p>
                            <p class="text-sm font-bold text-slate-800">
                                {{ $complaint->is_anonymous ? 'Nama Disembunyikan' : ($complaint->user->name ?? 'User') }}
                            </p>
                        </div>
                    </div>
                    <span class="px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase tracking-widest border border-indigo-100">
                        {{ $complaint->category }}
                    </span>
                </div>

                {{-- Konten Laporan --}}
                <div class="p-6 sm:p-8">
                    <div class="flex items-center gap-2 mb-4 text-slate-400">
                        <i class="fa-regular fa-calendar text-xs"></i>
                        <p class="text-[11px] font-bold uppercase tracking-tight">{{ $complaint->created_at->translatedFormat('d F Y, H:i') }} WIB</p>
                    </div>

                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mb-6">
                        {{ $complaint->title }}
                    </h1>

                    <div class="mb-8">
                        <p class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-3">Deskripsi Laporan</p>
                        <p class="text-slate-600 leading-relaxed font-medium text-sm sm:text-base">
                            {!! nl2br(e($complaint->description)) !!}
                        </p>
                    </div>

                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-camera"></i> Lampiran Bukti Foto
                        </p>
                        <div class="rounded-2xl border-2 border-dashed border-slate-100 bg-slate-50/50 p-4 min-h-[200px] flex items-center justify-center">
                            @if($complaint->evidence_photo)
                                <img src="{{ asset('images/' . $complaint->evidence_photo) }}" class="max-h-[400px] rounded-xl shadow-md">
                            @else
                                <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Tidak ada lampiran foto</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-5">Status Laporan</h3>
                
                @php
                    $statusConfig = [
                        'pending' => ['color' => 'amber', 'icon' => 'fa-clock', 'label' => 'Menunggu'],
                        'process' => ['color' => 'blue', 'icon' => 'fa-circle-notch fa-spin', 'label' => 'Diproses'],
                        'resolved' => ['color' => 'emerald', 'icon' => 'fa-check-double', 'label' => 'Selesai'],
                        'rejected' => ['color' => 'red', 'icon' => 'fa-circle-xmark', 'label' => 'Ditolak'],
                    ][$complaint->status] ?? ['color' => 'slate', 'icon' => 'fa-question', 'label' => 'Unknown'];
                @endphp

                <div class="flex items-center gap-4 p-5 rounded-2xl bg-{{ $statusConfig['color'] }}-50/50 border border-{{ $statusConfig['color'] }}-100">
                    <div class="w-12 h-12 shrink-0 rounded-xl bg-white border border-{{ $statusConfig['color'] }}-200 flex items-center justify-center text-{{ $statusConfig['color'] }}-500 shadow-sm">
                        <i class="fa-solid {{ $statusConfig['icon'] }} text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-black text-{{ $statusConfig['color'] }}-700 uppercase italic tracking-wider">{{ $statusConfig['label'] }}</p>
                        <p class="text-[9px] font-bold text-slate-400 mt-1 uppercase">Laporan sedang ditindaklanjuti.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-comments text-indigo-500"></i> Diskusi Laporan
                </h3>

                <div class="space-y-6 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                    @forelse($complaint->responses as $res)
                        <div class="space-y-2">
                            <div class="inline-block px-4 py-2.5 rounded-2xl text-xs font-bold shadow-sm 
                                {{ $res->user?->role !== 'user' ? 'bg-slate-100 text-slate-700' : 'bg-indigo-600 text-white' }}">
                                {{ $res->massage }}
                            </div>
                            <p class="text-[8px] font-black text-slate-400 uppercase tracking-wider pl-1">
                                {{ $res->user?->name }} • {{ $res->created_at->diffForHumans() }}
                            </p>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest">Belum ada tanggapan</p>
                        </div>
                    @endforelse
                </div>

                <form action="{{ route('responses.store') }}" method="POST" class="mt-6 pt-6 border-t border-slate-100">
                    @csrf
                    <input type="hidden" name="complaint_id" value="{{ $complaint->id }}">
                    <textarea name="massage" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-xs font-medium focus:ring-2 focus:ring-indigo-500 outline-none transition-all" placeholder="Tulis tanggapan..."></textarea>
                    <button class="w-full mt-3 bg-slate-900 text-white font-black py-3 rounded-xl text-[10px] uppercase tracking-[0.2em] hover:bg-indigo-600 transition-all">
                        Kirim Tanggapan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
</style>
@endsection