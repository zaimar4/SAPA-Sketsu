@extends('layouts.layout')
@section('title', 'Detail Laporan - ' . $complaint->ticket_number)

@section('content')
<x-sidenav></x-sidenav>

<div class="p-4 sm:p-6 lg:p-8 ml-0 lg:ml-64 min-h-screen bg-[#f1f5f9]">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 sm:gap-0 mb-6 sm:mb-8">
        <a href="{{ route('user.reports-all') }}" 
           class="text-xs font-bold text-slate-400 hover:text-indigo-600 transition-all uppercase tracking-widest flex items-center gap-2 w-fit">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Riwayat
        </a>
        <div class="px-3 py-1.5 sm:px-4 bg-white border border-slate-200 rounded-full text-[10px] font-black text-slate-500 uppercase tracking-widest shadow-sm max-w-max">
            Ticket ID: <span class="text-indigo-600">#{{ $complaint->ticket_number }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
        <div class="lg:col-span-2 space-y-4 sm:space-y-6">
            <div class="bg-white rounded-2xl sm:rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                
                <!-- Header Card -->
                <div class="bg-slate-50/50 px-4 sm:px-8 py-4 sm:py-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 sm:gap-3">
                    <div class="flex items-center gap-2 sm:gap-3 w-full sm:w-auto">
                        <div class="w-10 h-10 sm:w-10 sm:h-10 rounded-full bg-indigo-600 flex items-center justify-center text-white text-sm font-black border-2 border-white shadow-sm flex-shrink-0">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Pelapor</p>
                            <p class="text-sm font-bold text-slate-800 truncate">
                                {{ $complaint->is_anonymous ? 'Nama Disembunyikan (Anonim)' : Auth::user()->name }}
                            </p>
                        </div>
                    </div>
                    <span class="px-2 sm:px-3 py-1 rounded-lg bg-white text-indigo-600 text-[10px] font-black uppercase tracking-widest border border-slate-200 w-fit whitespace-nowrap">
                        {{ $complaint->category }}
                    </span>
                </div>

                <div class="p-4 sm:p-6 lg:p-8">
                    <!-- Tanggal -->
                    <div class="flex items-center gap-2 mb-4 text-slate-400">
                        <i class="fa-regular fa-calendar text-xs"></i>
                        <span class="text-xs font-bold italic">{{ $complaint->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
                    </div>

                    <!-- Judul -->
                    <h1 class="text-xl sm:text-2xl lg:text-3xl font-black text-slate-900 tracking-tight mb-4 sm:mb-6 leading-tight">
                        {{ $complaint->title }}
                    </h1>

                    <!-- Deskripsi -->
                    <div class="relative mb-8 sm:mb-10">
                        <div class="absolute left-[-10px] sm:left-[-20px] top-0 bottom-0 w-[2px] sm:w-[3px] bg-indigo-50 rounded-full"></div>
                        <h4 class="text-[10px] font-black text-indigo-500 uppercase tracking-widest mb-3">Deskripsi Laporan</h4>
                        <p class="text-slate-600 leading-relaxed font-medium text-sm sm:text-base text-justify">
                            {!! nl2br(e($complaint->description)) !!}
                        </p>
                    </div>

                    <!-- Lampiran Foto -->
                    <div class="mt-6 sm:mt-8">
                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-camera"></i> Lampiran Bukti Foto
                        </h4>
                        @if($complaint->evidence_photo)
                            <div class="group relative rounded-2xl overflow-hidden border border-slate-100 bg-slate-50 shadow-inner">
                                <img src="{{ asset('images/' . $complaint->evidence_photo) }}" 
                                     class="w-full h-auto object-cover max-h-[400px] sm:max-h-[500px] lg:max-h-[600px] transform group-hover:scale-[1.02] transition-transform duration-700">
                                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="bg-white/90 backdrop-blur-sm text-slate-900 text-[10px] font-black tracking-widest uppercase px-3 sm:px-4 py-2 rounded-full shadow-lg">
                                        Klik untuk Perbesar
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="py-12 sm:py-20 text-center border-2 border-dashed border-slate-100 rounded-2xl bg-slate-50/50">
                                <i class="fa-solid fa-image-slash text-slate-200 text-2xl sm:text-4xl mb-3"></i>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tidak ada lampiran foto</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-4 sm:space-y-6">
            <!-- Status Card -->
            <div class="bg-white rounded-2xl sm:rounded-3xl border border-slate-200 p-4 sm:p-6 shadow-sm">
                <h3 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 sm:mb-5">Status Laporan</h3>
                
                @php
                    $default = ['color' => 'slate', 'icon' => 'fa-question', 'desc' => 'Status tidak diketahui.', 'label' => 'Unknown'];
                    $statusConfig = [
                        'pending' => ['color' => 'amber', 'icon' => 'fa-clock-rotate-left', 'desc' => 'Menunggu verifikasi admin.', 'label' => 'Menunggu'],
                        'process' => ['color' => 'blue', 'icon' => 'fa-circle-notch fa-spin', 'desc' => 'Laporan sedang ditindaklanjuti.', 'label' => 'Diproses'],
                        'resolved' => ['color' => 'emerald', 'icon' => 'fa-check-double', 'desc' => 'Masalah telah selesai diatasi.', 'label' => 'Selesai'],
                        'rejected' => ['color' => 'red', 'icon' => 'fa-circle-xmark', 'desc' => 'Laporan ditolak oleh admin.', 'label' => 'Ditolak'],
                    ][$complaint->status] ?? $default;
                @endphp

                <div class="flex items-center gap-3 sm:gap-4 p-4 rounded-2xl bg-{{ $statusConfig['color'] }}-50 border border-{{ $statusConfig['color'] }}-100 transition-all duration-500 shadow-sm border-l-4 border-l-{{ $statusConfig['color'] }}-500">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 shrink-0 rounded-xl bg-{{ $statusConfig['color'] }}-100 flex items-center justify-center text-{{ $statusConfig['color'] }}-700 shadow-inner">
                        <i class="fa-solid {{ $statusConfig['icon'] }} text-lg sm:text-xl"></i>
                    </div>
                    <div class="flex-grow min-w-0">
                        <div class="flex items-center gap-2">
                            <p class="text-xs sm:text-sm font-black text-{{ $statusConfig['color'] }}-700 uppercase italic tracking-wider truncate">
                                {{ $statusConfig['label'] }}
                            </p>
                            @if($complaint->status == 'process')
                                <span class="flex h-2 w-2 relative ml-1">
                                    <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-blue-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                                </span>
                            @endif
                        </div>
                        <p class="text-[10px] font-bold text-{{ $statusConfig['color'] }}-600/80 leading-tight mt-0.5 line-clamp-2">
                            {{ $statusConfig['desc'] }}
                        </p>
                    </div>
                </div>
            </div>

         <div class="bg-white rounded-2xl sm:rounded-xl shadow-sm border border-slate-200 p-4 sm:p-5">
     {{-- Diskusi Laporan (Gaya Bubble Chat) --}}
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

                {{-- Form Kirim Pesan (Hanya Admin/Guru di gambar ini, tapi disesuaikan) --}}
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
@endsection