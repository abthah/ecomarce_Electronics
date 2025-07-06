<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Panel - Elektronik</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <script>
    // Konfigurasi Tailwind
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            primary: '#1e40af',
            secondary: '#1e293b',
          }
        }
      }
    }
  </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900">
  <div class="min-h-screen flex">
    <!-- Mobile Sidebar Toggle -->
    <button id="sidebarToggle" class="lg:hidden fixed top-4 left-4 z-50 p-2 rounded-md bg-primary text-white">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-40 w-64 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out bg-gradient-to-b from-primary to-secondary text-white">
      <div class="flex flex-col h-full">
        <div class="p-4">
          <h1 class="text-2xl font-bold mb-6 flex items-center">
            <i class="fas fa-tools mr-2"></i>
            Admin Panel
          </h1>
          <nav class="space-y-1">
            <a href="/elektronik/public/alat" class="flex items-center py-2 px-3 rounded-lg transition-colors duration-200 hover:bg-white/10">
              <i class="fas fa-box mr-3"></i>
              <span>Alat</span>
            </a>
            <a href="/elektronik/public/pinjaman" class="flex items-center py-2 px-3 rounded-lg transition-colors duration-200 hover:bg-white/10">
              <i class="fas fa-handshake mr-3"></i>
              <span>Pinjam</span>
            </a>
          </nav>
        </div>

        <div class="mt-auto p-4">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center py-2 px-3 rounded-lg bg-red-600 hover:bg-red-700 transition-colors duration-200">
              <i class="fas fa-sign-out-alt mr-2"></i>
              <span>Logout</span>
            </button>
          </form>
        </div>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 lg:ml-0 p-4">
      <div class="max-w-7xl mx-auto">
        @yield('content')
      </div>
    </main>
  </div>

  <script>
    // Toggle Sidebar
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    
    sidebarToggle.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', (e) => {
      if (window.innerWidth < 1024) {
        if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
          sidebar.classList.add('-translate-x-full');
        }
      }
    });

    // Handle window resize
    window.addEventListener('resize', () => {
      if (window.innerWidth >= 1024) {
        sidebar.classList.remove('-translate-x-full');
      }
    });

    // Active link highlighting
    const currentPath = window.location.pathname;
    document.querySelectorAll('nav a').forEach(link => {
      if (link.getAttribute('href') === currentPath) {
        link.classList.add('bg-white/10');
      }
    });
  </script>
</body>
</html>
