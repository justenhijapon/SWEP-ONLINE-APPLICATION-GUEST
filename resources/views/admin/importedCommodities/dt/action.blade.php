@php
    $attachmentFields = [
        'application_form_path' => 'Application Form',
        'affidavit_path' => 'Affidavit',
        'bill_landing_path' => 'Bill of Lading',
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


@endphp

<style>
    .btn-group button {
        white-space: nowrap; /* Prevents text wrapping */
        min-width: 55px; /* Adjust based on button size */
    }
</style>

<div class="btn-group d-flex flex-wrap w-auto">
{{--    <button type="button" data="{{ $data->slug }}" class="btn btn-info btn-sm edit_btn mr-1 w-auto"--}}
{{--            data-toggle="modal" data-target="#edit_modal" title="Receive" style="width: 40px; padding: 5px">--}}
{{--        Receive--}}
{{--    </button>--}}

{{--    <button data="{{ $data->slug }}" id="revokedButton_{{ $data->slug }}"  data-toggle="tooltip" title="Revoke"--}}
{{--            class="RevokeButton btn btn-sm btn-warning {{ $data->revoked == 1 ? 'btn-danger' : 'btn-success' }} mr-1 w-auto">--}}
{{--        {{ $data->revoked == 1 ? 'take backed' : 'take back' }}--}}
{{--    </button>--}}

    <div class="btn-group btn-group-sm">
        <button type="button" class="btn btn-default dropdown-toggle w-auto" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" title="">
            <span class="caret"></span> Action
        </button>

        <ul class="dropdown-menu">

            <li>
                <a href="{{ route('admin.ImportedCommodities.printOrderOfPayment', $data->slug) }}" class="btn btn-warning order_payment_btn mr-1 w-auto"
                   target="_blank" rel="noopener noreferrer">
                    View Order of Payment
                </a>
            </li>

            <li>
                <button type="button" data="{{ $data->slug }}" class="btn btn-warning order_payment_btn mr-1 w-auto"
                        data-toggle="modal" data-target="#OrderPayment_form" title="">
                    Order of Payment
                </button>
            </li>
            <li>
                <button type="button" data="{{ $data->slug }}" class="btn btn-info edit_btn mr-1 w-auto"
                        data-toggle="modal" data-target="#edit_modal" title="">
                    Approve
                </button>
            </li>
            <li class="">
                <button data="{{ $data->slug }}" id="revokedButton_{{ $data->slug }}"  data-toggle="tooltip" title=""
                        class="RevokeButton btn btn-outline-warning {{ $data->revoked == 1 ? 'btn-danger' : 'btn-success' }} mr-1 w-auto">
                    {{ $data->revoked == 1 ? 'take backed' : 'take back' }}
                </button>
            </li>
        </ul>
    </div>
</div>

<div class="btn-group btn-group-sm">
    <button type="button" class="btn btn-primary dropdown-toggle w-auto" data-toggle="dropdown"
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



