<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h2>Sukahaji Admin</h2>
        <p>Sistem Manajemen Kelurahan</p>
    </div>
    <nav class="nav-menu">
        <div class="nav-item">
            <a href="{{ route('admin.dashboard') }}" 
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i>📊</i>
                Dashboard
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.statistics.index') }}" 
               class="nav-link {{ request()->routeIs('admin.statistics.*') ? 'active' : '' }}">
                <i>📈</i>
                Statistik
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.budgets.index') }}" 
               class="nav-link {{ request()->routeIs('admin.budgets.*') ? 'active' : '' }}">
                <i>💰</i>
                Anggaran
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.profils.index') }}" 
               class="nav-link {{ request()->routeIs('admin.profils.*') ? 'active' : '' }}">
                <i>🏛️</i>
                Profil Kelurahan
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.pemerintahans.index') }}" 
               class="nav-link {{ request()->routeIs('admin.pemerintahans.*') ? 'active' : '' }}">
                <i>👥</i>
                Pemerintahan
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.layanans.index') }}" 
               class="nav-link {{ request()->routeIs('admin.layanans.*') ? 'active' : '' }}">
                <i>🛎️</i>
                Layanan
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.transparansis.index') }}" 
               class="nav-link {{ request()->routeIs('admin.transparansis.*') ? 'active' : '' }}">
                <i>💎</i>
                Transparansi
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.beritas.index') }}" 
               class="nav-link {{ request()->routeIs('admin.beritas.*') ? 'active' : '' }}">
                <i>📰</i>
                Berita
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.potensis.index') }}" 
               class="nav-link {{ request()->routeIs('admin.potensis.*') ? 'active' : '' }}">
                <i>🌟</i>
                Potensi Kelurahan
            </a>
        </div>
    </nav>
</aside>