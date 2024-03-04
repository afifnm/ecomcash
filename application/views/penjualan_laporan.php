<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		.a {
			padding: 4px;
		}
		td {
            vertical-align: top;
			font-size : 12px;
		}
		th {
            vertical-align: top;
			font-size : 12px;
			padding: 4px;
		}
	</style>
</head>

<body>
	<center>
		<h3> Penjualan dari tanggal <?= date_format(date_create($tanggal1)," d M Y"); ?> sampai
			<?= date_format(date_create($tanggal2)," d M Y"); ?></h3>
		<table border=2>
			<thead>
				<tr>
					<th>NO </th>
					<th>NO NOTA </th>
					<th>TANGGAL </th>
					<th>PELANGGAN </th>
					<th width=300>DESKRIPSI </th>
					<th>TOTAL </th>
				</tr>
			</thead>
			<tbody>
				<?php $total=0;  $no = 1; foreach ($penjualan as $row) {?>
				<tr>
					<td class="a"><?= $no; ?></td>
					<td class="a"><?= $row['kode_penjualan']; ?></td>
					<td class="a"><?= date_format(date_create($row['tanggal']),"d M Y"); ?></td>
					<td class="a"><?= $row['nama']; ?></td>
					<td>
						<?php
                        $this->db->from('detail_penjualan a');
                        $this->db->join('produk b','a.id_produk=b.id_produk','left');
                        $this->db->where('a.kode_penjualan',$row['kode_penjualan']);
                        $detail = $this->db->get()->result_array();
                    ?>
						<table>
							<?php $total=0; $no2=1; $jumlah =0; foreach($detail as $aa){ ?>
							<tr>
								<td width=150><?= $aa['nama'] ?></td>
								<td width=40><?= $aa['jumlah'] ?> PCS</td>
								<td style="text-align: right;" width=50><?= number_format($aa['harga']) ?> </td>
								<td style="text-align: right;" width=50><?=  number_format($aa['jumlah']*$aa['harga']) ?>
								</td>
							</tr>
							<?php $no2++; } ?>
						</table>
					</td>
					<td style="text-align: right;" class="a"><?= number_format($row['total_harga']); ?></td>
				</tr>
				<?php $no++; $total=$total+$row['total_harga'];} ?>
				<tr>
					<td colspan="5">-</td>
					<td style="text-align: right;"><?= number_format($total); ?></td>
				</tr>
			</tbody>
		</table>
	</center>
	<script>
		window.print();
	</script>
</body>

</html>