	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Content Row -->
		<div class="card col-8 mx-auto mt-5">
			<div class="card-title">
				<h1 class="h3 mt-5 text-center text-gray-800"><?= $title; ?></h1>
			</div>

			<div class="row">
				<div class="col">
					<form action="<?= base_url('dataJenisBarang/tambahDataAksi'); ?>" method="post" enctype="multipart/form-data">
						<div class="col-lg-10 mx-auto mb-5">
							<div class="form-group mx-auto">
								<label for="">Nama Jenis Barang</label>
								<input type="text" name="nama_jenis" class="form-control">
								<div class="text-small text-danger"><?= form_error('nama_jenis'); ?></div>
							</div>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- End of Main Content -->
