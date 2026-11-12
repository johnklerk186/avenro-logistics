<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - Avenro Logistics</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Google Fonts - Logistics Theme -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
    <!-- Use multiple CDN sources for better reliability -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        // Fallback if the first CDN fails
        if (typeof jQuery === 'undefined') {
            document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"><\/script>');
        }
    </script>
    <style>
        /* Logistics Orange Theme Variables */
        :root {
            --primary-bg: #FFFFFF;
            --secondary-bg: #F4F6F9;
            --accent-bg: #F1F4F9;
            --primary-orange: #0F2B4D;
            --secondary-orange: #1B4470;
            --light-orange: #C6A15B;
            --dark-orange: #0A1F3D;
            --text-primary: #2D3748;
            --text-secondary: #4A5568;
            --text-light: #718096;
            --success-green: #38A169;
            --warning-yellow: #C6A15B;
            --border-color: #E2E8F0;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body { 
            color: var(--text-primary);
            background-color: var(--secondary-bg);
        }

        h1, h2, h3, h4, h5, h6, .heading-font {
            font-family: 'Sora', sans-serif;
        }

        .btn-primary {
            background-color: var(--primary-orange);
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 700;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(15, 43, 77, 0.2);
        }
        .btn-primary:hover { 
            background-color: var(--dark-orange);
            box-shadow: 0 4px 12px rgba(15, 43, 77, 0.3);
        }

        .btn-secondary {
            background-color: #FFFFFF;
            color: var(--primary-orange);
            border: 2px solid var(--primary-orange);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .btn-secondary:hover { 
            background-color: var(--accent-bg);
        }

        .btn-danger {
            background-color: #E53E3E;
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 700;
            transition: all 0.2s ease;
        }
        .btn-danger:hover { background-color: #C53030; }

        .input-field {
            background-color: var(--primary-bg);
            color: var(--text-primary);
            border: 2px solid var(--border-color);
            padding: 0.75rem;
            border-radius: 8px;
            transition: all 0.15s ease;
        }
        .input-field:focus {
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 3px rgba(15, 43, 77, 0.1);
            outline: none;
        }

        .admin-card {
            background-color: var(--primary-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .admin-link { 
            color: var(--primary-orange);
            transition: color 0.15s ease;
        }
        .admin-link:hover { color: var(--dark-orange); }

        /* Sidebar Active State */
        .sidebar-active {
            background: linear-gradient(90deg, var(--accent-bg) 0%, var(--secondary-bg) 100%);
            border-left: 4px solid var(--primary-orange);
            color: var(--primary-orange);
            font-weight: 600;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full z-10" style="border-bottom: 3px solid #0F2B4D;">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <button id="mobile-menu-button" class="md:hidden inline-flex items-center justify-center p-2 rounded-md transition-colors duration-150" style="color: #4A5568;" onmouseover="this.style.color='#0F2B4D'; this.style.backgroundColor='#F1F4F9'" onmouseout="this.style.color='#4A5568'; this.style.backgroundColor='transparent'">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                    <div class="flex-shrink-0 flex items-center ml-2 md:ml-0">
                        <img src="{{ asset('images/logo.svg') }}" alt="Avenro Logistics" class="h-9 w-9 rounded-lg">
                        <span class="text-2xl font-bold heading-font" style="color: #0F2B4D;">Avenro <span style="color:#C6A15B;">Logistics</span> <span class="text-sm font-semibold" style="color:#718096;">Admin</span></span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-semibold hidden md:inline" style="color: #4A5568;">
                        <i class="fas fa-user-circle mr-1" style="color: #0F2B4D;"></i>
                        Welcome, {{ Auth::guard('admin')->user()->name }}
                    </span>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg font-semibold transition-all duration-150" style="color: #4A5568; border: 2px solid transparent;" onmouseover="this.style.color='#0F2B4D'; this.style.borderColor='#0F2B4D'; this.style.backgroundColor='#F1F4F9'" onmouseout="this.style.color='#4A5568'; this.style.borderColor='transparent'; this.style.backgroundColor='transparent'">
                            <i class="fas fa-sign-out-alt mr-2"></i><span class="hidden md:inline">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex h-screen pt-16">
        <!-- Mobile Sidebar Overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black opacity-50 z-20 hidden md:hidden"></div>

        <!-- Sidebar -->
        <div id="sidebar" class="w-64 bg-white shadow-xl fixed h-full z-30 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out" style="border-right: 2px solid #E2E8F0;">
            <div class="py-6 px-2">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center px-4 py-3 rounded-lg font-semibold transition-all duration-150 {{ request()->routeIs('admin.dashboard') ? 'sidebar-active' : '' }}"
                           style="color: {{ request()->routeIs('admin.dashboard') ? '#0F2B4D' : '#4A5568' }};"
                           onmouseover="if(!this.classList.contains('sidebar-active')) { this.style.backgroundColor='#F1F4F9'; this.style.color='#0F2B4D'; }"
                           onmouseout="if(!this.classList.contains('sidebar-active')) { this.style.backgroundColor='transparent'; this.style.color='#4A5568'; }">
                            <i class="fas fa-tachometer-alt w-5 mr-3"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.shipments.index') }}" 
                           class="flex items-center px-4 py-3 rounded-lg font-semibold transition-all duration-150 {{ request()->routeIs('admin.shipments.*') ? 'sidebar-active' : '' }}"
                           style="color: {{ request()->routeIs('admin.shipments.*') ? '#0F2B4D' : '#4A5568' }};"
                           onmouseover="if(!this.classList.contains('sidebar-active')) { this.style.backgroundColor='#F1F4F9'; this.style.color='#0F2B4D'; }"
                           onmouseout="if(!this.classList.contains('sidebar-active')) { this.style.backgroundColor='transparent'; this.style.color='#4A5568'; }">
                            <i class="fas fa-box-open w-5 mr-3"></i>
                            <span>Shipments</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.shipments.create') }}" 
                           class="flex items-center px-4 py-3 rounded-lg font-semibold transition-all duration-150 {{ request()->routeIs('admin.shipments.create') ? 'sidebar-active' : '' }}"
                           style="color: {{ request()->routeIs('admin.shipments.create') ? '#0F2B4D' : '#4A5568' }};"
                           onmouseover="if(!this.classList.contains('sidebar-active')) { this.style.backgroundColor='#F1F4F9'; this.style.color='#0F2B4D'; }"
                           onmouseout="if(!this.classList.contains('sidebar-active')) { this.style.backgroundColor='transparent'; this.style.color='#4A5568'; }">
                            <i class="fas fa-plus-circle w-5 mr-3"></i>
                            <span>New Shipment</span>
                        </a>
                    </li>
                    
                    
                   
                    <!-- Settings Section -->
                    <li class="px-4 pt-6 pb-2">
                        <div class="flex items-center">
                            <div class="flex-1 border-t" style="border-color: #C6A15B;"></div>
                            <span class="px-3 text-xs font-bold uppercase tracking-wider" style="color: #0F2B4D;">Settings</span>
                            <div class="flex-1 border-t" style="border-color: #C6A15B;"></div>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('admin.profile') }}" 
                           class="flex items-center px-4 py-3 rounded-lg font-semibold transition-all duration-150 {{ request()->routeIs('admin.profile') ? 'sidebar-active' : '' }}"
                           style="color: {{ request()->routeIs('admin.profile') ? '#0F2B4D' : '#4A5568' }};"
                           onmouseover="if(!this.classList.contains('sidebar-active')) { this.style.backgroundColor='#F1F4F9'; this.style.color='#0F2B4D'; }"
                           onmouseout="if(!this.classList.contains('sidebar-active')) { this.style.backgroundColor='transparent'; this.style.color='#4A5568'; }">
                            <i class="fas fa-user-cog w-5 mr-3"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.settings') }}" 
                           class="flex items-center px-4 py-3 rounded-lg font-semibold transition-all duration-150 {{ request()->routeIs('admin.settings') ? 'sidebar-active' : '' }}"
                           style="color: {{ request()->routeIs('admin.settings') ? '#0F2B4D' : '#4A5568' }};"
                           onmouseover="if(!this.classList.contains('sidebar-active')) { this.style.backgroundColor='#F1F4F9'; this.style.color='#0F2B4D'; }"
                           onmouseout="if(!this.classList.contains('sidebar-active')) { this.style.backgroundColor='transparent'; this.style.color='#4A5568'; }">
                            <i class="fas fa-cog w-5 mr-3"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 md:ml-64">
            <main class="p-4 md:p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Set up CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
        }

        mobileMenuButton.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);

        // Close sidebar when clicking a link (mobile)
        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) { // md breakpoint
                    toggleSidebar();
                }
            });
        });

        // Add active class to current menu item on load
        const currentPath = window.location.pathname;
        const menuItems = document.querySelectorAll('#sidebar a');
        menuItems.forEach(item => {
            if (item.getAttribute('href') === currentPath) {
                item.classList.add('sidebar-active');
                item.style.color = '#0F2B4D';
            }
            // Click feedback: highlight immediately and remove from others
            item.addEventListener('click', () => {
                menuItems.forEach(i => {
                    i.classList.remove('sidebar-active');
                    if (!i.classList.contains('sidebar-active')) {
                        i.style.color = '#4A5568';
                    }
                });
                item.classList.add('sidebar-active');
                item.style.color = '#0F2B4D';
            });
        });
    </script>

    @yield('scripts')
</body>
</html> 
