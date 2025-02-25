
@if($data->submission != 0)
    <p style="font-size: small" class="no-margin">
        {{ $data->submission == 1 ? 'Submitted' : $data->submission }}
    </p>

    <small class="no-margin text-muted">
        {{ date('M. d, Y | g:i A', strtotime($data->submission_date)) }}
    </small>
@endif


@if($data->received != 0)
    <hr style="margin: 0; padding: 0;">
    <p style="font-size: small" class="no-margin">
        {{ $data->received == 1 ? 'Received' : $data->received }}
    </p>
    <small class="no-margin text-muted">
        {{ date('M. d, Y | g:i A', strtotime($data->received_date)) }}
    </small>

@endif
