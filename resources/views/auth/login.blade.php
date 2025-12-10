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

        .login-container {
            display: flex;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 900px;
            max-width: 95%;
        }

        .login-left {
            background: url('https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=900&q=80') center/cover no-repeat;
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

        .login-left::before {
            content: "";
            position: absolute;
            inset: 0;

            /* Added dark gradient overlay */
            background: linear-gradient(rgba(0, 0, 0, 0.7),
                    rgba(0, 0, 0, 0.6));
        }


        .login-left h2,
        .login-left p {
            position: relative;
            z-index: 1;
        }

        .login-left h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .login-left p {
            font-size: 1rem;
            opacity: 0.9;
        }

        .login-right {
            flex: 1;
            padding: 50px 40px;
        }

        .login-right h3 {
            font-weight: 700;
            color: #0a3d62;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            width: 100%;
        }

        .btn-login {
            background: #0a3d62;
            color: #fff;
            font-weight: 600;
            padding: 12px;
            border-radius: 10px;
            width: 100%;
            transition: all 0.3s ease;
            border: none;
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

        .btn-login:hover {
            background: #3c6382;
        }

        .forgot-link {
            font-size: 0.9rem;
            color: #3c6382;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                width: 95%;
            }

            .login-left {
                height: 200px;
                padding: 20px;
            }

            .login-right {
                padding: 30px 20px;
            }
        }
    </style>

    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <div class="login-container">
        <!-- Left Side (Banner / Image) -->
        <div class="login-left">
            <h2>Welcome Back!</h2>
            <p>Access your Data Science Learning Dashboard and continue your journey.</p>
        </div>

        <!-- Right Side (Form) -->
        <div class="login-right">
            <div class="text-center mb-4">
                <a href="{{ route('home') }}" style="display: inline-block;">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo"
                        style="height:80px; display:block; margin:0 auto;">
                </a>
                <h3 class="mt-2">Login to Your Account</h3>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <x-text-input id="email" class="form-control mt-1" type="email" name="email"
                        :value="old('email')" placeholder="Email Address" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password with Eye Icon -->
                <div class="mb-4 password-wrapper">
                    <x-text-input id="password" class="form-control mt-1" type="password"
                        name="password" placeholder="Password" required autocomplete="current-password" />
                    <i class="bi bi-eye toggle-password" id="togglePassword"></i>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember + Forgot -->
                <!-- <div class="flex items-center justify-between mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <span class="ml-2 text-base font-semibold text-gray-600">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                    <a class="text-base text-indigo-600 hover:underline"
                        href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                    @endif
                </div> -->

                <!-- Submit -->
                <button type="submit" class="btn btn-login">{{ __('Log in') }}</button>

                <!-- Register -->
                <!-- <p class="text-center text-base mt-4">
                    Don’t have an account?
                    <a href="{{ route('register') }}" class="text-blue-600 hover:underline">
                        <u>Register Now</u>
                    </a>
                </p> -->
            </form>
        </div>
    </div>

    <!-- JS for Eye Icon -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>

</x-guest-layout>