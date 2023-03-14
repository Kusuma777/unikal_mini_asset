	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Content Row -->
		<div class="card col-8 mx-auto mt-5">
			<div class="card-title">
				<h1 class="h3 mt-4 text-center text-gray-800"><?= $title; ?></h1>
			</div>

			<div class="row">
				<div class="col">
					<form action="<?= base_url('detailPeminjaman/updateDataAksi'); ?>" method="post" enctype="multipart/form-data">
						<div class="col-lg-10 mx-auto mb-5">
							<input type="hidden" name="id_peminjaman_detail" value="<?= $detail['id_peminjaman_detail']; ?>">
							<div class="form-group mx-auto">
								<label for="">Nama Peminjam</label>
								<input type="text" disabled value="<?= $detail['nama_peminjam']; ?>" class="form-control">
								<!-- <div class="text-small text-danger"><?= form_error('id_peminjaman'); ?></div> -->
							</div>
							<div class="form-group mx-auto">
								<label for="">Jenis Barang</label>
								<select name="id_jenis" class="form-control" value="<?= $detail['id_jenis']; ?>" \ id="">
									<option value="">Pilih Jenis Barang</option>
									<?php foreach ($jenis as $j) : ?>
										<?php if ($j['id_jenis'] == $detail['id_jenis']) { ?>
											<option value="<?= $j['id_jenis']; ?>" selected><?= $j['nama_jenis']; ?></option>
										<?php } else { ?>
											<option value="<?= $detail['id_jenis']; ?>"><?= $j['nama_jenis']; ?></option>
										<?php } ?>
									<?php endforeach; ?>
								</select>
								<div class="text-small text-danger"><?= form_error('id_jenis'); ?></div>
							</div>
							<div class="form-group mx-auto">
								<label for="">Jenis Barang</label>
								<select name="id_barang" class="form-control" value="<?= $detail['id_barang']; ?>" id="">
									<option value="">Pilih Jenis Barang</option>
									<?php foreach ($barang as $b) : ?>
										<?php if ($b['id_barang'] == $detail['id_barang']) { ?>
											<option selected value="<?= $b['id_barang']; ?>"><?= $b['nama_barang']; ?></option>
										<?php } else { ?>
											<option value="<?= $b['id_barang']; ?>"><?= $b['nama_barang']; ?></option>
										<?php } ?>
									<?php endforeach; ?>
								</select>
								<div class="text-small text-danger"><?= form_error('id_barang'); ?></div>
							</div>
							<div>
								<label for="">Foto Peminjaman</label>
								<div class="custom-file mb-2">
									<input type="file" class="custom-file-input" name="foto_peminjaman" value="<?= $detail['foto_peminjaman']; ?>" id="customFile">
									<label class="custom-file-label" for="customFile">Choose file</label>
								</div>
								<img src="<?= base_url('assets/foto/') . $detail['foto_peminjaman']; ?>" width="200" alt="">
							</div>
							<input type="hidden" class="custom-file-input" name="foto_pengembalian" value="<?= $detail['foto_pengembalian']; ?>" id="customFile">
							<img src="<?= base_url('assets/foto/') . $detail['foto_pengembalian']; ?>" width="200" alt="">

							<button type="submit" class="btn btn-sm btn-primary mt-4">Ubah data</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- End of Main Content -->
