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
        <!-- info -->
        <div class="col-span-9 md:col-span-12 shadow rounded px-6 pt-5 pb-7">
            <form action="<?= base_url("customer/updatePassword") ?>" method="post">
                <h4 class="text-lg font-medium capitalize mb-4">Ganti Password</h4>
                <div class="space-y-4">
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label for="last">Password Lama</label>
                            <input type="text" name="passwordLama" value="<?= $this->session->userdata('password') ?>" class="input-box" readonly>
                        </div>
                        <div>
                            <label for="last">Password Baru</label>
                            <input type="text" name="passwordBaru" class="input-box">
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit"
                        class="py-3 px-4 text-center text-white bg-primary border border-primary rounded-md hover:bg-transparent hover:text-primary transition font-medium">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
        <!-- ./info -->
    </div>
    <!-- ./wrapper -->
    <?php require_once('_footer.php') ?>
</body>
</html>