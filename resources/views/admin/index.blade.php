@extends('layouts.admin')
@section('content')
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white p-6 rounded-lg shadow-sm">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Daftar Barang</h2>
                <p class="text-gray-600 mt-1">Kelola semua barang elektronik yang tersedia</p>
            </div>
            <a href="{{ route('alat.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 transform hover:scale-105">
                <i class="fas fa-plus mr-2"></i>
                Tambah Barang
            </a>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" id="searchInput" placeholder="Cari barang..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div class="flex gap-2">
                    <select id="sortSelect" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="nama">Urutkan berdasarkan nama</option>
                        <option value="harga">Urutkan berdasarkan harga</option>
                        <option value="stok">Urutkan berdasarkan stok</option>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
                        @foreach ($alat as $index => $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Barang"
                                             class="w-16 h-16 object-cover rounded-lg shadow-sm hover:scale-110 transition-transform duration-200 cursor-pointer"
                                             onclick="showImageModal(this.src)">
                                    @else
                                        <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->nama }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500 line-clamp-2">{{ $item->deskripsi }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Rp{{ number_format($item->harga, 0, ',', '.') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->stok > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $item->stok }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('alat.edit', $item->id) }}"
                                       class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors duration-200">
                                        <i class="fas fa-edit mr-1"></i>
                                        Edit
                                    </a>
                                    <form action="{{ route('alat.destroy', $item->id) }}" method="POST"
                                          class="inline-block"
                                          onsubmit="return confirmDelete(event)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                            <i class="fas fa-trash-alt mr-1"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @if($alat->isEmpty())
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fas fa-box-open text-4xl mb-2 text-gray-400"></i>
                                        <p class="text-lg">Tidak ada data barang.</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-2 rounded-lg max-w-2xl max-h-[90vh]">
            <img id="modalImage" src="" alt="Preview" class="max-w-full max-h-[80vh] object-contain">
            <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white hover:text-gray-300">
                <i class="fas fa-times text-2xl"></i>
            </button>
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
                
                if (sortBy === 'harga') {
                    return parseFloat(aValue.replace(/[^0-9.-]+/g, '')) - parseFloat(bValue.replace(/[^0-9.-]+/g, ''));
                }
                return aValue.localeCompare(bValue);
            });
            
            rows.forEach(row => tableBody.appendChild(row));
        });

        function getColumnIndex(sortBy) {
            const columns = {
                'nama': 3,
                'harga': 5,
                'stok': 6
            };
            return columns[sortBy];
        }

        // Image Modal
        function showImageModal(src) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            modalImg.src = src;
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Delete confirmation
        function confirmDelete(event) {
            event.preventDefault();
            if (confirm('Apakah Anda yakin ingin menghapus barang ini?')) {
                event.target.submit();
            }
        }

        // Close modal when clicking outside
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });
    </script>
@endsection
