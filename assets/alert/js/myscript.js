const flashData = $('.flash-data').data('flashdata');
const flashAuth = $('.flash-data').data('auth');
const flashMain = $('.flash-data').data('main');
const flashError = $('.flash-data').data('error');
const url = $('.flash-data').data('url');

if(flashData) {
	

	Swal.fire(
		{
		  toast: true,
		  icon: 'success',
		  titleText: flashData,
		  position: 'top',
		  width: 370,
		  backdrop: false,
		  showConfirmButton: false,
		  timer: 1900,
		  showClass:
		  {
			popup: 'animateanimated animatefadeInDown'
		  },
		  hideClass:
		  {
			popup: 'animateanimated animatefadeOutUp'
		  }
		}
	  )

}

$('.tombol-hapus').on('click', function(e) {

	e.preventDefault(); 
	const href = $(this).attr('href');
	
	Swal.fire({
		title: 'Apakah Anda Yakin',
		text: "Data Akan Dihapus!",
		icon: 'warning',
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
$('.tombol-update').on('click', function(e) {

	e.preventDefault(); 
	const type = $(this).attr('type');
	
	Swal.fire({
		title: 'Apakah Anda Yakin',
		text: "Barang Sudah Dikembalikan ?",
		icon: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya, Sudah'
	  }).then((result) => {
		if (result.isConfirmed) {
		  document.location.href = type;
		}
});	  

			
}); 

if (flashAuth) {

  const Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 2000,
    showClass:
      {
        popup: 'animate__animated animate__bounceInDown'
      },
      hideClass:
      {
        popup: 'animate__animated animate__fadeOut'
      },
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  Toast.fire({
    icon: 'success',
    title: flashAuth
  })

}

if (flashMain) {

  const Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  Toast.fire({
    icon: 'success',
    title: flashMain
  })

}

if (flashError) {
  Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'Unit ' + flashError + ' sedang digunakan pada riwayat service',
    footer: '<a href="'+ url +'service">hapus atau ubah data riwayat service</a>'
  })
}

// logout
$('.btn-logout').on('click', function (e) {

  e.preventDefault()

  Swal.fire({
    title: 'Yakin ingin keluar?',
    text: 'Pilih "logout" di bawah jika Anda siap untuk mengakhiri sesi Anda saat ini.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Logout'
  }).then((result) => {
    if (result.isConfirmed) {

      document.location.href = $(this).attr('href')

    }
  })

})

$(document).ready(function() {
	$('form #submit-btn').click(function(e) {
			let $form = $(this).closest('form');

			Swal.fire({
				title: 'Apakah Anda Yakin',
				text: "Barang Sudah Dikembalikan ?",
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: 'Batal',
				confirmButtonText: 'Ya, Sudah'
				}).then((result) => {
					if (result.value) {      
							$form.submit();
					}
			});

	});
	});
