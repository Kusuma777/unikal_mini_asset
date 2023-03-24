	<!-- Begin Page Content -->
	<div class="container-fluid  mb-5" style="min-height: 75vh;">

		<div class="card">

			<div class="row mt-3">

				<div class="col">

					<div class="col-lg-12 mx-auto mt-2 mb-5">
						<div class="col-lg-12">
							<a class="btn btn-primary mb-2 float-lg-right" href="<?= base_url('dataJenisBarang/tambahData'); ?>">+ Tambah Data</a>
						</div>

						<div class="col-lg-3 col-sm-6 col-md-3 col-sm-3">
							<div class="form-group mx-auto">
								<select name="id_jenis" class="form-control" id="jenis">
									<option value="">Pilih Jenis Barang</option>
									<?php foreach ($jenis as $j) : ?>
										<option value="<?= $j['id_jenis']; ?>"><?= $j['nama_jenis']; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered table-hover" id="tableJenis">
								<thead class="bg-primary text-white">
									<tr>
										<th>#</th>
										<th>Nama Jenis Barang</th>
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
