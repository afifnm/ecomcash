<div id="myalert" style="margin-top: 10px;">
	<?php echo $this->session->flashdata('notifikasi', true)?>
</div>
<div class="grid grid-cols-12 gap-6 mt-10">
	<div class="intro-y col-span-12 lg:col-span-6">
		<!-- BEGIN: Keranjang -->
		<div class="intro-y box">
			<div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
				<h2 class="font-medium text-base mr-auto">
					Profile 
				</h2>
			</div>
			<div class="p-5">
				<form action="<?= base_url('auth/update') ?>" method="post">
					<input type="hidden" name="id" value="1">
					<div class="preview">
                    <div class="mt-1">
							<label>Nama CV</label>
							<input type="text" name="nama_cv" class="input w-full border mt-2" value="<?= $profil->nama_cv ?>" required>
						</div>
                        <div class="mt-1">
							<label>Alamat/label>
							<input type="text" name="alamat" class="input w-full border mt-2" value="<?= $profil->alamat ?>" required>
						</div>
                        <div class="mt-1">
							<label>Nomor Telp</label>
							<input type="text" name="telp" class="input w-full border mt-2" value="<?= $profil->telp ?>" required>
						</div>
                        <div class="mt-1">
							<label>Email</label>
							<input type="text" name="email" class="input w-full border mt-2" value="<?= $profil->email ?>" required>
						</div>
						<div class="mt-5">
							<button
								class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white w-full">
								<i data-feather="save" class="w-4 h-4 mr-2"></i> Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- END: Keranjang -->
	</div>
</div>