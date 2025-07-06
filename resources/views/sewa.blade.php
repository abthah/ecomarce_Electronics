<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam Alat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-400 via-purple-500 to-purple-700 min-h-screen p-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-8">
                <h1 class="text-3xl font-bold text-center">Pinjam Alat</h1>
                <p class="text-center text-blue-100 mt-2">Lengkapi form di bawah untuk meminjam alat</p>
            </div>

            <!-- Product Information Section -->
            <div class="p-8 border-b border-gray-200">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Product Image -->
                    <div class="space-y-4">
                        <div
                            class="aspect-square bg-gray-100 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-300 overflow-hidden">
                            <img src="{{ asset('storage/' . $alat->foto) }}" alt="Deskripsi Gambar"
                                class="object-cover w-full h-full rounded-xl">
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="space-y-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $alat->nama }}</h2>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <span class="text-gray-600 font-medium">Stok Tersedia</span>
                                <span class="text-2xl font-bold text-green-600">{{ $alat->stok }} Unit</span>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <span class="text-gray-600 font-medium">Harga Sewa</span>
                                <span class="text-2xl font-bold text-blue-600">Rp
                                    {{ number_format($alat->harga, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="p-4 bg-blue-50 rounded-lg">
                            <h3 class="font-semibold text-gray-900 mb-2">Deskripsi</h3>
                            <p class="text-gray-700 text-sm leading-relaxed">{{ $alat->deskripsi }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="p-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-6">Informasi Peminjam</h3>

                <form action="{{ route('pinjaman.store') }}" method="POST" class="space-y-6" onsubmit="return confirm('Pastikan Data Sudah Benar?');">
                    @csrf
                    <input type="hidden" name="alat_id" value="{{ $alat->id }}">

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Nama Peminjam -->
                        <div class="space-y-2">
                            <label for="nama" class="block text-sm font-medium text-gray-700">
                                Nama Lengkap
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nama" name="nama" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                placeholder="Masukkan nama lengkap Anda">
                        </div>

                        <!-- Email -->
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Email
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                placeholder="contoh@email.com">
                        </div>

                        <!-- Nomor HP -->
                        <div class="space-y-2">
                            <label for="nomor_hp" class="block text-sm font-medium text-gray-700">
                                Nomor Handphone
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" id="nomor_hp" name="nomor_hp" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                placeholder="08xxxxxxxxxx">
                        </div>

                        <!-- Jumlah Pinjam -->
                        <div class="space-y-2">
                            <label for="jumlah" class="block text-sm font-medium text-gray-700">
                                Jumlah Pinjam
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="jumlah" name="jumlah" required min="1"
                                max="{{ $alat->stok }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                placeholder="Jumlah unit yang ingin dipinjam">
                            <p class="text-xs text-gray-500">Maksimal {{ $alat->stok }} unit</p>
                        </div>

                        <!-- Durasi Pinjam -->
                        <div class="space-y-2">
                            <label for="durasi" class="block text-sm font-medium text-gray-700">
                                Durasi Pinjam (Hari)
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="durasi" name="durasi" required min="1"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                placeholder="Berapa hari akan dipinjam">
                        </div>
                    </div>

                    <!-- Total Harga -->
                    <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-700 font-medium">Total Harga:</span>
                            <span id="total-harga" class="text-2xl font-bold text-blue-600">Rp 0</span>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="space-y-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">
                            Alamat Lengkap
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea id="alamat" name="alamat" required rows="3"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                            placeholder="Masukkan alamat lengkap untuk pengiriman/pengambilan alat"></textarea>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">Ketentuan Peminjaman</h3>
                                <div class="mt-2 text-sm text-yellow-700">
                                    <ul class="list-disc list-inside space-y-1">
                                        <li>Alat harus dikembalikan dalam kondisi baik</li>
                                        <li>Kerusakan alat menjadi tanggung jawab peminjam</li>
                                        <li>Keterlambatan pengembalian dikenakan denda</li>
                                        <li>Lakukan konfirmasi sebelum mengambil alat</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-between pt-6">
                        <a href="/" class="text-gray-500 hover:text-gray-700 font-medium">
                            ← Kembali ke daftar alat
                        </a>
                        <button type="submit"
                            class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-3 px-8 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Ajukan Peminjaman
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Add some interactive features
        document.getElementById('jumlah').addEventListener('input', calculateTotal);
        document.getElementById('durasi').addEventListener('input', calculateTotal);

        function calculateTotal() {
            const jumlah = parseInt(document.getElementById('jumlah').value) || 0;
            const durasi = parseInt(document.getElementById('durasi').value) || 0;
            const hargaPerHari = {{ $alat->harga }};
            const total = jumlah * durasi * hargaPerHari;
            
            document.getElementById('total-harga').textContent = 
                'Rp ' + total.toLocaleString('id-ID');
        }

        // Form validation feedback
        const inputs = document.querySelectorAll('input[required], textarea[required]');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim() === '') {
                    this.classList.add('border-red-500');
                    this.classList.remove('border-gray-300');
                } else {
                    this.classList.remove('border-red-500');
                    this.classList.add('border-gray-300');
                }
            });
        });
    </script>
</body>

</html>
