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
    <!-- login -->
    <div class="contain py-16">
        <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">
            <div id="myalert" style="margin-bottom: 20px;">
                <?= $this->session->flashdata('notifikasi', true)?>
            </div>
            <h2 class="text-2xl uppercase font-medium mb-1">Register</h2>
            <p class="text-gray-600 mb-6 text-sm">Buat akun anda untuk memulai belanja</p>
            <form action="<?= base_url('login/simpan') ?>" method="post" autocomplete="off"  onsubmit="return validateForm()">
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
                    <div>
                        <label for="password" class="text-gray-600 mb-2 block">Konfirmasi Password</label>
                        <input type="password" name="passwordKonf" id="passwordKonf" required
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="*******">
                    </div>
                    <div>
                        <label for="nama" class="text-gray-600 mb-2 block">Nama Lengkap</label>
                        <input type="nama" name="nama" id="nama" required
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="Nama Lengkap">
                    </div>
                    <div>
                        <label for="alamat" class="text-gray-600 mb-2 block">Alamat Lengkap</label>
                        <input type="alamat" name="alamat" id="alamat" required
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="Alamat Lengkap">
                    </div>
                    <div>
                        <label for="telp" class="text-gray-600 mb-2 block">No. Telp (Whatsapp)</label>
                        <input type="telp" name="telp" id="telp" required
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="Tulis dengan format +62896733333">
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit"
                        class="block w-full py-2 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">Register</button>
                </div>
            </form>
            <!-- login with -->
            <div class="mt-6 flex justify-center relative">
                <div class="text-gray-600 uppercase px-3 bg-white z-10 relative"> - </div>
                <div class="absolute left-0 top-3 w-full border-b-2 border-gray-200"></div>
            </div>
            <p class="mt-4 text-center text-gray-600">Sudah punya akun? <a href="<?= base_url("login") ?>"
                    class="text-primary">Login Sekarang!</a></p>
        </div>
    </div>
    <!-- ./login -->
    <?php require_once('_footer.php') ?>
    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var passwordKonf = document.getElementById("passwordKonf").value;
            if (password !== passwordKonf) {
                alert("Password dan konfirmasi password tidak sesuai.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>