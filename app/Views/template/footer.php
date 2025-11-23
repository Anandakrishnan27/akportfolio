<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- 2. DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<!-- 3. DataTables JS (after jQuery!) -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var base_url = "<?= base_url() ?>";

    $(document).ready(function () {
        $(document).on("click", "#submit-btn", function (e) {
            e.preventDefault();

            var form = $("#contact-form");
            var submitBtn = $(this);
            var originalText = submitBtn.find('.btn-text').text();

            // Optional: basic validation check
            if (!form[0].checkValidity()) {
                form[0].reportValidity();
                return;
            }

            // Show loading state
            submitBtn.addClass("disabled");
            submitBtn.find('.btn-text').text('Submitting...');

            $.ajax({
                url: base_url + "form-insert",
                method: "POST",
                data: form.serialize(),
                dataType: 'json',
                success: function (response) {
                    console.log(response);

                    if (response.status === 'success') {
                        alert("Form submitted successfully!");
                        form[0].reset();
                    } else {
                        alert("Error: " + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', xhr.responseText);
                    alert("Error submitting form. Please try again.");
                },
                complete: function () {
                    // Reset button state
                    submitBtn.removeClass("disabled");
                    submitBtn.find('.btn-text').text(originalText);
                }
            });
        });
    });
    ContactList();

    function ContactList() {
        $("#contactTable").DataTable().destroy();
        $("#contactTable").DataTable({
            processing: true,
            serverSide: true,
            serverMethod: "post",
            ajax: {
                url: base_url + "contact-list", // No trailing slash
                type: "POST",
                data: function (data) {
                    // Add CSRF token
                    var csrfName = $(".txt_csrfname").attr("name");
                    var csrfHash = $(".txt_csrfname").val();
                    data[csrfName] = csrfHash;
                    return data;
                },
                dataSrc: function (data) {
                    // Update CSRF token after response
                    $(".txt_csrfname").val(data.token);
                    return data.aaData;
                },
            },
            columns: [{
                data: "contact_id",
                render: function (data, type, row) {
                    return '<span data-label="S.No">' + data + '</span>';
                }
            },
            {
                data: "contact_name",
                render: function (data, type, row) {
                    return '<span data-label="Name">' + data + '</span>';
                }
            },
            {
                data: "contact_phone",
                render: function (data, type, row) {
                    return '<span data-label="Phone">' + data + '</span>';
                }
            },
            {
                data: "contact_email",
                render: function (data, type, row) {
                    return '<span data-label="Email">' + data + '</span>';
                }
            },
            {
                data: "contact_subject",
                render: function (data, type, row) {
                    return '<span data-label="Subject">' + data + '</span>';
                }
            },
            {
                data: "Actions",
                className: "action-cell"
            }
            ],
            columnDefs: [{
                targets: [0, 4],
                orderable: false
            }],
        });
    }

    $(document).ready(function () {
        ContactList();

        // Handle "View" button click
        $('#contactTable').on('click', '.view-contact', function () {
            var contactId = $(this).data('id');

            $.ajax({
                url: base_url + 'get-contact/' + contactId,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        $('#modal-name').text(response.data.contact_name);
                        $('#modal-phone').text(response.data.contact_phone);
                        $('#modal-email').text(response.data.contact_email);
                        $('#modal-subject').text(response.data.contact_subject);
                        $('#modal-message').text(response.data.contact_message);
                        $('#modal-date').text(response.data.contact_created_at || 'N/A');
                        $('#contactModal').modal('show');
                    } else {
                        alert('Failed to load contact details.');
                    }
                },
                error: function () {
                    alert('Error fetching contact info.');
                }
            });
        });
    });
    document.getElementById('carousalForm').addEventListener('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to add this Carousel?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#5156be",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, submit it!",
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('carousalForm');
                const formData = new FormData(form);

                // Show loading state
                const submitBtn = document.querySelector('.submit-btn');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Inserting...';
                submitBtn.disabled = true;

                fetch('<?= base_url('insert-Carousal') ?>', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Success!",
                                html: "Carousel added successfully!",
                                confirmButtonColor: "#5156be",
                            }).then(() => {
                                // Reset form
                                form.reset();
                                previewContainer.style.display = 'none';
                                // Update CSRF token
                                if (data.csrfHash) {
                                    const csrfInput = document.querySelector(
                                        'input[name="<?= csrf_token() ?>"]');
                                    if (csrfInput) {
                                        csrfInput.value = data.csrfHash;
                                    }
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Insert Failed",
                                html: data.message || "Something went wrong.",
                                confirmButtonColor: "#d33",
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: "error",
                            title: "AJAX Error",
                            text: "Something went wrong while sending data.",
                            confirmButtonColor: "#d33",
                        });
                    })
                    .finally(() => {
                        // Restore button state
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    });
            }
        });
    });
</script>
<script>
    // Image preview functionality
    const imageUpload = document.getElementById('imageUpload');
    const fileInput = document.getElementById('carousalimage');
    const previewContainer = document.getElementById('imagePreview');
    const previewImage = document.getElementById('previewImage');

    imageUpload.addEventListener('click', () => {
        fileInput.click();
    });

    fileInput.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
            }

            reader.readAsDataURL(this.files[0]);
        }
    });

    // Form submission
    const carousalForm = document.getElementById('carousalForm');
    const successMessage = document.getElementById('successMessage');

    carousalForm.addEventListener('submit', function (e) {
        e.preventDefault();

        // Get form values
        const carousalCode = document.getElementById('carousalCode').value;
        const carousalimage = document.getElementById('carousalimage').files[0];
        const carousalStatus = document.getElementById('carousalStatus').checked;

        // In a real application, you would send this data to a server
        // For this example, we'll just show a success message

        // Validate form (basic validation)
        if (!carousalCode || !carousalimage) {
            alert('Please fill in all required fields');
            return;
        }

        // Show success message
        successMessage.style.display = 'block';

        // Reset form after 2 seconds
        setTimeout(() => {
            carousalForm.reset();
            previewContainer.style.display = 'none';
            successMessage.style.display = 'none';
        }, 2000);
    });
</script>