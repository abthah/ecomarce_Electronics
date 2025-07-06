<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Alat Pendakian</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(45deg, #1a1a1a, #2c3e50);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            transform: translateY(0);
            transition: all 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h1 {
            color: #fff;
            font-size: 2em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .login-header p {
            color: #ccc;
            font-size: 0.9em;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            color: #fff;
            margin-bottom: 8px;
            font-size: 0.9em;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 1em;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .remember-me input[type="checkbox"] {
            width: auto;
            margin-right: 10px;
        }

        .remember-me label {
            color: #ccc;
            font-size: 0.9em;
        }

        .forgot-password {
            text-align: right;
            margin-bottom: 20px;
        }

        .forgot-password a {
            color: #4a90e2;
            text-decoration: none;
            font-size: 0.9em;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #357abd;
        }

        .login-button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(45deg, #4a90e2, #357abd);
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 1em;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .login-button:hover {
            background: linear-gradient(45deg, #357abd, #2c6aa0);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 144, 226, 0.3);
        }

        .error-message {
            color: #ff6b6b;
            font-size: 0.9em;
            margin-top: 5px;
            display: none;
        }

        .success-message {
            color: #51cf66;
            font-size: 0.9em;
            margin-top: 5px;
            display: none;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .shake {
            animation: shake 0.5s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Selamat Datang</h1>
            <p>Silakan login untuk melanjutkan</p>
        </div>

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Masukkan email Anda">
                <div class="error-message" id="emailError"></div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="current-password" placeholder="Masukkan password Anda">
                <div class="error-message" id="passwordError"></div>
            </div>

            

           
            <button type="submit" class="login-button">
                Login
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');

            // Fungsi untuk menampilkan error dengan animasi
            function showError(element, message) {
                element.textContent = message;
                element.style.display = 'block';
                element.parentElement.classList.add('shake');
                setTimeout(() => {
                    element.parentElement.classList.remove('shake');
                }, 500);
            }

            // Validasi form
            form.addEventListener('submit', function(e) {
                let isValid = true;
                emailError.style.display = 'none';
                passwordError.style.display = 'none';

                // Validasi email
                if (!emailInput.value) {
                    showError(emailError, 'Email harus diisi');
                    isValid = false;
                } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value)) {
                    showError(emailError, 'Format email tidak valid');
                    isValid = false;
                }

                // Validasi password
                if (!passwordInput.value) {
                    showError(passwordError, 'Password harus diisi');
                    isValid = false;
                } else if (passwordInput.value.length < 6) {
                    showError(passwordError, 'Password minimal 6 karakter');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });

            // Efek hover pada input
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });

            // Animasi saat halaman dimuat
            const container = document.querySelector('.login-container');
            container.style.opacity = '0';
            container.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                container.style.transition = 'all 0.5s ease';
                container.style.opacity = '1';
                container.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</body>
</html>
