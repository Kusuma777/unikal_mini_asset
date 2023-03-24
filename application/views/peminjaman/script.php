<script>
	var table;
	$(document).ready(function() {

		//datatables
		var table = $('#tablePeminjaman').DataTable({

			"processing": true,
			"serverSide": true,
			"order": [],

			"ajax": {
				"url": "<?= site_url('dataPeminjaman/get_data_peminjaman') ?>",
				"type": "POST",
				"data": function(data) {
					data.status_peminjaman = $('#status').val();
				}
			},

			"columnDefs": [{
				"targets": [0, 2, 5, 6],
				"orderable": false,
			}, ],

		});


		$("select").on("change", function() {
			table.ajax.reload();
		});

	});

	// confirm hapus
	$('#tablePeminjaman').on('click', '.tombol-hapus', function() {

		const url = $(this).data('url');
		const id = $(this).data('id');

		Swal.fire({
			title: 'Apakah anda yakin?',
			text: "Data Peminjaman akan dihapus",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'Hapus'
		}).then((result) => {
			if (result.isConfirmed) {

				$.ajax({
					method: 'POST',
					url: url + 'dataPeminjaman/delete',
					data: {
						id: id
					},
					dataType: 'json',

					success: function(data) {
						location.reload()
						Toast.fire({
							icon: 'success',
							title: data.text
						})

					}
				})

			}
		})

	});
</script>