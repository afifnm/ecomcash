<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('_css.php'); ?>
</head>
<body>
    <?php require_once('_nav.php'); ?>
    <!-- login -->
    <div class="contain py-16">
        <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">
            <div id="myalert" style="margin-bottom: 20px;">
                <?= $this->session->flashdata('notifikasi', true)?>
            </div>
            <h2 class="text-2xl uppercase font-medium mb-1">Login</h2>
            <p class="text-gray-600 mb-6 text-sm">Masukan email dan password anda</p>
            <form action="<?= base_url('login/cek') ?>" method="post" autocomplete="off">
                <div class="space-y-2">
                    <div>
                        <label for="email" class="text-gray-600 mb-2 block">Email address</label>
                        <input type="email" name="email" id="email" required
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="pipapip@gmail.com">
                    </div>
                    <div>
                        <label for="password" class="text-gray-600 mb-2 block">Password</label>
                        <input type="password" name="password" id="password" required
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="*******">
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit"
                        class="block w-full py-2 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">Login</button>
                </div>
            </form>
            <!-- login with -->
            <div class="mt-6 flex justify-center relative">
                <div class="text-gray-600 uppercase px-3 bg-white z-10 relative"> - </div>
                <div class="absolute left-0 top-3 w-full border-b-2 border-gray-200"></div>
            </div>
            <p class="mt-4 text-center text-gray-600">Belum punya akun? <a href="<?= base_url("login/register") ?>"
                    class="text-primary">Daftar Sekarang!</a></p>
        </div>
    </div>
    <!-- ./login -->
    <?php require_once('_footer.php') ?>
</body>
</html>