<script>
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
