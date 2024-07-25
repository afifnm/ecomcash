<div id="myalert" style="margin-top: 10px;">
	<?php echo $this->session->flashdata('notifikasi', true)?>
</div>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<a href="<?= base_url('admin/pembelian/transaksi/') ?>"
	class="button mr-auto inline-block bg-theme-1 text-white">Tambah Pembelian </a>
	<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		<a href="javascript:;" data-toggle="modal" data-target="#import"
			class="button mr-1 inline-block bg-theme-1 text-white">Laporan Pembelian </a>
	</div>
</div>
<div class="modal" id="import">
	<div class="modal__content modal__content--lg">
		<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
			<h2 class="font-medium text-base mr-auto">LAPORAN</h2>
		</div>
		<form action="<?php echo site_url('admin/pembelian/laporan');?>" target="_blank">
			<div class="intro-y box p-5">
				<div class="mt-3">
					<label>Dari</label>
					<div class="relative mt-2">
						<input type="date" name="tanggal1" class="input w-full border col-span-4" required>
					</div>
				</div>
				<div class="mt-3">
					<label>Sampai</label>
					<div class="relative mt-2">
						<input type="date" name="tanggal2" class="input w-full border col-span-4" required>
					</div>
				</div>
			</div>
			<div class="px-5 py-3 text-right border-t border-gray-200">
				<button type="submit" class="button w-30 bg-theme-1 text-white">Tampilkan</button>
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
				<th class="border-b-2 whitespace-no-wrap">NO PEMBELIAN </th>
				<th class="border-b-2 whitespace-no-wrap">SUPPLIER</th>
				<th class="border-b-2 whitespace-no-wrap">STATUS </th>
				<th class="border-b-2 whitespace-no-wrap">TANGGAL </th>
				<th class="border-b-2 whitespace-no-wrap text-right">NOMINAL </th>
				<th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
			</tr>
		</thead>
		<tbody>
			<?php  $no = 1; foreach ($user as $row) {?>
			<tr>
				<td class="text-left border-b"><?= $no; ?></td>
				<td class="text-left border-b"><?= $row['kode_pembelian']; ?></td>
				<td class="text-left border-b"><?= $row['supplier']; ?></td>
				<td class="text-left border-b"><?= $row['status']; ?></td>
				<td class="text-left border-b"><?= date_format(date_create($row['tanggal'])," D, d M Y"); ?></td>
				<td class="text-right border-b">Rp. <?= number_format($row['bayar']); ?></td>
				<td class="border-b w-5">
					<div class="flex sm:justify-center items-center">
						<a href="<?= base_url('admin/pembelian/invoice/'.$row['kode_pembelian']) ?>"
							class="flex items-center text-theme-1">
							<i data-feather="file-minus" class="w-4 h-4 mr-1"></i> Invoice
						</a>
						<a href="<?= base_url('assets/bukti/'.$row['bukti']); ?>" class="flex items-center text-theme-1 ml-3" target="_blank">
							<i data-feather="image" class="w-4 h-4 mr-1"></i>
							Bukti Nota </a> 
					</div>
				</td>
			</tr>
			<?php $no++; } ?>
		</tbody>
	</table>
</div>
<div class="modal" id="header-footer-modal-preview">
	<div class="modal__content modal__content--xl">
		<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
			<h2 class="font-medium text-base mr-auto">PILIH PELANGGAN</h2>
		</div>
			<div class="intro-y datatable-wrapper box p-5 mt-5">
				<table class="table table-report table-report--bordered display datatable w-full">
					<thead>
						<tr>
							<th class="border-b-2 whitespace-no-wrap">NO </th>
							<th class="border-b-2 whitespace-no-wrap">NAMA</th>
							<th class="border-b-2 whitespace-no-wrap">ALAMAT </th>
							<th class="border-b-2 whitespace-no-wrap">NO. TELP </th>
							<th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-left border-b">1</td>
							<td class="text-left border-b">-</td>
							<td class="text-left border-b">Bukan Pelanggan</td>
							<td class="text-left border-b">-</td>
							<td class="border-b w-5">
								<div class="flex sm:justify-center items-center">
									<a href="<?= base_url('admin/penjualan/transaksi/1') ?>"
										class="flex items-center text-theme-1">
										<i data-feather="file-minus" class="w-4 h-4 mr-1 ml-2"></i> PILIH
									</a>
								</div>
							</td>
						</tr>
						<?php  $no = 2; foreach ($pelanggan as $row) {?>
						<tr>
							<td class="text-left border-b"><?= $no; ?></td>
							<td class="text-left border-b"><?= $row['nama']; ?></td>
							<td class="text-left border-b"><?= $row['alamat']; ?></td>
							<td class="text-left border-b"><?= $row['telp']; ?></td>
							<td class="border-b w-5">
								<div class="flex sm:justify-center items-center">
									<a href="<?= base_url('admin/penjualan/transaksi/'.$row['id_pelanggan']) ?>"
										class="flex items-center text-theme-1">
										<i data-feather="file-minus" class="w-4 h-4 mr-1 ml-2"></i> PILIH
									</a>
								</div>
							</td>
						</tr>
						<?php $no++; } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>