@extends('layouts.admin')
@section('content')
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white p-6 rounded-lg shadow-sm">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Data Pinjaman</h2>
                <p class="text-gray-600 mt-1">Kelola semua data peminjaman alat</p>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg animate-fade-in-down">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Search and Filter Section -->
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" id="searchInput" placeholder="Cari peminjaman..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div class="flex gap-2">
                    <select id="filterStatus" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="all">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="completed">Selesai</option>
                    </select>
                    <select id="sortSelect" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="nama">Urutkan berdasarkan nama</option>
                        <option value="total">Urutkan berdasarkan total harga</option>
                        <option value="durasi">Urutkan berdasarkan durasi</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
                        @foreach ($pinjamen as $index => $pinjaman)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $pinjaman->nama }}</div>
                                    <div class="text-sm text-gray-500">{{ $pinjaman->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $pinjaman->alat->nama ?? 'Alat tidak ditemukan' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $pinjaman->jumlah }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $pinjaman->durasi }} hari
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        Rp {{ number_format($pinjaman->total_harga, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $pinjaman->nomor_hp }}</div>
                                    <div class="text-sm text-gray-500 line-clamp-1">{{ $pinjaman->alamat }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="showDetails({{ $pinjaman->id }})" 
                                            class="text-blue-600 hover:text-blue-900 mr-3">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <form action="{{ route('pinjaman.destroy', $pinjaman->id) }}" 
                                          method="POST" 
                                          class="inline-block"
                                          onsubmit="return confirmDelete(event)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @if ($pinjamen->isEmpty())
                            <tr>
                                <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fas fa-clipboard-list text-4xl mb-2 text-gray-400"></i>
                                        <p class="text-lg">Data pinjaman tidak tersedia.</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Details Modal -->
    <div id="detailsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-2xl w-full mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-900">Detail Peminjaman</h3>
                <button onclick="closeDetailsModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="modalContent" class="space-y-4">
                <!-- Content will be loaded dynamically -->
            </div>
        </div>
    </div>

    <script>
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('tableBody');
        const rows = tableBody.getElementsByTagName('tr');

        searchInput.addEventListener('keyup', function() {
            const searchText = this.value.toLowerCase();
            
            Array.from(rows).forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchText) ? '' : 'none';
            });
        });

        // Sort functionality
        const sortSelect = document.getElementById('sortSelect');
        sortSelect.addEventListener('change', function() {
            const sortBy = this.value;
            const rows = Array.from(tableBody.getElementsByTagName('tr'));
            
            rows.sort((a, b) => {
                const aValue = a.querySelector(`td:nth-child(${getColumnIndex(sortBy)})`).textContent;
                const bValue = b.querySelector(`td:nth-child(${getColumnIndex(sortBy)})`).textContent;
                
                if (sortBy === 'total') {
                    return parseFloat(aValue.replace(/[^0-9.-]+/g, '')) - parseFloat(bValue.replace(/[^0-9.-]+/g, ''));
                }
                return aValue.localeCompare(bValue);
            });
            
            rows.forEach(row => tableBody.appendChild(row));
        });

        function getColumnIndex(sortBy) {
            const columns = {
                'nama': 2,
                'total': 6,
                'durasi': 5
            };
            return columns[sortBy];
        }

        // Details Modal
        function showDetails(id) {
            const modal = document.getElementById('detailsModal');
            const content = document.getElementById('modalContent');
            
            // Fetch data and populate modal
            fetch(`/elektronik/public/pinjaman/${id}`)
                .then(response => response.json())
                .then(data => {
                    content.innerHTML = `
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Nama</p>
                                <p class="font-medium">${data.nama}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="font-medium">${data.email}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Nomor HP</p>
                                <p class="font-medium">${data.nomor_hp}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Alamat</p>
                                <p class="font-medium">${data.alamat}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Alat</p>
                                <p class="font-medium">${data.alat.nama}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Jumlah</p>
                                <p class="font-medium">${data.jumlah}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Durasi</p>
                                <p class="font-medium">${data.durasi} hari</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Total Harga</p>
                                <p class="font-medium">Rp ${new Intl.NumberFormat('id-ID').format(data.total_harga)}</p>
                            </div>
                        </div>
                    `;
                });
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDetailsModal() {
            const modal = document.getElementById('detailsModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Delete confirmation
        function confirmDelete(event) {
            event.preventDefault();
            if (confirm('Apakah Anda yakin ingin menghapus data peminjaman ini? Stok alat akan dikembalikan.')) {
                event.target.submit();
            }
        }

        // Close modal when clicking outside
        document.getElementById('detailsModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDetailsModal();
            }
        });

        // Add animation classes
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.05}s`;
                row.classList.add('animate-fade-in');
            });
        });
    </script>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
        .animate-fade-in-down {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>
@endsection
