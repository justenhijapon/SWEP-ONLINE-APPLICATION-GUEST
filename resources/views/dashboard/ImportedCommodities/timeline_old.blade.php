<div class="col-sm-12" style="padding-bottom: 10px">
    <p align="center" style="margin: 5px; font-weight: bold">Timeline</p>
    <div class="ibox-content inspinia-timeline" style="padding-right: 10px; padding-left: 10px">

        <div class="timeline-item">
            <div class="row">
                <div class="col-5 date">
                    <i class="fa fa-plus-circle"></i>
                    <p class="no-margin" style="margin: 0; font-size: 10px"> {{ date('M. d, Y | g:i A', strtotime($data->created_at)) }}</p>
                    {{--															<p class="no-margin" style="margin: 0; font-size: 10px">{{ \Carbon\Carbon::parse($data->created_at)->format('M. j, Y') }}</p>--}}
                    <small class="text-navy">
                        {{ str_replace([' minutes', ' minute'], [' mins.', ' min.'], \Carbon\Carbon::parse($data->created_at)->diffForHumans()) }}
                    </small>
                </div>
                <div class="col-7 content no-top-border">
                    <p class="m-b-xs"><strong class="badge label-success">Created</strong></p>
                    <small>Application started</small>
                </div>
            </div>
        </div>


        @if($data->submission != 0)
            <div class="timeline-item">
                <div class="row">
                    <div class="col-5 date">
                        <i class="fa fa-arrow-circle-right"></i>
                        <p class="no-margin" style="margin: 0; font-size: 10px">{{ date('M. d, Y | g:i A', strtotime($data->submission_date)) }}</p>
                        {{--															<p class="no-margin" style="margin: 0; font-size: 10px">{{ \Carbon\Carbon::parse($data->submission_date)->format('M. j, Y') }}</p>--}}
                        <small class="text-navy">
                            {{ str_replace([' minutes', ' minute'], [' mins.', ' min.'], \Carbon\Carbon::parse($data->submission_date)->diffForHumans()) }}
                        </small>
                    </div>
                    <div class="col-7 content">
                        <p class="m-b-xs"><strong class="badge label-success">{{ $data->submission == 1 ? 'Submitted' : $data->submission }}</strong></p>
                        <small>Application submitted successfully</small>
                    </div>
                </div>
            </div>

            {{--													@if($data->received != 1)--}}
            <div class="timeline-item">
                <div class="row">
                    <div class="col-5 date">
                        <i class="fa fa-search"></i>
                    </div>
                    <div class="col-7 content">
                        <p class="m-b-xs"><strong class="badge label-info">Processing</strong></p>
                        <small>Your application is being reviewed. Expect a response within 3 working days.</small>
                    </div>
                </div>
            </div>
            {{--													@endif--}}
        @endif

        @if($data->revoked != 0)
            <div class="timeline-item">
                <div class="row">
                    <div class="col-5 date">
                        <i class="fa fa-arrow-circle-right"></i>
                        <p class="no-margin" style="margin: 0; font-size: 10px">{{ date('M. d, Y | g:i A', strtotime($data->submission_date)) }}</p>
                        <small class="text-navy">
                            {{ str_replace([' minutes', ' minute'], [' mins.', ' min.'], \Carbon\Carbon::parse($data->submission_date)->diffForHumans()) }}
                        </small>
                    </div>
                    <div class="col-7 content">
                        <p class="m-b-xs"><strong class="badge label-success">{{ $data->submission == 0 ? 'Submitted' : $data->submission }}</strong></p>
                        <small>Application submitted successfully</small>
                    </div>
                </div>
            </div>

            <div class="timeline-item">
                <div class="row">
                    <div class="col-5 date">
                        <i class="fa fa-search"></i>
                        {{--																<p class="no-margin" style="margin: 0; font-size: 10px">{{ \Carbon\Carbon::parse($data->submission_date)->format('M. j, Y') }}</p>--}}
                        <small class="text-navy">
                            {{--																	{{ str_replace([' minutes', ' minute'], [' mins.', ' min.'], \Carbon\Carbon::parse($data->submission_date)->diffForHumans()) }}--}}
                        </small>
                    </div>
                    <div class="col-7 content">
                        <p class="m-b-xs"><strong class="badge label-info">In Review/Processing</strong></p>
                        <small>Your application is being reviewed. Expect a response within 3 working days.</small>
                    </div>
                </div>
            </div>

            <div class="timeline-item">
                <div class="row">
                    <div class="col-5 date">
                        <i class="fa fa-undo"></i>
                        <p class="no-margin" style="margin: 0; font-size: 10px">{{ date('M. d, Y | g:i A', strtotime($data->revoked_date)) }}</p>
                        <small class="text-navy">
                            {{ str_replace([' minutes', ' minute'], [' mins.', ' min.'], \Carbon\Carbon::parse($data->revoked_date)->diffForHumans()) }}
                        </small>
                    </div>
                    <div class="col-7 content">
                        <p class="m-b-xs"><strong class="badge label-danger">{{ $data->revoked == 1 ? 'Revoked' : $data->revoked }}</strong></p>
                        <small>Your application has been revoked due to missing documents or incorrect information.</small>
                        <small>Please review the requirements, make the necessary updates, and resubmit if applicable.</small>
                    </div>
                </div>
            </div>
        @endif

        @if($data->received != 0)
            <div class="timeline-item">
                <div class="row">
                    <div class="col-5 date">
                        <i class="fa fa-check-circle"></i>
                        <p class="no-margin" style="margin: 0; font-size: 10px">{{ date('M. d, Y | g:i A', strtotime($data->received_date)) }}</p>
                        <small class="text-navy">
                            {{ str_replace([' minutes', ' minute'], [' mins.', ' min.'], \Carbon\Carbon::parse($data->received_date)->diffForHumans()) }}
                        </small>
                    </div>
                    <div class="col-7 content">
                        <p class="m-b-xs"><strong class="badge label-success">{{ $data->received == 1 ? 'Received' : $data->received }}</strong></p>
                        <small>Your application has been received. To proceed, please visit our office and settle the payment at your earliest convenience.</small>
                    </div>
                </div>
            </div>

            <div class="timeline-item">
                <div class="row">
                    <div class="col-6 date" style="padding-left: 20px">
                        <i class="fa fa-circle"></i>
                        {{--															<i class="fa fa-clock-o"></i>--}}
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>