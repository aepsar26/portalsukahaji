<nav>
    <div class="container">
        <div class="nav-container">
            <ul class="nav-menu">
                <li><a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda') ? 'active' : '' }}">Beranda</a></li>
                <li><a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'active' : '' }}">Profil</a></li>
                <li><a href="{{ route('pemerintahan') }}" class="{{ request()->routeIs('pemerintahan') ? 'active' : '' }}">Pemerintahan</a></li>
                <li><a href="{{ route('pelayanan') }}" class="{{ request()->routeIs('pelayanan') ? 'active' : '' }}">Pelayanan</a></li>
                <li><a href="{{ route('transparansi') }}" class="{{ request()->routeIs('transparansi') ? 'active' : '' }}">Transparansi</a></li>
                <li><a href="{{ route('berita') }}" class="{{ request()->routeIs('berita') ? 'active' : '' }}">Berita</a></li>
                <li><a href="{{ route('potensi') }}" class="{{ request()->routeIs('potensi') ? 'active' : '' }}">Potensi</a></li>
            </ul>
        </div>
    </div>
</nav>
