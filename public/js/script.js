

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


function showInput() {
    var select = document.getElementById("keperluan");
    var lainnyaInput = document.getElementById("lainnya");

    if (select.value === "other") {
        lainnyaInput.classList.remove("hidden");
    } else {
        lainnyaInput.classList.add("hidden");
    }
}
    

function showOtherInput() {
    var select = document.getElementById("tujuan_berkunjung");
    var lainnyaInput = document.getElementById("tujuan_berkunjung_lainnya");

    if (select.value === "Lainnya") {
        lainnyaInput.classList.remove("hidden");
    } else {
        lainnyaInput.classList.add("hidden");
    }
}



document.addEventListener('DOMContentLoaded', function () {
    flatpickr("input[name='start']", {
        dateFormat: "Y-m-d",
        onChange: function(selectedDates, dateStr, instance) {
            console.log('Selected start date:', dateStr);
        }
    });

    flatpickr("input[name='end']", {
        dateFormat: "Y-m-d",
        onChange: function(selectedDates, dateStr, instance) {
            console.log('Selected end date:', dateStr);
        }
    });
});


function showOtherInput() {
    var select = document.getElementById('tujuan_berkunjung');
    var otherInput = document.getElementById('tujuan_berkunjung_lainnya');
    if (select.value === 'other') {
      otherInput.classList.remove('hidden');
    } else {
      otherInput.classList.add('hidden');
    }
  }