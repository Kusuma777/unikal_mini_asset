</div>
<!-- Footer -->
<footer class="sticky-footer bg-white mt-4">
	<div class="container mx-auto">
		<div class="copyright text-center my-auto">
			<span>Copyright &copy; Universitas Pekalongan <?= date('Y'); ?></span>
		</div>
	</div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<a class="btn btn-primary" href="<?= base_url('auth'); ?>">Logout</a>
			</div>
		</div>
	</div>
</div>


<!-- Bootstrap core JavaScript-->

<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/'); ?>js/demo/chart-area-demo.js"></script>
<script src="<?= base_url('assets/'); ?>js/demo/chart-pie-demo.js"></script>

<script src="<?= base_url('assets/'); ?>alert/js/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets/'); ?>alert/js/myscript.js"></script>

<script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>


<script type="text/javascript">
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
</script>

<script type="text/javascript">
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
</script>

<script type="text/javascript">
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
</script>

<script>
	// Add the following code if you want the name of the file appear on select
	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
</script>




</body>

</html>