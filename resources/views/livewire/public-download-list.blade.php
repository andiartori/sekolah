<div class="bg-secondary min-h-screen w-screen">
    <!-- Top Navbar -->
    <nav class="w-full p-4">
        <div class="flex justify-end">
            <a href="/admin/login" 
               class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                Admin Login
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex items-center justify-center">
        <div class="w-3/4 mx-auto p-12 space-y-6 rounded-lg">
            <h1 class="text-3xl text-white font-bold text-center">Daftar Materi Download</h1>
            
            <!-- Search -->
            <div class="my-6">
                <label class="block text-lg font-medium text-white mb-2">Cari Materi</label>
                <input type="text" wire:model.debounce.500ms="search" 
                       class="border p-2 w-full rounded border-green-600 text-white bg-transparent" 
                       placeholder="Ketik nama materi...">
            </div>

            <!-- Download List -->
            @if($downloads->count())
                <div class="grid gap-6">
                    @foreach($downloads as $download)
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl shadow p-6 border border-gray-300">
                            <h2 class="text-xl font-semibold text-white mb-2">
                                {{ $download->materi_download }}
                            </h2>
                            <p class="text-sm text-gray-300 mb-4">
                                📅 Ditambahkan pada {{ $download->created_at->format('d M Y, H:i') }}
                            </p>
                            <div class="flex justify-end">
                                <a href="{{ $download->download_url }}" target="_blank"
                                   class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200">
                                    Unduh
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-red-100/90 text-red-800 p-4 rounded border border-red-300">
                    <p class="text-center font-semibold">⚠️ Tidak ada materi ditemukan.</p>
                </div>
            @endif
        </div>
    </div>
</div>
