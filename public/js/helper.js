$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

function SuccessAlert(title, msg) {
    return Swal.fire(title, msg, 'success');
}

function ErrorAlert(title, msg) {
    Swal.fire(title, msg, 'error');
}

async function AjaxPost(url, param = {}, onSuccess = function () {
}, onAccepted = function () {

}) {
    try {
        let response = await $.post(url, param);
        if (response['status'] === 200) {
            onSuccess();
        } else {
            onAccepted();
        }
    } catch (e) {
        let error_message = JSON.parse(e.responseText);
        console.log(error_message);
        ErrorAlert('Error', error_message.message);
    }
}

function blockLoading(state) {
    if (state) {
        $('#overlay-loading').css('display', 'flex')
    } else {
        $('#overlay-loading').css('display', 'none')
    }
}

function AlertConfirm(title = 'Apakah Anda Yakin?', text = 'Apa anda yakin melanjutkan proses', fn) {
    Swal.fire({
        title: title,
        text: text,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya'
    }).then((result) => {
        if (result.value) {
            fn();
        }
    });
}

async function BaseDeleteHandler(url, id) {
    try {
        await $.post(url);
        Swal.fire({
            title: 'Success',
            text: 'Berhasil menghapus data...',
            icon: 'success',
            timer: 700
        }).then(() => {
            window.location.reload();
        })
    }catch (e) {
        let error_message = JSON.parse(e.responseText);
        ErrorAlert('Error', error_message.message);
    }
}

function validateMessage(message, target = []) {
    $.each(target, function (k, v) {
        let elTarget = $('#' + v + '-error');
        if (!elTarget.hasClass('d-none')) {
            elTarget.addClass('d-none');
        }
    });

    for (const [key, value] of Object.entries(message)) {
        let elTarget = $('#' + key + '-error');
        elTarget.removeClass('d-none');
        elTarget.html(value[0]);
    }
}

function createLoader(text = 'sedang mengunduh data...', height = 600) {
    return '<div class="d-flex flex-column align-items-center justify-content-center" style="height: ' + height + 'px">' +
        '<div class="spinner-border" role="status" style="color: var(--bg-primary);">\n' +
        '  <span class="sr-only" style="color: #117d17;"></span>\n' +
        '</div>' +
        '<div style="color: var(--dark); font-weight: 500;">' + text + '</div>' +
        '</div>';
}

function createEmptyProduct() {
    return '<div class="d-flex flex-column align-items-center justify-content-center" style="height: ' + 400 + 'px">' +
        '<div style="color: var(--dark); font-weight: 500;">Product Tidak Ditemukan...</div>' +
        '</div>';
}

function debounce(fn, delay) {
    var timer = null;
    return function () {
        var context = this,
            args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            fn.apply(context, args);
        }, delay);
    };
}
// var myToastEl = document.getElementById('liveToast');
// var myToast = new bootstrap.Toast(myToastEl, {
//     autohide: true,
//     animation: true,
//     delay: 1000
// });
// myToast.show();
