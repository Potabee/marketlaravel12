<nav class="navbar navbar-expand bg-white border-bottom shadow-sm">
    <div class="container-fluid">
        <!-- Hamburger Button (Hanya tampil di mobile) -->
        <button class="btn btn-light d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu"
            aria-controls="sidebarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Spacer untuk mendorong dropdown ke kanan -->
        <div class="flex-grow-1"></div>

        <!-- Settings Dropdown -->
        <div class="dropdown">
            <button class="btn btn-link text-dark text-decoration-none d-flex align-items-center" type="button"
                id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="text-end me-2">
                    <div class="fw-medium">{{ Auth::user()->name }}</div>
                </div>
                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
