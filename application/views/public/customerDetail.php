<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('_css.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php require_once('_nav.php'); ?>
    <!-- wrapper -->
    <div id="myalert" style="margin-bottom: 20px;">
        <?= $this->session->flashdata('notifikasi', true) ?>
    </div>
    <div class="container grid grid-cols-12 sm:grid-cols-1 items-start gap-6 pt-4 pb-16">
        <?php require_once('_sideCustomer.php'); ?>
        <div class="col-span-8 border border-gray-200 p-4 rounded">
            <h4 class="text-gray-800 text-lg mb-4 font-medium uppercase">Detail PESANAN</h4>
            <div class="space-y-2">
                <?php $total = 0; foreach ($detail as $row) { ?>
                    <div class="flex justify-between">
                        <div>
                            <h5 class="text-gray-800 font-medium"><?= $row['nama'] ?></h5>
                            <p class="text-sm text-gray-600">
                                Rp. <?= number_format($row['harga']) ?> x <?= $row['jumlah'] ?>
                            </p>
                        </div>
                        <p class="text-gray-800 font-medium">Rp. <?= number_format($row['jumlah'] * $row['harga']) ?></p>
                    </div>
                <?php $total += $row['jumlah'] * $row['harga']; } ?>
            </div>
            <div class="flex justify-between text-gray-800 font-medium py-3 uppercase">
                <p class="font-semibold">Total</p>
                <p>Rp. <?= number_format($total) ?></p>
            </div>
            <div class="flex justify-between text-gray-800 font-medium py-3 uppercase">
                <p class="font-semibold">Pembayaran</p>
                <p><?= $penjualan->pembayaran ?></p>
            </div>
            <div class="flex justify-between text-gray-800 font-medium py-3 uppercase">
                <p class="font-semibold">Status Pesanan</p>
                <p><?= $penjualan->status ?></p>
            </div>
            <?php if($penjualan->pembayaran=="Transfer"){ ?>
                <div class="flex justify-between text-gray-800 font-medium py-3 uppercase">
                    <p class="font-semibold">Bukti Transfer</p>
                    <p>
                        <a href="<?= base_url('assets/bukti/'.$penjualan->bukti); ?>" target="_blank">Lihat Bukti Transfer</a> 
                    </p>
                </div>
            <?php } ?>
            <?php if($penjualan->status=="proses"){ ?>
                <a href="#" onclick="confirmCancel('<?= base_url('customer/cancel/'.$penjualan->kode_penjualan) ?>')" class="block w-full py-3 px-4 text-center text-white bg-primary border border-primary rounded-md hover:bg-transparent hover:text-primary transition font-medium">
                    Batalkan Pesanan
                </a>
            <?php } ?>
        </div>
    </div>
    <!-- ./wrapper -->
    <?php require_once('_footer.php') ?>

    <script>
        function confirmCancel(url) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan membatalkan pesanan ini.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, batalkan!',
                cancelButtonText: 'Lanjutkan Pesanan'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url; // Redirect to the cancellation URL
                }
            });
        }
    </script>
</body>
</html>
