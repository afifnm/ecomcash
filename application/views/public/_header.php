<!-- header -->
<header class="py-4 shadow-sm bg-white">
    <div class="container flex items-center justify-between">
        <a href="<?= base_url('beranda')?>">
            <img src="<?= base_url('assets/logo.png')?>" alt="Logo" class="w-14">
        </a>
        <div class="w-full max-w-xl relative flex">
            <span class="absolute left-4 top-3 text-lg text-gray-400">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text" name="pencarian" id="search"
                class="w-full border border-primary border-r-0 pl-12 py-3 pr-3 rounded-l-md focus:outline-none hidden md:flex"
                placeholder="Cari Produk...">
            <button
                class="bg-primary border border-primary text-white px-8 rounded-r-md hover:bg-transparent hover:text-primary transition hidden md:flex">Pencarian</button>
        </div>
    </div>
</header>