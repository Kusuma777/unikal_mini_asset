<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Content Row -->
	<div class="card col-8 mx-auto mt-5">
		<div class="card-title">
			<h1 class="h3 mt-4 text-center text-gray-800"><?= $title; ?></h1>
		</div>

		<div class="row">
			<div class="col">
				<form action="<?= base_url('detailPeminjaman/tambahDataAksi'); ?>" method="post" enctype="multipart/form-data">
					<div class="col-lg-10 mx-auto mb-5">
						<div class="form-group mx-auto">
							<label for="">Nama Peminjam</label>
							<select name="id_peminjaman" value="<?= set_value('id_peminjaman'); ?>" class="form-control" id="">
								<option value="">Pilih Peminjam</option>
								<?php foreach ($peminjaman as $p) : ?>
									<option value="<?= $p['id_peminjaman']; ?>"><?= $p['nama_peminjam']; ?></option>
								<?php endforeach; ?>
							</select>
							<div class="text-small text-danger"><?= form_error('id_peminjaman'); ?></div>
						</div>
						<div class="form-group mx-auto">
							<label for="">Jenis Barang</label>
							<select name="id_jenis" value="<?= set_value('id_jenis'); ?>" class="form-control" id="">
								<option value="">Pilih Jenis Barang</option>
								<?php foreach ($jenis as $j) : ?>
									<option value="<?= $j['id_jenis']; ?>"><?= $j['nama_jenis']; ?></option>
								<?php endforeach; ?>
							</select>
							<div class="text-small text-danger"><?= form_error('id_jenis'); ?></div>
						</div>
						<div class="form-group mx-auto">
							<label for="">Nama Barang</label>
							<select name="id_barang" value="<?= set_value('id_barang'); ?>" class="form-control" id="">
								<option value="">Pilih Jenis Barang</option>
								<?php foreach ($barang as $b) : ?>
									<option value="<?= $b['id_barang']; ?>"><?= $b['nama_barang']; ?></option>
								<?php endforeach; ?>
							</select>
							<div class="text-small text-danger"><?= form_error('id_jenis'); ?></div>
						</div>
						<div>
							<label for="">Foto peminjaman</label>
							<div class="custom-file mb-2">
								<input type="file" class="custom-file-input" value="<?= set_value('foto_peminjaman'); ?>" name="foto_peminjaman" id="customFile" required>
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
						</div>
						<button type="submit" class="btn btn-primary mt-3">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- End of Main Content -->
