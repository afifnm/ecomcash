<div id="myalert" style="margin-top: 10px;">
	<?php echo $this->session->flashdata('notifikasi', true)?>
</div>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview"
		class="button inline-block bg-theme-1 text-white mr-auto">Tambah Pengguna </a>
</div>
<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
	<table class="table table-report table-report--bordered display datatable w-full">
		<thead>
			<tr>
				<th class="border-b-2 whitespace-no-wrap">NO </th>
				<th class="border-b-2 whitespace-no-wrap">NAMA </th>
				<th class="border-b-2 whitespace-no-wrap">USERNAME </th>
				<th class="border-b-2 whitespace-no-wrap">LEVEL </th>
				<th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
			</tr>
		</thead>
		<tbody>
			<?php  $no = 1; foreach ($data2 as $user) {?>
			<tr>
				<td class="text-left border-b"><?= $no; ?></td>
				<td class="text-left border-b"><?= $user['nama']; ?></td>
				<td class="text-left border-b"><?= $user['username']; ?></td>
				<td class="text-left border-b"><?= $user['level']; ?></td>
				<td class="border-b w-5">
					<div class="flex sm:justify-center items-center">
						<a href="javascript:;" onclick="edit(
                                <?php echo $user['id_user'] ?>,
                                '<?php echo $user['nama'] ?>',
                                '<?php echo $user['username'] ?>',
                                '<?php echo $user['level'] ?>'
                                )" class="flex items-center mr-3" data-toggle="modal" data-target="#edit-data">
							<i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
						</a>
						<?php if($no>1){ ?>
						<a href="javascript:;" onclick="hapus(<?php echo $user['id_user'] ?>)"
							class="flex items-center text-theme-6" data-toggle="modal" data-target="#hapus-data">
							<i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
							Delete </a>
						<?php } ?>
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
			<h2 class="font-medium text-base mr-auto">TAMBAH PENGGUNA </h2>
		</div>
		<form action="<?php echo site_url('admin/pengguna/simpan');?>" method="POST">
			<div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
				<div class="col-span-12 sm:col-span-12"><label>Nama </label><input type="text" name="nama" required
						class="input w-full border mt-2 flex-1" placeholder="masukan nama ..."> </div>
				<div class="col-span-12 sm:col-span-12"><label>Username</label><input type="text" name="username"
						class="input w-full border mt-2 flex-1" placeholder="username ..."> </div>
				<div class="col-span-12 sm:col-span-12"><label>Password</label><input type="password" name="password"
						class="input w-full border mt-2 flex-1" placeholder="password ..."> </div>
				<div class="col-span-12 sm:col-span-12"><label>Level</label>
					<select name="level" class="input w-full border mt-2 flex-1">
						<option value="Admin">Admin</option>
						<option value="Kasir">Kasir</option>
					</select>
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
			<h2 class="font-medium text-base mr-auto">PERBARUI PENGGUNA </h2>
		</div>
		<form action="<?php echo site_url('admin/pengguna/update');?>" method="POST">
			<input type="hidden" name="id" id="id" class="input w-full border mt-2">
			<div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
				<div class="col-span-12 sm:col-span-12">
					<label>Nama </label>
					<input type="text" name="nama" id="nama" class="input w-full border mt-2 flex-1">
				</div>
				<div class="col-span-12 sm:col-span-12">
					<label>Username</label>
					<input type="text" name="username" class="input w-full border mt-2 flex-1" id="username" readonly>
				</div>
				<div class="col-span-12 sm:col-span-12"><label>Level</label>
					<select name="level" class="input w-full border mt-2 flex-1">
						<option value="Admin" id="admin">Admin</option>
						<option value="Kasir" id="kasir">Kasir</option>
					</select>
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
	function edit(id, nama, username, level) {
		document.getElementById('id').value = id;
		document.getElementById('nama').value = nama;
		document.getElementById('username').value = username;
		if (level == 'Admin') {
			document.getElementById("admin").selected = "true";
		} else {
			document.getElementById("kasir").selected = "true";
		}
	};

	function hapus(id) {
		var link = document.getElementById('link_hapus');
		link.href = "<?php echo site_url('admin/pengguna/hapus/');?>" + id;
	};
</script>
