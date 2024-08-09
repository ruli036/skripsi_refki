<?= $this->extend('layout/master_public') ?>
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
                    <li class="breadcrumb-item active">Mahasiswa</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<?php if (session()->getFlashdata('errorid')) : ?>
<div class="container-fluid">
    <div class="alert alert-secondary dark alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('errorid'); ?>.
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title=""
            title=""></button>
    </div>
</div>
<?php endif; ?>
<div class="container-fluid">
    <div class="row project-cards">
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h4 class="mb-0">MAHASISWA</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-end align-items-center">
                                
                            </div>
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
                                    <a href="#">Mahasiswa </a>
                                </h6>

                                <div class="table-responsive">
                                    <table class="table" id="tabledata">
                                        <thead>
                                            <tr class="border-bottom-primary">
                                                <th scope="col">No</th>
                                                <th scope="col">Jurusan</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Jenis Kelamin</th>
                                                <th scope="col">Tempat, Tgl Lahir</th>
                                                <th scope="col">Tempat Kerja</th>
                                                <th scope="col">Posisi Kerja</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($mahasiswa)) : ?>
                                            <tr>
                                                <td colspan="8" class="text-center">
                                                    Data Kosong
                                                </td>
                                            </tr>
                                            <?php else : ?>
                                            <?php
                                                $page = isset($_GET['page_siswa']) ? $_GET['page_siswa'] : 1;
                                                $no = 1 + (10 * ($page - 1));

                                                foreach ($mahasiswa as $key => $value) : ?>
                                            <tr class="border-bottom-secondary">
                                                <th scope="row"><?= $no++ ?></th>
                                                <td><?= $value->jurusan ?></td>
                                                <td><?= $value->nama ?></td>
                                                <td><?= $value->jk == 'P' ? 'Perempuan' : 'Laki-Laki' ?></td>
                                                <td><?= $value->tempat_lahir ?>, <?= $value->tgl_lahir ?></td>
                                                <td><?= $value->perusahaan ?></td>
                                                <td><?= $value->pekerjaan ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
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
    $("#tabledata").DataTable({
        "paging": true,
        "ordering": true,
        "info": false,
        "searching": true,
    });

</script>
<?= $this->endSection() ?>