<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/dashboard') ? '' : 'collapsed' }}"
                href="{{ route('ShowDashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

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


        {{-- MASTER PRODUCT --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/currency*') ? '' : 'collapsed' }}" data-bs-target="#currency-nav"
                data-bs-toggle="collapse" href="#">
                <i class="bx bx-money"></i><span>Master Currency</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>

            <ul id="currency-nav" class="nav-content collapse {{ request()->is('admin/currency*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('ConsoleIndexCurrency') }}"
                        class="{{ request()->is('admin/currency/list*') || request()->is('admin/currency/create') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Setting</span>
                    </a>
                </li>

            </ul>
        </li>
        {{-- END OF MASTER PRODUCT --}}

        {{-- MASTER PRODUCT --}}
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#properties-nav" data-bs-toggle="collapse" href="#">
                <i class="bx bxs-box"></i><span>My Properties</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="properties-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-circle"></i><span>Setting</span>
                    </a>
                </li>

            </ul>
        </li>
        {{-- END OF MASTER PRODUCT --}}
    </ul>
    </ul>
</aside>
<!-- End Sidebar-->