<div id="myalert" style="margin-top: 10px;">
    <?php echo $this->session->flashdata('notifikasi', true)?>
</div>
<div class="grid grid-cols-12 gap-6 mt-10">
    <div class="intro-y col-span-4">
        <!-- BEGIN: Keranjang -->
        <div class="intro-y box">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                <h2 class="font-medium text-base mr-auto"> Cek Pesanan  #<?= $nota ?> </h2>
            </div>
            <div class="p-5">
                <div class="preview">
                    <div class="mt-3">
                        <label>Pelanggan</label>
                        <input type="text" class="input w-full border bg-gray-100" value="<?= $this->View_model->get_pelanggan_nama($penjualan->id_pelanggan) ?>" disabled>
                    </div>
                    <div class="mt-3">
                        <label>Tanggal</label>
                        <input type="text" class="input w-full border bg-gray-100" value="<?= mediumdate_indo($penjualan->tanggal); ?>" disabled>
                    </div>
                    <div class="mt-3">
                        <label>Pembayaran</label>
                        <input type="text" class="input w-full border bg-gray-100" value="<?= $penjualan->pembayaran ?>" disabled>
                    </div>
                    <div class="mt-3">
                        <label>Status Pesanan</label>
                        <input type="text" class="input w-full border bg-gray-100" value="<?= $penjualan->status ?>" disabled>
                    </div>
                    <?php if($penjualan->pembayaran=='Transfer'){ ?>
                    <div class="mt-5">
                        <a class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white w-full text-lg">
                            <i data-feather="download" class="w-4 h-4 mr-2"></i> Lihat Bukti Transfer </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- END: Keranjang -->
    </div>
    <div class="intro-y col-span-8">
        <!-- BEGIN: Bayar -->
        <div class="intro-y box">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                <h2 class="font-medium text-base mr-auto">
                    Produk yang dipilih
                </h2>
            </div>
            <div class="p-5">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">#</th>
                                <th class="border-b-2 whitespace-no-wrap">Kode Barang</th>
                                <th class="border-b-2 whitespace-no-wrap">Produk</th>
                                <th class="border-b-2 whitespace-no-wrap">Jumlah</th>
                                <th class="border-b-2 whitespace-no-wrap  text-right">Harga</th>
                                <th class="border-b-2 whitespace-no-wrap  text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total=0; $no=1; foreach($detail as $row){ ?>
                            <tr>
                                <td class="border-b whitespace-no-wrap"><?= $no; ?></td>
                                <td class="border-b whitespace-no-wrap"><?= $row['kode_produk'] ?></td>
                                <td class="border-b whitespace-no-wrap"><?= $row['nama'] ?></td>
                                <td class="border-b whitespace-no-wrap"><?= $row['jumlah'] ?></td>
                                <td class="border-b whitespace-no-wrap text-right">Rp.
                                    <?=  number_format($row['harga']) ?></td>
                                <td class="border-b whitespace-no-wrap text-right">Rp.
                                    <?=  number_format($row['jumlah']*$row['harga']) ?></td>
                            </tr>
                            <?php $total=$total+$row['jumlah']*$row['harga']; $no++; } ?>
                            <tr>
                                <td colspan=5 class="border-b whitespace-no-wrap">Total Harga</td>
                                <td class="border-b whitespace-no-wrap text-right">Rp. <?= number_format($total) ;?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php if($penjualan->status=='proses'){ ?>
                    <div class="flex space-x-2 mt-5 justify-center">
                        <a class="button w-32 flex items-center justify-center bg-theme-1 text-white text-lg px-4 py-2" id="approve-btn">
                            Setujui
                        </a>
                        <a class="button w-32 flex items-center justify-center bg-theme-1 text-white text-lg px-4 py-2" id="cancel-btn">
                            Batalkan
                        </a>
                    </div> 
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- END: Bayar -->
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <!-- Include Feather Icons -->
 <script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();
    document.getElementById('approve-btn').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah Anda yakin menyetujui pesanan ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, setujui!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Arahkan ke URL jika disetujui
                window.location.href = '<?= base_url('admin/pesanan/approve/1/'.$nota) ?>';
            }
        }) 
    });
    document.getElementById('cancel-btn').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah Anda yakin membatalakan ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, batalkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Arahkan ke URL jika disetujui
                window.location.href = '<?= base_url('admin/pesanan/approve/0/'.$nota) ?>';
            }
        })
    });
</script>