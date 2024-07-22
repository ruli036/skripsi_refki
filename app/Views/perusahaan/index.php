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
					<li class="breadcrumb-item active">Perusahaan</li>
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
						<h4>PERUSAHAAN</h4>
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
									<a href="#">Data Relasi Perusahaan </a>
									<span class="pull-right">

									</span>
								</h6>

								<div class="table-responsive">
									<table class="table" id="tabledata">
										<thead>
											<tr class="border-bottom-primary">
												<th scope="col">No</th>
												<th scope="col">Nama</th>
												<th scope="col">Tanggal Kerjasama </th>
												<th scope="col">Alamat</th>
												<th scope="col">Status</th>
												<th scope="col">Aksi</th>
											</tr>
										</thead>
										<tbody>
												<?php

												foreach ($perusahaan as $key => $value) : ?>
													<tr class="border-bottom-secondary">
														<th scope="row"><?= ++$key ?></th>
														<td><?= $value->nama ?></td>
														<td><?= $value->tgl_kerja_sama ?></td>
														<td><?= $value->alamat ?></td>
														<td><?= $value->stts == 'A'?'AKTIF':'NON AKTIF' ?></td>
														<td>
															<button type="button" class="btn btn-primary btn-sm" onclick="openModal('<?= $value->id ?>','<?= $value->nama ?>','<?= $value->tgl_kerja_sama ?>','<?= $value->alamat ?>','<?= $value->stts ?>')">
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
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="form-group row" style="padding-bottom: 15px;">
					<label class="col-sm-3 col-form-label">Nama Perusahaan</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" required placeholder="Nama Perusahaan" id="nama">
					</div>
				</div>
				<div class="form-group row" style="padding-bottom: 15px;">
					<label class="col-sm-3 col-form-label">Tanggal Kerja Sama</label>
					<div class="col-sm-9">
						<input type="date" class="form-control" required placeholder="Tanggal" id="tgl">
					</div>
				</div>
				<div class="form-group row" style="padding-bottom: 15px;">
					<label class="col-sm-3 col-form-label">Alamat</label>
					<div class="col-sm-9">
						<textarea name="" id="alamat" class="form-control"></textarea>
						<!-- <input type="text" class="form-control" required placeholder="Alamat" id="alamat"> -->
					</div>
				</div>
				<div class="form-group row" style="padding-bottom: 15px;">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="stts">
                                <option value="A"> AKTIF</option>
                                <option value="N"> NON AKTIF</option>
                        </select>
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
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Add Data</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="form-group row" style="padding-bottom: 15px;">
					<label class="col-sm-3 col-form-label">Nama Perusahaan</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" required placeholder="Nama Perusahaan" id="nama2">
					</div>
				</div>
				<div class="form-group row" style="padding-bottom: 15px;">
					<label class="col-sm-3 col-form-label">Tanggal Kerja Sama</label>
					<div class="col-sm-9">
						<input type="date" class="form-control" required placeholder="Tanggal" id="tgl2">
					</div>
				</div>
				<div class="form-group row" style="padding-bottom: 15px;">
					<label class="col-sm-3 col-form-label">Alamat</label>
					<div class="col-sm-9">
						<textarea name="" id="alamat2" class="form-control"></textarea>
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
	function openModal(id, nama, tgl, alamat,stts) {
		$("#id").val(id);
		$("#nama").val(nama);
		$("#tgl").val(tgl);
		$("#alamat").val(alamat);
		$("#stts").val(stts);
		var myModal = new bootstrap.Modal(document.getElementById('edit'), {
			keyboard: true
		});
		myModal.show();
	}

	function simpan() {
		const id = $("#id").val();
		const nama = $("#nama").val();
		const tgl = $("#tgl").val();
		const alamat = $("#alamat").val();
		const stts = $("#stts").val();
		if (nama === ''|| alamat === '' || tgl === '') {
			return Swal.fire("INFO", "Harap mengisi semua data ", 'warning');
		}
		let formData = new FormData();
		formData.append('id', id);
		formData.append('nama', nama);
		formData.append('tgl_kerja_sama', tgl);
		formData.append('alamat', alamat);
		formData.append('stts', stts);
		$.ajax({
			url: "<?= url_to('editrelasi') ?>",
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
							location.href = "<?= site_url('admin/perusahaan') ?>";
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
		const nama = $("#nama2").val();
		const tgl = $("#tgl2").val();
		const alamat = $("#alamat2").val();
		if (nama === ''|| alamat === '' || tgl === '') {
			return Swal.fire("INFO", "Harap mengisi semua data ", 'warning');
		}
		let formData = new FormData();
		formData.append('id', id);
		formData.append('nama', nama);
		formData.append('tgl_kerja_sama', tgl);
		formData.append('alamat', alamat);
		$.ajax({
			url: "<?= url_to('addrelasi') ?>",
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
							location.href = "<?= site_url('admin/perusahaan') ?>";
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
            title: "Delete Data Rekan Kerja" ,
            text: "Anda yakin menghapus data rekan kerja ini!",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "OK",
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= url_to('deleterelasi') ?>",
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