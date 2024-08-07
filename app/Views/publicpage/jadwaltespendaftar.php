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
                    <li class="breadcrumb-item active">Lowongan</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="col-xxl-12 col-xl-12 box-col-8e">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="header-top">
                        <h5>Jadwal Tes Pelamar Kerja</h5>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive ">
                        <table class="table" id="tabledata">
                            <thead>
                                <tr class="border-bottom-primary">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Perusahaan</th>
                                    <th scope="col">Posisi </th>
                                    <th scope="col" width='15%'>Lokasi </th>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                foreach ($jadwal as $key => $value) : ?>
                                    <tr class="border-bottom-secondary">
                                        <th scope="row"><?= ++$key ?></th>
                                        <td><?= $value->nama ?> <br>
                                            <?= $value->no_hp ?>
                                        </td>
                                        <td><?= $value->perusahaan ?></td>
                                        <td><?= $value->posisi ?></td>
                                        <td><?= $value->lokasi ?></td>
                                        <td><?= $value->waktu??'Belum ditentukan ' ?></td>
                                        <td><?= $value->stts == 'P' ? 'Mendaftar' : ($value->stts == 'W' ? 'Wawancara' : ($value->stts == 'L' ? 'Lulus' : 'Tidak Lulus')) ?></td>
                                        
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>

                        </table>
                    </div>
                </div>
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
</script>
<?= $this->endSection() ?>