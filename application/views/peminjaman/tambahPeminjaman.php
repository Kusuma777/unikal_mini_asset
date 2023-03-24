	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Content Row -->
		<div class="card col-8 mx-auto mt-5">
			<div class="card-title">
				<h1 class="h3 mt-4 text-center text-gray-800"><?= $title; ?></h1>
			</div>

			<form method="post" id="tambah_peminjaman" enctype="multipart/form-data">
				<div class="row">
					<div class="col-lg-10 mx-auto mb-5">
						<div class="form-group mx-auto">
							<label for="">Nama Peminjam</label>
							<input type="text" name="nama_peminjam" value="<?= set_value('nama_peminjam'); ?>" class="form-control">
						</div>
						<div class="form-group mx-auto">
							<label for="">No Telp/Wa</label>
							<input type="number" name="no_telp" value="<?= set_value('no_telp'); ?>" class="form-control">
						</div>
						<div class="row">
							<div class="col">
								<div class="form-group mx-auto">
									<label for="">Tanggal Dipinjam</label>
									<input type="date" id="tgl_dipinjam" name="tgl_dipinjam" value="<?= set_value('tgl_dipijam'); ?>" class="form-control">
								</div>
							</div>
							<div class="col">
								<div class="form-group mx-auto">
									<label for="">Tanggal Pengembalian</label>
									<input type="date" name="tgl_pengembalian" value="<?= set_value('tgl_pengembalian'); ?>" class="form-control">
								</div>
							</div>
						</div>

						<div class="form-group mx-auto">
							<label for="">Catatan ( Optional )</label>
							<textarea name="catatan" class="form-control" cols="30" rows="5"><?= set_value('catatan'); ?></textarea>
						</div>
						<div class="card mb-2">
							<div class="p-3">
								<div class="card-title">
									<h4>Barang</h4>
								</div>
								<div class="form-group mx-auto">
									<div class="row">
										<div class="col">
											<select id="id_jenis" name="id_jenis" value="<?= set_value('id_jenis'); ?>" class="form-control" id="id_jenis">
												<option value="">Pilih Jenis Barang Yang Dipinjam</option>
												<?php foreach ($jenis as $j) : ?>
													<option value="<?= $j['id_jenis']; ?>"><?= $j['nama_jenis']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col">
											<select id="id_barang" name="id_barang" value="<?= set_value('id_barang'); ?>" class="form-control" id="id_barang">
												<option value="">Pilih Nama Barang Yang Dipinjam</option>
												<?php foreach ($barang as $b) : ?>
													<option value="<?= $b['id_barang']; ?>"><?= $b['nama_barang']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<button type="button" class="btn btn-primary mt-3" id="btn-barang">Tambah</button>
								</div>

								<hr>

								<div class="card-title">
									<h4>List Barang</h4>
								</div>
								<table class="table table-bordered display text-center" id="tbl-barang">
									<thead class="bg-light">
										<tr>
											<th>Jenis Barang</th>
											<th>Nama Barang</th>
										</tr>
									</thead>
									<tbody>
										<tr>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						<div>
							<label for="">Foto peminjaman</label>
							<div class="custom-file mb-2">
								<input type="file" class="custom-file-input" value="<?= set_value('foto_peminjaman'); ?>" name="foto_peminjaman" id="customFile">
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
	<!-- End of Main Content -->

	<script type="text/javascript">
		// $(document).ready(function() {
		$('#btn-barang').click(function() {
			let id_barang = $("#id_barang").val();
			let nm_jenis = $("#id_jenis :selected").text();
			let nm_barang = $("#id_barang :selected").text();

			console.log('click');
			let data = `<tr class="child">
							<td><input type="hidden" name="id_barang[]" value="${id_barang}"></input>
							${nm_jenis}</td>
							<td>${nm_barang}</td>
						</tr>`
			$('#tbl-barang tbody').append(data);
		});

		$('#tambah_peminjaman').validate({
			rules: {
				nama_peminjam: {
					required: true
				},
				no_telp: {
					required: true
				},
				tgl_dipinjam: {
					required: true
				},
				tgl_pengembalian: {
					required: true
				},
				foto_peminjaman: {
					required: true
				},
			},
			messages: {
				nama_peminjam: {
					required: 'Field harus di isi'
				},
				no_telp: {
					required: 'Field harus di isi'
				},
				tgl_dipinjam: {
					required: 'Field harus di isi'
				},
				tgl_pengembalian: {
					required: 'Field harus di isi'
				},
				foto_peminjaman: {
					required: 'Field harus di isi'
				},
				foto_peminjaman: {
					required: 'Field harus di isi'
				},
			},
			errorElement: 'span',
			errorPlacement: function(error, element) {
				error.addClass('invalid-feedback');
				element.closest('.col-sm-8').append(error);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass('is-invalid');
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).removeClass('is-invalid');
			},
			submitHandler: function(form) {
				var id_barang = [];

				$('input[name~="id_barang[]"]').each(function(k, v) {
					id_barang.push({
						id_barang: $(this).val()
					});
				});

				console.log(id_barang)

				var foto = $('input[name="foto_peminjaman"]').prop('files')[0];
				var form_data = new FormData();
				form_data.append("data", $('#tambah_peminjaman').serialize());
				form_data.append("barang", JSON.stringify(id_barang));
				form_data.append("foto_peminjaman", foto);

				$.ajax({
					type: 'POST',
					url: '<?= base_url('DataPeminjaman/tambahDataAksi') ?>',
					data: form_data,
					processData: false,
					contentType: false,
					success: function(output) {

					}
				})


			}
		});

		// });
	</script>