<x-guest-layout>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0a3d62, #3c6382);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-container {
            display: flex;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 950px;
            max-width: 95%;
        }

        .register-left {
            background: url('https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=900&q=80') center/cover no-repeat;
            position: relative;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
            padding: 30px;
            flex-direction: column;
        }

        .register-left::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.6));
        }

        .register-left h2,
        .register-left p {
            position: relative;
            z-index: 1;
        }

        .register-left h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .register-left p {
            font-size: 1rem;
            opacity: 0.9;
        }

        .register-right {
            flex: 1;
            padding: 50px 40px;
        }

        .register-right h3 {
            font-weight: 700;
            color: #0a3d62;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            width: 100%;
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(0%);
            cursor: pointer;
            color: #6b7280;
        }

        .btn-register {
            background: #0a3d62;
            color: #fff;
            font-weight: 600;
            padding: 12px;
            border-radius: 10px;
            width: 100%;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-register:hover {
            background: #3c6382;
        }

        .login-link {
            font-size: 0.95rem;
            color: #3c6382;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .register-container {
                flex-direction: column;
                width: 95%;
            }

            .register-left {
                height: 200px;
                padding: 20px;
            }

            .register-right {
                padding: 30px 20px;
            }
        }
    </style>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <div class="register-container">
        <!-- Left Side -->
        <div class="register-left">
            <h2 class="mb-4">Join Our Learning Community</h2>
            <p class="mb-4">Start your journey to mastering Data Science, AI, and more with expert-led courses.</p>
        </div>

        <!-- Right Side -->
        <div class="register-right">
            <div class="text-center mb-4">
                 <a href="{{ route('home') }}" style="display: inline-block;">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo"
                        style="height:80px; display:block; margin:0 auto;">
                </a>
                <h3 class="mt-2">Create Your Account</h3>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <x-text-input id="name" class="form-control mt-1" type="text" name="name" :value="old('name')" placeholder="Full Name" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <x-text-input id="email" class="form-control mt-1" type="email" name="email" :value="old('email')" placeholder="Email Address" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                 <div class="mb-4">
                        <select id="role" name="role" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">-- Select Role --</option>
                            <option value="student">Student</option>
                            <option value="trainer">Trainer</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                <!-- Password -->
                <div class="mb-4 password-wrapper">
                    <x-text-input id="password" class="form-control mt-1" type="password" name="password" placeholder="Password" required autocomplete="new-password" />
                    <i class="bi bi-eye toggle-password" id="togglePassword"></i>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-4 password-wrapper">
                    <x-text-input id="password_confirmation" class="form-control mt-1" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />
                    <i class="bi bi-eye toggle-password" id="toggleConfirmPassword"></i>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-register">{{ __('Register') }}</button>

                <!-- Login Link -->
                <p class="text-center text-base mt-4">
                    Already registered?
                    <a href="{{ route('login') }}" class="login-link"><u>Login Now</u></a>
                </p>
            </form>
        </div>
    </div>

    <!-- Password Toggle JS -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
        const confirmPassword = document.querySelector('#password_confirmation');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });

        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>
</x-guest-layout>