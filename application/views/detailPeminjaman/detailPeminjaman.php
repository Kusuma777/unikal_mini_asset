	<!-- Begin Page Content -->
	<div class="container-fluid">

			<div class="card">

				<div class="row">
					<!-- Content Row -->
					<div class="col-lg-11 mx-auto mt-4 mb-5">
						<div class="col-lg-12">
							<a class="btn btn-primary mb-2 m float-lg-right" href="<?= base_url('detailPeminjaman/tambahData'); ?>">+ Tambah Data</a>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<div class="form-group mx-auto">
								<select name="id_jenis" class="form-control" id="jenis">
									<option value="">Pilih Jenis Barang</option>
									<?php foreach ($jenis as $j) : ?>
										<option value="<?= $j['id_jenis']; ?>"><?= $j['nama_jenis']; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="table-responsive ">
							<table id="tableDetail" class="table">
								<thead class="bg-primary text-white">
									<tr class="text-center">
										<td>#</td>
										<td>Nama Peminjam</td>
										<td>Jenis Barang</td>
										<td>Nama Barang</td>
										<td>Foto Peminjaman</td>
										<td>Foto Pengembalian</td>
										<td>Action</td>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>

			</div>
	</div>



	<!-- End of Main Content -->
