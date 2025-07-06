<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechRental - Penyewaan Barang Elektronik</title>
    <!-- Preload critical assets -->
    <link rel="preload" href="https://cdn.tailwindcss.com" as="script">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" as="style">
    
    <!-- Defer non-critical CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" media="print" onload="this.media='all'">
    <script src="https://cdn.tailwindcss.com" defer></script>
    
    <style>
        /* Critical CSS */
        .loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Optimize animations */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }

        /* Defer non-critical styles */
        .nav-link, .nav-link-mobile, .mobile-menu-enter, .mobile-menu-leave {
            will-change: transform, opacity;
        }
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
        .nav-link {
            @apply text-white hover:text-white transition-colors duration-300;
        }
        .nav-link-mobile {
            @apply text-white transition-colors duration-300;
        }
        .nav-link.active {
            @apply text-white;
        }
        .nav-link.active::after {
            content: '';
            @apply absolute bottom-0 left-0 w-full h-0.5 bg-white transform scale-x-100 transition-transform duration-300;
        }
        .mobile-menu-enter {
            animation: slideDown 0.3s ease-out;
        }
        .mobile-menu-leave {
            animation: slideUp 0.3s ease-out;
        }
        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        @keyframes slideUp {
            from {
                transform: translateY(0);
                opacity: 1;
            }
            to {
                transform: translateY(-100%);
                opacity: 0;
            }
        }

        /* Glassmorphism effect */
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Gradient animation */
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .animate-gradient {
            background-size: 200% 200%;
            animation: gradient 15s ease infinite;
        }

        /* Navbar scroll behavior */
        .navbar-hidden {
            transform: translateY(-100%);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease-in-out;
        }

        .navbar-visible {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
            transition: all 0.3s ease-in-out;
        }

        /* Ensure navbar is always on top */
        #navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Dark mode styles */
        .dark {
            color-scheme: dark;
        }

        .dark body {
            @apply bg-gray-900 text-gray-100;
        }

        .dark .bg-white {
            @apply bg-gray-800;
        }

        .dark .text-gray-600 {
            @apply text-gray-300;
        }

        .dark .text-gray-800 {
            @apply text-gray-100;
        }

        .dark .bg-gray-50 {
            @apply bg-gray-800;
        }

        .dark .border-gray-300 {
            @apply border-gray-600;
        }

        .dark .shadow-lg {
            @apply shadow-gray-900;
        }

        /* Theme transition */
        * {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        /* Theme toggle button animation */
        .theme-toggle-icon {
            transition: transform 0.5s ease;
        }

        .dark .theme-toggle-icon {
            transform: rotate(180deg);
        }

        /* Product card hover effects */
        .product-card {
            perspective: 1000px;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        /* Line clamp for description */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Smooth transitions */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }
    </style>
</head>
<body class="font-sans">
    <!-- Loading Screen -->
    <div id="loading" class="loading">
        <div class="loading-spinner"></div>
    </div>

    <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300" id="navbar">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-purple-900/80 backdrop-blur-lg"></div>
        <div class="container mx-auto px-4 relative">
            <div class="flex justify-between items-center h-20">
                <!-- Logo Section -->
                <div class="flex items-center space-x-3 group">
                    <div class="relative">
                        <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg blur opacity-25 group-hover:opacity-75 transition duration-1000"></div>
                        <div class="relative bg-white/10 backdrop-blur-sm p-3 rounded-lg">
                            <i class="fas fa-laptop text-2xl text-white group-hover:scale-110 transition-transform duration-300"></i>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-2xl font-bold bg-gradient-to-r from-white via-blue-200 to-purple-200 bg-clip-text text-transparent">TechRental</span>
                        <span class="text-xs text-blue-200">Your Tech Partner</span>
                    </div>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="#hero" class="nav-link group relative px-4 py-2">
                        <span class="relative z-10 flex items-center">
                            <i class="fas fa-home mr-2 text-blue-300 group-hover:text-white transition-colors"></i>
                            <span>Beranda</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/0 via-blue-500/20 to-purple-500/0 rounded-lg transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                    </a>
                    <a href="#products" class="nav-link group relative px-4 py-2">
                        <span class="relative z-10 flex items-center">
                            <i class="fas fa-laptop mr-2 text-blue-300 group-hover:text-white transition-colors"></i>
                            <span>Produk</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/0 via-blue-500/20 to-purple-500/0 rounded-lg transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                    </a>
                    <a href="#testimonial" class="nav-link group relative px-4 py-2">
                        <span class="relative z-10 flex items-center">
                            <i class="fas fa-star mr-2 text-blue-300 group-hover:text-white transition-colors"></i>
                            <span>Testimoni</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/0 via-blue-500/20 to-purple-500/0 rounded-lg transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                    </a>
                    <a href="#footer" class="nav-link group relative px-4 py-2">
                        <span class="relative z-10 flex items-center">
                            <i class="fas fa-envelope mr-2 text-blue-300 group-hover:text-white transition-colors"></i>
                            <span>Kontak</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/0 via-blue-500/20 to-purple-500/0 rounded-lg transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                    </a>
                    
                    <!-- Auth Buttons -->
                    <div class="flex items-center space-x-3 ml-4">
                        <a href="{{ route('login') }}" class="px-4 py-2 text-white hover:text-blue-200 transition-colors duration-300">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-white/10 backdrop-blur-sm rounded-lg text-white hover:bg-white/20 transition-all duration-300">
                            <i class="fas fa-user-plus mr-2"></i>
                            Register
                        </a>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center space-x-4">
                    <!-- Auth Buttons Mobile -->
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('login') }}" class="p-2 text-white hover:text-blue-200 transition-colors duration-300">
                            <i class="fas fa-sign-in-alt"></i>
                        </a>
                        <a href="{{ route('register') }}" class="p-2 bg-white/10 backdrop-blur-sm rounded-lg text-white hover:bg-white/20 transition-all duration-300">
                            <i class="fas fa-user-plus"></i>
                        </a>
                    </div>
                    <button id="mobile-menu-btn" class="p-2 rounded-lg bg-white/10 backdrop-blur-sm hover:bg-white/20 transition-all duration-300">
                        <i class="fas fa-bars text-xl text-white group-hover:rotate-90 transition-transform duration-500"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden">
            <div class="absolute inset-0 bg-gradient-to-b from-blue-900/95 to-purple-900/95 backdrop-blur-lg">
                <div class="container mx-auto px-4 py-4">
                    <div class="flex flex-col space-y-2">
                        <a href="#hero" class="nav-link-mobile group">
                            <div class="flex items-center px-4 py-3 rounded-lg bg-white/5 hover:bg-white/10 transition-all duration-300">
                                <i class="fas fa-home mr-3 text-blue-300 group-hover:text-white transition-colors"></i>
                                <span>Beranda</span>
                                <i class="fas fa-chevron-right ml-auto transform group-hover:translate-x-1 transition-transform"></i>
                            </div>
                        </a>
                        <a href="#products" class="nav-link-mobile group">
                            <div class="flex items-center px-4 py-3 rounded-lg bg-white/5 hover:bg-white/10 transition-all duration-300">
                                <i class="fas fa-laptop mr-3 text-blue-300 group-hover:text-white transition-colors"></i>
                                <span>Produk</span>
                                <i class="fas fa-chevron-right ml-auto transform group-hover:translate-x-1 transition-transform"></i>
                            </div>
                        </a>
                        <a href="#testimonial" class="nav-link-mobile group">
                            <div class="flex items-center px-4 py-3 rounded-lg bg-white/5 hover:bg-white/10 transition-all duration-300">
                                <i class="fas fa-star mr-3 text-blue-300 group-hover:text-white transition-colors"></i>
                                <span>Testimoni</span>
                                <i class="fas fa-chevron-right ml-auto transform group-hover:translate-x-1 transition-transform"></i>
                            </div>
                        </a>
                        <a href="#footer" class="nav-link-mobile group">
                            <div class="flex items-center px-4 py-3 rounded-lg bg-white/5 hover:bg-white/10 transition-all duration-300">
                                <i class="fas fa-envelope mr-3 text-blue-300 group-hover:text-white transition-colors"></i>
                                <span>Kontak</span>
                                <i class="fas fa-chevron-right ml-auto transform group-hover:translate-x-1 transition-transform"></i>
                            </div>
                        </a>
                        <!-- Auth Links Mobile -->
                        <div class="pt-4 border-t border-white/10">
                            <a href="{{ route('login') }}" class="nav-link-mobile group">
                                <div class="flex items-center px-4 py-3 rounded-lg bg-white/5 hover:bg-white/10 transition-all duration-300">
                                    <i class="fas fa-sign-in-alt mr-3 text-blue-300 group-hover:text-white transition-colors"></i>
                                    <span>Login</span>
                                    <i class="fas fa-chevron-right ml-auto transform group-hover:translate-x-1 transition-transform"></i>
                                </div>
                            </a>
                            <a href="{{ route('register') }}" class="nav-link-mobile group">
                                <div class="flex items-center px-4 py-3 rounded-lg bg-white/5 hover:bg-white/10 transition-all duration-300">
                                    <i class="fas fa-user-plus mr-3 text-blue-300 group-hover:text-white transition-colors"></i>
                                    <span>Register</span>
                                    <i class="fas fa-chevron-right ml-auto transform group-hover:translate-x-1 transition-transform"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    @if(session('success'))
    <div class="fixed top-20 left-1/2 transform -translate-x-1/2 z-50" id="alert">
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    <!-- Hero Section -->
    <section id="hero" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white pt-16 min-h-screen flex items-center">
        <div class="container mx-auto px-4 py-20">
            <div class="flex flex-col md:flex-row items-center" data-aos="fade-up">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6 animate-fade-in">
                        Sewa Barang Elektronik Terpercaya
                    </h1>
                    <p class="text-xl mb-8 animate-fade-in">
                        Nikmati teknologi terkini dengan harga terjangkau. Kami menyediakan berbagai perangkat elektronik berkualitas untuk kebutuhan Anda.
                    </p>
                    <div class="space-x-4 animate-fade-in">
                        <a href="#products" class="bg-purple-500 hover:bg-purple-600 px-8 py-3 rounded-lg font-semibold transition">
                            Lihat Produk
                        </a>
                        <a href="#footer" class="border-2 border-white hover:bg-white hover:text-blue-600 px-8 py-3 rounded-lg font-semibold transition">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2" data-aos="fade-left">
                    <div class="relative w-full h-96 flex items-center justify-center">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-laptop-code text-9xl text-white opacity-20 animate-pulse"></i>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Koleksi Barang Elektronik</h2>
                <p class="text-xl text-gray-600">Temukan perangkat elektronik terbaik untuk kebutuhan Anda</p>
            </div>

            <!-- Search and Filter Bar -->
            <div class="max-w-4xl mx-auto mb-12" data-aos="fade-up">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 relative">
                        <input type="text" id="search-input" 
                               class="w-full px-6 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300"
                               placeholder="Cari produk...">
                        <i class="fas fa-search absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-6 py-3 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition-all duration-300 flex items-center gap-2">
                            <i class="fas fa-filter"></i>
                            <span>Filter</span>
                        </button>
                        <button class="px-6 py-3 rounded-xl bg-white border border-gray-200 hover:bg-gray-50 transition-all duration-300 flex items-center gap-2">
                            <i class="fas fa-sort"></i>
                            <span>Urutkan</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product Grid -->
            <div id="product-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($alat as $item)
                <div class="product-card group" data-aos="fade-up">
                    <div class="relative overflow-hidden rounded-2xl bg-white shadow-lg transition-all duration-300 hover:shadow-2xl">
                        <!-- Product Image -->
                        <div class="relative h-64 overflow-hidden">
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" 
                                     alt="Foto Barang" 
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                            @else
                                <img src="/api/placeholder/300/200" 
                                     alt="{{ $item->nama }}" 
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        <!-- Product Info -->
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">
                                    {{ $item->nama }}
                                </h3>
                                <span class="px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-600">
                                    Tersedia
                                </span>
                            </div>
                            
                            <p class="text-gray-600 mb-4 line-clamp-2">
                                {{ $item->deskripsi }}
                            </p>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-tag text-blue-500"></i>
                                    <span class="text-2xl font-bold text-blue-600">
                                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                                    </span>
                                    <span class="text-sm text-gray-500">/hari</span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-6 flex gap-3">
                                <a href="{{ url('pinjaman/create/' . $item->id) }}" 
                                   class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition-all duration-300 flex items-center justify-center gap-2 group-hover:scale-105">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span>Sewa Sekarang</span>
                                </a>
                                
                            </div>

                            <!-- Additional Info -->
                            
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12" data-aos="fade-up">
                <button class="px-8 py-4 rounded-xl bg-white border-2 border-blue-600 text-blue-600 font-semibold hover:bg-blue-50 transition-all duration-300 flex items-center gap-2 mx-auto">
                    <span>Lihat Lebih Banyak</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section id="testimonial" class="py-20 bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Apa Kata Mereka?</h2>
                <p class="text-xl text-gray-600">Testimoni dari pelanggan setia kami</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial Card 1 -->
                <div class="group" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative bg-white/80 backdrop-blur-lg p-8 rounded-2xl shadow-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                        <!-- Quote Icon -->
                        <div class="absolute -top-4 -left-4 w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white text-2xl transform rotate-12 group-hover:rotate-45 transition-transform duration-300">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        
                        <!-- Rating -->
                        <div class="flex mb-4">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>

                        <!-- Testimonial Text -->
                        <p class="text-gray-600 mb-6 relative z-10">
                            "Laptop yang disewakan sangat bagus dan terawat. Proses sewa mudah dan pelayanan sangat memuaskan!"
                        </p>

                        <!-- User Info -->
                        <div class="flex items-center">
                            <div class="relative">
                                <div class="w-12 h-12 rounded-full overflow-hidden ring-2 ring-blue-500">
                                    <img src="{{ asset('storage/ridwan.webp') }}" alt="Ahmad Ridwan" class="w-full h-full object-cover">
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-bold text-gray-800">Ahmad Ridwan</h4>
                                <p class="text-sm text-gray-500">Pengusaha</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial Card 2 -->
                <div class="group" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative bg-white/80 backdrop-blur-lg p-8 rounded-2xl shadow-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                        <!-- Quote Icon -->
                        <div class="absolute -top-4 -left-4 w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white text-2xl transform rotate-12 group-hover:rotate-45 transition-transform duration-300">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        
                        <!-- Rating -->
                        <div class="flex mb-4">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>

                        <!-- Testimonial Text -->
                        <p class="text-gray-600 mb-6 relative z-10">
                            "Harga sewa sangat terjangkau dengan kualitas barang yang premium. Sangat membantu untuk kebutuhan kerja saya."
                        </p>

                        <!-- User Info -->
                        <div class="flex items-center">
                            <div class="relative">
                                <div class="w-12 h-12 rounded-full overflow-hidden ring-2 ring-purple-500">
                                    <img src="{{ asset('storage/sari.webp') }}" alt="Sari Melati" class="w-full h-full object-cover">
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-bold text-gray-800">Sari Melati</h4>
                                <p class="text-sm text-gray-500">Content Creator</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial Card 3 -->
                <div class="group" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative bg-white/80 backdrop-blur-lg p-8 rounded-2xl shadow-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                        <!-- Quote Icon -->
                        <div class="absolute -top-4 -left-4 w-12 h-12 bg-gradient-to-br from-pink-500 to-red-500 rounded-full flex items-center justify-center text-white text-2xl transform rotate-12 group-hover:rotate-45 transition-transform duration-300">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        
                        <!-- Rating -->
                        <div class="flex mb-4">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>

                        <!-- Testimonial Text -->
                        <p class="text-gray-600 mb-6 relative z-10">
                            "Sudah beberapa kali sewa di sini. Selalu puas dengan pelayanan dan kondisi barang. Tim yang profesional!"
                        </p>

                        <!-- User Info -->
                        <div class="flex items-center">
                            <div class="relative">
                                <div class="w-12 h-12 rounded-full overflow-hidden ring-2 ring-pink-500">
                                    <img src="{{ asset('storage/budi.png') }}" alt="Budi Santoso" class="w-full h-full object-cover">
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-bold text-gray-800">Budi Santoso</h4>
                                <p class="text-sm text-gray-500">Freelancer</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial Stats -->
            <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-8" data-aos="fade-up">
                <div class="text-center">
                    <div class="text-4xl font-bold text-blue-600 mb-2">500+</div>
                    <p class="text-gray-600">Pelanggan Puas</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-purple-600 mb-2">1000+</div>
                    <p class="text-gray-600">Transaksi Sukses</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-pink-600 mb-2">4.8</div>
                    <p class="text-gray-600">Rating Rata-rata</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-red-600 mb-2">98%</div>
                    <p class="text-gray-600">Kepuasan Pelanggan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="footer" class="bg-gradient-to-r from-gray-900 to-gray-800 text-white py-16 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-purple-500"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div data-aos="fade-up" class="transform hover:scale-105 transition-transform duration-300">
                    <div class="flex items-center mb-4">
                        <div class="bg-gradient-to-r from-blue-500 to-purple-500 p-2 rounded-lg mr-3">
                            <i class="fas fa-laptop text-2xl"></i>
                        </div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">TechRental</span>
                    </div>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        Penyedia layanan sewa barang elektronik terpercaya dengan pengalaman lebih dari 5 tahun.
                        Nikmati teknologi terkini dengan harga terjangkau.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="social-link bg-gray-700 p-3 rounded-full hover:bg-blue-600 transition-all duration-300">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="social-link bg-gray-700 p-3 rounded-full hover:bg-pink-600 transition-all duration-300">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="social-link bg-gray-700 p-3 rounded-full hover:bg-green-600 transition-all duration-300">
                            <i class="fab fa-whatsapp text-xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-xl font-bold mb-6 bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">Quick Links</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="#hero" class="footer-link flex items-center text-gray-300 hover:text-white transition-all duration-300">
                                <i class="fas fa-chevron-right text-xs mr-2 text-blue-400"></i>
                                Beranda
                            </a>
                        </li>
                        <li>
                            <a href="#products" class="footer-link flex items-center text-gray-300 hover:text-white transition-all duration-300">
                                <i class="fas fa-chevron-right text-xs mr-2 text-blue-400"></i>
                                Produk
                            </a>
                        </li>
                        <li>
                            <a href="#testimonial" class="footer-link flex items-center text-gray-300 hover:text-white transition-all duration-300">
                                <i class="fas fa-chevron-right text-xs mr-2 text-blue-400"></i>
                                Testimoni
                            </a>
                        </li>
                        <li>
                            <a href="#" class="footer-link flex items-center text-gray-300 hover:text-white transition-all duration-300">
                                <i class="fas fa-chevron-right text-xs mr-2 text-blue-400"></i>
                                Tentang Kami
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-xl font-bold mb-6 bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">Kontak</h3>
                    <ul class="space-y-4">
                        <li class="flex items-center group">
                            <div class="bg-gray-700 p-3 rounded-lg mr-3 group-hover:bg-blue-600 transition-all duration-300">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <span class="text-gray-300 group-hover:text-white transition-all duration-300">Jl. Teknologi No. 123, Jakarta</span>
                        </li>
                        <li class="flex items-center group">
                            <div class="bg-gray-700 p-3 rounded-lg mr-3 group-hover:bg-blue-600 transition-all duration-300">
                                <i class="fas fa-phone"></i>
                            </div>
                            <span class="text-gray-300 group-hover:text-white transition-all duration-300">+62 812-3456-7890</span>
                        </li>
                        <li class="flex items-center group">
                            <div class="bg-gray-700 p-3 rounded-lg mr-3 group-hover:bg-blue-600 transition-all duration-300">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <span class="text-gray-300 group-hover:text-white transition-all duration-300">info@techrental.com</span>
                        </li>
                    </ul>
                </div>

                <!-- Operating Hours -->
                <div data-aos="fade-up" data-aos-delay="300">
                    <h3 class="text-xl font-bold mb-6 bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">Jam Operasional</h3>
                    <ul class="space-y-4">
                        <li class="flex items-center justify-between bg-gray-700/50 p-3 rounded-lg hover:bg-gray-700 transition-all duration-300">
                            <span class="text-gray-300">Senin - Jumat</span>
                            <span class="text-blue-400">08:00 - 17:00</span>
                        </li>
                        <li class="flex items-center justify-between bg-gray-700/50 p-3 rounded-lg hover:bg-gray-700 transition-all duration-300">
                            <span class="text-gray-300">Sabtu</span>
                            <span class="text-blue-400">08:00 - 15:00</span>
                        </li>
                        <li class="flex items-center justify-between bg-gray-700/50 p-3 rounded-lg hover:bg-gray-700 transition-all duration-300">
                            <span class="text-gray-300">Minggu</span>
                            <span class="text-red-400">Tutup</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="mt-12 pt-8 border-t border-gray-700 text-center text-gray-400">
                <p>&copy; 2024 TechRental. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Remove loading screen when page is ready
        window.addEventListener('load', function() {
            const loading = document.getElementById('loading');
            if (loading) {
                loading.style.opacity = '0';
                setTimeout(() => {
                    loading.remove();
                }, 300);
            }
        });

        // Lazy load images
        document.addEventListener('DOMContentLoaded', function() {
            const lazyImages = document.querySelectorAll('img[data-src]');
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        observer.unobserve(img);
                    }
                });
            });

            lazyImages.forEach(img => imageObserver.observe(img));

            // Initialize other features
            initializeNavbar();
            initializeSearch();
        });

        // Separate functions for better performance
        function initializeNavbar() {
            let lastScrollTop = 0;
            const navbar = document.getElementById('navbar');
            const scrollThreshold = 50;
            
            window.addEventListener('scroll', function() {
                const currentScroll = window.pageYOffset;
                
                if (currentScroll > lastScrollTop && currentScroll > scrollThreshold) {
                    navbar.classList.add('navbar-hidden');
                } else {
                    navbar.classList.remove('navbar-hidden');
                }
                
                lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
            }, { passive: true });
        }

        function initializeSearch() {
            const searchInput = document.getElementById('search-input');
            const productCards = document.querySelectorAll('.product-card');
            
            if (searchInput) {
                searchInput.addEventListener('input', debounce(function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    
                    productCards.forEach(card => {
                        const title = card.querySelector('h3').textContent.toLowerCase();
                        const description = card.querySelector('p').textContent.toLowerCase();
                        card.style.display = title.includes(searchTerm) || description.includes(searchTerm) ? 'block' : 'none';
                    });
                }, 150));
            }
        }

        // Utility function for debouncing
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Smooth scroll untuk link footer
        document.querySelectorAll('.footer-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Animasi hover untuk social links
        document.querySelectorAll('.social-link').forEach(link => {
            link.addEventListener('mouseover', function() {
                this.style.transform = 'scale(1.1)';
            });
            
            link.addEventListener('mouseout', function() {
                this.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>
