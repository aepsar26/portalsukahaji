<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard' }} - Admin Portal</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    window.successMessage = @json(session('success'));
    window.errorMessages = @json($errors->all());
</script>


</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <main class="main-content">

            <!-- Top Bar -->
            <div class="top-bar">
                <div class="user-info">
                    <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                    <div class="user-avatar" onclick="toggleUserMenu()">AD ▼</div>

                    <div id="user-menu" class="user-menu">
                        <a href="{{ route('admin.profile.edit') }}">Ubah Profil</a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="button" class="btn-logout" onclick="confirmLogout()">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Top Bar -->

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/admin.js') }}"></script>
    @stack('scripts')
</body>
</html>
