<?= $this->extend('layout/master') ?>
<?= $this->section('main-content') ?>

<div class="container-fluid">
	<div class="page-title">
		<div class="row">
			<div class="col-6">
				<h3><?= env('TITLE', 'Default Title') ?></h3>
			</div>
			<div class="col-6">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= base_url("home") ?>">
							<svg class="stroke-icon">
								<use href="assets/svg/icon-sprite.svg#stroke-home"></use>
							</svg></a>
					</li>
					<li class="breadcrumb-item">Home</li>
					<li class="breadcrumb-item active">Lowongan</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<?php if (session()->getFlashdata('errorid')) : ?>
	<div class="container-fluid">
		<div class="alert alert-secondary dark alert-dismissible fade show" role="alert"><?= session()->getFlashdata('errorid'); ?>.
			<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
		</div>
	</div>
<?php endif; ?>
<div class="container-fluid">
	<div class="row project-cards">
		<div class="col-md-12 project-list">
			<div class="card">
				<div class="row">
					<div class="col-md-6">
						<h4>LOWONGAN</h4>
					</div>
					<div class="col-md-6">
						<div class="form-group mb-0 me-0">
							<a type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#add">
								ADD DATA
							</a>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-xl-12 xl-100 box-col-12">
			<div class="card">
				<div class="job-search">
					<div class="card-body">
						<div class="media">
							<img class="img-40 img-fluid m-r-20" src="<?= base_url('nubis/images/logo.png') ?>" alt="">
							<div class="media-body">
								<h6 class="f-w-600">
									<a href="#">Data Lowongan Perusahaan </a>
									<span class="pull-right">

									</span>
								</h6>

								<div class="table-responsive">
									<table class="table" id="tabledata">
										<thead>
											<tr class="border-bottom-primary">
												<th scope="col">No</th>
												<th scope="col">Perusahaan</th>
												<th scope="col" width='15%'>Alamat </th>
												<th scope="col">Posisi</th>
												<th scope="col">Kuota</th>
												<th scope="col">Pendaftar</th>
												<th scope="col">Batas Pendaftaran</th>
												<th scope="col">Aksi</th>
											</tr>
										</thead>
										<tbody>
												<?php

												foreach ($lowongan as $key => $value) : ?>
													<tr class="border-bottom-secondary">
														<th scope="row"><?= ++$key ?></th>
														<td><?= $value->perusahaan ?></td>
														<td><?= $value->alamat ?></td>
														<td><?= $value->posisi ?></td>
														<td><?= $value->kuota ?></td>
														<td><?= $value->pendaftar ?></td>
														<td><?= $value->tgl_awal ?> Sampai <?= $value->tgl_akhir ?></td>
														<td>
															<button type="button" class="btn btn-primary btn-sm" onclick="openModal('<?= $value->id ?>','<?= $value->id_rekan ?>','<?= $value->posisi ?>','<?= $value->kuota ?>','<?= $value->tgl_awal ?>','<?= $value->tgl_akhir ?>')">
																Edit
															</button>
															<button type="button" class="btn btn-danger btn-sm" onclick="deleted('<?= $value->id ?>')">
																Delete
															</button>
														</td>
													</tr>
												<?php endforeach; ?>
										</tbody>

									</table>

								</div>
							</div>
						</div>
						<div class="job-description">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				
				<div class="form-group row" style="padding-bottom: 15px;">
                    <label class="col-sm-2 col-form-label">Perusahaan</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="id_rekan">
                            <?php foreach ($rekankerja as $rk) : ?>
                                <option value="<?= $rk->id ?>"> <?= $rk->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
				<div class="form-group row" style="padding-bottom: 15px;">
					<label class="col-sm-2 col-form-label">Posisi</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" required placeholder="Posisi" id="posisi">
					</div>
				</div>
				<div class="form-group row" style="padding-bottom: 15px;">
					<label class="col-sm-2 col-form-label">Kuota</label>
					<div class="col-sm-10">
						<input type="number" class="form-control" required placeholder="Kuota" id="kuota">
					</div>
				</div>
				<div class="form-group row" style="padding-bottom: 15px;">
					<label class="col-sm-2 col-form-label">Batas Pendaftaran</label>
					<div class="col-sm-5">
						<input type="date" class="form-control" required placeholder="Tgl Awal" id="tgl_awal">
					</div>
					<div class="col-sm-5">
						<input type="date" class="form-control" required placeholder="Tgl Akhir" id="tgl_akhir">
					</div>
				</div>
				<input type="hidden" class="form-control" disabled id="id">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick="simpan()">Save changes</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Add Data</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="form-group row" style="padding-bottom: 15px;">
                    <label class="col-sm-2 col-form-label">Perusahaan</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="id_rekan2">
                            <?php foreach ($rekankerja as $rk) : ?>
                                <option value="<?= $rk->id ?>"> <?= $rk->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
				<div class="form-group row" style="padding-bottom: 15px;">
					<label class="col-sm-2 col-form-label">Posisi</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" required placeholder="Posisi" id="posisi2">
					</div>
				</div>
				<div class="form-group row" style="padding-bottom: 15px;">
					<label class="col-sm-2 col-form-label">Kuota</label>
					<div class="col-sm-10">
						<input type="number" class="form-control" required placeholder="Kuota" id="kuota2">
					</div>
				</div>
				<div class="form-group row" style="padding-bottom: 15px;">
					<label class="col-sm-2 col-form-label">Batas Pendaftaran</label>
					<div class="col-sm-5">
						<input type="date" class="form-control" required placeholder="Tgl Awal" id="tgl_awal2">
					</div>
					<div class="col-sm-5">
						<input type="date" class="form-control" required placeholder="Tgl Akhir" id="tgl_akhir2">
					</div>
				</div>
				
				<input type="hidden" class="form-control" disabled id="id2">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick="adddata()">Save</button>
			</div>
		</div>
	</div>
</div>


<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>cuba/assets/css/vendors/date-picker.css">
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url() ?>cuba/assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="<?= base_url() ?>cuba/assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="<?= base_url('assets/js/upload.js') ?>"></script>

<script type="text/javascript">
	 $(document).ready(function() {
        $('#tabledata').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            pageLength: 10,
			dom: 'Bfrtip',
			buttons: [{
				extend: 'excelHtml5',
				text: 'Export to Excel',
				className: 'btn btn-success btn-sm mb-1 text-end',
			}], // Set the default page length
            order: [[ 3, "desc" ]] // Order by the 4th column (Age) descending
        });
    });
	function openModal(id, idrekan, posisi, kuota, tglawal, tglakhir ) {
		$("#id").val(id);
		$("#id_rekan").val(idrekan);
		$("#posisi").val(posisi);
		$("#kuota").val(kuota);
		$("#tgl_awal").val(tglawal);
		$("#tgl_akhir").val(tglakhir);
		var myModal = new bootstrap.Modal(document.getElementById('edit'), {
			keyboard: true
		});
		myModal.show();
	}

	function simpan() {
		const id = $("#id").val();
		const id_rekan = $("#id_rekan").val();
		const posisi = $("#posisi").val();
		const kuota = $("#kuota").val();
		const tgl_awal = $("#tgl_awal").val();
		const tgl_akhir = $("#tgl_akhir").val();
		if (posisi === ''|| kuota === '' || tgl_awal === ''|| tgl_akhir === '') {
			return Swal.fire("INFO", "Harap mengisi semua data ", 'warning');
		}
		let formData = new FormData();
		formData.append('id', id);
		formData.append('id_rekan', id_rekan);
		formData.append('posisi', posisi);
		formData.append('kuota', kuota);
		formData.append('tgl_awal', tgl_awal);
		formData.append('tgl_akhir', tgl_akhir);
		$.ajax({
			url: "<?= url_to('editlowongan') ?>",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			dataType: "json",
			beforeSend: function() {
				Swal.fire({
					title: "Loading!",
					allowOutsideClick: false,
					didOpen: () => {
						Swal.showLoading()
					}
				});
			},
			success: function(data) {
				console.log(data);
				Swal.fire(data.title, data.msg, data.icon).then(function(result) {
					if (result.isConfirmed) {
						if (data.stts) {
							location.href = "<?= site_url('admin/lowongan') ?>";
						}
					}
				});
			},
			error: function(jqXHR, textStatus, errorThrown) {
				Swal.fire("Response", "Cek kembali inputan anda ", "warning");
			}
		});
	}
	function adddata() {
		const id = $("#id2").val();
		const id_rekan = $("#id_rekan2").val();
		const posisi = $("#posisi2").val();
		const kuota = $("#kuota2").val();
		const tgl_awal = $("#tgl_awal2").val();
		const tgl_akhir = $("#tgl_akhir2").val();
		if (posisi === ''|| kuota === '' || tgl_awal === ''|| tgl_akhir === '') {
			return Swal.fire("INFO", "Harap mengisi semua data ", 'warning');
		}
		let formData = new FormData();
		formData.append('id', id);
		formData.append('id_rekan', id_rekan);
		formData.append('posisi', posisi);
		formData.append('kuota', kuota);
		formData.append('tgl_awal', tgl_awal);
		formData.append('tgl_akhir', tgl_akhir);
		$.ajax({
			url: "<?= url_to('addlowongan') ?>",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			dataType: "json",
			beforeSend: function() {
				Swal.fire({
					title: "Loading!",
					allowOutsideClick: false,
					didOpen: () => {
						Swal.showLoading()
					}
				});
			},
			success: function(data) {
				console.log(data);
				Swal.fire(data.title, data.msg, data.icon).then(function(result) {
					if (result.isConfirmed) {
						if (data.stts) {
							location.href = "<?= site_url('admin/lowongan') ?>";
						}
					}
				});
			},
			error: function(jqXHR, textStatus, errorThrown) {
				Swal.fire("Response", "Cek kembali inputan anda ", "warning");
			}
		});
	}
	function deleted(id) {
        Swal.fire({
            title: "Delete Lowongan" ,
            text: "Anda yakin menghapus lowongan ini!",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "OK",
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= url_to('deletelowongan') ?>",
                    type: "POST",
					data:{
						id : id
					},
                    dataType: 'json',
                    beforeSend: function () {
                        Swal.fire({
                            title: "Loading!",
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        });
                    },
                    success: function (data) {
                        Swal.fire({
                            icon: data.stts,
                            title: data.msg
                        }).then((result) => {
                    /* Read more about handling dismissals below */
                            location.reload(true);
                        });
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        Swal.fire("error");
                    }
                });
            }
        });

    }
</script>
<?= $this->endSection() ?>