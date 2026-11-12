@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">
        <!-- Page Header -->
        <div class="mb-6 bg-white rounded-lg shadow-md p-6" style="border-left: 4px solid #0F2B4D;">
            <h1 class="text-3xl font-bold heading-font" style="color: #2D3748;">
                <i class="fas fa-user-circle mr-2" style="color: #0F2B4D;"></i>Profile
            </h1>
            <p class="text-sm mt-1" style="color: #718096;">Manage your account information and preferences</p>
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

        <div class="bg-white rounded-lg shadow-lg overflow-hidden" style="border-top: 3px solid #0F2B4D;">
            <div class="p-8">
                <!-- Profile Header -->
                <div class="flex items-center space-x-6 mb-8 pb-6 border-b-2" style="border-color: #E2E8F0;">
                    <div class="h-24 w-24 rounded-full flex items-center justify-center shadow-lg" style="background: linear-gradient(135deg, #0F2B4D 0%, #1B4470 100%);">
                        <span class="text-4xl font-bold text-white">{{ substr($admin->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold heading-font" style="color: #2D3748;">{{ $admin->name }}</h2>
                        <p class="text-sm font-medium mt-1" style="color: #718096;">
                            <i class="fas fa-envelope mr-2" style="color: #0F2B4D;"></i>{{ $admin->email }}
                        </p>
                    </div>
                </div>

                <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block text-sm font-semibold mb-2" style="color: #4A5568;">
                            <i class="fas fa-user mr-1" style="color: #0F2B4D;"></i>Full Name
                        </label>
                        <input type="text" name="name" id="name" 
                               value="{{ old('name', $admin->name) }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-3 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold mb-2" style="color: #4A5568;">
                            <i class="fas fa-envelope mr-1" style="color: #0F2B4D;"></i>Email Address
                        </label>
                        <input type="email" name="email" id="email" 
                               value="{{ old('email', $admin->email) }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-3 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="btn-primary inline-flex items-center">
                            <i class="fas fa-save mr-2"></i>Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 