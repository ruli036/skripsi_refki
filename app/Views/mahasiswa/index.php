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
                    <li class="breadcrumb-item active">Mahasiswa</li>
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
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h4 class="mb-0">MAHASISWA</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-end align-items-center">
                                <a href="#" class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#add">ADD DATA</a>
                                <form action="" class="d-flex" autocomplete="on">
                                    <input type="text" name="keyword" value="<?= $keyword ?>" class="form-control me-2" placeholder="Pencarian">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </form>
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
                                                <th scope="col">NIM</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Jenis Kelamin</th>
                                                <th scope="col">Tempat, Tgl Lahir</th>
                                                <th scope="col">Agama</th>
                                                <th scope="col">No Hp</th>
                                                <th scope="col">IPK</th>
                                                <th scope="col">Aksi</th>
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
                                                        <td><?= $value['jurusan'] ?></td>
                                                        <td><?= $value['nim'] ?></td>
                                                        <td><?= $value['nama'] ?></td>
                                                        <td><?= $value['jk'] == 'P' ? 'Perempuan' : 'Laki-Laki' ?></td>
                                                        <td><?= $value['tempat_lahir'] ?>, <?= $value['tgl_lahir'] ?></td>
                                                        <td><?= $value['agama'] ?></td>
                                                        <td><?= $value['no_hp'] ?></td>
                                                        <td><?= $value['ipk'] ?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary btn-sm" onclick="openModal('<?= $value['id'] ?>','<?= $value['id_jurusan'] ?>','<?= $value['nim'] ?>','<?= $value['nama'] ?>','<?= $value['tempat_lahir'] ?>','<?= $value['tgl_lahir'] ?>','<?= $value['agama'] ?>','<?= $value['no_hp'] ?>','<?= $value['ipk'] ?>','<?= $value['jk'] ?>')">
                                                                Edit
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="deleted('<?= $value['id'] ?>')">
                                                                Delete
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>

                                    </table>
                                    <div class="pull-left">
                                        <?= $pager->links('siswa') ?>
                                    </div>

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

<div class="modal fade " id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group row" style="padding-bottom: 15px;">
                    <label class="col-sm-3 col-form-label">Jurusan</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="id_jurusan" id="id_jurusan">
                            <?php foreach ($jurusan as $rk) : ?>
                                <option value="<?= $rk->id ?>"> <?= $rk->nama ?> (<?= $rk->kode ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row" style="padding-bottom: 15px;">
                    <label class="col-sm-3 col-form-label">NIM</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" required placeholder="NIM" id="nim">
                    </div>
                </div>
                <div class="form-group row" style="padding-bottom: 15px;">
                    <label class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" required placeholder="Nama" id="nama">
                    </div>
                </div>
                <div class="form-group row" style="padding-bottom: 15px;">
                    <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" required placeholder="Tempat Lahir" id="tempat_lahir">
                    </div>
                </div>
                <div class="form-group row" style="padding-bottom: 15px;">
                    <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" required placeholder="Tanggal Lahir" id="tgl_lahir">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jk" id="L" value="L">
                            <label class="form-check-label" for="L">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jk" id="P" value="P">
                            <label class="form-check-label" for="P">
                                Perempuan
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row" style="padding-bottom: 15px;">
                    <label class="col-sm-3 col-form-label">Agama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" required placeholder="Agama" id="agama">
                    </div>
                </div>
                <div class="form-group row" style="padding-bottom: 15px;">
                    <label class="col-sm-3 col-form-label">No Hp</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" required placeholder="No Hp" id="no_hp">
                    </div>
                </div>
                <div class="form-group row" style="padding-bottom: 15px;">
                    <label class="col-sm-3 col-form-label">IPK</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" required placeholder="IPK" id="ipk">
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
<div class="modal fade " id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group row" style="padding-bottom: 15px;">
                    <label class="col-sm-3 col-form-label">Jurusan</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="id_jurusan2" id="id_jurusan2">
                            <?php foreach ($jurusan as $rk) : ?>
                                <option value="<?= $rk->id ?>"> <?= $rk->nama ?> (<?= $rk->kode ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row" style="padding-bottom: 15px;">
                    <label class="col-sm-3 col-form-label">NIM</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" required placeholder="NIM" id="nim2">
                    </div>
                </div>
                <div class="form-group row" style="padding-bottom: 15px;">
                    <label class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" required placeholder="Nama" id="nama2">
                    </div>
                </div>
                <div class="form-group row" style="padding-bottom: 15px;">
                    <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" required placeholder="Tempat Lahir" id="tempat_lahir2">
                    </div>
                </div>
                <div class="form-group row" style="padding-bottom: 15px;">
                    <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" required placeholder="Tanggal Lahir" id="tgl_lahir2">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jk2" id="L2" value="L">
                            <label class="form-check-label" for="L2">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jk2" id="P2" value="P">
                            <label class="form-check-label" for="P2">
                                Perempuan
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row" style="padding-bottom: 15px;">
                    <label class="col-sm-3 col-form-label">Agama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" required placeholder="Agama" id="agama2">
                    </div>
                </div>
                <div class="form-group row" style="padding-bottom: 15px;">
                    <label class="col-sm-3 col-form-label">No Hp</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" required placeholder="No Hp" id="no_hp2">
                    </div>
                </div>
                <div class="form-group row" style="padding-bottom: 15px;">
                    <label class="col-sm-3 col-form-label">IPK</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" required placeholder="IPK" id="ipk2">
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url() ?>cuba/assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="<?= base_url() ?>cuba/assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script src="<?= base_url('assets/js/upload.js') ?>"></script>

<script type="text/javascript">
    function openModal(id, idjsn, nim, nama, tempat, tgl_lahir, agama, nohp, ipk, jk) {
        $("#id").val(id);
        $("#id_jurusan").val(idjsn);
        $("#nim").val(nim);
        $("#nama").val(nama);
        $("#tgl_lahir").val(tgl_lahir);
        $("#agama").val(agama);
        $("#tempat_lahir").val(tempat);
        $("#no_hp").val(nohp);
        $("#ipk").val(ipk);
        if (jk === 'L') {
            $("#L").prop("checked", true);
        } else if (jk === 'P') {
            $("#P").prop("checked", true);
        }
        var myModal = new bootstrap.Modal(document.getElementById('edit'), {
            keyboard: true
        });
        myModal.show();
    }

    function simpan() {
        const id = $("#id").val();
        const id_jurusan = $("#id_jurusan").val();
        const nim = $("#nim").val();
        const nama = $("#nama").val();
        const tgl_lahir = $("#tgl_lahir").val();
        const agama = $("#agama").val();
        const tempat_lahir = $("#tempat_lahir").val();
        const no_hp = $("#no_hp").val();
        const ipk = $("#ipk").val();
        var jk = $("input[name='jk']:checked").val();
        if (nama === '' || no_hp === '' || ipk === '' || tempat_lahir === '' || agama === '' || tgl_lahir === '' || nim === '') {
            return Swal.fire("INFO", "Harap mengisi semua data ", 'warning');
        }
        let formData = new FormData();
        formData.append('id', id);
        formData.append('id_jurusan', id_jurusan);
        formData.append('nim', nim);
        formData.append('nama', nama);
        formData.append('tgl_lahir', tgl_lahir);
        formData.append('agama', agama);
        formData.append('tempat_lahir', tempat_lahir);
        formData.append('no_hp', no_hp);
        formData.append('jk', jk);
        $.ajax({
            url: "<?= url_to('editmahasiswa') ?>",
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
                            location.href = "<?= site_url('admin/mahasiswa') ?>";
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
        const id_jurusan = $("#id_jurusan2").val();
        const nim = $("#nim2").val();
        const nama = $("#nama2").val();
        const tgl_lahir = $("#tgl_lahir2").val();
        const agama = $("#agama2").val();
        const tempat_lahir = $("#tempat_lahir2").val();
        const no_hp = $("#no_hp2").val();
        const ipk = $("#ipk2").val();
        var jk = $("input[name='jk2']:checked").val();
        if (nama === '' || no_hp === '' || ipk === '' || tempat_lahir === '' || agama === '' || tgl_lahir === '' || nim === '') {
            return Swal.fire("INFO", "Harap mengisi semua data ", 'warning');
        }
        let formData = new FormData();
        formData.append('id', id);
        formData.append('id_jurusan', id_jurusan);
        formData.append('nim', nim);
        formData.append('nama', nama);
        formData.append('tgl_lahir', tgl_lahir);
        formData.append('agama', agama);
        formData.append('tempat_lahir', tempat_lahir);
        formData.append('no_hp', no_hp);
        formData.append('jk', jk);
        $.ajax({
            url: "<?= url_to('addmahasiswa') ?>",
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
                            location.href = "<?= site_url('admin/mahasiswa') ?>";
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
            title: "Delete Data Mahasiswa",
            text: "Anda yakin menghapus data mahasiswa ini!",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "OK",
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= url_to('deletemahasiswa') ?>",
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