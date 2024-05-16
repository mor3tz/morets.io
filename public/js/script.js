

function showUploadFileName(type) {
    let input, fileNameDisplay, uploadText;

    if (type === 'ktp') {
        input = document.getElementById('foto_ktp');
        fileNameDisplay = document.getElementById('file-name-ktp');
        uploadText = document.getElementById('upload-text-ktp');
    } else if (type === 'vaksin') {
        input = document.getElementById('kartu_vaksin');
        fileNameDisplay = document.getElementById('file-name-vaksin');
        uploadText = document.getElementById('upload-text-vaksin');
    }

    if (input.files && input.files.length > 0) {
        const fileName = input.files[0].name;
        fileNameDisplay.textContent = `File uploaded: ${fileName}`;
        uploadText.textContent = 'Change file';
    } else {
        fileNameDisplay.textContent = '';
        uploadText.textContent = 'Upload a file';
    }
}