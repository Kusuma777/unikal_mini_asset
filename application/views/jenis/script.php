<script>
	var table;
	$(document).ready(function() {

		//datatables
		var table = $('#tableJenis').DataTable({

			"processing": true,
			"serverSide": true,
			"order": [],

			"ajax": {
				"url": "<?= site_url('dataJenisBarang/get_data_jenis') ?>",
				"type": "POST",
				"data": function(data) {
					data.id_jenis = $('#jenis').val();
				}
			},

			"columnDefs": [{
					"targets": [2],
					"orderable": false,
				},
				{
					"targets": [0, 1, 2],
					"className": 'text-center align-middle'
				}
			],

		});


		$("select").on("change", function() {
			table.ajax.reload();
		});

	});

	// confirm hapus
	$('#tableJenis').on('click', '.tombol-hapus', function() {

		const url = $(this).data('url');
		const id = $(this).data('id');

		Swal.fire({
			title: 'Apakah anda yakin?',
			text: "Jenis barang akan dihapus",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'Hapus'
		}).then((result) => {
			if (result.isConfirmed) {


				$.ajax({
					method: 'POST',
					url: url + 'dataJenisBarang/delete',
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