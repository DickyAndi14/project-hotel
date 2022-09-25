<!-- Sidebar -->
<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a>GRATHAEL</a>
  </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Menu</li>
      @if(auth()->user()->role == 'admin')
          <li class="nav-item">
            <a href="{{ route('kamar.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
                Kamar
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('fasilitas.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
                Fasilitas Hotel
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('fasilitas-kamar.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
                Fasilitas kamar
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('tipe-kamar.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
                Tipe kamar
            </a>
          </li>
        @else
          <li class="nav-item">
            <a href="{{ route('buku.tamu.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
                Resepsionis
            </a>
          </li>
        @endif
    </ul>
    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
      {!! Form::open(['route' => 'logout', 'method' => 'post']) !!}
          <button class="btn btn-danger btn-lg btn-block" id="logout"><i class="fa fa-arrow-rotate-back mr-2"></i><b>Keluar</b></button>
      {!! Form::close() !!}
    </div>
</aside>