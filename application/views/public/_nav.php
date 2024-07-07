<!-- navbar -->
<nav class="bg-gray-800">
    <div class="container flex">
        <div class="px-8 py-4 bg-primary md:flex items-center cursor-pointer relative group hidden">
            <span class="text-white">
                <i class="fa-solid fa-bars"></i>
            </span>
            <h2 class="text-2xl text-white"><?= $site['nama_cv'] ?></h2>
        </div>

        <div class="flex items-center justify-between flex-grow md:pl-12 py-5">
            <div class="flex items-center space-x-6 capitalize">
                <a href="<?= base_url('beranda') ?>" class="text-gray-200 hover:text-white transition">Beranda</a>
                <a href="<?= base_url('produk') ?>" class="text-gray-200 hover:text-white transition">Belanja</a>
                <a href="<?= base_url('beranda/tentangkami') ?>" class="text-gray-200 hover:text-white transition">Tentang Kami</a>
            </div>
            <a href="<?= base_url('login') ?>" class="text-gray-200 hover:text-white transition">Login</a>
        </div>
    </div>
</nav>