function confirmDeletion(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}

function edit(element) {
    var modalId = element.getAttribute('data-target').substring(1);
    var url = element.getAttribute('data-url');
    var modal = document.getElementById(modalId);
    var form = modal.querySelector('form');
    form.dataset.url = url;

    form.querySelectorAll('.is-invalid').forEach(function (element) {
        element.classList.remove('is-invalid');
    });
    form.querySelectorAll('.invalid-feedback').forEach(function (element) {
        element.innerHTML = '';
    });

    var dataAttributes = element.dataset;
    var inputFile;
    for (var key in dataAttributes) {
        if (dataAttributes.hasOwnProperty(key)) {
            var inputField = modal.querySelector(`#${key}`);
            if (inputField) {
                inputFile = inputField
                if (inputField.type === 'file') {
                    var fileNameDisplay = modal.querySelector('#display_image');
                    if (fileNameDisplay) {
                        fileNameDisplay.innerHTML = `
                            <img src="/storage/${dataAttributes[key]}" class="img-fluid mt-3" alt="">
                        `
                    }
                } else if (inputField.tagName === 'SELECT') {
                    var options = inputField.querySelectorAll('option');
                    for (var i = 0; i < options.length; i++) {
                        var option = options[i];
                        if (option.value === dataAttributes[key]) {
                            option.setAttribute('selected', '')
                            break;
                        }
                    }
                    $('.selectpicker').selectpicker('destroy')
                    document.getElementById(key).classList.add('selectpicker')
                    $('.selectpicker').selectpicker()
                } else {
                    inputField.value = dataAttributes[key];
                }
            }
            if (key === 'manage_instrument_images') {
                var manageInstrumentImage =  document.getElementById('manage_instrument_images')
                manageInstrumentImage.href = dataAttributes[key]
            }
        }
    } 

    if(inputFile){
        inputFile.addEventListener('change', function () {
            var file = inputFile.files[0]
            var displayImage = document.getElementById('display_image')
            if (displayImage) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    displayImage.innerHTML = `
                        <img src="${e.target.result}" class="img-fluid mt-3" alt="">
                    `;
                }
                reader.readAsDataURL(file);
            }
        })
    }
} 

document.addEventListener('DOMContentLoaded', function () {
    var forms = document.querySelectorAll('.ajax-form');
    forms.forEach(function (form) {
        var submitButton = form.querySelector('button[type="submit"]');
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            submitButton.disabled = true;
            
            var url = form.getAttribute('data-url');
            var formData = new FormData(form);
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.status === 422) {
                        submitButton.disabled = false;
                        form.querySelectorAll('.is-invalid').forEach(function (element) {
                            element.classList.remove('is-invalid');
                        });
                        Object.keys(data.errors).forEach(function (key) {
                            var input = form.querySelector('[name="' + key + '"]');
                            if (!input) {
                                input = form.querySelector('[name="' + key + '[]"]');
                            }
                            if (input) {
                                input.addEventListener('input', function () {
                                    if ((input.type === 'file' && input.files.length > 0) ||
                                        (input.value && input.value.trim() !== '')) {
                                        input.classList.remove('is-invalid');
                                        input.classList.add('is-valid');
                                        let message = document.getElementById(key + 'Feedback');
                                        message.innerHTML = '';
                                    } else {
                                        input.classList.add('is-invalid');
                                        let message = document.getElementById(key + 'Feedback');
                                        message.innerHTML = data.errors[key][0];
                                    }
                                });

                                if (input.type === 'file' && input.files.length === 0) {
                                    input.classList.add('is-invalid');
                                    let message = document.getElementById(key + 'Feedback');
                                    message.innerHTML = data.errors[key][0];
                                } else {
                                    input.classList.add('is-invalid');
                                    let message = document.getElementById(key + 'Feedback');
                                    message.innerHTML = data.errors[key][0];
                                }
                            }
                        });
                    } else {
                        $('.hide').click();
                        Swal.fire({
                            title: "Good job!",
                            text: data.message,
                            icon: "success",
                            isConfirmed: true,
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                })
                .catch(e => {
                    console.log(e);
                })
        });
    });
});