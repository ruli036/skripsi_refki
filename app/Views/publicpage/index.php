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
                    <li class="breadcrumb-item active">Informasi</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-12 col-md-12 box-col-12">
    <div class="email-right-aside bookmark-tabcontent">
        <div class="card email-body radius-left">
            <div class="ps-0">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="pills-created" role="tabpanel" aria-labelledby="pills-created-tab">
                        <div class="card mb-0">
                            <div class="card-header d-flex">
                                <h5 class="mb-0">INFO MADING</h5> 
                            </div>
                            <div class="card-body p-0">
                                <div class="taskadd">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <?php foreach ($info as $key => $value) : ?>
                                                <tr>
                                                    <td>
                                                    <h2 class="task_title_0"><?= $value->judul ?></h2>
                                                    <p class="project_name_0">Dibuat : <?= $value->created_at ?></p>
                                                        <p class="task_desc_0"><?= htmlspecialchars_decode($value->desc) ?></p>
                                                    </td>

                                                </tr>
                                            <?php endforeach; ?>


                                        </table>
                                    </div>
                                </div>
                            </div>
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
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script src="<?= base_url() ?>cuba/assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="<?= base_url() ?>cuba/assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="<?= base_url('assets/js/upload.js') ?>"></script>

 
<?= $this->endSection() ?>