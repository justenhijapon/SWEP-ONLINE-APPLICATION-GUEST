<div class="col-sm-12" style="padding-bottom: 10px; padding-right: 0; padding-left: 0;">
    <p align="center" style="margin: 5px; font-weight: bold">Timeline</p>
    <div class="ibox-content inspinia-timeline" style="padding-right: 10px; padding-left: 10px">



{{--        @foreach($timeline as $event)--}}
{{--            <div class="timeline-item">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-5 date">--}}
{{--                        @if($event['type'] == 'Submitted' || $event['type'] == 'Resubmitted')--}}
{{--                            <i class="fa fa-arrow-circle-right text-{{ $event['type'] == 'Submitted' ? 'success' : 'warning' }}"></i>--}}
{{--                        @else--}}
{{--                            <i class="fa fa-times-circle text-danger"></i>--}}
{{--                        @endif--}}
{{--                        <p class="no-margin" style="margin: 0; font-size: 10px">--}}
{{--                            {{ \Carbon\Carbon::parse($event['data']->submission_date)->format('M. d, Y | g:i A') }}--}}
{{--                        </p>--}}
{{--                        <small class="text-navy">--}}
{{--                            {{ \Carbon\Carbon::parse($event['data']->submission_date)->diffForHumans() }}--}}
{{--                        </small>--}}
{{--                    </div>--}}
{{--                    <div class="col-7 content">--}}
{{--                        <p class="m-b-xs">--}}
{{--                            <strong class="badge label-{{ $event['type'] == 'Revoked' ? 'danger' : ($event['type'] == 'Submitted' ? 'success' : 'warning') }}">--}}
{{--                                {{ $event['type'] }}--}}
{{--                            </strong>--}}
{{--                        </p>--}}
{{--                        <small>--}}
{{--                            @if($event['type'] == 'Submitted')--}}
{{--                                Application submitted successfully.--}}
{{--                            @elseif($event['type'] == 'Revoked')--}}
{{--                                Your application was revoked. Please review and resubmit.<br>--}}
{{--                                <strong>Remarks:</strong> <code>{{ $event['data']->remarks ?? 'No remarks provided' }}</code>--}}
{{--                            @else--}}
{{--                                Your application was resubmitted successfully.--}}
{{--                            @endif--}}
{{--                        </small>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            --}}{{-- Processing status after Submitted and Resubmitted --}}
{{--            @if($event['type'] == 'Submitted' || $event['type'] == 'Resubmitted')--}}
{{--                <div class="timeline-item">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-5 date">--}}
{{--                            <i class="fa fa-search"></i>--}}
{{--                        </div>--}}
{{--                        <div class="col-7 content">--}}
{{--                            <p class="m-b-xs"><strong class="badge label-info">Processing</strong></p>--}}
{{--                            <small>Your application is being reviewed. Expect a response within 3 working days.</small>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        @endforeach--}}

        <style>
            .timeline-container {
                max-height: 795px; /* Set max height */
                overflow-y: auto; /* Enable vertical scrolling if content exceeds max height */
                overflow-x: hidden; /* Prevent horizontal scrolling */
                padding-right: 10px;
                padding-bottom: 5px; /* Prevent extra space at the bottom */
                scrollbar-width: thin; /* Firefox scrollbar styling */
                scrollbar-color: #ccc transparent; /* Customize scrollbar */
            }

            /* Hide scrollbar in WebKit browsers (Chrome, Safari) */
            .timeline-container::-webkit-scrollbar {
                width: 6px; /* Thin scrollbar */
            }
            .timeline-container::-webkit-scrollbar-thumb {
                background-color: #aaa; /* Scrollbar color */
                border-radius: 3px;
            }
            .timeline-container::-webkit-scrollbar-track {
                background: transparent; /* Hide scrollbar track */
            }
        </style>

        <div class="timeline-container">
{{--        <div class="timeline-container" style="max-height: 795px; overflow-y: auto; padding-right: 10px;">--}}
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
                        <p class="m-b-xs"><strong class="badge label-success">{{ $data->received == 1 ? 'Approved' : $data->received }}</strong></p>
                        <small>Your application has been validated and approved.  Print the attached Order of Payment (download) and settle the payment immediately at SRA Main Office, North Avenue, Diliman, Quezon City.</small>

                        @php
                            $OP = \App\Models\Admin\OrderOfPayment::where('slug', $data->slug)->first();
                        @endphp

                        @if($OP->verify == 1)

                            <p>
                                <a href="javascript:void(0);" class="download_OP_btn" data-slug="{{ $data->slug }}">
                                    <li class="fa fa-file-pdf-o"></li> Download Order of Payment
                                </a>
                            </p>
                        @endif
{{--                        {{dd($OP->verify)}}--}}

                    </div>
                </div>
            </div>
        @endif

            <div class="timeline-item">
                @foreach($timeline as $event)
                    {{-- Processing status before Submitted and Resubmitted --}}
                    @if($event['type'] == 'Submitted' || $event['type'] == 'Resubmitted')
                        <div class="timeline-item">
                            <div class="row">
                                <div class="col-5 date">
                                    <i class="fa fa-search"></i>
                                </div>
                                <div class="col-7 content">
                                    <p class="m-b-xs"><strong class="badge label-info">Processing</strong></p>
                                    <small>Your application is being reviewed and processed.</small>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-5 date">
                                @if($event['type'] == 'Submitted' || $event['type'] == 'Resubmitted')
                                    <i class="fa fa-arrow-circle-up text-{{ $event['type'] == 'Submitted' ? 'success' : 'warning' }}"></i>
                                @else
                                    <i class="fa fa-times-circle text-danger"></i>
                                @endif
                                <p class="no-margin" style="margin: 0; font-size: 10px">
                                    {{ \Carbon\Carbon::parse($event['data']->submission_date)->format('M. d, Y | g:i A') }}
                                </p>
                                <small class="text-navy">
                                    {{ \Carbon\Carbon::parse($event['data']->submission_date)->diffForHumans() }}
                                </small>
                            </div>
                            <div class="col-7 content">
                                <p class="m-b-xs">
                                    <strong class="badge label-{{ $event['type'] == 'Take Back' ? 'danger' : ($event['type'] == 'Submitted' ? 'success' : 'warning') }}">
                                        {{ $event['type'] }}
                                    </strong>
                                </p>
                                <small>
                                    @if($event['type'] == 'Submitted')
                                        Application submitted successfully.
                                    @elseif($event['type'] == 'Take Back')
{{--                                        Your application has been Take Back. Please review the remarks below, make the necessary updates, and resubmit your application.<br>--}}
                                        <strong>Remarks:</strong> {{ $event['data']->remarks ?? 'No remarks provided' }}
                                    @else
                                        Your application was resubmitted successfully.
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="timeline-item">
                <div class="row">
                    <div class="col-5 date">
                        <i class="fa fa-plus-circle"></i>
                        <p class="no-margin" style="margin: 0; font-size: 10px"> {{ date('M. d, Y | g:i A', strtotime($data->created_at)) }}</p>
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

            <div class="timeline-item">
                <div class="row">
                    <div class="col-6 date" style="padding-left: 20px">
                        <i class="fa fa-clock-o"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>