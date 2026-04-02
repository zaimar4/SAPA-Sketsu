@extends('layouts.layout')
@section('title', 'Riwayat Laporan - Sapa Sketsu')

@section('content')
    <x-sidenav></x-sidenav>

    <div class="lg:ml-64 min-h-screen bg-[#f8fafc]">
        <div class="p-4 sm:p-6 lg:p-8 pt-16 lg:pt-8">

            {{-- Breadcrumb --}}
            <nav class="flex mb-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                <span>Dashboard</span>
                <span class="mx-2">/</span>
                <span class="text-indigo-600">Riwayat Laporan</span>
            </nav>

            {{-- Page Header --}}
            <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-slate-200 pb-6 mb-6 gap-4">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">Riwayat Laporan</h1>
                    <p class="text-sm text-slate-500 mt-1">Lihat semua riwayat laporan Anda</p>
                </div>

                <div class="flex items-center gap-3 self-start sm:self-auto">
                    <div class="text-right">
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Total Laporan</p>
                        <p class="text-lg font-bold text-slate-800">
                            {{ $total }}
                            <span class="text-xs font-medium text-slate-500 uppercase">Laporan</span>
                        </p>
                    </div>
                    <div class="h-10 w-px bg-slate-200"></div>
                </div>
            </div>

            {{-- Filter Form --}}
            <div class="bg-white p-4 border border-slate-200 shadow-sm mb-5 rounded-xl">
                <form action="{{ route('user.reports-all') }}" method="GET"
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-3">

                    {{-- Search --}}
                    <div class="sm:col-span-2 lg:col-span-2">
                        <label class="block text-[10px] font-bold text-slate-500 mb-1.5 uppercase">Cari Laporan</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                                <i class="fa-solid fa-magnifying-glass text-xs"></i>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="w-full border-slate-300 rounded-lg text-sm py-2 pl-9 focus:border-indigo-500 focus:ring-0 placeholder:text-slate-300"
                                placeholder="Judul, Tiket, atau Isi...">
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="lg:col-span-1">
                        <label class="block text-[10px] font-bold text-slate-500 mb-1.5 uppercase">Status</label>
                        <select name="status"
                            class="w-full border-slate-300 rounded-lg text-sm py-2 focus:border-indigo-500 focus:ring-0">
                            <option value="">Semua</option>
                            <option value="pending"  {{ request('status') == 'pending'  ? 'selected' : '' }}>Pending</option>
                            <option value="process"  {{ request('status') == 'process'  ? 'selected' : '' }}>Process</option>
                            <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                        </select>
                    </div>

                    {{-- Category --}}
                    <div class="lg:col-span-1">
                        <label class="block text-[10px] font-bold text-slate-500 mb-1.5 uppercase">Kategori</label>
                        <select name="category"
                            class="w-full border-slate-300 rounded-lg text-sm py-2 focus:border-indigo-500 focus:ring-0">
                            <option value="">Semua</option>
                            @foreach ($categories as $key => $value)
                                <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Actions --}}
                    <div class="sm:col-span-2 lg:col-span-2 flex items-end gap-2">
                        <button type="submit"
                            class="flex-1 bg-indigo-600 text-white px-5 py-2 rounded-lg text-sm font-bold hover:bg-indigo-700 transition">
                            Terapkan
                        </button>
                        @if (request('search') || request('status') || request('category'))
                            <a href="{{ route('user.reports-all') }}"
                                class="text-slate-500 border border-slate-300 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-slate-50 transition flex items-center gap-1.5">
                                <i class="fa-solid fa-rotate-left"></i>
                                <span class="hidden sm:inline">Reset</span>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Table (desktop) / Cards (mobile) --}}

            {{-- Desktop Table --}}
            <div class="hidden sm:block bg-white border border-slate-200 shadow-sm rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm min-w-[640px]">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th class="px-5 py-3 font-bold text-[10px] uppercase tracking-wider text-slate-500 text-left">Timestamp</th>
                                <th class="px-5 py-3 font-bold text-[10px] uppercase tracking-wider text-slate-500 text-center">ID Tiket</th>
                                <th class="px-5 py-3 font-bold text-[10px] uppercase tracking-wider text-slate-500 text-left">Judul Laporan</th>
                                <th class="px-5 py-3 font-bold text-[10px] uppercase tracking-wider text-slate-500 text-left hidden lg:table-cell">Kategori</th>
                                <th class="px-5 py-3 font-bold text-[10px] uppercase tracking-wider text-slate-500 text-center">Status</th>
                                <th class="px-5 py-3 font-bold text-[10px] uppercase tracking-wider text-slate-500 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($complaints as $item)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-5 py-4 whitespace-nowrap">
                                    <p class="text-slate-700 font-semibold text-sm">{{ $item->created_at->format('d/m/Y') }}</p>
                                    <p class="text-[10px] text-slate-400">{{ $item->created_at->format('H:i') }} WIB</p>
                                </td>

                                <td class="px-5 py-4 text-center">
                                    <code class="text-[10px] font-bold bg-slate-100 px-2 py-1 text-slate-600 rounded">
                                        {{ $item->ticket_number }}
                                    </code>
                                </td>

                                <td class="px-5 py-4">
                                    <p class="text-slate-900 font-bold text-sm">{{ $item->title }}</p>
                                    <p class="text-xs text-slate-400 truncate max-w-[160px]">{{ $item->description }}</p>
                                </td>

                                <td class="px-5 py-4 hidden lg:table-cell">
                                    <span class="text-[10px] font-bold text-slate-500 border border-slate-200 px-2.5 py-1 rounded-full bg-slate-50">
                                        {{ strtoupper($item->category) }}
                                    </span>
                                </td>

                                <td class="px-5 py-4 text-center">
                                    @php
                                        $colors = [
                                            'pending'  => 'bg-amber-100 text-amber-600',
                                            'process'  => 'bg-blue-100 text-blue-600',
                                            'resolved' => 'bg-emerald-100 text-emerald-600',
                                            'rejected' => 'bg-red-100 text-red-600',
                                        ];
                                    @endphp
                                    <span class="inline-block px-2.5 py-1 rounded-full text-[10px] font-bold {{ $colors[$item->status] ?? 'text-slate-600' }}">
                                        {{ strtoupper($item->status) }}
                                    </span>
                                </td>

                                <td class="px-5 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('user.complaints-show', $item->slug) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-slate-100 shadow-sm bg-white hover:bg-indigo-600 group transition-all">
                                            <i class="fa-regular fa-eye text-indigo-600 group-hover:text-white text-xs transition-colors"></i>
                                        </a>

                                        @if ($item->status == 'pending')
                                            <form action="{{ route('user.complaints-destroy', $item->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-red-100 shadow-sm bg-white hover:bg-red-600 group transition-all">
                                                    <i class="fa-regular fa-trash-can text-red-500 group-hover:text-white text-xs transition-colors"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center text-slate-400 italic text-sm">
                                    <i class="fa-regular fa-folder-open text-4xl text-slate-200 mb-3 block"></i>
                                    Tidak ada laporan yang ditemukan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($complaints->hasPages())
                    <div class="px-5 py-3 bg-slate-50 border-t border-slate-200 text-xs">
                        {{ $complaints->links() }}
                    </div>
                @endif
            </div>

            {{-- Mobile Cards --}}
            <div class="sm:hidden space-y-3">
                @forelse($complaints as $item)
                <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-slate-900 text-sm leading-tight truncate">{{ $item->title }}</p>
                            <p class="text-xs text-slate-400 mt-0.5 line-clamp-2">{{ $item->description }}</p>
                        </div>
                        @php
                            $colors = [
                                'pending'  => 'bg-amber-100 text-amber-600',
                                'process'  => 'bg-blue-100 text-blue-600',
                                'resolved' => 'bg-emerald-100 text-emerald-600',
                                'rejected' => 'bg-red-100 text-red-600',
                            ];
                        @endphp
                        <span class="flex-shrink-0 px-2.5 py-1 rounded-full text-[10px] font-bold {{ $colors[$item->status] ?? 'text-slate-600' }}">
                            {{ strtoupper($item->status) }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2 flex-wrap">
                            <code class="text-[10px] font-bold bg-slate-100 px-2 py-0.5 text-slate-600 rounded">
                                {{ $item->ticket_number }}
                            </code>
                            <span class="text-[10px] font-bold text-slate-400 border border-slate-200 px-2 py-0.5 rounded-full bg-slate-50">
                                {{ strtoupper($item->category) }}
                            </span>
                            <span class="text-[10px] text-slate-400">
                                {{ $item->created_at->format('d/m/Y H:i') }}
                            </span>
                        </div>

                        <div class="flex items-center gap-2">
                            <a href="{{ route('user.complaints-show', $item->slug) }}"
                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-slate-100 bg-white hover:bg-indigo-600 group transition-all">
                                <i class="fa-regular fa-eye text-indigo-600 group-hover:text-white text-xs transition-colors"></i>
                            </a>
                            @if ($item->status == 'pending')
                                <form action="{{ route('user.complaints-destroy', $item->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-red-100 bg-white hover:bg-red-600 group transition-all">
                                        <i class="fa-regular fa-trash-can text-red-500 group-hover:text-white text-xs transition-colors"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white border border-slate-200 rounded-xl p-10 text-center shadow-sm">
                    <i class="fa-regular fa-folder-open text-4xl text-slate-200 mb-3 block"></i>
                    <p class="text-slate-400 italic text-sm">Tidak ada laporan yang ditemukan.</p>
                </div>
                @endforelse

                @if ($complaints->hasPages())
                    <div class="py-3 text-xs">
                        {{ $complaints->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection