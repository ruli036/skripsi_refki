var imagesampah = document.getElementById('image-crop');

$('.previewcrop').hide();
$('.custom-file').show();
$('#image-bb').show();
$("body").on("change", "#pembayaran", function (e) {
    var files = e.target.files;
    var done = function (url) {
        imagesampah.src = url;
        // bs_modal.modal('show');
        cropper = new Cropper(imagesampah, {
            dragMode: 'move',
            aspectRatio: 2/3,
            autoCropArea: 0.8,
            restore: false,
            guides: false,
            center: false,
            highlight: false,
            cropBoxMovable: false,
            cropBoxResizable: false,
            toggleDragModeOnDblclick: false,
        });
        // document.getElementsByClassName('upload-file-data')[0].classList.remove('disabled');
        // document.getElementsByClassName('upload-file-preview')[0].classList.add('disabled');
        $('.previewcrop').show();
        $('.custom-file').hide();
        $('#image-bb').hide();
    };


    if (files && files.length > 0) {
        file = files[0];

        if (URL) {
            done(URL.createObjectURL(file));
        } else if (FileReader) {
            reader = new FileReader();
            reader.onload = function (e) {
                done(reader.result);
            };
            reader.readAsDataURL(file);
        }
    }
});

$("#crop").click(function () {
    canvas = cropper.getCroppedCanvas({
        width: 600,
        height: 600,
    });

    canvas.toBlob(function (blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function () {
            var base64data = reader.result;
            $('#imagepembayaran').val(base64data);
            var img = document.getElementById('image-bb');
            img.src = base64data;
            // bs_modal.modal('hide');
            cropper.destroy();
            cropper = null;
            $('.previewcrop').hide();
            $('.custom-file').show();
            $('#image-bb').show();
        };
    });
});