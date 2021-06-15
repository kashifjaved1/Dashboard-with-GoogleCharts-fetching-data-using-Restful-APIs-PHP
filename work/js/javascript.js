$(document).ready(function () {
    $("#ajax-upload-form").submit(function (e) {
        e.preventDefault();

        var fd = new FormData();
        var files = $(".file-input")[0].files;

        for (var i = 0; i < files.length; i++) {
            fd.append("ajax_file", files[i]);
            var bar = '<div class="progress" id="' + i + '">' +
                    '<span class="abort" id="abort-' + i + '">&times;</span>' +
                    '<div class="progress-title" id="progress-title-' + i + '"></div>' +
                    '<div class="progress-bar" id="progress-bar-' + i + '"></div>' +
                    '</div>';
            $(".progress-container").append(bar);
            uploadFile(fd, i, files[i]);
            if (i === (files.length - 1))
                this.reset();
        }
    });
    $(document).on("click", ".progress-error > .abort", function () {
        $(this).closest(".progress").fadeOut(3000, function () {
            $(this).remove();
        });
    });

});

function uploadFile(fd, i, file) {
    var ajax = $.ajax({
        url: 'process-upload.php',
        type: 'POST',
        data: fd,
        processData: false,
        contentType: false,
        xhr: function () {
            var xhr = $.ajaxSettings.xhr();
            if (xhr.upload) {
                xhr.upload.addEventListener("progress", function (progress) {
                    var total = Math.round((progress.loaded / progress.total) * 100);
                    $("#progress-bar-" + i).css({"width": total + "%"});
                    $("#progress-title-" + i).text(file.name + ' - ' + total + "%");
                }, false);
                xhr.addEventListener("abort", function () {
                    $("#progress-bar-" + i).closest(".progress").fadeOut(3000, function () {
                        $(this).remove();
                    });
                }, false);
                xhr.addEventListener("loadend", function () {
                    $("#progress-bar-" + i).closest(".progress").fadeOut(3000, function () {
                        $(this).remove();
                    });
                }, false);

                xhr.addEventListener("error", function () {
                    $("#progress-bar-" + i).closest(".progress")
                            .addClass("progress-error").find("status-count").text("Error");
                }, false);
                xhr.addEventListener("timeout", function (progress) {
                    $("#progress-bar-" + i).closest(".progress")
                            .addClass("progress-timedout").find("status-count").text("Timed Out");
                }, false);
            }
            return xhr;
        }
    });
    $(document).on("click", ".progress > #abort-" + i, function () {
        ajax.abort();
    });
}