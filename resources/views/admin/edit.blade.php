@extends('layouts.admin')

@section('content')
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white p-6 rounded-lg shadow-sm">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Edit Alat</h2>
                <p class="text-gray-600 mt-1">Ubah informasi alat elektronik</p>
            </div>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <form action="{{ route('alat.update', $alat->id) }}" method="POST" enctype="multipart/form-data" id="editForm" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Image Upload Section -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Foto Alat</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-500 transition-colors duration-200" id="dropZone">
                        <div class="space-y-1 text-center">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>
                            <div class="flex text-sm text-gray-600">
                                <label for="foto" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                    <span>Upload foto baru</span>
                                    <input id="foto" name="foto" type="file" class="sr-only" accept="image/*" onchange="previewImage(this)">
                                </label>
                                <p class="pl-1">atau drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF sampai 2MB</p>
                        </div>
                    </div>
                    <div id="imagePreview" class="{{ $alat->foto ? '' : 'hidden' }} mt-4">
                        <img id="preview" src="{{ $alat->foto ? asset('storage/' . $alat->foto) : '#' }}" 
                             alt="Preview" class="max-h-48 rounded-lg shadow-sm">
                        <button type="button" onclick="removeImage()" class="mt-2 text-red-600 hover:text-red-800 text-sm">
                            <i class="fas fa-times mr-1"></i>Hapus gambar
                        </button>
                    </div>
                </div>

                <!-- Form Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Nama Alat</label>
                        <input type="text" name="nama" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               value="{{ $alat->nama }}"
                               placeholder="Masukkan nama alat">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">Rp</span>
                            <input type="number" name="harga" required
                                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   value="{{ $alat->harga }}"
                                   placeholder="0"
                                   oninput="formatNumber(this)">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Stok</label>
                        <input type="number" name="stok" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               value="{{ $alat->stok }}"
                               placeholder="0"
                               min="0">
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" required rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="Masukkan deskripsi alat">{{ $alat->deskripsi }}</textarea>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 pt-4">
                    <a href="{{ route('alat.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Image Preview
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const imagePreview = document.getElementById('imagePreview');
            const dropZone = document.getElementById('dropZone');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    dropZone.classList.add('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage() {
            const input = document.getElementById('foto');
            const preview = document.getElementById('preview');
            const imagePreview = document.getElementById('imagePreview');
            const dropZone = document.getElementById('dropZone');

            input.value = '';
            preview.src = '#';
            imagePreview.classList.add('hidden');
            dropZone.classList.remove('hidden');
        }

        // Drag and Drop
        const dropZone = document.getElementById('dropZone');
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            dropZone.classList.add('border-blue-500');
        }

        function unhighlight(e) {
            dropZone.classList.remove('border-blue-500');
        }

        dropZone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            const input = document.getElementById('foto');
            
            input.files = files;
            previewImage(input);
        }

        // Number Formatting
        function formatNumber(input) {
            // Remove non-numeric characters
            let value = input.value.replace(/\D/g, '');
            
            // Format with thousand separator
            if (value !== '') {
                value = parseInt(value).toLocaleString('id-ID');
            }
            
            input.value = value;
        }

        // Form Validation
        const form = document.getElementById('editForm');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Basic validation
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('border-red-500');
                } else {
                    field.classList.remove('border-red-500');
                }
            });
            
            if (isValid) {
                form.submit();
            } else {
                alert('Mohon lengkapi semua field yang diperlukan');
            }
        });

        // Initialize number formatting for existing values
        document.addEventListener('DOMContentLoaded', function() {
            const hargaInput = document.querySelector('input[name="harga"]');
            if (hargaInput.value) {
                formatNumber(hargaInput);
            }
        });
    </script>
@endsection
