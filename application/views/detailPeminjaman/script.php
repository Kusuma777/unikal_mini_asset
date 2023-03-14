<script>
	// confirm hapus
	$('#tableDetail').on('click', '.tombol-hapus', function() {

		const url = $(this).data('url');
		const id = $(this).data('id');
		// const nama = $(this).data('nama');

		Swal.fire({
			title: 'Apakah anda yakin?',
			text: "Data akan dihapus",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Hapus'
		}).then((result) => {
			if (result.isConfirmed) {

				$.ajax({
					url: url + 'DetailPeminjaman/delete',
					data: {
						id: id,
						// nama: nama
					},
					method: 'POST',

					dataType: 'json',
					success: function(data) {

						document.location.href = url + data.alert + data.text + data.location

					}
				})

			}
		})

	});
</script>
