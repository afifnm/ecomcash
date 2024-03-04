<div id="myalert">
	<?php echo $this->session->flashdata('notifikasi', true)?>
</div>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview"
		class="button mr-auto inline-block bg-theme-1 text-white">Tambah Penjualan </a>
	<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		<a href="javascript:;" data-toggle="modal" data-target="#nota"
			class="button mr-1 inline-block bg-theme-1 text-white">Cek Nota </a>
		<a href="javascript:;" data-toggle="modal" data-target="#import"
			class="button mr-1 inline-block bg-theme-1 text-white">Laporan Penjualan</a>
	</div>
</div>
<div class="grid grid-cols-12 gap-6">
	<div class="col-span-9 grid grid-cols-12 gap-6">
		<!-- BEGIN: General Report -->
		<div class="col-span-12 md:col-span-12 mt-8">
			<div class="grid grid-cols-12 gap-6">
				<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
					<div class="report-box zoom-in">
						<div class="box p-5">
							<div class="text-2xl font-bold leading-8 mt-6">Rp. <?= number_format($hari_ini) ?></div>
							<div class="text-base text-gray-600 mt-1">penjualan hari ini</div>
						</div>
					</div>
				</div>
				<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
					<div class="report-box zoom-in">
						<div class="box p-5">
							<div class="text-2xl font-bold leading-8 mt-6">Rp. <?= number_format($bulan_ini) ?></div>
							<div class="text-base text-gray-600 mt-1">penjualan bulan ini</div>
						</div>
					</div>
				</div>
				<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
					<div class="report-box zoom-in">
						<div class="box p-5">
							<div class="text-4xl font-bold leading-8 mt-6"><?= $bulan ?></div>
							<div class="text-base text-gray-600 mt-1">transaksi (bulan ini)</div>
						</div>
					</div>
				</div>
				<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
					<div class="report-box zoom-in">
						<div class="box p-5">
							<div class="text-4xl font-bold leading-8 mt-6"><?= $produk ?></div>
							<div class="text-base text-gray-600 mt-1">produk</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-span-8">
			<?php 
			$bulan_now =  date('Y-m');
			$this->db->select('sum(total_harga) as total')->from('penjualan');
			$this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $bulan_now);
			$total_now = $this->db->get()->row()->total;

			$bulan_1 =  date('Y-m',strtotime("-1 Months"));
			$this->db->select('sum(total_harga) as total')->from('penjualan');
			$this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $bulan_1);
			$total_1 = $this->db->get()->row()->total;

			$bulan_2 =  date('Y-m',strtotime("-2 Months"));
			$this->db->select('sum(total_harga) as total')->from('penjualan');
			$this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $bulan_2);
			$total_2= $this->db->get()->row()->total;

			$bulan_3 =  date('Y-m',strtotime("-3 Months"));
			$this->db->select('sum(total_harga) as total')->from('penjualan');
			$this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $bulan_3);
			$total_3 = $this->db->get()->row()->total;

			$bulan_4 =  date('Y-m',strtotime("-4 Months"));
			$this->db->select('sum(total_harga) as total')->from('penjualan');
			$this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $bulan_4);
			$total_4 = $this->db->get()->row()->total;

			$bulan_5 =  date('Y-m',strtotime("-5 Months"));
			$this->db->select('sum(total_harga) as total')->from('penjualan');
			$this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $bulan_5);
			$total_5 = $this->db->get()->row()->total;
			if($total_now==NULL){ $total_now = 0;}
			if($total_1==NULL){ $total_1 = 0;}
			if($total_2==NULL){ $total_2 = 0;}
			if($total_3==NULL){ $total_3 = 0;}
			if($total_4==NULL){ $total_4 = 0;}
			if($total_5==NULL){ $total_5 = 0;}
			
			$nama_now =  date('F');
			$nama_1 =  date('F',strtotime("-1 Months"));
			$nama_2 =  date('F',strtotime("-2 Months"));
			$nama_3 =  date('F',strtotime("-3 Months"));
			$nama_4 =  date('F',strtotime("-4 Months"));
			$nama_5 =  date('F',strtotime("-5 Months"));
			?>
			<div class="intro-y datatable-wrapper box mt-2 p-5">
				<canvas id="myChart" style="width:100%;max-width:600px"></canvas>
				<script>
				const xValues = ["<?= $nama_5 ?>", "<?= $nama_4 ?>", "<?= $nama_3 ?>", "<?= $nama_2 ?>", "<?= $nama_1 ?>", "<?= $nama_now ?>"];
				const yValues = [<?= $total_5; ?>, <?= $total_4; ?>, <?= $total_3; ?>, <?= $total_2; ?>, <?= $total_1; ?>,<?= $total_now; ?>];
				const barColors = ["red", "green","blue","orange","brown","pink"];
				new Chart("myChart", {
				type: "bar",
				data: {
					labels: xValues,
					datasets: [{
					backgroundColor: barColors,
					data: yValues
					}]
				},
				options: {
					legend: {display: false},
					title: {
					display: true,
					text: "Penjualan 5 Bulan Terakhir"
					}
				}
				});
				</script>
			</div>
		</div>
		<div class="col-span-4 mt-1">
			<div class="grid grid-cols-12 gap-6">
				<div class="col-span-12 intro-y">
										<?php foreach($produk5 as $aa){ ?>
						<div class="intro-x">
							<div class="box px-5 py-3 mb-3 flex items-center zoom-in">
								<div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
									<img src="<?= base_url('assets/') ?>dist/images/profile-14.jpg">
								</div>
								<div class="ml-4 mr-auto">
									<div class="font-small"><?= $aa['nama'] ?></div>
									<div class="text-gray-600 text-xs">#<?= $aa['kode_produk'] ?></div>
								</div>
								<div class="text-theme-9 text-right"><?= $aa['total'] ?></div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-span-3 xxl:border-l border-theme-5 -mb-10 pb-10">
		<div class="xxl:pl-6 grid grid-cols-12 gap-6">
			<!-- BEGIN: Transactions -->
			<div class="col-span-12 mt-3">
				<div class="mt-5">
					<?php foreach($recent as $aa){ ?>
					<a href="<?= base_url('penjualan/invoice/'.$aa['kode_penjualan']) ?>">
						<div class="intro-x">
							<div class="box px-5 py-3 mb-3 flex items-center zoom-in">
								<div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
									<img src="<?= base_url('assets/') ?>dist/images/profile-14.jpg">
								</div>
								<div class="ml-4 mr-auto">
									<div class="font-small"><?= $aa['nama'] ?></div>
									<div class="text-gray-600 text-xs">#<?= $aa['kode_penjualan'] ?></div>
								</div>
								<div class="text-theme-9 text-right">Rp. <?= number_format($aa['total_harga']) ?></div>
							</div>
						</div>
					</a>
					<?php } ?>
					<a href="<?= base_url('penjualan') ?>"
						class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 text-theme-16">Lihat
						Transaksi Bulan Ini</a>
				</div>
			</div>
			<!-- END: Transactions -->
		</div>
	</div>
</div>







<div class="modal" id="import">
	<div class="modal__content modal__content--lg">
		<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
			<h2 class="font-medium text-base mr-auto">LAPORAN</h2>
		</div>
		<form action="<?php echo site_url('penjualan/laporan');?>" target="_blank">
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
<div class="modal" id="nota">
	<div class="modal__content modal__content--lg">
		<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
			<h2 class="font-medium text-base mr-auto">CEK NOTA</h2>
		</div>
		<form action="<?php echo site_url('penjualan/cek/');?>" method="GETS">
			<div class="intro-y box p-5">
				<div class="mt-3">
					<label>Masukan nomor nota</label>
					<div class="relative mt-2">
						<input type="text" name="kode_penjualan" class="input w-full border col-span-4" required>
					</div>
				</div>
			</div>
			<div class="px-5 py-3 text-right border-t border-gray-200">
				<button type="submit" class="button w-30 bg-theme-1 text-white">Tampilkan</button>
			</div>
		</form>
	</div>
</div>
<div class="modal" id="header-footer-modal-preview">
	<div class="modal__content modal__content--xl p-2 text-center">
		<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
			<h2 class="font-medium text-base mr-auto">PILIH PELANGGAN </h2>
		</div>
		<div class="intro-y datatable-wrapper box p-1 mt-5">
			<table class="table table-report table-report--bordered display datatable w-full" style="font-size: 12px;">
				<thead>
					<tr>
						<th class="border-b-2 whitespace-no-wrap">NO </th>
						<th class="border-b-2 whitespace-no-wrap">NAMA </th>
						<th class="border-b-2 whitespace-no-wrap">ALAMAT </th>
						<th class="border-b-2 whitespace-no-wrap text-right">TELP </th>
						<th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
					</tr>
				</thead>
				<tbody>
					<?php  $no = 1; foreach ($pelanggan as $row) {?>
					<tr>
						<td class="text-left border-b"><?= $no; ?></td>
						<td class="text-left border-b"><?= $row['nama']; ?></td>
						<td class="text-left border-b"><?= $row['alamat']; ?></td>
						<td class="text-right border-b"><?= $row['telp']; ?></td>
						<td class="border-b w-5">
							<div class="flex sm:justify-center items-center">
								<a href="<?= base_url('penjualan/transaksi/'.$row['id_pelanggan']) ?>"
									class="flex items-center text-theme-1">
									<i data-feather="play" class="w-4 h-4 mr-1 ml-2"></i> pilih
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