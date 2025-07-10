<header class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container-fluid">
            <button class="btn btn-link d-md-none" type="button" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>

            <a class="navbar-brand d-none d-md-block" href="index.html">Admin Panel</a>

            <form class="d-flex ms-auto me-3 search-bar" style="width: 300px;">
                <input class="form-control" type="search" placeholder="Search here..." aria-label="Search">
                <button class="btn" type="submit"><i class="bi bi-search"></i></button>
            </form>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ Auth::user()->avatarUrl() }}" alt="User" class="rounded-circle" width="30" height="30">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownUser">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person-circle me-2"></i>Profil</a></li>
                        <li><a class="dropdown-item" href="settings.html"><i class="bi bi-gear-fill me-2"></i>Paramètres</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>Déconnexion</button>
                        </form>
                    </ul>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-bell-fill"></i>
                        <span class="badge rounded-pill bg-danger">3+</span>
                    </a>
                </li>
            </ul>
        </div>
    </header>