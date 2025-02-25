@php
    $attachmentFields = [
    'bill_landing_path' => 'Bill of Landing',
    'commercial_invoice_path' => 'Commercial Invoice',
    'packing_list_path' => 'Packing List',
    'cert_origin_path' => 'Certificate of Origin',
    'cert_analysis_path' => 'Certificate of Analysis',
    'notarized_gmo_non_gmo_path' => 'Notarized GMO/Non-GMO',
    'important_declaration_path' => 'Important Declaration',
    'application_form_path' => 'Application Form',
    'affidavit_path' => 'Affidavit'
    ];

    // Count non-empty attachments
    $attachmentsCount = 0;
    foreach ($attachmentFields as $field => $label) {
        if (!empty($data->$field) && $data->$field !== null) {
    $attachmentsCount++;
        }
    }
    // Determine button color based on attachment count
    $btnClass = ($attachmentsCount === 9) ? 'btn-primary' : 'btn-danger';







// Generate dropdown for available files
$dropdownMenu = '<div class="btn-group btn-group-sm">
    <button type="button" class="btn ' . $btnClass . ' dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="caret"></span> View Files (' . $attachmentsCount . '/9)
    </button>
    <ul class="dropdown-menu dropdown-menu-right">';

        foreach ($attachmentFields as $field => $label) {
        if (!empty($data->$field) && $data->$field !== null) {
        $fileUrl = url("/show_file_custom/imported_commodities/{$data->slug}/{$field}");
        $dropdownMenu .= '<li><a href="#" class="view-file-link" data-url="' . $fileUrl . '">
                <small class="view-file no-margin">' . $label . '</small>
            </a></li>';
        }
        }

        $dropdownMenu .= '</ul></div>';

// Action buttons (Edit & Delete)
    $buttons = '<div class="btn-group">
        <button type="button" data="' . $data->slug . '" class="btn btn-default btn-sm edit_btn" data-toggle="modal" data-target="#edit_modal" title="Edit" data-placement="top">
            <i class="fa fa-edit"></i>
        </button>
    </div>';

    // Merge buttons with dropdown
    return $buttons . ' ' . $dropdownMenu;
    })

@endphp