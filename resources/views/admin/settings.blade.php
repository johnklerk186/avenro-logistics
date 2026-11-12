@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">
        <!-- Page Header -->
        <div class="mb-6 bg-white rounded-lg shadow-md p-6" style="border-left: 4px solid #0F2B4D;">
            <h1 class="text-3xl font-bold heading-font" style="color: #2D3748;">
                <i class="fas fa-cog mr-2" style="color: #0F2B4D;"></i>Settings
            </h1>
            <p class="text-sm mt-1" style="color: #718096;">Manage your account settings and site preferences</p>
        </div>

        @if(session('success'))
        <div class="border rounded-lg px-6 py-4 mb-6 shadow-sm" style="background-color: #D4EDDA; border-color: #38A169; color: #155724;">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3" style="color: #38A169;"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @if ($errors->any())
        <div class="border rounded-lg px-6 py-4 mb-6 shadow-sm" style="background-color: #FED7D7; border-color: #E53E3E; color: #742A2A;">
            <div class="flex items-start">
                <i class="fas fa-exclamation-circle mr-3 mt-1" style="color: #E53E3E;"></i>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li class="font-medium">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <!-- Branding Section -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6" style="border-top: 3px solid #0F2B4D;">
            <div class="p-8">
                <h2 class="text-xl font-bold heading-font mb-6 pb-3 border-b-2" style="color: #2D3748; border-color: #C6A15B;">
                    <i class="fas fa-palette mr-2" style="color: #0F2B4D;"></i>Branding Settings
                </h2>
                <form action="{{ route('admin.settings.branding') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="site_name" class="block text-sm font-semibold mb-2" style="color: #4A5568;"><i class="fas fa-building mr-1" style="color: #0F2B4D;"></i>Site Name</label>
                        <input type="text" name="site_name" id="site_name" 
                               value="{{ old('site_name', $settings->site_name) }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-3 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>

                    <div>
                        <label for="favicon" class="block text-sm font-semibold mb-2" style="color: #4A5568;"><i class="fas fa-icons mr-1" style="color: #0F2B4D;"></i>Favicon</label>
                        @if($settings->favicon)
                            <div class="mt-2 mb-2">
                                @php
                                    $favPath = ltrim($settings->favicon, '/');
                                    $favUrl = file_exists(public_path($favPath)) ? asset($favPath) : asset('storage/' . $favPath);
                                @endphp
                                <img src="{{ $favUrl }}" alt="Current Favicon" class="h-8">
                            </div>
                        @endif
                        <input type="file" name="favicon" id="favicon" accept="image/x-icon,image/png"
                               class="mt-1 block w-full text-sm"
                               style="color: #4A5568;"
                               onchange="this.style.color='#0F2B4D'">
                        <p class="mt-1 text-sm" style="color: #718096;">Recommended: 32x32 PNG or ICO file</p>
                    </div>

                   

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="currency_code" class="block text-sm font-semibold mb-2" style="color: #4A5568;"><i class="fas fa-coins mr-1" style="color: #0F2B4D;"></i>Currency Code</label>
                            <input type="text" name="currency_code" id="currency_code"
                                   value="{{ old('currency_code', $settings->currency_code) }}"
                                   class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-3 transition-all duration-150"
                                   style="border-color: #E2E8F0;"
                                   onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                                   onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'"
                                   placeholder="e.g. USD">
                        </div>
                        <div>
                            <label for="currency_symbol" class="block text-sm font-semibold mb-2" style="color: #4A5568;"><i class="fas fa-dollar-sign mr-1" style="color: #0F2B4D;"></i>Currency Symbol</label>
                            <input type="text" name="currency_symbol" id="currency_symbol"
                                   value="{{ old('currency_symbol', $settings->currency_symbol) }}"
                                   class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-3 transition-all duration-150"
                                   style="border-color: #E2E8F0;"
                                   onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                                   onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'"
                                   placeholder="e.g. $">
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="btn-primary inline-flex items-center">
                            <i class="fas fa-save mr-2"></i>Save Branding Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Password Change Section -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6" style="border-top: 3px solid #0F2B4D;">
            <div class="p-8">
                <h2 class="text-xl font-bold heading-font mb-6 pb-3 border-b-2" style="color: #2D3748; border-color: #C6A15B;">
                    <i class="fas fa-lock mr-2" style="color: #0F2B4D;"></i>Change Password
                </h2>
                <form action="{{ route('admin.settings.password') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="current_password" class="block text-sm font-semibold mb-2" style="color: #4A5568;"><i class="fas fa-key mr-1" style="color: #0F2B4D;"></i>Current Password</label>
                        <input type="password" name="current_password" id="current_password" 
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-3 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold mb-2" style="color: #4A5568;"><i class="fas fa-lock mr-1" style="color: #0F2B4D;"></i>New Password</label>
                        <input type="password" name="password" id="password" 
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-3 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold mb-2" style="color: #4A5568;"><i class="fas fa-lock mr-1" style="color: #0F2B4D;"></i>Confirm New Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-3 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="btn-primary inline-flex items-center">
                            <i class="fas fa-shield-alt mr-2"></i>Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

        
    </div>
</div>
@endsection 