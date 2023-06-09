<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Login</title>

	<!-- Custom fonts for this template-->
	<link href="<?= base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">

	<!-- Animated css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

	<style>
		body {
			min-height: 100vh;
			display: flex;
			justify-content: center;
			align-items: center;
		}
	</style>

</head>

<body class="bg-gradient-warning">

	<div class="flash-data" data-auth="<?= $this->session->flashdata('auth') ?>"></div>


	<div class="container">

		<!-- Outer Row -->
		<div class="row justify-content-center">

			<div class="col-xl-10 col-lg-12 col-md-9">

				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="col-lg-6 d-none d-lg-block border-right">
								<img src="<?= base_url('assets/img/unikal.png') ?>" alt="" class="img-fluid">
							</div>
							<div class="col-lg-6 p-5">
								<div class="my-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900">Login Page</h1>
									</div>

									<?= $this->session->flashdata('validasi_login'); ?>

									<form class="user" action="<?= base_url('auth') ?>" method="post">
										<div class="form-group">
											<input type="text" class="form-control form-control-user" id="username" placeholder="Username" name="username" value="<?= set_value('username') ?>">
											<?= form_error('username', '<small class="text-danger ml-3">', '</small>') ?>
										</div>
										<div class="form-group">
											<input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password">
											<?= form_error('password', '<small class="text-danger ml-3">', '</small>') ?>
										</div>
										<hr>
										<button type="submit" class="btn btn-outline-warning btn-user btn-block">
											Login
										</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
	<script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>

	<!-- Sweet alert -->
	<script src="<?= base_url('assets/alert/sweetalert2.all.min.js') ?>"></script>
	<script src="<?= base_url('assets/alert/executor.js') ?>"></script>

</body>

</html>
