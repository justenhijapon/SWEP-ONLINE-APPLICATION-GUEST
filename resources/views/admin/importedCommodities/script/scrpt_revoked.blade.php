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



    .swal2-title-lg {
        font-size: 2.5rem !important;
    }

    .swal2-html-lg {
        font-size: 1.8rem !important;
    }

    .swal2-input-lg {
        font-size: 1.8rem !important;
        padding: 1rem !important;
        min-height: 100px !important;
    }

    .swal2-confirm-lg, .swal2-cancel-lg {
        font-size: 1.8rem !important;
        padding: 0.75rem 1.5rem !important;
    }


</style>
<script>

    $('body').on('click', '.RevokeButton', function () {
        let button = $(this);
        let originalText = button.html(); // Save original button content
        let slug = button.attr('data');
        let url = '{{ route('admin.importedCommodities.revokedUpdate', 'slug') }}'.replace('slug', slug);

        Swal.fire({
            title: "Are you sure?",
            html: "<strong>Please enter a reason for taking back this application:</strong>",
            input: 'textarea',
            inputPlaceholder: "Enter remarks here...",
            showCancelButton: true,
            confirmButtonText: 'Yes, Revoke it!',
            cancelButtonText: 'Cancel',
            inputValidator: (value) => {
                if (!value) {
                    return 'Remarks are required!';
                }
            },
            width: '700px',
            customClass: {
                title: 'swal2-title-lg',
                htmlContainer: 'swal2-html-lg',
                input: 'swal2-input-lg',
                confirmButton: 'swal2-confirm-lg',
                cancelButton: 'swal2-cancel-lg'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                let remarks = result.value;

                // Show loading state on the button
                button.prop('disabled', true).html('<i class="fa fa-circle-o-notch fa-spin"></i> Submitting...');

                // Proceed with revocation
                $.ajax({
                    url: url,
                    data: {
                        revoked: 'true',
                        remarks: remarks,
                    },
                    type: 'POST',
                    headers: {
                        {!! __html::token_header() !!}
                    },
                    success: function (response) {
                        applicationTbl.draw();

                        // Update button to revoked state
                        button.removeClass('btn-success').addClass('btn-danger').html('Revoked');

                        // Enhanced success notification
                        Swal.fire({
                            title: 'Revoked!',
                            text: 'The application has been successfully taken back.',
                            icon: 'success',
                            width: '500px',
                            customClass: {
                                title: 'swal2-title-lg',
                                htmlContainer: 'swal2-html-lg',
                                confirmButton: 'swal2-confirm-lg'
                            }
                        });
                    },
                    error: function (response) {
                        console.log(response);
                        button.prop('disabled', false).html(originalText);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong while taking back the application.',
                            icon: 'error',
                            width: '600px',
                            customClass: {
                                title: 'swal2-title-lg',
                                htmlContainer: 'swal2-html-lg',
                                confirmButton: 'swal2-confirm-lg'
                            }
                        });
                    }
                });
            }
        });
    });

</script>


<script type="text/javascript">
    {{--$('body').on('click', '.RevokeButton', function () {--}}
    {{--    let button = $(this);--}}
    {{--    let originalText = button.html(); // Save original button content--}}
    {{--    let slug = button.attr('data');--}}
    {{--    let url = '{{ route('admin.importedCommodities.revokedUpdate', 'slug') }}'.replace('slug', slug);--}}

    {{--    // Prompt for remarks before confirmation--}}
    {{--    swal({--}}
    {{--        title: "Are you sure?",--}}
    {{--        text: "Please enter a reason for taking back this application:",--}}
    {{--        type: "input",--}}
    {{--        showCancelButton: true,--}}
    {{--        closeOnConfirm: false,--}}
    {{--        inputPlaceholder: "Enter remarks here...",--}}
    {{--    }, function (remarks) {--}}
    {{--        if (remarks === false) return false;--}}
    {{--        if (remarks.trim() === "") {--}}
    {{--            swal.showInputError("Remarks are required!");--}}
    {{--            return false;--}}
    {{--        }--}}

    {{--        // Show loading state on the button--}}
    {{--        button.prop('disabled', true).html('<i class="fa fa-circle-o-notch fa-spin"></i> Submitting...');--}}

    {{--        // Proceed with revocation if confirmed--}}
    {{--        $.ajax({--}}
    {{--            url: url,--}}
    {{--            data: {--}}
    {{--                revoked: 'true',--}}
    {{--                remarks: remarks,--}}
    {{--            },--}}
    {{--            type: 'POST',--}}
    {{--            headers: {--}}
    {{--                {!! __html::token_header() !!}--}}
    {{--            },--}}
    {{--            success: function (response) {--}}
    {{--                applicationTbl.draw();--}}

    {{--                // Update button to revoked state--}}
    {{--                button.removeClass('btn-success').addClass('btn-danger').html('Revoked');--}}

    {{--                swal("Revoked!", "The application has been successfully take back.", "success");--}}
    {{--            },--}}
    {{--            error: function (response) {--}}
    {{--                console.log(response);--}}
    {{--                // Restore button if error occurs--}}
    {{--                button.prop('disabled', false).html(originalText);--}}
    {{--                swal("Error!", "Something went wrong while take back.", "error");--}}
    {{--            }--}}
    {{--        });--}}
    {{--    });--}}
    {{--});--}}

    {{--$('body').on('click', '.RevokeButton', function () {--}}
{{--        let button = $(this);--}}
{{--        let slug = button.attr('data');--}}
{{--        let url = '{{ route('admin.importedCommodities.revokedUpdate', 'slug') }}'.replace('slug', slug);--}}

{{--        // Prompt for remarks before confirmation--}}
{{--        swal({--}}
{{--            title: "Are you sure?",--}}
{{--            text: "Please enter a reason for take back this application:",--}}
{{--            type: "input",  // Use input type--}}
{{--            showCancelButton: true,--}}
{{--            closeOnConfirm: false,--}}
{{--            inputPlaceholder: "Enter remarks here...",--}}
{{--        }, function (remarks) {--}}
{{--            if (remarks === false) return false;  // If cancelled, do nothing--}}
{{--            if (remarks.trim() === "") {--}}
{{--                swal.showInputError("Remarks are required!");--}}
{{--                return false;--}}
{{--            }--}}

{{--            // Proceed with revocation if confirmed--}}
{{--            $.ajax({--}}
{{--                url: url,--}}
{{--                data: {--}}
{{--                    revoked: 'true', // Always set revoked to true--}}
{{--                    remarks: remarks, // Send remarks--}}
{{--                },--}}
{{--                type: 'POST',--}}
{{--                headers: {--}}
{{--                    {!! __html::token_header() !!}--}}
{{--                },--}}
{{--                success: function (response) {--}}
{{--                    applicationTbl.draw();--}}
{{--                    console.log(response);--}}

{{--                    // Update button class and text--}}
{{--                    button.removeClass('btn-success').addClass('btn-danger').text('Revoked');--}}

{{--                    // Show success message--}}
{{--                    swal("Revoked!", "The application has been successfully revoked.", "success");--}}
{{--                },--}}
{{--                error: function (response) {--}}
{{--                    console.log(response);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    });--}}
</script>
