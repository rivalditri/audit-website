function uploadFile() {
    var formData = new FormData(document.querySelector('#form-upload'));
    var xhr = new XMLHttpRequest();

    xhr.open('POST', '/upload', true);
    xhr.setRequestHeader('Content-Type', 'multipart/form-data');
    xhr.send(formData);

    xhr.onload = function (event) {
        if (xhr.status === 201) {
            // Success
            alert('File berhasil diupload!');
            // Prevent page reload
            event.preventDefault();
        } else {
            // Error
            alert('Gagal mengupload file!');
        }
    };
}

document.querySelector('#form-upload').querySelector('.btn-upload').addEventListener('click', uploadFile);
