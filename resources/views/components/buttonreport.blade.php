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