<div class="bg-secondary min-h-screen w-full overflow-x-hidden">
    <!-- Top Navbar -->
    <nav class="w-full p-4 flex justify-between">
        <div>
            <h2 class="text-white font-bold text-xl">SDN CIPINANG 07</h2>
        </div>
        <div class="flex justify-end gap-4">
            <a href="/admin/login" class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                Admin Login
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex flex-col items-center justify-center">
        <div class="w-32 h-32">
            <img class="w-full h-full object-contain" src="{{ asset('logo.png') }}" alt="Logo">
        </div>

        <div class="w-3/4 mx-auto p-12 space-y-6 rounded-lg">
            <h1 class="text-3xl text-white font-bold text-center">Kolom Pencarian Data Murid</h1>
            
            <div class="text-white">
                <p class="font-semibold mb-2">Catatan:</p>
                <ul class="list-disc pl-5 space-y-1">
                    <li>Mohon mencantumkan nama murid lengkap</li>
                    <li>Klik ikon <em>Calendar</em> untuk memilih tanggal lahir murid</li>
                </ul>
            </div>
            
            <form wire:submit.prevent="search" class="space-y-4 p-4 shadow">
                <div>
                    <label class="block text-lg font-medium text-white">Nama Lengkap</label>
                    <input required type="text" wire:model="nama_murid" class="border p-2 w-full rounded border-green-600 text-white bg-transparent">
                </div>
                <div>
                    <label class="block text-lg font-medium text-white">Tanggal Lahir Murid</label>
                    <input required type="date" wire:model="tanggal_lahir" class="border p-2 w-1/2 rounded border-green-600 text-white bg-transparent">
                </div>
                <div class="flex items-center justify-center my-12">
                    <button type="submit" class="bg-amber-600 text-white px-4 py-2 rounded hover:bg-amber-900">Mulai Pencarian</button>
                </div>
            </form>

            @if($student)
                <div class="p-6 rounded shadow bg-white/10 backdrop-blur-sm text-white">
                    <h2 class="text-2xl font-bold mb-6 text-center text-white">Data Siswa</h2>
                    <table class="table-auto w-full border-collapse border border-gray-300">
                        <tbody>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Nama</td><td class="border border-gray-300 p-3">{{ $student->nama_murid }}</td></tr>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Nomor Induk</td><td class="border border-gray-300 p-3">{{ $student->no_induk }}</td></tr>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Nomor NISN</td><td class="border border-gray-300 p-3">{{ $student->no_nisn }}</td></tr>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Tempat, Tanggal Lahir</td><td class="border border-gray-300 p-3">{{ $student->tempat_lahir }}, {{ $student->tanggal_lahir->format('d-m-Y') }}</td></tr>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Kelas Saat Ini</td><td class="border border-gray-300 p-3">{{ $student->kelas }}</td></tr>
                        </tbody>
                    </table>
                    
                    <div class="flex items-center justify-center mt-8">
                        <button wire:click="$set('student', null)" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Cari Lagi</button>
                    </div>
                </div>
            @elseif($nama_murid || $tanggal_lahir)
                <div class="bg-red-100/90 text-red-800 p-4 rounded border border-red-300">
                    <p class="text-center font-semibold">⚠️ Tidak ada siswa ditemukan dengan data yang Anda masukkan.</p>
                    <p class="text-center text-sm mt-2">Pastikan nama lengkap dan tanggal lahir sudah benar.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer class="w-full bg-gray-900/50 backdrop-blur-sm mt-12 py-6">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-300">
                <div class="text-center md:text-left">
                    <p class="font-semibold text-white text-base">SDN CIPINANG MELAYU 07</p>
                    <p class="mt-1">Jl. Borobudur No.1, RT.1/RW.10, Cipinang Melayu, Kec. Makasar</p>
                    <p>Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13620</p>
                </div>
                <div class="text-center md:text-right">
                    <p>&copy; 2025 SDN Cipinang Melayu 07</p>
                </div>
            </div>
        </div>
    </footer>
</div>