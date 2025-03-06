

@if($data->submission != 0)

    <p style="font-size: small" class="no-margin">
        {{ $data->submission == 1 ? 'Submitted' : $data->submission }} |

    @if ($data->received == 0)
        <span class="text-success badge label-info">
            <i class="fa fa-circle-o-notch fa-spin"></i> New
        </span>
    @else
        <span class="text-secondary">Processed</span>
    @endif
    </p>

    <small class="no-margin text-muted">
        {{ date('M. d, Y | g:i A', strtotime($data->submission_date)) }}
    </small>
<br class="no-margin">
    <small class="no-margin text-muted">
        {{ str_replace([' minutes', ' minute'], [' mins.', ' min.'], \Carbon\Carbon::parse($data->submission_date)->diffForHumans()) }}
    </small>

@endif


@if($data->received != 0)
    <hr style="margin: 0; padding: 0;">
        <p style="font-size: small" class="no-margin badge label-success"> <i class="fa fa-check-circle"></i>
            {{ $data->received == 1 ? 'Received' : $data->received }}
        </p>
        <small class="no-margin text-muted">
            {{ str_replace([' minutes', ' minute'], [' mins.', ' min.'], \Carbon\Carbon::parse($data->received_date)->diffForHumans()) }}
        </small>
        <br>
        <small class="no-margin text-muted">
            {{ date('M. d, Y | g:i A', strtotime($data->received_date)) }}
        </small>


@endif

@if($data->revoked != 0)
    <hr style="margin: 0; padding: 0;">

    <p style="font-size: small" class="no-margin badge label-danger"> <i class="fa fa-undo"></i>
        {{ $data->revoked == 1 ? 'Revoked' : $data->revoked }}
    </p><br>
    <small class="no-margin text-muted">
        {{ date('M. d, Y | g:i A', strtotime($data->revoked_date)) }}
    </small>

@endif
