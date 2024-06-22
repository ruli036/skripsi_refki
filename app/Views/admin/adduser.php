<?= $this->extend('layout/master') ?>
<?= $this->section('main-content') ?>

<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Tes Dinas Aceh Jaya</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url("home") ?>">
                            <svg class="stroke-icon">
                                <use href="ccc/assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a>
                    </li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Profile</li>
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
    <div class="edit-profile">
        <div class="row">
            <div class="col-xl-12 xl-100 box-col-12">
                <div class="card">
                    <div class="job-search">
                        <div class="card-body">
                            <div class="media">
                                <img class="img-40 img-fluid m-r-20" src="<?= base_url('nubis/images/logo.png') ?>" alt="">
                                <div class="media-body">
                                    <h6 class="f-w-600">
                                        <a href="#">Add User</a>
                                        <!-- <span class="pull-right">
										<button class="btn btn-primary" type="button">Apply</button>
									</span> -->
                                    </h6>
                                    <p>LP3I Banda Aceh
                                        <span>
                                            <i class="fa fa-star font-warning"></i>
                                            <i class="fa fa-star font-warning"></i>
                                            <i class="fa fa-star font-warning"></i>
                                            <i class="fa fa-star font-warning"></i>
                                            <i class="fa fa-star font-warning"></i>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="job-description">
                            </div>
                            <?php
                            if (session()->getFlashdata('success')) : ?>
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?= session()->getFlashdata('success'); ?>
                                </div>
                            <?php endif; ?>
                            <form id="formbiodatadiri" enctype="multipart/form-data">
                                <div class="form-group row" style="padding-bottom: 15px;">
                                    <label class="col-sm-3 col-form-label">Photo</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" required value="" id="photo" accept="image/*">
                                    </div>
                                </div>
                                <div class="form-group row" style="padding-bottom: 15px;">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control " placeholder="Email" id="email">
                                    </div>
                                </div>
                                <div class="form-group row" style="padding-bottom: 15px;">
                                    <label class="col-sm-3 col-form-label">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" required placeholder="Nama Lengkap" name="username" id="username">
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input"  type="radio" name="jk" id="laki-laki" value="L" checked>
                            <label class="form-check-label" for="laki-laki">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jk" id="perempuan" value="P">
                            <label class="form-check-label" for="perempuan">
                                Perempuan
                            </label>
                        </div>
                    </div>
                </div> -->
                                <div class="form-group row" style="padding-bottom: 15px;">
                                    <label class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" required placeholder="Password" id="password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="button" onclick="simpan()" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8">

    </div>

</div>


<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>cuba/assets/css/vendors/date-picker.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url() ?>cuba/assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="<?= base_url() ?>cuba/assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script src="<?= base_url('assets/js/upload.js') ?>"></script>
<script type="text/javascript">
    function simpan() {
        const photo = $("#photo").val();
        const email = $("#email").val();
        const username = $("#username").val();
        const password = $("#password").val();
        if (photo === '' || email === '' || username === '') {
            return Swal.fire("INFO", "Harap mengisi semua data ", 'warning');
        }

        let formData = new FormData();
        formData.append('photo', $('#photo')[0].files[0]);
        formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

        // Append other form data
        formData.append('email', email);
        formData.append('username', username);
        formData.append('password_hash', password);
        $.ajax({
            url: "<?= url_to('simpanuser') ?>",
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
                            location.href = "<?= site_url('admin/datauser') ?>";
                        }
                    }
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.fire("Response", "Cek kembali inputan anda ", "warning");
            }
        });
    }
</script>
<?= $this->endSection() ?>