<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('_css.php'); ?>
</head>

<body>
    <?php require_once('_nav.php'); ?>
    <!-- product-detail -->
    <div id="myalert" style="margin-bottom: 20px;">
        <?= $this->session->flashdata('notifikasi', true)?>
    </div>
    <div class="container grid grid-cols-2 gap-6 py-16">
        <div class="p-10">
            <img src="<?= base_url('assets/produk/'.$produk->foto) ?>" alt="product" class="w-full">
        </div>
        <form action="<?= base_url('customer/addKeranjang') ?>" method="post">
            <input type="hidden" name="id_produk" value="<?= $produk->id_produk ?>">
            <div>
                <h2 class="text-3xl font-medium uppercase mb-2"><?= $produk->nama ?></h2>
                <div class="space-y-2">
                    <p class="text-gray-800 font-semibold space-x-2">
                        <span>Stok</span>
                        <?php if($produk->stok>0){ ?>
                        <span class="text-green-600"> : <?= $produk->stok; ?></span>
                        <?php } else { ?>
                        <span class="text-red-600"> : Habis</span>
                        <?php } ?>
                    </p>
                    <p class="space-x-2">
                        <span class="text-gray-800 font-semibold">Kategori : </span>
                        <span class="text-gray-600"><?= $produk->kategori ?></span>
                    </p>
                </div>
                <div class="flex items-baseline mb-1 space-x-2 font-roboto mt-4">
                    <p class="text-xl text-primary font-semibold">Rp. <?= number_format($produk->harga) ?></p>
                </div>
                <div class="mt-4">
                    <h3 class="text-sm text-gray-800 uppercase mb-1">Jumlah</h3>
                    <div class="flex border border-gray-300 text-gray-600 divide-x divide-gray-300 w-max">
                        <button type="button"
                            class="px-4 py-3 text-gray-600 text-sm border-r border-gray-300 focus:outline-none"
                            onclick="decreaseValue()">-</button>
                        <input type="text" name="jumlah" min="1" value="1" id="jumlah"
                            class="border-0 px-4 py-3 text-gray-600 text-sm text-center focus:ring-0 focus:border-primary placeholder-gray-400"
                            style="width: 50px;" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        <button type="button"
                            class="px-4 py-3 text-gray-600 text-sm border-l border-gray-300 focus:outline-none"
                            onclick="increaseValue()">+</button>
                    </div>
                </div>
                <div class="mt-6 flex gap-3 border-b border-gray-200 pb-5 pt-5">
                <?php if($this->session->userdata('login')=="Frontend"){ ?>
                    <button type="submit"
                        class="bg-primary border border-primary text-white px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:bg-transparent hover:text-primary transition">
                        <i class="fa-solid fa-bag-shopping"></i> Tambah ke keranjang
                    </button>
                <?php } else { ?>
                    <a href="<?= base_url('login') ?>"
                        class="bg-primary border border-primary text-white px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:bg-transparent hover:text-primary transition">
                        <i class="fa-solid fa-bag-shopping"></i> SILAHKAN LOGIN TERLEBIH DAHULU
                    </a>
                <?php } ?>
                </div>
            </div>
        </form>
    </div>
    <!-- ./product-detail -->

    <!-- product -->
    <div class="container pb-16">
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">PRODUK TERLARIS</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <?php foreach($this->View_model->get_produk_terlaris(8) as $produkTerbaru) { ?>
            <div class="bg-white shadow rounded overflow-hidden group">
                <div class="relative">
                    <img src="<?= base_url('assets/produk/'.$produkTerbaru['foto'])?>" alt="product 1"
                        class="h-auto max-w-lg w-full">
                </div>
                <div class="pt-4 pb-3 px-4">
                    <h4 class="uppercase font-medium fs-4 md:text-xl mb-2 text-gray-800 hover:text-primary transition">
                        <?= $produkTerbaru['nama']; ?></h4>
                    <div class="flex items-baseline mb-1 space-x-2">
                        <p class="fs-4 md:text-xl text-primary font-semibold">Rp.
                            <?= number_format($produkTerbaru['harga']); ?></p>
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
    <script>
        function increaseValue() {
            let value = parseInt(document.getElementById('jumlah').value, 10);
            value = isNaN(value) ? 1 : value;
            value++;
            document.getElementById('jumlah').value = value;
        }
        function decreaseValue() {
            let value = parseInt(document.getElementById('jumlah').value, 10);
            value = isNaN(value) ? 1 : value;
            value = value > 1 ? value - 1 : 1;
            document.getElementById('jumlah').value = value;
        }
    </script>
</body>

</html>