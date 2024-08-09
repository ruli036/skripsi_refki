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
                        <h5>Lowongan Pekerjaan</h5>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive ">
                        <table class="table" id="tabledata">
                            <thead>
                                <tr class="border-bottom-primary">
                                    <th scope="col" width='2%'>No</th>
                                    <th scope="col">Perusahaan</th>
                                    <th scope="col" width='15%'>Alamat </th>
                                    <th scope="col">Posisi</th>
                                    <th scope="col">Kuota</th>
                                    <th scope="col">Pendaftar</th>
                                    <th scope="col">Batas Pendaftaran</th>
                                    <th scope="col" class="text-center">#</th>
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
                                        <td class="row col-md-12">
                                            <div class="col-md-12">
                                                <a type="button" class="btn btn-primary btn-sm" href="#" onclick="openModal('<?= $value->id ?>')">
                                                    <i class="fas fa-send"></i> Lamar
                                                </a>
                                            </div>
                                        </td>
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

<div class="modal fade " id="lamar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Kirim Lamaran Anda</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group row" style="padding-bottom: 15px;">
                    <label class="col-sm-3 col-form-label">No NIM*</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" required placeholder="NIM" id="nim">
                        <input type="hidden" class="form-control" required placeholder="NIM" id="id_lowongan">
                    </div>
                </div>
                <div class="form-group row" style="padding-bottom: 15px;">
                    <label class="col-sm-3 col-form-label">CV Anda*</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" required placeholder="CV" id="file_cv">
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpan()">Ajukan Lamaran</button>
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
    function openModal(id_lowongan) {
        $("#id_lowongan").val(id_lowongan);
        var myModal = new bootstrap.Modal(document.getElementById('lamar'), {
            keyboard: true
        });
        myModal.show();
    }

    function simpan() {
        const nim = $("#nim").val();
        const file = $("#file_cv")[0].files[0];
        const idlowongan = $("#id_lowongan").val();
        if (nim === '' || file === undefined) {
            return Swal.fire("INFO", "Harap mengisi semua data ", 'warning');
        }
        let formData = new FormData();
        formData.append('nim', nim);
        formData.append('file', file);
        formData.append('id_lowongan', idlowongan);
        $.ajax({
            url: "<?= url_to('ajukanlamaran') ?>",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                Swal.fire({
                    title: "Loading!",
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });
            },
            success: function (data) {
                console.log(data);
                Swal.fire(data.title, data.msg, data.icon).then(function (result) {
                    if (result.isConfirmed) {
                        if (data.stts) {
                            location.href = "<?= site_url('jadwal') ?>";
                        }
                    }
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire("Response", "Cek kembali inputan anda ", "warning");
            }
        });
    }
</script>
<?= $this->endSection() ?>