<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard'); ?>">
				<div class="sidebar-brand-icon ">
					<i class="fas fa-fw fa-toolbox "></i>
				</div>
				<div class="sidebar-brand-text mx-2 mt-1">Mini Assets</div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Dashboard -->
			<li class="nav-item <?php if ($this->uri->segment(1) == 'dashboard') {
									echo "active";
								} ?>">
				<a class="nav-link" href="<?= base_url('dashboard'); ?>">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span></a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">
			<!-- Heading -->
			<div class="sidebar-heading mt-2">
				Admin
			</div>
			<!-- Nav Item - Pages Collapse Menu -->
			<li class="nav-item <?php if ($this->uri->segment(1) == 'dataBarang') {
									echo "active";
								} ?> <?php if ($this->uri->segment(1) == 'dataJenisBarang') {
											echo "active";
										} ?>">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
					<i class="fas fa-fw fa-folder-open"></i>
					<span>Master Data</span>
				</a>
				<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<a class="collapse-item" href="<?= base_url('dataJenisBarang'); ?>">Jenis Barang</a>
						<a class="collapse-item" href="<?= base_url('dataBarang'); ?>">Barang</a>
					</div>
				</div>
			</li>

			<!-- Nav Item - Utilities Collapse Menu -->
			<li class="nav-item <?php if ($this->uri->segment(1) == 'dataPeminjaman') {
									echo "active";
								} ?>">
				<a class="nav-link" href="<?= base_url('dataPeminjaman'); ?>">
					<i class="fas fa-fw fa-handshake"></i>
					<span>Peminjaman</span></a>
			</li>

			<li class="nav-item <?php if ($this->uri->segment(1) == 'log') {
									echo "active";
								} ?>">
				<a class="nav-link" href="<?= base_url('log'); ?>">
					<i class="fas fa-fw fa-history"></i>
					<span>Log Activity</span></a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">
			<!-- Heading -->
			<div class="sidebar-heading mt-2">
				Account
			</div>

			<!-- Nav Item - Tables -->
			<!-- Nav Item - Collapse Menu -->
			<li class="nav-item <?php if ($this->uri->segment(1) == 'users') {
									echo "active";
								} ?>">
				<a class="nav-link collapsed" href="<?= base_url('users') ?>">
					<i class="fas fa-fw fa-users"></i>
					<span>Users</span>
				</a>
			</li>

			<!-- Nav Item - Charts -->
			<li class="nav-item">
				<a class="nav-link btn-logout" href="<?= base_url('auth/logout') ?>">
					<i class="fas fa-fw fa-sign-out-alt"></i>
					<span>Logout</span></a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider d-none d-md-block">

			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>

		</ul>
		<!-- End of Sidebar -->