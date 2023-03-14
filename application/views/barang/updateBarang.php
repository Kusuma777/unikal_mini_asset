	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Content Row -->
		<div class="card col-8 mx-auto mt-5">
			<div class="card-title">
				<h1 class="h3 mt-5 text-center text-gray-800"><?= $title; ?></h1>
			</div>
			<img src="<?= base_url('assets/foto/') . $barang['file_foto']; ?>" width="100" alt="" class="mx-auto mb-2 shadow">

			<div class="row">
				<div class="col">
					<form action="<?= base_url('dataBarang/updateDataAksi'); ?>" method="post" enctype="multipart/form-data">
						<div class="col-lg-10 mx-auto mb-5">
							<input type="hidden" name="id_barang" value="<?= $barang['id_barang']; ?>">
							<div class="form-group mx-auto">
								<label for="">Nama Barang</label>
								<select name="id_jenis" class="form-control" value="<?= $barang['id_jenis']; ?>" id="">
									<?php foreach ($jenis as $j) : ?>
										<?php if ($j['id_jenis'] == $barang['id_jenis']) { ?>
											<option selected value="<?= $j['id_jenis']; ?>"><?= $j['nama_jenis']; ?></option>
										<?php } else { ?>
											<option value="<?= $j['id_jenis']; ?>"><?= $j['nama_jenis']; ?></option>
										<?php } ?>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group mx-auto">
								<label for="">Nama Barang</label>
								<input type="text" name="nama_barang" value="<?= $barang['nama_barang']; ?>" class="form-control">
								<div class="text-small text-danger"><?= form_error('nama_barang'); ?></div>
							</div>
							<div class="form-group mx-auto">
								<label for="">Stok</label>
								<input type="number" name="stok" value="<?= $barang['stok']; ?>" class="form-control">
								<div class="text-small text-danger"><?= form_error('stok'); ?></div>
							</div>
							<div class="form-group mx-auto">
								<label for="">Keterangan</label>
								<textarea name="keterangan" id="" class="form-control" cols="20" rows="5"><?= $barang['keterangan']; ?></textarea>
								<div class="text-small text-danger"><?= form_error('keterangan'); ?></div>
							</div>
							<div>
								<label for="">Foto Barang</label>
								<div class="custom-file mb-2">
									<input type="file" class="custom-file-input" value="<?= set_value('file_foto'); ?>" name="file_foto" id="customFile">
									<label class="custom-file-label" for="customFile">Choose file</label>
								</div>
							</div>
							<input type="hidden" name="status">
							<button type="submit" class="btn btn-sm btn-primary mt-2">Ubah Data</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- End of Main Content -->
