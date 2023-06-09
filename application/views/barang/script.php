<script>
	var table;
	$(document).ready(function() {

		//datatables
		var table = $('#tableBarang').DataTable({

			"processing": true,
			"serverSide": true,
			"order": [],

			"ajax": {
				"url": "<?= site_url('dataBarang/get_data_barang') ?>",
				"type": "POST",
				"data": function(data) {
					data.id_jenis = $('#jenis').val();
				}
			},

			"columnDefs": [{
					"targets": [0, 1, 7],
					"orderable": false,
				},
				{
					"targets": [0, 1, 2, 3, 4, 5, 6, 7],
					"className": 'text-center align-middle'
				}
			],

		});


		$("select").on("change", function() {
			table.ajax.reload();
		});

	});

	// confirm hapus
	$('#tableBarang').on('click', '.tombol-hapus', function() {

		const url = $(this).data('url');
		const id = $(this).data('id');

		Swal.fire({
			title: 'Apakah anda yakin?',
			text: "Data barang akan dihapus",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'Hapus'
		}).then((result) => {
			if (result.isConfirmed) {

				$.ajax({
					method: 'POST',
					url: url + 'dataBarang/delete',
					data: {
						id: id
					},
					dataType: 'json',

					success: function(data) {
						location.reload();

						Toast.fire({
							icon: data.type,
							title: data.text
						})

					}
				})

			}
		})

	});
</script>