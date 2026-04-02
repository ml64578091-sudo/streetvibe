<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="text-nowrap logo-img">
                <img src="{{ asset('backend/images/logos/dark-logo.svg') }}" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>

        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('home') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">MANAGEMENT</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.brands.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-tag"></i>
                        </span>
                        <span class="hide-menu">Brand</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.categories.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-category"></i>
                        </span>
                        <span class="hide-menu">Kategori</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.products.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-package"></i>
                        </span>
                        <span class="hide-menu">Produk</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.outfit.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-shirt"></i>
                        </span>
                        <span class="hide-menu">Referensi Outfit</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">OTHERS</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('welcome') }}" target="_blank" aria-expanded="false">
                        <span>
                            <i class="ti ti-world"></i>
                        </span>
                        <span class="hide-menu">Lihat Website</span>
                    </a>
                </li>
                <li class="sidebar-item">
    <a class="sidebar-link" href="{{ route('admin.gallery.index') }}">
        <span><i class="ti ti-photo"></i></span>
        <span class="hide-menu">Gallery</span>
    </a>
</li>
            </ul>
        </nav>
        </div>
    </aside>
