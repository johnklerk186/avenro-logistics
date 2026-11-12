<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        .heading-font {
            font-family: 'Sora', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #F4F6F9 0%, #F1F4F9 100%);
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="max-w-md w-full">
            <!-- Logo/Brand Section -->
            <div class="text-center mb-8">
                <img src="{{ asset('images/logo.svg') }}" alt="Avenro Logistics" class="h-20 w-20 mb-4 rounded-2xl shadow-lg bg-white p-2">
                <h1 class="text-4xl font-bold heading-font" style="color: #2D3748;">Avenro Admin</h1>
                <p class="text-sm mt-2" style="color: #718096;">Avenro Logistics</p>
            </div>

            <!-- Login Card -->
            <div class="bg-white rounded-2xl shadow-2xl p-8" style="border-top: 4px solid #0F2B4D;">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold heading-font text-center" style="color: #2D3748;">
                        Welcome Back
                    </h2>
                    <p class="text-center text-sm mt-2" style="color: #718096;">Sign in to access your admin dashboard</p>
                </div>

                <form class="space-y-6" action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf
                    
                    <div>
                        <label for="email" class="block text-sm font-semibold mb-2" style="color: #4A5568;">
                            <i class="fas fa-envelope mr-2" style="color: #0F2B4D;"></i>Email Address
                        </label>
                        <input id="email" name="email" type="email" required autocomplete="email" autofocus
                            class="block w-full px-4 py-3 rounded-lg border-2 transition-all duration-150 @error('email') border-red-500 @enderror" 
                            style="border-color: #E2E8F0;"
                            placeholder="admin@example.com"
                            value="{{ old('email') }}"
                            onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                            onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold mb-2" style="color: #4A5568;">
                            <i class="fas fa-lock mr-2" style="color: #0F2B4D;"></i>Password
                        </label>
                        <input id="password" name="password" type="password" required autocomplete="current-password"
                            class="block w-full px-4 py-3 rounded-lg border-2 transition-all duration-150" 
                            style="border-color: #E2E8F0;"
                            placeholder="Enter your password"
                            onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                            onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>

                    @error('email')
                        <div class="rounded-lg px-4 py-3" style="background-color: #FED7D7; border: 1px solid #E53E3E; color: #742A2A;">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle mr-2" style="color: #E53E3E;"></i>
                                <span class="text-sm font-medium">{{ $message }}</span>
                            </div>
                        </div>
                    @enderror

                    <div class="pt-2">
                        <button type="submit" 
                                class="w-full py-4 px-6 rounded-lg font-bold text-lg transition-all duration-200 shadow-lg heading-font"
                                style="background-color: #0F2B4D; color: #FFFFFF;"
                                onmouseover="this.style.backgroundColor='#0A1F3D'; this.style.boxShadow='0 10px 25px rgba(15, 43, 77, 0.3)'"
                                onmouseout="this.style.backgroundColor='#0F2B4D'; this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                            <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                        </button>
                    </div>
                </form>

                <!-- Footer -->
                <div class="mt-6 text-center">
                    <p class="text-xs" style="color: #718096;">
                        <i class="fas fa-shield-alt mr-1" style="color: #0F2B4D;"></i>
                        Secure admin access only
                    </p>
                </div>
            </div>

            <!-- Copyright -->
            <div class="text-center mt-6">
                <p class="text-sm" style="color: #718096;">
                    © {{ date('Y') }} Avenro Logistics. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
