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

function store(element){
    let modalId = element.getAttribute('data-bs-target').substring(1)
    let url = element.getAttribute('data-url')
    let modal = document.getElementById(modalId)
    let form = modal.querySelector('form')
    form.dataset.url = url

    let input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'id';
    input.id = 'id'
    input.value = element.getAttribute('data-payment_id');
    form.appendChild(input);
}

function detail(element){
    let detail = document.getElementById('detail')
    let orderId = element.getAttribute('data-order_id')
    let name = element.getAttribute('data-name')
    let address = element.getAttribute('data-address')
    let amountPaid = parseFloat(element.getAttribute('data-amount_paid'))
    let status = element.getAttribute('data-status')
    let proofPayment = element.getAttribute('data-proof_payment')
    let proofImage = ''
    if (proofPayment) {
        proofImage += `
            <img src="storage/${proofPayment}" class="img-fluid" alt="">
        `
    }
    fetch('order/detail/'+orderId, {
        method: 'GET'
    })
    .then(response => response.json())
    .then(res => {
        let instrumentsHTML = '';
        res.data.instruments.forEach(item => {
            instrumentsHTML += `
                <tr>
                    <td>${item.instrument.name_instrument}</td>
                    <td>${item.quantity}</td>
                    <td>Rp. ${item.instrument.price.toLocaleString()}</td>
                </tr>
            `;
        });
        detail.innerHTML = `
            <div class="container" style="margin-top: -20px;">
                <div class="row">
                    <div class="col-md-12">
                    <p class="mt-3">Name : ${name}</p>
                    <p style="margin-top: -14px;">Ordered at : ${res.data.ordered_at}</p>
                    <p style="margin-top: -14px;">Shipping address : ${address}</p>
                    <p style="margin-top: -14px;">Status : <span class="badge text-bg-info p-2">${status}</span></p>
                    </div>
                </div>
            </div>  
            <div class="table-responsive">
                <table class="table table-sm table-borderless text-end">
                    <thead>
                        <tr>
                            <th>Instrument</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${instrumentsHTML}
                    </tbody>
                </table>
            </div>
            <p class="float-end badge text-bg-info p-2">Total payment : Rp. ${amountPaid.toLocaleString()}</p>
            ${proofImage}
        `
    })
    .catch(e => {
        console.log(e);
    })
}

function updateQuantity(element){
    let modalId = element.getAttribute('data-bs-target').substring(1)
    let url = element.getAttribute('data-url')
    let modal = document.getElementById(modalId)
    let form = modal.querySelector('form')
    form.dataset.url = url
    let input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'instrument_id';
    input.id = 'instrument_id'
    input.value = element.getAttribute('data-instrument_id');
    form.appendChild(input);

    let quantity = document.getElementById('quantity')
    quantity.value = element.getAttribute('data-quantity')
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
                    if (data.status === 422) {
                        submitButton.disabled = false;
                        form.querySelectorAll('.is-invalid').forEach(function (element) {
                            element.classList.remove('is-invalid');
                        });
                        Object.keys(data.errors).forEach(function (key) {
                            if (key === 'instrumentAlready') {
                                $('.hide').click();
                                Swal.fire({
                                    text: data.errors[key][0],
                                    icon: "info",
                                    isConfirmed: true,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false
                                })
                            }
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
                        console.log(data);
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
                    submitButton.disabled = true;
                    console.log(e);
                })
        });
    });
});