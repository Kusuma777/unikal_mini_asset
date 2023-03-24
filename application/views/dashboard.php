                <!-- Begin Page Content -->
                <div class="container-fluid">
                	<!-- Content Row -->
                	<div class="row">
                		<div class="col-xl-3 col-md-6 mb-4">
                			<div class="card border-left-primary shadow h-100 py-2">
                				<div class="card-body">
                					<div class="row no-gutters align-items-center">
                						<div class="col mr-2">
                							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                								Data Jenis Barang</div>
                							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jenis; ?></div>
                						</div>
                						<div class="col-auto">
                							<i class="fas fa-desktop fa-2x text-gray-300"></i>
                						</div>
                					</div>
                				</div>
                			</div>
                		</div>

                		<div class="col-xl-3 col-md-6 mb-4">
                			<div class="card border-left-success shadow h-100 py-2">
                				<div class="card-body">
                					<div class="row no-gutters align-items-center">
                						<div class="col mr-2">
                							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                								Data Barang</div>
                							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $barang; ?></div>
                						</div>
                						<div class="col-auto">
                							<i class="fas fa-laptop fa-2x text-gray-300"></i>
                						</div>
                					</div>
                				</div>
                			</div>
                		</div>

                		<div class="col-xl-3 col-md-6 mb-4">
                			<div class="card border-left-warning shadow h-100 py-2">
                				<div class="card-body">
                					<div class="row no-gutters align-items-center">
                						<div class="col mr-2">
                							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                								Data Peminjaman</div>
                							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $peminjaman; ?></div>
                						</div>
                						<div class="col-auto">
                							<i class="fas fa-handshake fa-2x text-gray-300"></i>
                						</div>
                					</div>
                				</div>
                			</div>
                		</div>

                		<div class="row ml-1">
                			<div class="col-lg-12">
                				<div class="card shadow mb-4" style="max-height: 410px;">
                					<div class="card-header py-3">
                						<h6 class="m-0 font-weight-bold text-primary">Last activity</h6>
                					</div>
                					<div class="card-body  overflow-auto">
                						<ul class="list-group list-group-flush">
                							<?php foreach ($log as $l) : ?>
                								<li class="list-group-item"><?= $l['keterangan'] . ", pada <span class='text-truncate'>" . $l['created_at'] . "</span>" ?></li>
                							<?php endforeach ?>
                						</ul>
                					</div>
                				</div>
                			</div>
                		</div>
                	</div>
                </div>
                <!-- /.container-fluid -->
                <!-- End of Main Content -->