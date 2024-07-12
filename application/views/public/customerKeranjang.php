<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('_css.php'); ?>
</head>
<body>
    <?php require_once('_nav.php'); ?>
    <!-- wrapper -->
    <div id="myalert" style="margin-bottom: 20px;">
        <?= $this->session->flashdata('notifikasi', true)?>
    </div>
    <div class="container grid grid-cols-12 sm:grid-cols-1 items-start gap-6 pt-4 pb-16">
        <?php require_once('_sideCustomer.php'); ?>
        <!-- wishlist -->
        <div class="col-span-9 space-y-4">
            <?php foreach($keranjang as $row) { ?>
            <div class="flex items-center justify-between border gap-6 p-4 border-gray-200 rounded">
                <div class="w-28">
                    <img src="<?= base_url('assets/produk/'.$row['foto'])?>" class="w-full">
                </div>
                <div class="w-1/3">
                    <h2 class="text-gray-800 text-xl font-medium uppercase"><?= $row['nama'] ?></h2>
                    <p class="text-gray-500 text-sm">
                        Jumlah beli :
                        <span class="text-green-600"><?= $row['jumlah'] ?></span>
                        <br>
                        <span class="text-primary">Rp. <?= number_format($row['harga']) ?></span>
                        <?php if($row['jumlah']>$row['stok']){ ?>
                            <span class="text-red-600">(stok tidak tersedia)</span>
                        <?php } ?>
                    </p>
                </div>
                <div class="text-primary text-lg font-semibold">Rp. <?= number_format($row['jumlah']*$row['harga']) ?></div>
                <a href="<?= base_url('customer/hapusKeranjang/'.$row['id_keranjang']) ?>"
                    class="px-6 py-2 text-center text-sm text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">
                hapus
                </a>
                <div class="text-gray-600 cursor-pointer hover:text-primary">
                    <i class="fa-solid fa-trash"></i>
                </div>
            </div>
            <?php } ?>
            <a href="<?= base_url('customer/checkout') ?>" class="block w-full py-3 px-4 text-center text-white bg-primary border border-primary rounded-md hover:bg-transparent hover:text-primary transition font-medium">
                Buat Pesanan
            </a>
        </div>
        <!-- ./wishlist -->
    </div>
    <!-- ./wrapper -->
    <?php require_once('_footer.php') ?>
</body>
</html>