<div class="sidebar" data-color="green" data-background-color="white" data-image="{{ asset('/assets/img/sidebar-1.jpg') }}">
    <div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-normal">
        ADMIN
    </a></div>
    <div class="sidebar-wrapper">
    <ul class="nav">
        <li class="nav-item {{ $sidebar=='dashboard' ? 'active':'' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="material-icons">dashboard</i>
            <p>Dashboard</p>
        </a>
        </li>
        <li class="nav-item {{ $sidebar=='produksi' ? 'active':'' }}">
        <a class="nav-link" href="{{ route('produksi') }}">
            <i class="material-icons">donut_small</i>
            <p>Produksi</p>
        </a>
        </li>
        <li class="nav-item {{ $sidebar=='payments' ? 'active':'' }}">
        <a class="nav-link" href="{{route('payments')}}">
            <i class="material-icons">payments</i>
            <p>Pembayaran</p>
        </a>
        </li>
        <li class="nav-item ">
        <a class="nav-link" href="./typography.html">
            <i class="material-icons">table_view</i>
            <p>Piutang</p>
        </a>
        </li>
    </ul>
    </div>
</div>