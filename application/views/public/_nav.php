<!-- navbar -->
<nav class="bg-gray-800 py-2">
    <div class="container flex">
        <div class="px-8 py-4 bg-primary md:flex items-center cursor-pointer relative group hidden">
            <span class="text-white">
                <i class="fa-solid fa-bars"></i>
            </span>
            <a href="<?= base_url('beranda') ?>">
                <h2 class="text-2xl text-white"><?= $site['nama_cv'] ?></h2>
            </a> 
        </div>

        <div class="flex items-center justify-between flex-grow md:pl-12 py-5">
            <div class="flex items-center space-x-6 capitalize">
                <a href="<?= base_url('beranda') ?>" class="text-gray-200 hover:text-white transition">Beranda</a>
                <a href="<?= base_url('produk') ?>" class="text-gray-200 hover:text-white transition">Mulai Belanja</a>
                <a href="<?= base_url('beranda/alur') ?>" class="text-gray-200 hover:text-white transition">Alur Belanja</a>
                <?php if($this->session->userdata('login')=="Frontend"){ ?>
                <a href="<?= base_url('customer/keranjang') ?>" class="text-gray-200 hover:text-white transition">
                    Keranjang Belanja
                    (<?= $this->View_model->get_jumlah_keranjang($this->session->userdata('id_pelanggan')) ?>)
                </a>
                <?php } ?>
            </div>
            <?php if($this->session->userdata('login')=="Frontend"){ ?>
                <a href="<?= base_url('customer') ?>" class="text-gray-200 hover:text-white transition">
                    <?= $this->session->userdata('nama') ?>
                </a>
            <?php } else { ?>
                <a href="<?= base_url('login') ?>" class="text-gray-200 hover:text-white transition">
                    Login
                </a>
            <?php } ?>
        </div>
    </div>
</nav>