<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('overview') }}">
            <img src="{{ asset('img/logo2.png') }}" width="200" alt="">
            {{-- <span class="align-middle">Arfa Farma</span> --}}
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Utama
            </li>

            <li class="sidebar-item @if($id_page == 1) active @endif">
                <a class="sidebar-link" href="{{ route('overview') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Halaman Utama</span>
                </a>
            </li>


            @if (auth()->user()->role == "pemilik")
                
            <li class="sidebar-header">
                Pengguna
            </li>

            <li class="sidebar-item @if($id_page == 8) active @endif">
                <a class="sidebar-link" href="{{ route('users-management') }}">
                    <i class="align-middle" data-feather="users"></i> 
                    <span class="align-middle">Kelola Pengguna</span>
                </a>
            </li>
           
            @endif

            <li class="sidebar-header">
                Pembelian & Penjualan
            </li>
            
            @if (auth()->user()->role != 'pemilik')
            <li class="sidebar-item @if($id_page == 10) active @endif">
                <a class="sidebar-link" href="{{ route('sales-management') }}">
                    <i class="align-middle" data-feather="dollar-sign"></i> 
                    <span class="align-middle">Penjualan</span>
                </a>
            </li>

            <li class="sidebar-item @if($id_page == 9) active @endif">
                <a class="sidebar-link" href="{{ route('purchase-management') }}">
                    <i class="align-middle" data-feather="grid"></i> 
                    <span class="align-middle">Pembelian</span>
                </a>
            </li>

            <li class="sidebar-item @if($id_page == 15) active @endif">
                <a class="sidebar-link" href="{{ route('data-faktur') }}">
                    <i class="align-middle" data-feather="file"></i> 
                    <span class="align-middle">Data Barang Masuk</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->role != 'admin')
            <li class="sidebar-item @if($id_page == 14) active @endif">
                <a class="sidebar-link" href="{{ route('purchase-agreement') }}">
                    <i class="align-middle" data-feather="check-circle"></i> 
                    <span class="align-middle">Persetujuan Surat</span>
                </a>    
            </li>
            @endif

            @if (auth()->user()->role != 'pemilik')
                

            <li class="sidebar-header">
                Master Data
            </li>
            <li class="sidebar-item @if($id_page == 2) active @endif">
                <a class="sidebar-link" href="{{ route('barang') }}">
                    <i class="align-middle" data-feather="package"></i> 
                    <span class="align-middle">Data Barang</span>
                </a>
            </li>
            
            <li class="sidebar-item @if($id_page == 3) active @endif">
                <a class="sidebar-link" href="{{ route('supplier') }}">
                    <i class="align-middle" data-feather="truck"></i> 
                    <span class="align-middle">Data Supplier</span>
                </a>
            </li>
            
            <li class="sidebar-item @if($id_page == 4) active @endif">
                <a class="sidebar-link" href="{{ route('kategori') }}">
                    <i class="align-middle" data-feather="clipboard"></i> 
                    <span class="align-middle">Data Kategori</span>
                </a>
            </li>

            <li class="sidebar-item @if($id_page == 5) active @endif">
                <a class="sidebar-link" href="{{ route('bentuk') }}">
                    <i class="align-middle" data-feather="triangle"></i> 
                    <span class="align-middle">Data Bentuk Sediaan</span>
                </a>
            </li>

            <li class="sidebar-item @if($id_page == 6) active @endif">
                <a class="sidebar-link" href="{{ route('satuan') }}">
                    <i class="align-middle" data-feather="disc"></i> 
                    <span class="align-middle">Data Satuan</span>
                </a>
            </li>

            <li class="sidebar-item @if($id_page == 7) active @endif">
                <a class="sidebar-link" href="{{ route('golongan') }}">
                    <i class="align-middle" data-feather="bar-chart-2"></i> 
                    <span class="align-middle">Data Golongan</span>
                </a>
            </li>
            @endif


            <li class="sidebar-header">
                Laporan
            </li>
            
            <li class="sidebar-item @if($id_page == 12) active @endif">
                <a class="sidebar-link" href="{{ route('sales-report') }}">
                    <i class="align-middle" data-feather="file-minus"></i> 
                    <span class="align-middle">Laporan Penjualan</span>
                </a>
            </li>

            <li class="sidebar-item @if($id_page == 11) active @endif">
                <a class="sidebar-link" href="{{ route('purchase-report') }}">
                    <i class="align-middle" data-feather="file-plus"></i> 
                    <span class="align-middle">Laporan Pembelian</span>
                </a>
            </li>


            <li class="sidebar-item @if($id_page == 13) active @endif">
                <a class="sidebar-link" href="{{ route('stock-report') }}">
                    <i class="align-middle" data-feather="box"></i> 
                    <span class="align-middle">Laporan Persediaan</span>
                </a>
            </li>

        </ul>
    </div>
</nav>