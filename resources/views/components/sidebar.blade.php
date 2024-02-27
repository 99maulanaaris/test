<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item ">
        <a class="nav-link {{ request()->is('/') ? '' : 'collapsed' }}" href="{{ route('home') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ request()->is(['master','master/*']) ? '' : 'collapsed' }}" href="{{ route('master.index') }}">
          <i class="bi bi-database"></i>
          <span>Master Pengguna</span>
        </a>
      </li>

      <li class="nav-item">
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="nav-link collapsed" type="submit">
              <i class="bi bi-box-arrow-right"></i>
              <span>Logout</span>
            </button>
        </form>
      </li>

    </ul>

</aside>
