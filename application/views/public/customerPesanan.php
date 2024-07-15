<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('_css.php'); ?>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
</head>
<body>
    <?php require_once('_nav.php'); ?>
    <!-- wrapper -->
    <div id="myalert" style="margin-bottom: 20px;">
        <?= $this->session->flashdata('notifikasi', true) ?>
    </div>
    <div class="container grid grid-cols-12 sm:grid-cols-1 items-start gap-6 pt-4 pb-16">
        <?php require_once('_sideCustomer.php'); ?>
        <div class="col-span-9 border border-gray-200 p-4 rounded">
            <h4 class="text-gray-800 text-lg mb-4 font-medium uppercase">DAFTAR Pesanan</h4>
            <div class="space-y-2">
                <!-- Tabel Daftar Pesanan -->
                <table id="daftarPesanan" class="display">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Pesanan</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($pesanan as $row) { ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= $row['kode_penjualan'] ?></td>
                                <td class="text-center"><?= $row['status'] ?></td>
                                <td class="text-right">Rp. <?= number_format($row['total_harga']) ?></td>
                                <td class="text-center"><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('customer/detail/'.$row['kode_penjualan']) ?>">
                                        Detail Pesanan
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- ./wrapper -->
    <?php require_once('_footer.php') ?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#daftarPesanan').DataTable();
        });
    </script>
</body>
</html>
