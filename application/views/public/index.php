<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('_css.php'); ?>
</head>
<body>
    <?php require_once('_nav.php'); ?>
    <!-- banner -->
    <div class="bg-cover bg-no-repeat bg-center py-36" style="background-image: url('<?= base_url('assets/back.jpg')?>');">
        <div class="container">
            <h1 class="text-6xl text-gray-800 font-medium mb-4 capitalize">
                <?= $site['nama_cv'] ?> <br> Murah Cepat Terpercaya
            </h1>
            <p>Selamat datang di <?= $site['nama_cv'] ?>! Temukan kebutuhan sehari-hari Anda dengan kemudahan dan kenyamanan. Dari makanan hingga perawatan pribadi, kami hadir untuk memenuhi setiap kebutuhan Anda. Jelajahi beragam produk berkualitas dengan harga terjangkau. Mulai belanja sekarang dan nikmati pengalaman berbelanja online yang menyenangkan bersama kami.</p>
            <div class="mt-12">
                <a href="<?= base_url('produk') ?>" class="bg-primary border border-primary text-white px-8 py-3 font-medium 
                    rounded-md hover:bg-transparent hover:text-primary">Mulai Belanja</a>
            </div>
        </div>
    </div>
    <!-- ./banner -->
    <!-- features -->
    <div class="container py-16">
        <div class="w-10/12 grid grid-cols-1 md:grid-cols-3 gap-6 mx-auto justify-center">
            <div class="border border-primary rounded-sm px-3 py-6 flex justify-center items-center gap-5">
                <img src="<?= base_url('assets/public/')?>assets/images/icons/delivery-van.svg" alt="Delivery" class="w-12 h-12 object-contain">
                <div>
                    <h4 class="font-medium capitalize text-lg">Free Ongkir</h4>
                    <p class="text-gray-500 text-sm">Radius 2 km SMKN 2 Karanganyar</p>
                </div>
            </div>
            <div class="border border-primary rounded-sm px-3 py-6 flex justify-center items-center gap-5">
                <img src="<?= base_url('assets/public/')?>assets/images/icons/money-back.svg" alt="Delivery" class="w-12 h-12 object-contain">
                <div>
                    <h4 class="font-medium capitalize text-lg">Uang Kembali</h4>
                    <p class="text-gray-500 text-sm">Apabila produk salah</p>
                </div>
            </div>
            <div class="border border-primary rounded-sm px-3 py-6 flex justify-center items-center gap-5">
                <img src="<?= base_url('assets/public/')?>assets/images/icons/service-hours.svg" alt="Delivery" class="w-12 h-12 object-contain">
                <div>
                    <h4 class="font-medium capitalize text-lg">Layanan 24 Jam</h4>
                    <p class="text-gray-500 text-sm">Customer support</p>
                </div>
            </div>
        </div>
    </div>
    <!-- ./features -->
    <div class="container">
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">PENCARIAN</h2>
        <div class="grid grid-cols-6 md:grid-cols-6 gap-4">
            <?php require_once('_search.php') ?>
        </div> 
    </div> 
    <!-- categories -->
    <div class="container py-16">
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">Kategori Produk</h2>
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
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">PRODUK TERBARU</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <?php foreach($this->View_model->get_produk_terbaru(8) as $produkTerbaru) { ?> 
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