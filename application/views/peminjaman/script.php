<script>
	// confirm hapus
	$('#tablePeminjaman').on('click', '.tombol-hapus', function() {

		const url = $(this).data('url');
		const id = $(this).data('id');

		Swal.fire({
			title: 'Apakah anda yakin?',
			text: "Data peminjaman akan dihapus",
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


	$('.tombol-update').on('click', function(e) {

		e.preventDefault();
		const href = $(this).attr('href');

		Swal.fire({
			title: 'Apakah Anda Yakin',
			text: "Data Akan Dihapus!",
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				document.location.href = href;
			}
		});


	});
</script>