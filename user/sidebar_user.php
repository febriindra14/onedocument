<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon mx-2">
            <i class="fas fa-book"></i>
            <!--<img src="../img/unuyo.png" alt=" " class="logo-login"> -->
        </div>
        <div class="sidebar-brand-text mx-0 ">One document</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php if ($page == "homeq") echo "active"; ?>">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php if ($page == "userq") echo "active"; ?>">
        <a class="nav-link collapsed" href="profil.php" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-address-card"></i>
            <span>Profil</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php if ($page == "penelitianq") echo "active"; ?>">
        <a class="nav-link collapsed" href="penelitian.php" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-hands-helping"></i>
            <span>Penelitian</span>
        </a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item <?php if ($page == "pengabdianq") echo "active"; ?>">
        <a class="nav-link" href="pengabdian.php">
            <i class="fas fa-fw fa-people-carry"></i>
            <span>Pengabdian</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item <?php if ($page == "publikasiq") echo "active"; ?>">
        <a class="nav-link" href="publikasi.php">
            <i class="fas fa-fw fa-book-open"></i>
            <span>Publikasi</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->