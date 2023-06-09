	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Content Row -->
		<div class="row justify-content-md-center w-100">
			<div class="col-lg-7 md-6">
				<div class="card">
					<h5 class="card-header bg-primary text-white">D E T A I L</h5>
					<div class="card-body">

						<table class="table-borderless col-lg-12 col-md-8">
							<tr>
								<td class="col-lg-3 col-md-5 col-sm-5">Nama</td>
								<td>: <?= $detail['nama_peminjam']; ?></td>
							</tr>
							<tr>
								<td class="col-lg-3 col-md-5 col-sm-5">Nomor Telepon </td>
								<td>: <?= $detail['no_telp']; ?></td>
							</tr>
							<tr>
								<td class="col-lg-3 col-md-5 col-sm-5">Nomor Telepon </td>
								<td>: <?= $detail['no_telp']; ?></td>
							</tr>
							<tr>
								<td class="col-lg-3 col-md-5 col-sm-5">Tanggal Dipinjam</td>
								<td>: <?= $detail['tgl_dipinjam']; ?></td>
							</tr>
							<tr>
								<td class="col-lg-3 col-md-5 col-sm-5">Tanggal Pengembalian</td>
								<td>: <?= $detail['tgl_pengembalian']; ?></td>
							</tr>

							<tr>
								<td class="col-lg-3 col-md-5 col-sm-5">Catatan</td>
								<td>: <?= $detail['catatan']; ?></td>
							</tr>
							<tr>
								<td class="col-lg-3 col-md-5 col-sm-5">Status</td>
								<td>: <?php if ($detail['status_peminjaman'] == 1) { ?>
										<span class="badge badge-primary">Sedang dipinjam</span>
									<?php } elseif ($detail['status_peminjaman'] == 2) { ?>
										<span class="badge badge-success">Sudah dikembalikan</span>
									<?php } else { ?>
										<span class="badge badge-danger">Belum dikembalikan</span>
									<?php } ?>
								</td>
							</tr>
							<tr>

							</tr>
						</table>
						<div class="col-xl-6 col-md-6 mb-4 mt-3">
							<h5>Foto peminjaman :</h5>
							<img src="<?= base_url('assets/foto/') . $detail['foto_peminjaman']; ?>" width="300" alt="">

						</div>
						<h5>Foto pengembalian :</h5>
						<?php if ($detail['foto_pengembalian'] == null) : ?>
							<form action="<?= base_url('dataPeminjaman/updateDataDetail'); ?>" method="post" enctype="multipart/form-data">
								<div class="col-xl-6 col-md-6 mt-3">
									<input type="hidden" name="id_peminjaman" value="<?= $detail['id_peminjaman']; ?>">
									<div class="custom-file mb-2">
										<input type="file" class="custom-file-input" required name="foto_pengembalian" value="<?= $detail['foto_pengembalian']; ?>" id="customFile">
										<label class="custom-file-label" for="customFile">Choose file</label>
									</div>
								</div>
								<input type="hidden" name="status_peminjaman" value="2">
								<input type="hidden" name="tambah" value="1">
								<!-- <input type="hidden" name="id_jenis" value="<?= $detail['id_jenis']; ?>">
								<input type="hidden" name="id_barang" value="<?= $detail['id_barang']; ?>"> -->
								<input type="hidden" name="nama_peminjam" value="<?= $detail['nama_peminjam']; ?>">
								<input type="hidden" name="no_telp" value="<?= $detail['no_telp']; ?>">
								<input type="hidden" name="tgl_dipinjam" value="<?= $detail['tgl_dipinjam']; ?>">
								<input type="hidden" name="tgl_pengembalian" value="<?= $detail['tgl_pengembalian']; ?>">
								<input type="hidden" name="foto_peminjaman" value="<?= $detail['foto_peminjaman']; ?>">
								<input type="hidden" name="foto_pengembalian" value="<?= $detail['foto_pengembalian']; ?>">
								<input type="hidden" name="catatan" value="<?= $detail['catatan']; ?>">

								<a href="<?= base_url('dataPeminjaman/index'); ?>" class="btn btn-danger mt-3">kembali</a>
								<button type="button" class="btn btn-primary mt-3" id="submit-btn">Barang Sudah Dikembalikan</button>
							</form>
						<?php else : ?>
							<img src="<?= base_url('assets/foto/') . $detail['foto_pengembalian']; ?>" width="300" alt="">
						<?php endif; ?>

					</div>
				</div>
			</div>
		</div>
	</div>