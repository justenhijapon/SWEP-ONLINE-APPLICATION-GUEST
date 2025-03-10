<style>
    .swal2-large-popup {
        font-size: 18px !important; /* Increase font size */
        padding: 30px !important; /* Increase padding */
    }

    .swal2-large-title {
        font-size: 24px !important; /* Larger title */
    }

    .swal2-large-content {
        font-size: 18px !important; /* Larger text */
    }


    /* Increase modal size */
    .swal2-extra-large-popup {
        font-size: 20px !important; /* Larger font size */
        padding: 10px !important; /* Increase padding */
        width: 35% !important; /* Make modal wider */
    }

    /* Increase title size */
    .swal2-extra-large-title {
        font-size: 28px !important; /* Larger title */
        font-weight: bold;
    }

    /* Increase content size */
    .swal2-extra-large-content {
        font-size: 18px !important; /* Bigger text */
    }

    /* Style textarea */
    .swal2-extra-large-textarea {
        font-size: 18px !important; /* Larger text */
        padding: 10px !important;
        min-height: 100px !important; /* Adjust height */
        width: 90% !important;
    }


</style>
<script>
    $(document).on("click", ".revoked_btn", function () {
        var slug = $(this).attr("data"); // Get the slug from the button

        if (confirm("Are you sure you want to revoke this record?")) {
            $.ajax({
                url: "/update-status", // Update with your route
                type: "POST",
                data: {
                    slug: slug,
                    status: 0, // Update received value to 0
                    _token: "{{ csrf_token() }}" // Laravel CSRF token
                },
                success: function (response) {
                    succeed(form, true, true); // Call the success function

                    // Refresh DataTables without reloading the page
                    $('#yourDataTableID').DataTable().ajax.reload();
                },
                error: function () {
                    alert("Something went wrong.");
                }
            });
        }
    });

</script>
<script type="text/javascript">
    {{--$('body').on('click', '.RevokeButton', function () {--}}
    {{--    let button = $(this);--}}
    {{--    let slug = button.attr('data');--}}
    {{--    let url = '{{ route('admin.importedCommodities.revokedUpdate', 'slug') }}'.replace('slug', slug);--}}

    {{--    // Show SweetAlert2 modal with textarea input--}}
    {{--    Swal.fire({--}}
    {{--        title: "Are you sure?",--}}
    {{--        html: "<strong>Please enter a reason for revoking this application:</strong>", // Use HTML for bold text--}}
    {{--        input: "textarea", // Change to textarea--}}
    {{--        inputPlaceholder: "Enter remarks here...",--}}
    {{--        icon: "warning", // Add warning icon--}}
    {{--        showCancelButton: true,--}}
    {{--        confirmButtonText: "Revoke",--}}
    {{--        cancelButtonText: "Cancel",--}}
    {{--        width: "500px", // Increase modal width--}}
    {{--        customClass: {--}}
    {{--            popup: 'swal2-extra-large-popup',--}}
    {{--            title: 'swal2-extra-large-title',--}}
    {{--            htmlContainer: 'swal2-extra-large-content',--}}
    {{--            input: 'swal2-extra-large-textarea' // Custom class for textarea styling--}}
    {{--        },--}}
    {{--        inputAttributes: {--}}
    {{--            'rows': 5, // Set textarea size--}}
    {{--            'style': 'resize: vertical;' // Allow vertical resizing--}}
    {{--        },--}}
    {{--        inputValidator: (value) => {--}}
    {{--            if (!value.trim()) {--}}
    {{--                return "Remarks are required!";--}}
    {{--            }--}}
    {{--        }--}}
    {{--    }).then((result) => {--}}
    {{--        if (result.isConfirmed) {--}}
    {{--            let remarks = result.value;--}}

    {{--            // Proceed with revocation if confirmed--}}
    {{--            $.ajax({--}}
    {{--                url: url,--}}
    {{--                type: 'POST',--}}
    {{--                data: {--}}
    {{--                    revoked: 'true', // Always set revoked to true--}}
    {{--                    remarks: remarks // Send remarks--}}
    {{--                },--}}
    {{--                headers: {--}}
    {{--                    {!! __html::token_header() !!}--}}
    {{--                },--}}
    {{--                success: function (response) {--}}
    {{--                    applicationTbl.draw();--}}
    {{--                    console.log(response);--}}

    {{--                    // Update button class and text--}}
    {{--                    button.removeClass('btn-success').addClass('btn-danger').text('Revoked');--}}

    {{--                    // Show success message with large size--}}
    {{--                    Swal.fire({--}}
    {{--                        title: "Revoked!",--}}
    {{--                        text: "The application has been successfully revoked.",--}}
    {{--                        icon: "success",--}}
    {{--                        width: "600px",--}}
    {{--                        customClass: {--}}
    {{--                            popup: 'swal2-extra-large-popup',--}}
    {{--                            title: 'swal2-extra-large-title',--}}
    {{--                            content: 'swal2-extra-large-content',--}}
    {{--                        }--}}
    {{--                    });--}}
    {{--                },--}}
    {{--                error: function (response) {--}}
    {{--                    console.log(response);--}}
    {{--                    Swal.fire({--}}
    {{--                        title: "Error!",--}}
    {{--                        text: "Something went wrong while revoking the application.",--}}
    {{--                        icon: "error",--}}
    {{--                        width: "600px",--}}
    {{--                        customClass: {--}}
    {{--                            popup: 'swal2-extra-large-popup',--}}
    {{--                            title: 'swal2-extra-large-title',--}}
    {{--                            content: 'swal2-extra-large-content',--}}
    {{--                        }--}}
    {{--                    });--}}
    {{--                }--}}
    {{--            });--}}
    {{--        }--}}
    {{--    });--}}
    {{--});--}}

</script>

<script type="text/javascript">
$('body').on('click', '.RevokeButton', function () {
        let button = $(this);
        let slug = button.attr('data');
        let url = '{{ route('admin.importedCommodities.revokedUpdate', 'slug') }}'.replace('slug', slug);

        // Prompt for remarks before confirmation
        swal({
            title: "Are you sure?",
            text: "Please enter a reason for revoking this application:",
            type: "input",  // Use input type
            showCancelButton: true,
            closeOnConfirm: false,
            inputPlaceholder: "Enter remarks here...",
        }, function (remarks) {
            if (remarks === false) return false;  // If cancelled, do nothing
            if (remarks.trim() === "") {
                swal.showInputError("Remarks are required!");
                return false;
            }

            // Proceed with revocation if confirmed
            $.ajax({
                url: url,
                data: {
                    revoked: 'true', // Always set revoked to true
                    remarks: remarks, // Send remarks
                },
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (response) {
                    applicationTbl.draw();
                    console.log(response);

                    // Update button class and text
                    button.removeClass('btn-success').addClass('btn-danger').text('Revoked');

                    // Show success message
                    swal("Revoked!", "The application has been successfully revoked.", "success");
                },
                error: function (response) {
                    console.log(response);
                }
            });
        });
    });
</script>
