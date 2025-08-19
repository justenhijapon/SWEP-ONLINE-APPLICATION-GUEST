<div class="col-sm-12" style="padding-bottom: 10px; padding-right: 0; padding-left: 0;">
    <p align="center" style="margin: 5px; font-weight: bold">Timeline</p>
    <div class="ibox-content inspinia-timeline" style="padding-right: 10px; padding-left: 10px">



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
                        <p class="m-b-xs"><strong class="badge label-success">{{ $data->received == 1 ? 'Processed' : $data->received }}</strong></p>
                        <small>Your application has been validated.  Print the attached Order of Payment (download) and settle the payment immediately at SRA Main Office, North Avenue, Diliman, Quezon City.</small>

                        @php
                            $OP = \App\Models\Admin\OrderOfPayment::where('slug', $data->slug)->first();
                        @endphp

                        @if($OP && $OP->verify == 1)

                            <p>
                                <a href="F:void(0);" class="download_OP_btn" data-slug="{{ $data->slug }}">
                                    <li class="fa fa-file-pdf-o"></li> Download Order of Payment
                                </a>
                            </p>

                        @else
                                <p>No order of payment found.</p>
                        @endif
                        <small> Attach the proof of payment & SRA payment details form (If paid over the counter, Online Banking or any other payment channel)</small>

                        <form id="attach_proof_payment" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <label style="margin-top: 10px">Attach Proof of Payment</label>
                            @if(!empty($data->proof_payment_path))
                                <button type="button" class="btn btn-info btn-flat ml-2" style="margin-bottom: 15px; height: 30px;"
                                        data-toggle="modal"
                                        data-target="#filePreviewModalProofPayment"
                                        data-file-url="{{ asset('show_file_custom_user/imported_commodities/' . $data->slug . '/proof_payment_path') }}">
                                    <li class="fa fa-file-pdf-o"></li>
                                    File Preview
                                </button>
                            @endif
                            <div class="input-group input-group-sm" style="margin-bottom: 10px/'">
                                <input type="file"
                                       class="form-control"
                                       name="proof_payment"
                                       id="proof_payment"
                                       accept=".jpg,.jpeg,.png,.pdf"
                                       data-slug="{{ $data->slug }}"
                                        style="height: 30px; font-size: 10px"> {{-- slug from record --}}

                                <input type="text"
                                       class="form-control"
                                       value="{{basename($data->proof_payment_path)}}"
                                       style="width: 40px; wheight: 30px; font-size: 10px"
                                       readonly>
                            </div>

                        </form>

                        {{-- File Preview Modal --}}
                        <div class="modal fade" id="filePreviewModalProofPayment" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Proof of Payment Preview</h5>
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <iframe id="filePreviewFrameProofPayment" src="" width="100%" height="500px" style="border: none;"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>







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







