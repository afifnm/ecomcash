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
        <div class="col-span-8 border border-gray-200 p-4 rounded">
            <h4 class="text-gray-800 text-lg mb-4 font-medium uppercase">Checkout</h4>
            <div class="space-y-2">
                <?php $total=0; foreach($keranjang as $row) { ?>
                    <div class="flex justify-between">
                        <div>
                            <h5 class="text-gray-800 font-medium"><?= $row['nama'] ?></h5>
                            <p class="text-sm text-gray-600">
                                Rp. <?= number_format($row['harga']) ?>x<?= $row['jumlah'] ?>
                            </p>
                        </div>
                        <p class="text-gray-800 font-medium">Rp. <?= number_format($row['jumlah']*$row['harga']) ?></p>
                    </div>
                <?php $total = $total+$row['jumlah']*$row['harga']; } ?>
            </div>
            <div class="flex justify-between text-gray-800 font-medium py-3 uppercas">
                <p class="font-semibold">Total</p>
                <p>Rp. <?= number_format($total) ?></p>
            </div>
            <div class="space-y-2">
                <div>
                    <label for="Pembayaran" class="text-gray-600 mb-2 block">Metode Pembayaran</label>
                    <select name="pembayaran" id="pembayaran" required class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" onchange="toggleBuktiInput()">
                        <option value="Tunai">Tunai (Cash)</option>
                        <option value="Transfer">Transfer</option>
                    </select>
                </div>
                <div id="buktiWrapper" style="display: none;">
                    <label for="bukti" class="text-gray-600 mb-2 block">Bukti Pembayaran (Transfer)</label>
                    <input type="file" name="bukti" id="bukti" onchange="updateBuktiLabel(this)"
                        class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
                </div>
            </div>
            <div class="flex items-center mb-4 mt-2">
                <input type="checkbox" name="agreement" id="agreement" class="text-primary focus:ring-0 rounded-sm cursor-pointer w-3 h-3" onchange="toggleCheckoutButton()">
                <label for="agreement" class="text-gray-600 ml-3 cursor-pointer text-sm">
                    Saya setuju <a class="text-primary">dan yakin untuk membeli produk diatas.</a>
                </label>
            </div>
            <button type="submit" id="checkoutButton" class="block w-full py-3 px-4 text-center text-white bg-primary border border-primary rounded-md hover:bg-transparent hover:text-primary transition font-medium" disabled>
                Checkout
            </button>
        </div>
    </div>
    <!-- ./wrapper -->
    <?php require_once('_footer.php') ?>

    <script>
        function toggleBuktiInput() {
            var pembayaran = document.getElementById('pembayaran').value;
            var buktiWrapper = document.getElementById('buktiWrapper');
            if (pembayaran === 'Transfer') {
                buktiWrapper.style.display = 'block';
            } else {
                buktiWrapper.style.display = 'none';
            }
        }

        function toggleCheckoutButton() {
            var agreement = document.getElementById('agreement').checked;
            var checkoutButton = document.getElementById('checkoutButton');
            checkoutButton.disabled = !agreement;
        }
    </script>
</body>
</html>
