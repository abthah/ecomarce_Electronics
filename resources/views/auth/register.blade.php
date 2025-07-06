<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-900 to-purple-900 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white/10 backdrop-blur-lg p-8 rounded-2xl shadow-2xl transform hover:scale-[1.02] transition-all duration-300">
            <div class="text-center">
                <h2 class="mt-6 text-3xl font-extrabold text-white">
                    Buat Akun Baru
                </h2>
                <p class="mt-2 text-sm text-gray-300">
                    Bergabunglah dengan TechRental untuk menikmati layanan kami
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6" id="registerForm">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label for="name" class="text-white text-sm font-medium">Nama Lengkap</label>
                    <div class="mt-1 relative">
                        <input id="name" name="name" type="text" required 
                            class="appearance-none relative block w-full px-3 py-2 border border-indigo-600 bg-indigo-900/50 placeholder-gray-400 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300"
                            :value="old('name')" autocomplete="name" autofocus>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-indigo-400"></i>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="text-white text-sm font-medium">Email</label>
                    <div class="mt-1 relative">
                        <input id="email" name="email" type="email" required 
                            class="appearance-none relative block w-full px-3 py-2 border border-indigo-600 bg-indigo-900/50 placeholder-gray-400 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300"
                            :value="old('email')" autocomplete="username">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-indigo-400"></i>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="text-white text-sm font-medium">Password</label>
                    <div class="mt-1 relative">
                        <input id="password" name="password" type="password" required 
                            class="appearance-none relative block w-full px-3 py-2 border border-indigo-600 bg-indigo-900/50 placeholder-gray-400 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300"
                            autocomplete="new-password">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-eye text-indigo-400 cursor-pointer" id="togglePassword"></i>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="text-white text-sm font-medium">Konfirmasi Password</label>
                    <div class="mt-1 relative">
                        <input id="password_confirmation" name="password_confirmation" type="password" required 
                            class="appearance-none relative block w-full px-3 py-2 border border-indigo-600 bg-indigo-900/50 placeholder-gray-400 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300"
                            autocomplete="new-password">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-eye text-indigo-400 cursor-pointer" id="toggleConfirmPassword"></i>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('login') }}" 
                        class="text-sm text-indigo-400 hover:text-indigo-300 transition-colors duration-300">
                        Sudah punya akun?
                    </a>

                    <button type="submit" 
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 transform hover:scale-105">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-user-plus"></i>
                        </span>
                        Daftar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Password visibility toggle
        const togglePassword = document.getElementById('togglePassword');
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('password_confirmation');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // Form animation
        const form = document.getElementById('registerForm');
        const inputs = form.querySelectorAll('input');

        inputs.forEach(input => {
            // Add floating label effect
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('scale-105');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('scale-105');
            });

            // Add ripple effect on input
            input.addEventListener('mousedown', function(e) {
                const ripple = document.createElement('div');
                ripple.classList.add('ripple');
                this.appendChild(ripple);

                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                ripple.style.width = ripple.style.height = `${size}px`;

                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                ripple.style.left = `${x}px`;
                ripple.style.top = `${y}px`;

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add cursor trail effect
        const cursor = document.createElement('div');
        cursor.classList.add('cursor-trail');
        document.body.appendChild(cursor);

        document.addEventListener('mousemove', (e) => {
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';
        });

        // Add style for cursor trail
        const style = document.createElement('style');
        style.textContent = `
            .cursor-trail {
                width: 20px;
                height: 20px;
                background: radial-gradient(circle, rgba(99,102,241,0.5) 0%, rgba(99,102,241,0) 70%);
                border-radius: 50%;
                position: fixed;
                pointer-events: none;
                z-index: 9999;
                transform: translate(-50%, -50%);
                transition: width 0.3s, height 0.3s;
            }

            .ripple {
                position: absolute;
                border-radius: 50%;
                background: rgba(99,102,241,0.3);
                transform: scale(0);
                animation: ripple 0.6s linear;
                pointer-events: none;
            }

            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }

            input:focus {
                transform: translateY(-2px);
            }

            .form-group {
                position: relative;
                overflow: hidden;
            }

            .form-group::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 2px;
                background: linear-gradient(90deg, #6366F1, #8B5CF6);
                transform: scaleX(0);
                transition: transform 0.3s ease;
            }

            .form-group:focus-within::after {
                transform: scaleX(1);
            }
        `;
        document.head.appendChild(style);
    </script>
</x-guest-layout>
