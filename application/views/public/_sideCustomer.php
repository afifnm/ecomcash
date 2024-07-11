<!-- sidebar -->
<div class="col-span-3 md:col-span-12">
    <div class="px-4 py-3 shadow flex items-center gap-4">
        <div class="flex-shrink-0">
            <img src="<?= base_url('assets') ?>/logo.png" alt="profile"
                class="rounded-full w-14 h-14 border border-gray-200 p-1 object-cover">
        </div>
        <div class="flex-grow">
            <p class="text-gray-600">Hello,</p>
            <h4 class="text-gray-800 font-medium"><?= $this->session->userdata('nama') ?></h4>
        </div>
    </div>
    <?php $uri = $this->uri->segment(2) ?> 
    <div class="mt-6 bg-white shadow rounded p-4 divide-y divide-gray-200 space-y-4 text-gray-600">
        <div class="space-y-1 pl-8">
            <a href="<?= base_url('customer') ?>" class="relative block capitalize transition hover:text-primary <?php if($uri==NULL){ echo "text-primary"; } ?>"> Biodata </a>
            <a href="<?= base_url('customer/password') ?>" class="relative block capitalize transition hover:text-primary <?php if($uri=='password'){ echo "text-primary"; } ?>"> Ganti Password</a>
        </div>
        <div class="space-y-1 pl-8 pt-4">
            <a href="<?= base_url('customer/keranjang') ?>" class="relative block capitalize transition hover:text-primary <?php if($uri=='keranjang'){ echo "text-primary"; } ?>"> Keranjang</a>
            <a href="<?= base_url('customer/pesanan') ?>" class="relative block capitalize transition hover:text-primary <?php if($uri=='pesanan'){ echo "text-primary"; } ?>"> Pesanan</a>
        </div>
        <div class="space-y-1 pl-8 pt-4">
            <a href="<?= base_url('login/logout') ?>" class="relative hover:text-primary block font-medium capitalize transition">
                Logout
            </a>
        </div>
    </div>
</div>
<!-- ./sidebar -->