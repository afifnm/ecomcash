<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('_css.php'); ?>
    <style>
        .menu li.active a {
            background-color: #007bff; /* Warna latar belakang untuk menu aktif */
            color: white; /* Warna teks untuk menu aktif */
        }
    </style>
</head>
<body>
    <?php require_once('_nav.php'); ?>
    <div class="container py-5">
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">PENCARIAN</h2>
        <div class="grid grid-cols-6 md:grid-cols-6 gap-4">
            <?php require_once('_search.php') ?>
        </div> 
    </div> 
    <!-- categories -->
    <div class="container py-4">
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">PILIH PRODUK</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <?php foreach($this->View_model->get_kategori() as $kategori) { ?> 
                <div class="relative rounded-sm overflow-hidden group">
                    <img src="<?= base_url('assets/kategori/'.$kategori['foto']) ?>" alt="category 1" class="w-full">
                    <a href="<?= base_url('produk/k/'.$kategori['slug']) ?>"
                        class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-60 transition"><?= $kategori['kategori'] ?></a>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- ./categories -->
    <!-- new arrival -->
    <div class="container pb-16">
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6"><?= $judul ?></h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <?php foreach($produk as $cc) { ?> 
            <div class="bg-white shadow rounded overflow-hidden group">
                <div class="relative">
                    <img src="<?= base_url('assets/produk/'.$cc['foto'])?>" alt="product 1" class="h-auto max-w-lg w-full">
                </div>
                <div class="pt-4 pb-3 px-4">
                    <h4 class="uppercase font-medium fs-4 md:text-xl mb-2 text-gray-800 hover:text-primary transition"><?= $cc['nama']; ?></h4>
                    <div class="flex items-baseline mb-1 space-x-2">
                        <p class="fs-4 md:text-xl text-primary font-semibold">Rp. <?= number_format($cc['harga']); ?></p>
                    </div>
                </div>
                <a href="<?= base_url('produk/v/'.$cc['slug']) ?>"
                    class="block w-full py-1 text-center text-white bg-primary border border-primary rounded-b hover:bg-transparent hover:text-primary transition">
                    Lihat Produk</a>
            </div>
        <?php } ?>
        </div>
        <div class="py-5">
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>
    <!-- ./new arrival -->

    <!-- ads -->
    <div class="container pb-16">
        <a href="https://pipapip.web.id/" target="_blank">
            <img src="<?= base_url('assets/offer.jpg')?>" alt="ads" class="w-full">
        </a>
    </div>
    <!-- ./ads -->

    <!-- product -->
    <div class="container pb-16">
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">PRODUK TERLARIS</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <?php foreach($this->View_model->get_produk_terlaris(8) as $produkTerbaru) { ?> 
            <div class="bg-white shadow rounded overflow-hidden group">
                <div class="relative">
                    <img src="<?= base_url('assets/produk/'.$produkTerbaru['foto'])?>" alt="product 1" class="h-auto max-w-lg w-full">
                </div>
                <div class="pt-4 pb-3 px-4">
                    <h4 class="uppercase font-medium fs-4 md:text-xl mb-2 text-gray-800 hover:text-primary transition"><?= $produkTerbaru['nama']; ?></h4>
                    <div class="flex items-baseline mb-1 space-x-2">
                        <p class="fs-4 md:text-xl text-primary font-semibold">Rp. <?= number_format($produkTerbaru['harga']); ?></p>
                    </div>
                </div>
                <a href="<?= base_url('produk/v/'.$produkTerbaru['slug']) ?>"
                    class="block w-full py-1 text-center text-white bg-primary border border-primary rounded-b hover:bg-transparent hover:text-primary transition">
                    Lihat Produk</a>
            </div>
        <?php } ?>
        </div>
    </div>
    <!-- ./product -->
    <?php require_once('_footer.php') ?>
</body>
</html>