	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Content Row -->
		<div class="card col-8 mx-auto mt-5">
			<div class="card-title">
				<h1 class="h3 mt-5 text-center text-gray-800"><?= $title; ?></h1>
			</div>

			<div class="row">
				<div class="col">
					<form action="<?= base_url('dataBarang/tambahDataAksi'); ?>" method="post" enctype="multipart/form-data">
						<div class="col-lg-10 mx-auto mb-5">
							<div class="form-group mx-auto">
								<label for="">Nama Jenis Barang</label>
								<select name="id_jenis" value="<?= set_value('id_jenis'); ?>" class="form-control" id="">
									<option value="">Pilih Jenis Barang</option>
									<?php foreach ($barang as $b) : ?>
										<option value="<?= $b['id_jenis']; ?>"><?= $b['nama_jenis']; ?></option>
									<?php endforeach; ?>
								</select>
								<div class="text-small text-danger"><?= form_error('id_jenis'); ?></div>
							</div>
							<div class="form-group mx-auto">
								<label for="">Nama Barang</label>
								<input type="text" name="nama_barang" value="<?= set_value('nama_barang'); ?>" class="form-control">
								<div class="text-small text-danger"><?= form_error('nama_barang'); ?></div>
							</div>
							<div class="form-group mx-auto">
								<label for="">Stok</label>
								<input type="text" name="stok" value="<?= set_value('stok'); ?>" class="form-control">
								<div class="text-small text-danger"><?= form_error('stok'); ?></div>
							</div>
							<div class="form-group mx-auto">
								<label for="">Keterangan</label>
								<textarea name="keterangan" id="" class="form-control" cols="20" rows="5"><?= set_value('keterangan'); ?></textarea>
								<div class="text-small text-danger"><?= form_error('keterangan'); ?></div>
							</div>
							<div>
								<label for="">Foto Barang</label>
								<div class="custom-file mb-2">
									<input type="file" class="custom-file-input" value="<?= set_value('file_foto'); ?>" name="file_foto" id="customFile" required>
									<label class="custom-file-label" for="customFile">Choose file</label>
								</div>
							</div>
							<input type="hidden" name="status">
							<button type="submit" class="btn btn-primary mt-2">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- End of Main Content -->
