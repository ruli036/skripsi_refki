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
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="card-title mb-0">My Profile</h4>

                            </div>
                            <div class="col-md-2">
                                <div class="btn-group text-end" role="group">
                                       
                                </div>
                            </div>

                        </div>
                        <div class="card-options">

                        </div>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row mb-2">
                                <div class="profile-title">
                                    <div class="media">
                                        <img class="img-100 rounded-3" alt="" src="<?= base_url('assets/files/foto/' . $user->photo) ?>" onerror="this.onerror=null;this.src='https://nse.alazharcairobna.sch.id/assets/img/boy.png';">
                                        <div class="media-body">
                                            <h5 class="mb-1"></h5>


                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label> <br>
                                <b><?= $user->email ?></b> <br>
                                <label class="form-label">Username</label> <br>
                                <b><?= $user->username ?></b> <br>
                                <label class="form-label">Role User</label> <br>
                                <b><?= $role ?></b> <br>

                            </div>
                        </form>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Ganti Password
                                        </button>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">

            </div>

        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row" style="padding-bottom: 15px;">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" required placeholder="Password" id="password">
                                <input type="hidden" class="form-control" value="<?=$user->id?>" disabled id="id">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="simpan()">Save changes</button>
                    </div>
                </div>
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
                
                const id = $("#id").val();
                const password = $("#password").val();
                if (password === '') {
                    return Swal.fire("INFO", "Harap mengisi semua data ", 'warning');
                }
                let formData = new FormData();
                formData.append('id', id);
                formData.append('password', password);
                $.ajax({
                    url: "<?= url_to('gantipass') ?>",
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
                                    location.href = "<?= site_url('dashboard') ?>";
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