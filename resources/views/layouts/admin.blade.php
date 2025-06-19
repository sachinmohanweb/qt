<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('styles')
</head>
<body>
    <div class="admin-wrapper">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                 <img src="https://www.qot.co.in/wp-content/uploads/2025/01/LOGO-QOT-01-e1736444536786-300x217.png">
                </div>
                <div class="sidebar-logo">Admin Panel</div>
            </div>
            
            <nav class="sidebar-menu">
                <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('admin.users.index') }}" class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
                
                <a href="{{ route('admin.testimonials.index') }}" class="menu-item {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                    <i class="fas fa-star"></i>
                    <span>Testimonials</span>
                </a>
                
                <a href="{{ route('admin.blogs.index') }}" class="menu-item {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                    <i class="fas fa-blog"></i>
                    <span>Blogs</span>
                </a>
                
                <a href="{{ route('admin.service-types.index') }}" class="menu-item {{ request()->routeIs('admin.service-types.*') ? 'active' : '' }}">
                    <i class="fas fa-cogs"></i>
                    <span>Menu Items</span>
                </a>
                
                <a href="{{ route('admin.services.index') }}" class="menu-item {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                    <i class="fas fa-tools"></i>
                    <span>Projects</span>
                </a>
                
                <a href="{{ route('admin.service-galleries.index') }}" class="menu-item {{ request()->routeIs('admin.service-galleries.*') ? 'active' : '' }}">
                    <i class="fas fa-images"></i>
                    <span>Project Images</span>
                </a>
                <a href="{{ route('admin.video-items.index') }}" class="menu-item {{ request()->routeIs('admin.video-items.*') ? 'active' : '' }}">
                    <i class="fas fa-images"></i>
                    <span>Video Items</span>
                </a>
            </nav>
        </aside>
        
        <main class="content-wrapper">
            <div class="topbar">
                <button class="menu-toggle btn btn-sm btn-outline-secondary d-md-none">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="user-dropdown">
                    <div class="user-info">
                        <div class="user-avatar">
                            {{ auth()->user() ? substr(auth()->user()->name, 0, 1) : 'U' }}
                        </div>
                        <span>{{ auth()->user() ? auth()->user()->name : 'User' }}</span>
                        <i class="fas fa-chevron-down ms-2"></i>
                    </div>
                    
                    <div class="dropdown-menu">
                        <a href="{{ route('password.form') }}" class="dropdown-item">
                            <i class="fas fa-key"></i> Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                @yield('content')
            </div>
        </main>
    </div>
    
    <script src="{{ asset('assets/js/admin.js') }}"></script>
    <script>
        // Setup CSRF token for Ajax requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Toggle functionality for status and home visibility
        function toggleStatus(url, element) {
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Toggle the switch appearance
                    element.classList.toggle('active');
                    if (element.classList.contains('active')) {
                        element.style.backgroundColor = '#28a745';
                        element.querySelector('.toggle-slider').style.transform = 'translateX(20px)';
                    } else {
                        element.style.backgroundColor = '#dc3545';
                        element.querySelector('.toggle-slider').style.transform = 'translateX(0)';
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
    @stack('scripts')
</body>
</html>