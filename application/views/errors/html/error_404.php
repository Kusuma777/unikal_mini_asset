<?php

$base_url = 'http://localhost/mini_assets/';

defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>>404 Page Not Found</title>

    <!-- Custom fonts for this template-->
    <link href="<?= $base_url;?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= $base_url;?>assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body>
	<!-- Begin Page Content -->
	<div class="container-fluid">

<!-- 404 Error Text -->
<div class="text-center mt-5">
	<div class="error mx-auto" data-text="404">404</div>
	<p class="lead text-gray-800 mb-5">Page Not Found</p>
	<p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
	<a href="<?= $base_url?>dashboard">&larr; Back to Dashboard</a>
</div>

</div>
<!-- /.container-fluid -->

</div>
</body>
</html>
