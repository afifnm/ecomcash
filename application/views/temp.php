<!DOCTYPE html>
<html lang="en">
<!-- BEGIN: Head -->

<head>
	<meta charset="utf-8">
	<link href="<?= base_url('assets/')?>dist/images/logo.svg" rel="shortcut icon">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="LEFT4CODE">
	<title><?= $judul_halaman ?></title>
	<!-- BEGIN: CSS Assets-->
	<link rel="stylesheet" href="<?= base_url('assets/')?>dist/css/app.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
	<!-- END: CSS Assets-->
</head>
<!-- END: Head -->

<body class="app">
	<?php $halaman = $this->uri->segment(2);?>
	<!-- BEGIN: Mobile Menu -->
	<div class="mobile-menu md:hidden">
		<div class="mobile-menu-bar">
			<a href="" class="flex mr-auto">
				<img class="w-6" src="<?= base_url('assets/')?>dist/images/logo.svg">
			</a>
			<a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2"
					class="w-8 h-8 text-white transform -rotate-90"></i> </a>
		</div>
		<ul class="border-t border-theme-24 py-5 hidden">
			<li>
				<a href="<?= base_url('admin/home') ?>" class="menu menu--<?php if($halaman=='home'){ echo "active"; } ?>">
					<div class="menu__icon"> <i data-feather="home"></i> </div>
					<div class="menu__title"> Dashboard </div>
				</a>
			</li>
			<li>
				<a href="<?= base_url('admin/penjualan') ?>"
					class="menu menu--<?php if($halaman=='penjualan'){ echo "active"; } ?>">
					<div class="menu__icon"> <i data-feather="shopping-cart"></i> </div>
					<div class="menu__title"> Penjualan </div>
				</a>
			</li>
			<li>
				<a href="<?= base_url('admin/produk') ?>"
					class="menu menu--<?php if($halaman=='produk'){ echo "active"; } ?>">
					<div class="menu__icon"> <i data-feather="package"></i> </div>
					<div class="menu__title"> Produk </div>
				</a>
			</li>
			<li>
				<a href="<?= base_url('admin/pengguna') ?>"
					class="menu menu--<?php if($halaman=='pengguna'){ echo "active"; } ?>">
					<div class="menu__icon"> <i data-feather="user"></i> </div>
					<div class="menu__title"> Pengguna </div>
				</a>
			</li>
		</ul>
	</div>
	<!-- END: Mobile Menu -->
	<!-- BEGIN: Top Bar -->
	<div class="border-b border-theme-24 -mt-10 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 pt-3 md:pt-0 mb-10">
		<div class="top-bar-boxed flex items-center">
			<!-- BEGIN: Logo -->
			<a href="" class="-intro-x hidden md:flex">
				<img class="w-6" src="<?= base_url('assets/') ?>dist/images/logo.svg">
				<span class="text-white text-lg ml-3"> App<span class="font-medium">Kasir</span> </span>
			</a>
			<!-- END: Logo -->
			<!-- BEGIN: Breadcrumb -->
			<div class="-intro-x breadcrumb breadcrumb--light mr-auto"> <a href="" class="">App Kasir</a> <i
					data-feather="chevron-right" class="breadcrumb__icon"></i> <a href=""
					class="breadcrumb--active"><?= $judul_halaman; ?></a> </div>
			<!-- END: Breadcrumb -->
			<!-- BEGIN: Account Menu -->
			<div class="intro-x dropdown w-8 h-8 relative">
				<div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110">
					<img src="<?= base_url('assets/') ?>dist/images/profile-4.jpg">
				</div>
				<div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
					<div class="dropdown-box__content box bg-theme-38 text-white">
						<div class="p-4 border-b border-theme-40">
							<div class="font-medium"><?= $this->session->userdata('nama') ?></div>
							<div class="text-xs text-theme-41"><?= $this->session->userdata('level') ?></div>
						</div>
						<div class="p-2">
							<a href="<?= base_url('auth/profile') ?>"
								class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
								<i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
							<a href="<?= base_url('auth/logout') ?>"
								class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
								<i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
						</div>
					</div>
				</div>
			</div>
			<!-- END: Account Menu -->
		</div>
	</div>
	<!-- END: Top Bar -->
	<!-- BEGIN: Top Menu -->
	<nav class="top-nav">
		<ul>
			<li>
				<a href="<?= base_url('admin/home') ?>"
					class="top-menu top-menu--<?php if($halaman=='home'){ echo "active"; } ?>">
					<div class="top-menu__icon"> <i data-feather="home"></i> </div>
					<div class="top-menu__title"> Dashboard </div>
				</a>
			</li>
			<li>
				<a href="<?= base_url('admin/penjualan') ?>"
					class="top-menu top-menu--<?php if($halaman=='penjualan'){ echo "active"; } ?>">
					<div class="top-menu__icon"> <i data-feather="shopping-cart"></i> </div>
					<div class="top-menu__title"> Penjualan </div>
				</a>
			</li>
			<li>
				<a href="<?= base_url('admin/produk') ?>"
					class="top-menu top-menu--<?php if($halaman=='produk'){ echo "active"; } ?>">
					<div class="top-menu__icon"> <i data-feather="package"></i> </div>
					<div class="top-menu__title"> Produk </div>
				</a>
			</li>
			<li>
				<a href="<?= base_url('admin/kategori') ?>"
					class="top-menu top-menu--<?php if($halaman=='kategori'){ echo "active"; } ?>">
					<div class="top-menu__icon"> <i data-feather="grid"></i> </div>
					<div class="top-menu__title"> Kategori </div>
				</a>
			</li>
			<li>
				<a href="<?= base_url('admin/pelanggan') ?>"
					class="top-menu top-menu--<?php if($halaman=='pelanggan'){ echo "active"; } ?>">
					<div class="top-menu__icon"> <i data-feather="user"></i> </div>
					<div class="top-menu__title"> Pelanggan </div>
				</a>
			</li>
			<li>
				<a href="<?= base_url('admin/pengguna') ?>"
					class="top-menu top-menu--<?php if($halaman=='pengguna'){ echo "active"; } ?>">
					<div class="top-menu__icon"> <i data-feather="user-check"></i> </div>
					<div class="top-menu__title"> Pengguna </div>
				</a>
			</li>
		</ul>
	</nav>
	<!-- END: Top Menu -->
	<!-- BEGIN: Content -->
	<div class="content">
		<?= $contents; ?>
	</div>
	<!-- END: Content -->
	<!-- BEGIN: JS Assets-->
	<script src="<?= base_url('assets/')?>dist/js/app.js"></script>
	<!-- END: JS Assets-->
	
	<script>
    $('#myalert').delay('slow').slideDown('slow').delay(6500).slideUp(600);
  </script>
</body>

</html>