<div id="myalert" style="margin-top: 10px;">
	<?php echo $this->session->flashdata('notifikasi', true)?>
</div>
<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
	<table class="table table-report table-report--bordered display datatable w-full">
		<thead>
			<tr>
				<th class="border-b-2 whitespace-no-wrap">NO </th>
				<th class="border-b-2 whitespace-no-wrap">NO NOTA </th>
				<th class="border-b-2 whitespace-no-wrap">PEMBELI</th>
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
				<td class="text-left border-b"><?= $row['kode_penjualan']; ?></td>
				<td class="text-left border-b"><?= $row['nama']; ?></td>
				<td class="text-left border-b"><?= $row['status']; ?></td>
				<td class="text-left border-b"><?= date_format(date_create($row['tanggal'])," D, d M Y"); ?></td>
				<td class="text-right border-b">Rp. <?= number_format($row['total_harga']); ?></td>
				<td class="border-b w-5">
					<div class="flex sm:justify-center items-center">
						<a href="<?= base_url('admin/pesanan/cek/'.$row['kode_penjualan']) ?>"
							class="flex items-center text-theme-1">
							<i data-feather="file-minus" class="w-4 h-4 mr-1"></i> Cek Pesanan
						</a>
						<?php if($row['pembayaran']=="Transfer"){ ?>
						<a href="<?= base_url('assets/bukti/'.$row['bukti']); ?>" class="flex items-center text-theme-1 ml-3" target="_blank">
							<i data-feather="image" class="w-4 h-4 mr-1"></i>
							Bukti Transfer </a> 
						<?php } ?>
					</div>
				</td>
			</tr>
			<?php $no++; } ?>
		</tbody>
	</table>
</div>