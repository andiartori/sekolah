<div class="bg-secondary min-h-screen w-screen">
    <!-- Top Navbar -->
    <nav class="w-full p-4">
        <div class="flex justify-end">
            <a href="/admin/login" class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                Admin Login
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex items-center justify-center">
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
                    <input required type="text" wire:model="nama" class="border p-2 w-full rounded border-green-600 text-white bg-transparent">
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
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Nama</td><td class="border border-gray-300 p-3">{{ $student->nama }}</td></tr>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">NIPD</td><td class="border border-gray-300 p-3">{{ $student->nipd }}</td></tr>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Jenis Kelamin</td><td class="border border-gray-300 p-3">{{ $student->jenis_kelamin }}</td></tr>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">NISN</td><td class="border border-gray-300 p-3">{{ $student->nisn }}</td></tr>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Tempat, Tanggal Lahir</td><td class="border border-gray-300 p-3">{{ $student->tempat_lahir }}, {{ $student->tanggal_lahir->format('d-m-Y') }}</td></tr>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">NIK</td><td class="border border-gray-300 p-3">{{ $student->nik }}</td></tr>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Agama</td><td class="border border-gray-300 p-3">{{ $student->agama }}</td></tr>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Alamat</td><td class="border border-gray-300 p-3">{{ $student->alamat }}, RT {{ $student->rt }}/RW {{ $student->rw }}, {{ $student->kecamatan }}</td></tr>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Kelas Saat Ini</td><td class="border border-gray-300 p-3">{{ $student->kelas_saat_ini }}</td></tr>
                        </tbody>
                    </table>

                    <h3 class="text-xl font-bold mt-8 mb-4 text-center text-white">Data Orang Tua / Wali</h3>
                    <table class="table-auto w-full border-collapse border border-gray-300">
                        <tbody>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Ayah</td><td class="border border-gray-300 p-3">{{ $student->ayah_nama }} ({{ $student->ayah_tahun_lahir }})</td></tr>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Pendidikan Ayah</td><td class="border border-gray-300 p-3">{{ $student->ayah_pendidikan }}</td></tr>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Pekerjaan Ayah</td><td class="border border-gray-300 p-3">{{ $student->ayah_pekerjaan }}</td></tr>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Penghasilan Ayah</td><td class="border border-gray-300 p-3">{{ $student->formatted_ayah_penghasilan }}</td></tr>

                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Ibu</td><td class="border border-gray-300 p-3">{{ $student->ibu_nama }} ({{ $student->ibu_tahun_lahir }})</td></tr>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Pendidikan Ibu</td><td class="border border-gray-300 p-3">{{ $student->ibu_pendidikan }}</td></tr>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Pekerjaan Ibu</td><td class="border border-gray-300 p-3">{{ $student->ibu_pekerjaan }}</td></tr>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Penghasilan Ibu</td><td class="border border-gray-300 p-3">{{ $student->formatted_ibu_penghasilan }}</td></tr>

                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Wali</td><td class="border border-gray-300 p-3">{{ $student->wali_nama }} ({{ $student->wali_tahun_lahir }})</td></tr>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Pendidikan Wali</td><td class="border border-gray-300 p-3">{{ $student->wali_pendidikan }}</td></tr>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Pekerjaan Wali</td><td class="border border-gray-300 p-3">{{ $student->wali_pekerjaan }}</td></tr>
                            <tr><td class="border border-gray-300 p-3 font-semibold bg-gray-100/20">Penghasilan Wali</td><td class="border border-gray-300 p-3">{{ $student->formatted_wali_penghasilan }}</td></tr>
                        </tbody>
                    </table>
                    
                    <div class="flex items-center justify-center mt-8">
                        <button wire:click="$set('student', null)" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Cari Lagi</button>
                    </div>
                </div>
            @elseif($nama || $tanggal_lahir)
                <div class="bg-red-100/90 text-red-800 p-4 rounded border border-red-300">
                    <p class="text-center font-semibold">⚠️ Tidak ada siswa ditemukan dengan data yang Anda masukkan.</p>
                    <p class="text-center text-sm mt-2">Pastikan nama lengkap dan tanggal lahir sudah benar.</p>
                </div>
            @endif
        </div>
    </div>
</div>