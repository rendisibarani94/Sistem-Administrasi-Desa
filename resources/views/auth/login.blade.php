<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        body {
            background-image: url({{ asset('images/masyarakat/beranda.png') }});
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
        }
        .login-card {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.92);
            border-radius: 0.75rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .btn-login {
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex justify-center items-center p-4">
        <div class="login-card w-full max-w-md mx-4 p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Administrasi Desa</h1>
                <p class="text-gray-600 mt-2">Masuk ke sistem administrasi</p>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                    <div class="font-medium">{{ $errors->first() }}</div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Input -->
                <div class="mb-5">
                    <label class="block text-gray-700 font-medium mb-2" for="email">
                        Alamat Email
                    </label>
                    <input
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        id="email"
                        name="email"
                        type="email"
                        required
                        autofocus
                        placeholder="email@example.com"
                        value="{{ old('email') }}"
                    >
                </div>

                <!-- Password Input -->
                <div class="mb-5">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-gray-700 font-medium" for="password">
                            Kata Sandi
                        </label>
                    </div>
                    <input
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        id="password"
                        name="password"
                        type="password"
                        required
                        placeholder="••••••••"
                    >
                </div>


                <!-- Submit Button -->
                <div class="mb-6">
                    <button
                        class="btn-login w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-md"
                        type="submit"
                    >
                        Masuk
                    </button>
                </div>

            </form>
        </div>
    </div>
</body>
</html>
