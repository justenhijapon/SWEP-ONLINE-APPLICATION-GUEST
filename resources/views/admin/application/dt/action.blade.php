@php
    $attachmentFields = [
        'application_form_path' => 'Application Form',
        'affidavit_path' => 'Affidavit',
        'bill_landing_path' => 'Bill of Landing',
        'commercial_invoice_path' => 'Commercial Invoice',
        'packing_list_path' => 'Packing List',
        'cert_origin_path' => 'Certificate of Origin',
        'cert_analysis_path' => 'Certificate of Analysis',
        'notarized_gmo_non_gmo_path' => 'Notarized GMO/Non-GMO',
        'important_declaration_path' => 'Important Declaration',
    ];

    $attachmentsCount = 0;
    foreach ($attachmentFields as $field => $label) {
        if (!empty($data->$field) && $data->$field !== null) {
            $attachmentsCount++;
        }
    }

    $btnClass = ($attachmentsCount === 9) ? 'btn-primary' : 'btn-danger';

@endphp

<style>
    .btn-group button {
        white-space: nowrap; /* Prevents text wrapping */
        min-width: 55px; /* Adjust based on button size */
    }
</style>

<div class="btn-group d-flex flex-wrap w-auto">
    <button type="button" data="{{ $data->slug }}" class="btn btn-info btn-sm edit_btn mr-1 w-auto"
            data-toggle="modal" data-target="#edit_modal" title="Receive">
        Receive
    </button>
{{--    @if($data->received != 0)--}}

    <button data="{{ $data->slug }}" id="revokedButton_{{ $data->slug }}"
            class="RevokeButton btn btn-sm btn-warning {{ $data->revoked == 1 ? 'btn-danger' : 'btn-success' }} mr-1 w-auto">
        {{ $data->revoked == 1 ? 'Revoked' : 'Revoke' }}
    </button>

{{--    @endif--}}

</div>
    <div class="btn-group btn-group-sm">
        <button type="button" class="btn {{ $btnClass }} dropdown-toggle w-auto" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" title="Attachment">
            <span class="caret"></span> View Files ({{ $attachmentsCount }}/9)
        </button>
        <ul class="dropdown-menu">
            @foreach ($attachmentFields as $field => $label)
                @if (!empty($data->$field))
                    <li>
                        <a href="#" class="view-file-link" data-url="{{ url("/show_file_custom/imported_commodities/{$data->slug}/{$field}") }}">
                            <small class="view-file no-margin">{{ $label }}</small>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>




