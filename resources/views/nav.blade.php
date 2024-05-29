<ul class="navbar-nav" id="navbar-nav">
    <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Master Data</span>
    </li>

    <li class="nav-item">
        <a class="nav-link menu-link" href="#sidebarMasterData" data-bs-toggle="collapse" role="button"
            aria-expanded="false" aria-controls="sidebarMasterData">
            <i class="ri-pages-line"></i> <span data-key="t-pages">Master Data</span>
        </a>
        <div class="collapse menu-dropdown" id="sidebarMasterData">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a href="{{ route('pegawai.index') }}" class="nav-link" data-key="t-pegawai">
                        Pegawai
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('department.index') }}" class="nav-link" data-key="t-department">
                        department
                    </a>
                </li>
            </ul>
        </div>
    </li>


</ul>
