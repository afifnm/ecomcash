<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="<?= base_url('assets/logo.png')?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('assets/public/')?>assets/css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">
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
        </div>
        <!-- ./wishlist -->
    </div>
    <!-- ./wrapper -->
    <?php require_once('_footer.php') ?>
</body>

</html>