<nav class="navbar navbar-expand-lg navbar-custom px-3 py-2">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <!-- Search input and Toggle button SIDE-BY-SIDE -->
        <div class="d-flex align-items-center gap-3 w-100 justify-content-between">
            <!-- Search input -->
            <form class="d-flex position-relative nav-form my-2 my-lg-0">
                <span class="position-absolute top-50 translate-middle-y ms-3 text-white-50">
                    <img src="{{ asset('assets/admin/img/icons/Search.png') }}" alt="" />
                </span>
                <input style="width: 456px" class="form-control ps-5 search-input" type="search" placeholder="Search"
                    aria-label="Search" />
            </form>

            <!-- Toggle Button -->
            <button class="navbar-toggler text-white border-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#customNavbarContent" aria-controls="customNavbarContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon p-0"></span>
            </button>
        </div>
    </div>

    <!-- Collapsible Content -->
    <div class="collapse navbar-collapse justify-content-end" id="customNavbarContent">
        <div class="d-flex align-items-center gap-4 my-2 my-lg-0">
            <!-- Notification -->
            <button class="btn btn-link text-white position-relative p-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-bell" viewBox="0 0 16 16">
                    <path
                        d="M8 16a2 2 0 0 0 1.985-1.75H6.015A2 2 0 0 0 8 16zm.104-14.5a1.5 1.5 0 0 0-2.208.646A6.995 6.995 0 0 0 1 9c0 1.098-.243 1.95-.528 2.625-.167.4.126.875.595.875h13.866c.47 0 .762-.475.595-.875C14.243 10.95 14 10.098 14 9a6.995 6.995 0 0 0-4.896-6.354 1.5 1.5 0 0 0-.646-2.208z" />
                </svg>
                <span
                    class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                    <span class="visually-hidden">New alerts</span>
                </span>
            </button>

            <!-- Profile -->
            <div class="d-flex align-items-center text-white gap-2">
                <img src=" {{ asset('assets/admin/img/icons/Jake.png') }}" alt="Profile" class="profile-img" />
                <div class="d-none d-md-block">
                    <div class="fw-semibold d-flex align-items-center text-nowrap">Hammad Test</div>
                    <div class="small text-white" style="font-size: 8px; letter-spacing: 1">
                        hammad@example.com</div>
                </div>
            </div>

            <!-- Language Dropdown -->
            <div class="dropdown">
                <button style="width: 88px; height: 40px" class="btn btn-secondary dropdown-toggle bg-dark border-0"
                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    ENG
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">ENG</a></li>
                    <li><a class="dropdown-item" href="#">URDU</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
