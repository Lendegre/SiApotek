<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('overview') }}">
            <img src="{{ asset('img/logo.png') }}" width="50" alt="">
            <span class="align-middle">Arfa Farma</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Analytics
            </li>

            <li class="sidebar-item @if($id_page == 1) active @endif">
                <a class="sidebar-link" href="{{ route('overview') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Overview</span>
                </a>
            </li>

            <li class="sidebar-header">
                Plugins & Addons
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="charts-chartjs.html">
                    <i class="align-middle" data-feather="bar-chart-2"></i> <span
                        class="align-middle">Charts</span>
                </a>
            </li>
        </ul>
    </div>
</nav>