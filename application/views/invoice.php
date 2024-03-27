<div class="intro-y box overflow-hidden mt-5">
	<div class="border-b border-gray-200 text-center sm:text-left">
		<div class="px-5 py-10 sm:px-10 sm:py-10">
			<div class="text-theme-1 font-semibold text-3xl">INVOICE</div>
			<a href="<?= base_url('penjualan/nota/'.$penjualan->kode_penjualan); ?>" target="_blank"
			class="button inline-block bg-theme-1 text-white float-right">Cetak Nota </a>
			<div class="mt-2"> Nomor Nota <span class="font-medium">#<?= $nota ?></span> </div>
			<div class="mt-1">
				<?php
                $date=date_create($penjualan->tanggal);
                echo date_format($date,"D, d M Y");
                ?>
			</div>
		</div>
		<div class="flex flex-col lg:flex-row px-5 sm:px-10 pt-10 pb-10 sm:pb-10">
			<div class="">
				<div class="text-base text-gray-600"><?= $profil->nama_cv ?></div>
				<div class="text-lg font-medium text-theme-1 mt-2"><?= $profil->telp ?></div>
				<div class="mt-1"><?= $profil->email ?></div>
				<div class="mt-1"><?= $profil->alamat ?></div>
			</div>
		</div>
	</div>
	<div class="px-5 sm:px-16 py-10 sm:py-20">
		<div class="overflow-x-auto">
			<table class="table">
				<thead>
					<tr>
						<th class="border-b-2 whitespace-no-wrap">PRODUK</th>
						<th class="border-b-2 text-right whitespace-no-wrap">JUMLAH</th>
						<th class="border-b-2 text-right whitespace-no-wrap">HARGA</th>
						<th class="border-b-2 text-right whitespace-no-wrap">SUBTOTAL</th>
					</tr>
				</thead>
				<tbody>
					<?php $total=0; $no=1; foreach($detail as $row){ ?>
					<tr>
						<td class="border-b">
							<div class="font-medium whitespace-no-wrap"><?= $row['nama'] ?></div>
							<div class="text-gray-600 text-xs whitespace-no-wrap"><?= $row['kode_produk'] ?></div>
						</td>
						<td class="text-right border-b w-32"><?= $row['jumlah'] ?></td>
						<td class="text-right border-b w-32">Rp. <?= number_format($row['harga']) ?></td>
						<td class="text-right border-b w-32 font-medium">Rp.
							<?=  number_format($row['jumlah']*$row['harga']) ?></td>
					</tr>
					<?php $total=$total+$row['jumlah']*$row['harga']; $no++; } ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="px-5 sm:px-20 pb-10 sm:pb-20 flex flex-col-reverse sm:flex-row">
		<div class="text-center sm:text-left mt-10 sm:mt-0">
			<div class="text-base text-gray-600">Dibayar</div>
			<div class="text-xl text-theme-1 font-medium mt-2">Rp. <?= number_format($penjualan->bayar) ;?></div>
		</div>
		<div class="text-center sm:text-right sm:ml-auto">
			<div class="text-base text-gray-600">Total Tagihan</div>
			<div class="text-xl text-theme-1 font-medium mt-2">Rp. <?= number_format($total) ;?></div>
		</div>
	</div>
</div>