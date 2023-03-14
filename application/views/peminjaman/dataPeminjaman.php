<!-- Begin Page Content -->
<div class="container-fluid mb-5" style="min-height: 75vh;">

	<div class="card">

		<div class="row">
			<div class="col">
				<!-- Content Row -->
				<div class="col-lg-12 mx-auto mt-4 mb-5">
					<div class="col-lg-12">
						<a class="btn btn-primary mb-2 float-lg-right" href="<?= base_url('dataPeminjaman/tambahData'); ?>">+ Tambah Data</a>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6">
						<div class="form-group mx-auto">
							<select name="status_peminjaman" class="form-control" id="status">
								<option value="">Pilih Jenis Status</option>
								<option value="<?= $peminjaman['status_peminjaman'] = 1; ?>">dipinjam</option>
								<option value="<?= $peminjaman['status_peminjaman'] = 2; ?>">sudah dikembalikan</option>
								<option value="<?= $peminjaman['status_peminjaman'] = 3; ?>">belum dikembalikan</option>
							</select>
						</div>
					</div>
					<div class="table-responsive">
						<table id="tablePeminjaman" class="table table-hover">
							<thead class="thead-light">
								<tr class="text-center">
									<th>#</th>
									<th>Nama Peminjam</th>
									<th>No Telepon</th>
									<th>Tanggal Dipinjam</th>
									<th>Tanggal Pengembalian</th>
									<th>Status</th>
									<th>catatan</th>
									<th>Action</th>
								</tr>
							</thead>


						</table>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>



<!-- End of Main Content -->
