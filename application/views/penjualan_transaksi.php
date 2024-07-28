<div id="myalert" style="margin-top: 10px;">
    <?php echo $this->session->flashdata('notifikasi', true)?>
</div>
<div class="grid grid-cols-12 gap-6 mt-10">
    <div class="intro-y col-span-4">
        <!-- BEGIN: Keranjang -->
        <div class="intro-y box">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                <h2 class="font-medium text-base mr-auto">
                    Pilih produk terlebih dahulu
                </h2>
            </div>
            <div class="p-5">
                <form action="<?= base_url('admin/penjualan/addtemp') ?>" method="post">
                    <input type="hidden" name="kode_penjualan" value="<?= $nota ?>">
                    <div class="preview">
                        <div class="mt-1">
                            <input type="hidden" name="id_pelanggan" value="<?= $id_pelanggan; ?>">
                            <label>Pelanggan</label>
                            <input type="text" class="input w-full border mt-2 bg-gray-100" value="<?= $this->View_model->get_pelanggan_nama($id_pelanggan) ?>" disabled>
                        </div>
                        <div class="mt-1">
                            <label>Nomor Nota</label>
                            <input type="text" class="input w-full border mt-2 bg-gray-100" value="#<?= $nota ?>" disabled>
                        </div>
                        <div class="mt-5">
                            <label>Produk</label>
                            <select class="select2 w-full border mt-2 bg-gray-100" name="id_produk">
                                <?php foreach($produk as $aa){ ?>
                                <option value="<?= $aa['id_produk'] ?>">
                                    <?= $aa['kode_produk'] ?>
                                    <?= $aa['nama'] ?> - (<?= $aa['stok'] ?>)
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mt-5">
                            <label>Jumlah</label>
                            <input type="number" class="input w-full border mt-2" placeholder="jumlah" min=1 required
                                name="jumlah">
                        </div>
                        <div class="mt-5">
                            <button
                                class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white w-full text-lg">
                                <i data-feather="plus" class="w-4 h-4 mr-2"></i> Tambah ke keranjang </button>
                        </div>
                    </div>
                </form>
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
                    <?php if($temp==NULL) { ?>
                    <div class="rounded-md px-5 py-4 mb-2 bg-gray-200 text-gray-600">Belum ada produk yang dipilih,
                        silahkan pilih produk ke keranjang terlebih dahulu.</div>
                    <?php } else { ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">#</th>
                                <th class="border-b-2 whitespace-no-wrap">Kode Barang</th>
                                <th class="border-b-2 whitespace-no-wrap">Produk</th>
                                <th class="border-b-2 whitespace-no-wrap">Jumlah</th>
                                <th class="border-b-2 whitespace-no-wrap  text-right">Harga</th>
                                <th class="border-b-2 whitespace-no-wrap  text-right">Total</th>
                                <th class="border-b-2 whitespace-no-wrap text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total=0; $no=1; foreach($temp as $row){ ?>
                            <tr>
                                <td class="border-b whitespace-no-wrap"><?= $no; ?></td>
                                <td class="border-b whitespace-no-wrap"><?= $row['kode_produk'] ?></td>
                                <td class="border-b whitespace-no-wrap"><?= $row['nama'] ?></td>
                                <td class="border-b whitespace-no-wrap"><?= $row['jumlah'] ?></td>
                                <td class="border-b whitespace-no-wrap text-right">Rp.
                                    <?=  number_format($row['harga']) ?></td>
                                <td class="border-b whitespace-no-wrap text-right">Rp.
                                    <?=  number_format($row['jumlah']*$row['harga']) ?></td>
                                <td class="border-b whitespace-no-wrap">
                                    <div class="flex sm:justify-center items-center">
                                        <a onClick="return confirm('Apakah anda yakin menghapus produk dari keranjang?')"
                                            href="<?= base_url('admin/penjualan/hapus_temp/'.$row['id_temp']) ?>"
                                            class="flex items-center text-theme-6">
                                            <i data-feather="trash" class="w-4 h-4 mr-1 ml-2"></i> hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php $total=$total+$row['jumlah']*$row['harga']; $no++; } ?>
                            <tr>
                                <td colspan=5 class="border-b whitespace-no-wrap">Total Harga</td>
                                <td class="border-b whitespace-no-wrap text-right">Rp. <?= number_format($total) ;?>
                                </td>
                                <td class="border-b whitespace-no-wrap">-</td>
                            </tr>
                        </tbody>
                    </table>
                    <form action="<?= base_url('admin/penjualan/bayarv2') ?>" method="post" id="form_pembayaran" enctype="multipart/form-data" onsubmit="return validateForm()">
                        <div class="mt-3 pr-10 pl-10">
                            <input type="number" class="input w-full border mt-2 text-xl" placeholder="Uang yang dibayar" min="1"
                                required name="bayar" id="bayar" onkeyup="total()">
                        </div>
                        <div class="mt-3 pr-10 pl-10">
                            <select name="pembayaran" class="input w-full border mt-2 text-xl" id="metode_pembayaran" onchange="toggleBuktiInput()">
                                <option value="Tunai">Tunai (Cash)</option>
                                <option value="Transfer">Transfer</option>
                            </select>
                        </div>
                        <div class="mt-1 pr-10 pl-10" id="bukti_transfer_container" style="display: none;">
                            <label for="bukti" class="input border text-xl" id="bukti_label">Masukan bukti transfer</label>
                            <input type="file" class="input border text-lg" placeholder="Bukti transfer" name="bukti" id="bukti" accept=".jpeg, .jpg"
                                onchange="updateBuktiLabel(this)">
                        </div>
                        <div class="mt-3 pr-10 pl-10">
                            <input type="hidden" name="id_pelanggan" value="<?= $id_pelanggan; ?>">
                            <input type="hidden" name="total_harga" value="<?= $total; ?>" id="total_harga">
                            <h1 class="input w-full border mt-2 text-xl" id="sisa"> Rp. 0</h1>
                            <button type="submit"
                                    class="button w-32 mr-2 mb-2 mt-5 flex items-center justify-center bg-theme-1 text-white text-lg w-full"
                                    id="bayar_button">
                                <i data-feather="dollar-sign" class="w-4 h-4 mr-2"></i> Bayar
                            </button>
                        </div>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- END: Bayar -->
    </div>
</div>

<script>
    function total() {
        var total_harga, bayar;
        total_harga = parseInt(document.getElementById("total_harga").value);
        bayar = parseInt(document.getElementById("bayar").value);
        var abc = bayar - total_harga;
        if (abc < 0) {
            document.getElementById("sisa").innerHTML = 'Nominal uang yang dibayar tidak mencukupi';
        } else {
            var reverse = abc.toString().split('').reverse().join(''),
                ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            document.getElementById("sisa").innerHTML = 'Rp. ' + ribuan;
        }
    }

    function toggleBuktiInput() {
        var metode_pembayaran = document.getElementById('metode_pembayaran').value;
        var bukti_transfer_container = document.getElementById('bukti_transfer_container');

        if (metode_pembayaran === 'Transfer') {
            bukti_transfer_container.style.display = 'block';
        } else {
            bukti_transfer_container.style.display = 'none';
        }
    }

    function updateBuktiLabel(input) {
        var bukti_label = document.getElementById('bukti_label');
        if (input.files.length > 0) {
            bukti_label.innerText = input.files[0].name;
        } else {
            bukti_label.innerText = 'Masukan bukti transfer';
        }
    }

    function validateForm() {
        var metode_pembayaran = document.getElementById('metode_pembayaran').value;
        var bukti = document.getElementById('bukti').value;

        if (metode_pembayaran === 'Transfer' && bukti === '') {
            alert('Mohon unggah bukti transfer terlebih dahulu!');
            return false;
        }

        return true;
    }
</script>
