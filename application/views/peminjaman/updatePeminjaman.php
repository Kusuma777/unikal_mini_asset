	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Content Row -->
		<div class="card col-8 mx-auto mt-5">
			<div class="card-title">
				<h1 class="h3 mt-4 text-center text-gray-800"><?= $title; ?></h1>
			</div>

			<form action="<?= base_url('dataPeminjaman/updateDataAksi'); ?>" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col">
						<div class="col-lg-10 mx-auto mb-5">
							<input type="hidden" name="id_peminjaman" value="<?= $peminjaman['id_peminjaman']; ?>">
							<input type="hidden" name="status_peminjaman" value="<?= $peminjaman['status_peminjaman']; ?>">
							<div class="form-group mx-auto">
								<label for="">Nama Peminjam</label>
								<input type="text" name="nama_peminjam" value="<?= $peminjaman['nama_peminjam']; ?>" class="form-control">
								<div class="text-small text-danger"><?= form_error('nama_peminjam'); ?></div>
							</div>
							<div class="form-group mx-auto">
								<label for="">Nomor Telp/Wa</label>
								<input type="number" name="no_telp" value="<?= $peminjaman['no_telp']; ?>" class="form-control">
								<div class="text-small text-danger"><?= form_error('no_telp'); ?></div>
							</div>
							<div class="row">
								<div class="col">
									<div class="form-group mx-auto">
										<label for="">Tanggal Dipinjam</label>
										<input type="date" name="tgl_dipinjam" value="<?= $peminjaman['tgl_dipinjam']; ?>" class="form-control">
										<div class="text-small text-danger"><?= form_error('tgl_dipinjam'); ?></div>
									</div>
								</div>
								<div class="col">
									<div class="form-group mx-auto">
										<label for="">Tanggal Pengembalian</label>
										<input type="date" name="tgl_pengembalian" value="<?= $peminjaman['tgl_pengembalian']; ?>" class="form-control">
										<div class="text-small text-danger"><?= form_error('tgl_pengembalian'); ?></div>
									</div>
								</div>
							</div>
							<div class="form-group mx-auto">
								<label for="">Catatan ( Optional )</label>
								<textarea name="catatan" class="form-control" cols="30" rows="5"><?= $peminjaman['catatan']; ?></textarea>
								<div class="text-small text-danger"><?= form_error('catatan'); ?></div>
							</div>
							<div class="form-group mx-auto">
								<label for="">Jenis Barang</label>
								<select name="id_jenis" class="form-control" value="<?= $peminjaman['id_jenis']; ?>" id="">
									<option value="">Pilih Jenis Barang</option>
									<?php foreach ($jenis as $j) : ?>
										<?php if ($j['id_jenis'] == $peminjaman['id_jenis']) { ?>
											<option value="<?= $j['id_jenis']; ?>" selected><?= $j['nama_jenis']; ?></option>
										<?php } else { ?>
											<option value="<?= $j['id_jenis']; ?>"><?= $j['nama_jenis']; ?></option>
										<?php } ?>
									<?php endforeach; ?>
								</select>
								<div class="text-small text-danger"><?= form_error('id_jenis'); ?></div>
							</div>
							<div class="form-group mx-auto">
								<label for="">Jenis Barang</label>
								<select name="id_barang" class="form-control" value="<?= $peminjaman['id_barang']; ?>" id="">
									<option value="">Pilih Jenis Barang</option>
									<?php foreach ($barang as $b) : ?>
										<?php if ($b['id_barang'] == $peminjaman['id_barang']) { ?>
											<option selected value="<?= $b['id_barang']; ?>"><?= $b['nama_barang']; ?></option>
										<?php } else { ?>
											<option value="<?= $b['id_barang']; ?>"><?= $b['nama_barang']; ?></option>
										<?php } ?>
									<?php endforeach; ?>
								</select>
								<div class="text-small text-danger"><?= form_error('id_barang'); ?></div>
							</div>
							<button type="submit" class="btn btn-sm btn-primary mt-2">Ubah data</button>
						</div>
			</form>
		</div>
	</div>
	</div>
	</div>
	<!-- End of Main Content -->
