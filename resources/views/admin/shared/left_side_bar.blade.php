<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/dashboard') ? '' : 'collapsed' }}"
                href="{{ route('ShowDashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        {{-- MASTER REPORT --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/report*') ? '' : 'collapsed' }}" data-bs-target="#report-nav"
                data-bs-toggle="collapse" href="#">
                <i class="bx bxs-report"></i><span>Report</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>

            <ul id="report-nav" class="nav-content collapse {{ request()->is('admin/report*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('ConsoleIndexReport') }}"
                        class="{{ request()->is('admin/report*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Detail</span>
                    </a>
                </li>
            </ul>
        </li>
        {{-- END OF MASTER REPORT --}}


        {{-- MASTER PRODUCT --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/product*') ? '' : 'collapsed' }}" data-bs-target="#product-nav"
                data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Master Product</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>

            <ul id="product-nav" class="nav-content collapse {{ request()->is('admin/product*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('ConsoleShowListProduct') }}"
                        class="{{ request()->is('admin/product/list*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>List Product</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('ConsoleIndexListSukuBunga') }}"
                        class="{{ request()->is('admin/product/tarif_suku_bunga/list*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Tarif Suku Bunga</span>
                    </a>
                </li>

            </ul>
        </li>
        {{-- END OF MASTER PRODUCT --}}


        {{-- MASTER CURRENCY --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/currency*') ? '' : 'collapsed' }}"
                data-bs-target="#currency-nav" data-bs-toggle="collapse" href="#">
                <i class="bx bx-money"></i><span>Master Currency</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>

            <ul id="currency-nav" class="nav-content collapse {{ request()->is('admin/currency*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('ConsoleIndexCurrency') }}"
                        class="{{ request()->is('admin/currency/list*') || request()->is('admin/currency/create') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Kurs</span>
                    </a>
                </li>

            </ul>
        </li>
        {{-- END OF MASTER CURRENCY --}}

        {{-- MASTER PROPERTIES --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/properties*') ? '' : 'collapsed' }}"
                data-bs-target="#properties-nav" data-bs-toggle="collapse" href="#">
                <i class="bx bxs-box"></i><span>My Properties</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="properties-nav" class="nav-content collapse {{ request()->is('admin/properties*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('ConsoleIndexProperties') }}"
                        class="{{ request()->is('admin/properties/index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Settings</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('ConsoleIndexFooterText') }}"
                        class="{{ request()->is('admin/properties/footer_text*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Text Berjalan</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('ConsoleIndexFontColor') }}"
                        class="{{ request()->is('admin/properties/warna_text*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Warna Text</span>
                    </a>
                </li>
            </ul>
        </li>
        {{-- END OF MASTER PROPERTIES --}}
    </ul>
    </ul>
</aside>
<!-- End Sidebar-->
