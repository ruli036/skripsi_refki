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
					<li class="breadcrumb-item active">Informasi</li>
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
						<h4>Informasi</h4>
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
									<a href="#">Data Informasi </a>
									<span class="pull-right">

									</span>
								</h6>

								<div class="table-responsive">
									<table class="table" id="tabledata">
										<thead>
											<tr class="border-bottom-primary">
												<th scope="col">No</th>
												<th scope="col">Judul</th>
												<th scope="col">Keterangan</th>
												<th scope="col">Dibuat</th>
												<th scope="col">Aksi</th>
											</tr>
										</thead>
										<tbody>

											<?php

											foreach ($info as $key => $value) : ?>
												<tr class="border-bottom-secondary">
													<th scope="row"><?= ++$key ?></th>
													<td><?= $value->judul?></td>
													<td><?= htmlspecialchars_decode($value->desc)?></td>
													<td><?= $value->created_at ?></td>
													<td>
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
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
			<div class="form-group row" style="padding-bottom: 15px;">
					<label class="col-sm-2 col-form-label" for="editor">Informasi</label>
					<div class="col-sm-10">
						<textarea name="konten" id="editor" rows="10" cols="80"></textarea>
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
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Add Data</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				 
				<div class="form-group row" style="padding-bottom: 15px;">
					<label class="col-sm-2 col-form-label" for="editor1">Judul</label>
					<div class="col-sm-10">
					<input type="text" class="form-control" required placeholder="Judul" id="judul2">
					</div>
				</div>
				<div class="form-group row" style="padding-bottom: 15px;">
					<label class="col-sm-2 col-form-label" for="editor1">Informasi</label>
					<div class="col-sm-10">
						<textarea name="konten" id="editor1" rows="10" cols="80"></textarea>
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
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script src="<?= base_url() ?>cuba/assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="<?= base_url() ?>cuba/assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="<?= base_url('assets/js/upload.js') ?>"></script>

<script type="text/javascript">
	//  CKEDITOR.replace('editor');
	 CKEDITOR.replace('editor1');
	 
	$(document).ready(function() {
		$('#tabledata').DataTable({
			paging: true,
			searching: true,
			ordering: true,
			info: true,
			pageLength: 10, // Set the default page length
			order: [
				[3, "desc"]
			] // Order by the 4th column (Age) descending
		});
	});

	// function openModal(id, desc,stts) {
	// 	$("#editor").val(desc);
	// 	if(stts === 'E'){
	// 		var myModal = new bootstrap.Modal(document.getElementById('edit'), {
	// 		keyboard: true
	// 	});
	// 	}else{
	// 		var myModal = new bootstrap.Modal(document.getElementById('add'), {
	// 		keyboard: true
	// 	});
	// 	}
		
	// 	myModal.show();
	// }

	// function simpan() {
	// 	const id = $("#id").val();
	// 	const id_lowongan = $("#id_lowongan").val();
	// 	const id_siswa = $("#id_siswa").val();
	// 	const waktu = $("#waktu").val();
	// 	const stts = $("#stts").val();
	// 	if (waktu === '') {
	// 		return Swal.fire("INFO", "Harap mengisi semua data ", 'warning');
	// 	}
	// 	let formData = new FormData();
	// 	formData.append('id', id);
	// 	formData.append('id_lowongan', id_lowongan);
	// 	formData.append('id_siswa', id_siswa);
	// 	formData.append('waktu', waktu);
	// 	formData.append('stts', stts);
	// 	$.ajax({
	// 		url: "<?= url_to('editjadwaltes') ?>",
	// 		type: "POST",
	// 		data: formData,
	// 		contentType: false,
	// 		processData: false,
	// 		dataType: "json",
	// 		beforeSend: function() {
	// 			Swal.fire({
	// 				title: "Loading!",
	// 				allowOutsideClick: false,
	// 				didOpen: () => {
	// 					Swal.showLoading()
	// 				}
	// 			});
	// 		},
	// 		success: function(data) {
	// 			console.log(data);
	// 			Swal.fire(data.title, data.msg, data.icon).then(function(result) {
	// 				if (result.isConfirmed) {
	// 					if (data.stts) {
	// 						location.reload(true);
	// 					}
	// 				}
	// 			});
	// 		},
	// 		error: function(jqXHR, textStatus, errorThrown) {
	// 			Swal.fire("Response", "Cek kembali inputan anda ", "warning");
	// 		}
	// 	});
	// }

	function adddata() {
		var desc = CKEDITOR.instances.editor1.getData();
		const judul = $("#judul2").val();
		if (desc === '' || judul === '') {
			return Swal.fire("INFO", "Harap mengisi semua data ", 'warning');
		}
		let formData = new FormData();
		formData.append('judul', judul);
		formData.append('desc', desc);
		$.ajax({
			url: "<?= url_to('addinfo') ?>",
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
							location.reload(true);
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
			title: "Delete Informasi",
			text: "Anda yakin menghapus informasi ini!",
			icon: "info",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "OK",
			allowOutsideClick: false,
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: "<?= url_to('deleteinfo') ?>",
					type: "POST",
					data: {
						id: id
					},
					dataType: 'json',
					beforeSend: function() {
						Swal.fire({
							title: "Loading!",
							allowOutsideClick: false,
							showConfirmButton: false,
							didOpen: () => {
								Swal.showLoading()
							}
						});
					},
					success: function(data) {
						Swal.fire({
							icon: data.stts,
							title: data.msg
						}).then((result) => {
							/* Read more about handling dismissals below */
							location.reload(true);
						});
					},
					error: function(jqXHR, textStatus, errorThrown) {
						Swal.fire("error");
					}
				});
			}
		});

	}
</script>
<?= $this->endSection() ?>