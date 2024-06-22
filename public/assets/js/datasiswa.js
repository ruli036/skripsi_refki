$(document).ready(function () {
    // Setup datatables
    $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };

    var table = $("#tabledata").dataTable({
        initComplete: function () {
            var api = this.api();
            $('#mytable_filter input')
                .off('.DT')
                .on('input.DT', function () {
                    api.search(this.value).draw();
                });
        },
        oLanguage: {
            sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: { "url": baseurl + "aset/getdataaset", "type": "POST" },
        // p.nik,p.nama,if(q.jadwal_cuti='0','Backdate','Normal') as `jdwlcuti`,r.nama as `jenis_cuti`,q.tanggal_dari,q.tanggal_sampai,q.jlh_hari,q.stts_cuti
        columns: [
            { "data": "id_finance", "className": "text-center p-25", "orderable": false },
            // { "data": "tanggal", "className": "p-25 text-center" },
            // { "data": "kode", "className": "p-25" },
            // { "data": "uraian", "className": "p-25" },
            // { "data": "lokasi", "className": "p-25" },
            // { "data": "tarif", "className": "text-right p-25", render: $.fn.dataTable.render.number(',', '.', '') },
            // { "data": "masa", "className": "text-right p-25", render: $.fn.dataTable.render.number(',', '.', '') },
            // { "data": "hargaunit", "className": "text-right p-25", render: $.fn.dataTable.render.number(',', '.', '') },
            // { "data": "jmlh", "className": "text-right p-25" },
            // { "data": "hargabeli", "className": "text-right p-25", render: $.fn.dataTable.render.number(',', '.', '') },
        ],
        order: [[1, 'desc']],
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            $('td:eq(0)', row).html();
        },


    });
    // end setup datatables
    // get Edit Records
    $('#mytable').on('click', '.edit_record', function () {
        var kode = $(this).data('kode');
        var nama = $(this).data('nama');
        var harga = $(this).data('harga');
        var kategori = $(this).data('kategori');
        $('#ModalUpdate').modal('show');
        $('[name="kode_barang"]').val(kode);
        $('[name="nama_barang"]').val(nama);
        $('[name="harga"]').val(harga);
        $('[name="kategori"]').val(kategori);
    });
    // End Edit Records
    // get Hapus Records
    $('#mytable').on('click', '.hapus_record', function () {
        var kode = $(this).data('kode');
        $('#ModalHapus').modal('show');
        $('[name="kode_barang"]').val(kode);
    });
    // End Hapus Records
    $("#tabledata thead tr th").each(function () {
        $(this).removeClass("p-25");
        $(this).removeClass("text-right");
    });
});