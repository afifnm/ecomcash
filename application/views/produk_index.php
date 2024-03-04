<div id="myalert" style="margin-top: 10px;">
	<?php echo $this->session->flashdata('notifikasi', true)?>
</div>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview"
		class="button mr-auto inline-block bg-theme-1 text-white">Tambah Produk </a>
	<div class="w-full sm:w-auto flex mt-4 ml-5 sm:mt-0">

		<a href="javascript:;" data-toggle="modal" data-target="#import"
			class="button mr-1 inline-block bg-theme-1 text-white">Import </a>
	</div>
</div>
<div class="modal" id="import">
	<div class="modal__content modal__content--lg">
		<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
			<h2 class="font-medium text-base mr-auto">IMPORT DATA </h2>
		</div>
		<form action="<?php echo site_url('produk/import_excel');?>" method="POST" enctype="multipart/form-data">
			<div class="intro-y box p-5">
				<div class="mt-3">
					<label>Pilih File</label>
					<div class="relative mt-2">
						<input
							accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
							type="file" name="file" id="file" class="input w-full border col-span-4" required>
					</div>
					<br>
					<a href="<?= base_url('assets/format.xlsx') ?>">Download format import</a>
				</div>
			</div>
			<div class="px-5 py-3 text-right border-t border-gray-200">
				<button type="submit" class="button w-20 bg-theme-1 text-white">Simpan</button>
			</div>
		</form>
	</div>
</div>
<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
	<table class="table table-report table-report--bordered display datatable w-full">
		<thead>
			<tr>
				<th class="border-b-2 whitespace-no-wrap">NO </th>
				<th class="border-b-2 whitespace-no-wrap">NAMA </th>
				<th class="border-b-2 whitespace-no-wrap">KODE PRODUK </th>
				<th class="border-b-2 whitespace-no-wrap">STOK </th>
				<th class="border-b-2 whitespace-no-wrap text-right">HARGA </th>
				<th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
			</tr>
		</thead>
		<tbody>
			<?php  $no = 1; foreach ($user as $row) {?>
			<tr>
				<td class="text-left border-b"><?= $no; ?></td>
				<td class="text-left border-b"><?= $row['nama']; ?></td>
				<td class="text-left border-b"><?= $row['kode_produk']; ?></td>
				<td class="text-left border-b"><?= $row['stok']; ?></td>
				<td class="text-right border-b">Rp. <?=  number_format($row['harga']); ?></td>
				<td class="border-b w-5">
					<div class="flex sm:justify-center items-center">
						<a href="javascript:;" onclick="edit(
                                <?php echo $row['id_produk'] ?>,
                                '<?php echo $row['nama'] ?>',
                                '<?php echo $row['kode_produk'] ?>',
                                '<?php echo $row['stok'] ?>',
                                '<?php echo $row['harga'] ?>'
                                )" class="flex items-center mr-3" data-toggle="modal" data-target="#edit-data">
							<i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
						</a>
						<a href="javascript:;" onclick="hapus(<?php echo $row['id_produk'] ?>)"
							class="flex items-center text-theme-6" data-toggle="modal" data-target="#hapus-data">
							<i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
							Delete </a>
					</div>
				</td>
			</tr>
			<?php $no++; } ?>
		</tbody>
	</table>
</div>
<div class="modal" id="header-footer-modal-preview">
	<div class="modal__content">
		<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
			<h2 class="font-medium text-base mr-auto">TAMBAH PRODUK </h2>
		</div>
		<form action="<?php echo site_url('produk/simpan');?>" method="POST">
			<div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
				<div class="col-span-12 sm:col-span-12">
					<label>Nama </label>
					<input type="text" name="nama" required class="input w-full border mt-2 flex-1.">
				</div>
				<div class="col-span-12 sm:col-span-12">
					<label>Kode Produk</label>
					<input type="text" name="kode_produk" class="input w-full border mt-2 flex-1" required>
				</div>
				<div class="col-span-12 sm:col-span-12">
					<label>Stok</label>
					<input type="number" name="stok" class="input w-full border mt-2 flex-1" required>
				</div>
				<div class="col-span-12 sm:col-span-12">
					<label>Harga</label>
					<input type="number" name="harga" class="input w-full border mt-2 flex-1" required>
				</div>
			</div>
			<div class="px-5 py-3 text-right border-t border-gray-200">
				<button type="submit" class="button w-20 bg-theme-1 text-white">Simpan</button>
			</div>
		</form>
	</div>
</div>
<!-- BEGIN: EDIT Confirmation Modal -->
<div class="modal" id="edit-data">
	<div class="modal__content">
		<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
			<h2 class="font-medium text-base mr-auto">PERBARUI PRODUK </h2>
		</div>
		<form action="<?php echo site_url('produk/update');?>" method="POST">
			<input type="hidden" name="id_produk" id="id" class="input w-full border mt-2">
			<div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
				<div class="col-span-12 sm:col-span-12">
					<label>Nama </label>
					<input type="text" name="nama" id="nama" class="input w-full border mt-2 flex-1.">
				</div>
				<div class="col-span-12 sm:col-span-12">
					<label>Kode Produk</label>
					<input type="text" name="kode_produk" class="input w-full border mt-2 flex-1" id="kode_produk"
						readonly>
				</div>
				<div class="col-span-12 sm:col-span-12">
					<label>Stok</label>
					<input type="number" name="stok" class="input w-full border mt-2 flex-1" id="stok">
				</div>
				<div class="col-span-12 sm:col-span-12">
					<label>Harga</label>
					<input type="number" name="harga" class="input w-full border mt-2 flex-1" id="harga">
				</div>
			</div>
			<div class="px-5 py-3 text-right border-t border-gray-200">
				<button type="submit" class="button w-20 bg-theme-1 text-white">Simpan</button>
			</div>
		</form>
	</div>
</div>
<!-- END: EDIT Confirmation Modal -->
<!-- BEGIN: Delete Confirmation Modal -->
<div class="modal" id="hapus-data">
	<div class="modal__content">
		<div class="p-5 text-center">
			<i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
			<div class="text-3xl mt-5">Apakah kamu yakin?</div>
			<div class="text-gray-600 mt-2">Apakah Anda benar-benar ingin menghapus data ini? Proses
				ini tidak bisa dibatalkan.</div>
		</div>
		<div class="px-5 pb-8 text-center">
			<button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Batal</button>
			<a id="link_hapus" href="" class=" button w-24
				bg-theme-6 text-white">Hapus</a>
		</div>
	</div>
</div>
<!-- END: Delete Confirmation Modal -->
<script>
	function edit(id, nama, kode_produk, stok, harga) {
		document.getElementById('id').value = id;
		document.getElementById('nama').value = nama;
		document.getElementById('kode_produk').value = kode_produk;
		document.getElementById('stok').value = stok;
		document.getElementById('harga').value = harga;
	};

	function hapus(id) {
		var link = document.getElementById('link_hapus');
		link.href = "<?php echo site_url('produk/hapus/');?>" + id;
	};
</script>
