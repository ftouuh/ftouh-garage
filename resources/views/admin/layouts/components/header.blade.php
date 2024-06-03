<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <div class="navbar-brand-box" style="display:flex; justify-content:center; align-items:center;">
                <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logoheader.png" alt="logo-sm" height="22">
                    </span>
                    <span class="logo-lg"></span>
                </a>
                <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
                    <h1 style="color:white; font-weight:600; font-size:23px; margin:0;">GARAGE FTOUH</h1>
                </a>
            </div>
        </div>
        <div class="d-flex">
            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-search-line"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                    <form class="p-3">
                        <div class="mb-3 m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{ Auth::user()->name }}
            </div>
            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(app()->getLocale() == 'ar')
                        <img src="https://wallpapercave.com/wp/wp4034240.jpg" alt="Arabic" width="30" height="30" style="border-radius:50%;">
                    @elseif(app()->getLocale() == 'es')
                        <img src="assets/images/flags/spain.jpg" alt="Spanish" width="30" height="30" style="border-radius:50%;">
                    @elseif(app()->getLocale() == 'fr')
                        <img src="assets/images/flags/french.jpg" alt="French" width="30" height="30" style="border-radius:50%;">
                    @else
                        <img src="assets/images/flags/us.jpg" alt="English" width="30" height="30" style="border-radius:50%;">
                    @endif
                </button>
                <select class="dropdown-menu dropdown-menu-end selectLocale">
                    <option @if(app()->getLocale() == 'ar') selected @endif value="ar">
                        <img src="assets/images/flags/ar.jpg" alt="Arabic" class="me-1" height="12">
                        <span class="align-middle">ar</span>
                    </option>
                    <option @if(app()->getLocale() == 'es') selected @endif value="es">
                        <img src="assets/images/flags/spain.jpg" alt="Spanish" class="me-1" height="12">
                        <span class="align-middle">es</span>
                    </option>
                    <option @if(app()->getLocale() == 'en') selected @endif value="en">
                        <img src="assets/images/flags/us.jpg" alt="English" class="me-1" height="12">
                        <span class="align-middle">en</span>
                    </option>
                    <option @if(app()->getLocale() == 'fr') selected @endif value="fr">
                        <img src="assets/images/flags/french.jpg" alt="French" class="me-1" height="12">
                        <span class="align-middle">fr</span>
                    </option>
                </select>
            </div>
            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="https://i.pinimg.com/originals/06/3b/bf/063bbf0665eaf9c1730bccdc5c8af1b2.jpg" alt="Default Avatar" class="rounded-circle header-profile-user" id="avatar-image">
                    <span class="d-none d-xl-inline-block ms-1">{{ Auth::user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <div class="dropdown-divider"></div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
