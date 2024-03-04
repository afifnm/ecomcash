<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $penjualan->kode_penjualan; ?></title>
</head>
<body>
	================================ <br>
	<?= $profil->nama_cv; ?> <br>
	<?= $profil->alamat; ?> <br>
	No. Telp <?= $profil->telp; ?> <br>
	================================ <br>
	<table>
		<tr>
			<td>No. Nota</td>
			<td> : <?= $penjualan->kode_penjualan; ?></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td> : <?= date_format(date_create($penjualan->tanggal)," D, d M Y"); ?></td>
		</tr>
		<tr>
			<td>Pelanggan</td>
			<td> : <?= $penjualan->nama; ?></td>
		</tr>
	</table>
	================================ <br>
	<table>
		<?php $total=0; $no=1; $jumlah =0; foreach($detail as $row){ ?>
		<tr>
			<td colspan=3><?= $row['nama'] ?></td>
		</tr>
		<tr>
			<td><?= $row['jumlah'] ?> PCS</td>
			<td style="text-align: right;"> Rp. <?= number_format($row['harga']) ?> </td>
			<td style="text-align: right;"> Rp. <?=  number_format($row['jumlah']*$row['harga']) ?> </td>
		</tr>
		<?php $jumlah=$jumlah+$row['jumlah']; $total=$total+$row['jumlah']*$row['harga']; $no++; } ?>
	</table>
	================================ <br>
	<table>
		<tr>
			<td>Total</td>
			<td style="text-align: right;"> : Rp. <?= number_format($total); ?></td>
		</tr>
		<tr>
			<td>Bayar</td>
			<td style="text-align: right;"> : Rp. <?= number_format($penjualan->bayar); ?></td>
		</tr>
		<tr>
			<td>Kembali</td>
			<td style="text-align: right;"> : Rp. <?= number_format($penjualan->bayar-$total); ?></td>
		</tr>
	</table>
	================================ <br>
	Jumlah Item : <?= $jumlah ?> PCS <br>
	================================ <br>
	--- TERIMA KASIH --- <br>
	================================ <br>
	<script>
		window.print();
	</script>
</body>
</html>