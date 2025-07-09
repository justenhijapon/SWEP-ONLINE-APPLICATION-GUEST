@php
    $random = Str::random();
@endphp

@extends('admin-layouts.modal-content', ['form_id'=> 'OrderPayment_form_'.$random, 'slug'=>$data->slug])

@section('modal-header')
    <div>
        <code>{{$data->slug}}</code> | Order of Payment
        <span class="pull-right" style="padding-right: 30px">
{{--             <a href="{{ route('admin.importedCommodities.printOrderOfPayment', $data->slug) }}" class="btn btn-info order_payment_btn mr-1 w-auto"--}}
{{--                target="_blank" rel="noopener noreferrer" >--}}
{{--                    Print--}}
{{--            </a>--}}

            <a href="{{ route('admin.importedCommodities.printOrderOfPayment', $data->slug) }}"
               class="btn btn-info order_payment_btn mr-1 w-auto"
               onclick="printOrderPayment(event, this)" >
               <li class="fa fa-print"></li> Print
            </a>

        </span>
    </div>

    <!-- Hidden container to hold the fetched print content -->
    <div id="printContainer" style="display: none;"></div>

@endsection

@section('content')

@endsection

@section('modal-body')
    <style>
        text-uppercase{
            text-transform: capitalize !important;
        }
    </style>
    <div class="row text-capitalize">
        <div class="col-md-12">
            <code class="pull-right">Fields with asterisks(*) are required</code>
        </div>


        {!! \App\Core\Helpers\__form2::textbox('reference_no', [
            'label'=>'Reference No. STD:',
            'cols'=>'6',
            'class'=>'text-uppercase',
            'id'=>'slug',
            'placeholder' => '',
            'required'=>'required',
        ], $data->reference_no) !!}


        {!! \App\Core\Helpers\__form2::textbox('date', [
           'label'=>'Date:',
           'cols'=>'6',
           'type' => 'date',
           'required'=>'required',
       ], $data->date) !!}

        <div class="col-md-12"></div>

        {!! \App\Core\Helpers\__form2::textbox('fullname', [
            'label'=>'To:',
            'cols'=>'6',
//            'class'=>'text-uppercase',
            'id'=>'slug',
            'placeholder' => '',
            'required'=>'required',
        ], \Illuminate\Support\Str::title($data->fullname)) !!}


        {!! \App\Core\Helpers\__form2::textbox('company', [
            'label'=>'Company:',
            'cols'=>'6',
            'id'=>'slug',
            'placeholder' => '',
            'required'=>'required',
        ], \Illuminate\Support\Str::title($data->company)) !!}


{{--        {!! \App\Core\Helpers\__form2::textbox('amount_in_word', [--}}
{{--            'label'=>'Amount in word:',--}}
{{--            'cols'=>'6',--}}
{{--            'id'=>'slug',--}}
{{--            'placeholder' => '',--}}
{{--//            'required'=>'required',--}}
{{--        ], $data->amount_in_word) !!}--}}

        {!! \App\Core\Helpers\__form2::textbox('lkg_bags', [
            'label'=>'Lkg-Bags:',
            'cols'=>'6',
            'id'=>'slug',
            'placeholder' => '',
            'required'=>'required',
        ], $data->lkg_bags) !!}

        {!! \App\Core\Helpers\__form2::textbox('metric_tons', [
            'label'=>'Metric Tons:',
            'cols'=>'6',
            'id'=>'slug',
            'placeholder' => '',
            'required'=>'required',
        ], $data->metric_tons) !!}

        {!! \App\Core\Helpers\__form2::textbox('boc_entry_no', [
            'label'=>'BOC Entry No.:',
            'cols'=>'6',
            'id'=>'slug',
            'placeholder' => '',
            'required'=>'required',
        ], $data->boc_entry_no) !!}

        {!! \App\Core\Helpers\__form2::textbox('amount', [
           'label'=>'Amount:',
           'cols'=>'6',
           'id'=>'slug',
           'placeholder' => '',
            'required'=>'required',
       ], $data->amount) !!}

        {!! \App\Core\Helpers\__form2::textbox('certified_correct', [
            'label'=>'Certified Correct:',
            'cols'=>'6',
            'id'=>'slug',
            'placeholder' => '',
            'required'=>'required',
        ], \Illuminate\Support\Str::title($data->certified_correct)) !!}

        {!! \App\Core\Helpers\__form2::textbox('approved_by', [
            'label'=>'Approved By:',
            'cols'=>'6',
            'id'=>'slug',
            'placeholder' => '',
            'required'=>'required',
        ], \Illuminate\Support\Str::title($data->approved_by)) !!}

    </div>
@endsection

@section('modal-footer')
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
@endsection



@section('scripts')



    <script>

        function printOrderPayment(event, element) {
            event.preventDefault(); // Prevent default link behavior

            var printWindow = window.open(element.href, '_blank', 'width=1100,height=600');

            if (printWindow) {
                printWindow.focus(); // Bring the window to the front
                printWindow.onload = function () {
                    setTimeout(function () {
                        printWindow.print();
                    }, 500); // Slight delay to allow full rendering
                };
            }
        }

        $('body').on('submit', "#OrderPayment_form_{{$random}}", function (e) {
            e.preventDefault();

            form = $(this);
            slug = form.attr('data');
            formdata = form.serialize();
            uri = "{{route('admin.importedCommodities.updateOrderPayment','slug')}}";
            uri = uri.replace('slug', slug);

            loading_btn(form);
            $.ajax({
                url: uri,
                data: formdata,
                type: 'POST',
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                success: function (response) {
                    succeed(form, true, true);
                    active = response.slug;
                    applicationTbl.draw();
                },
                error: function (response) {
                    errored(form, response);
                }
            })
        });

        {{--$("body").on('submit', "#OrderPayment_form", function (e) {--}}
        {{--    e.preventDefault(); // Prevent default form submission--}}
        {{--    var form = $(this);--}}
        {{--    var formdata = form.serialize();--}}
        {{--    var slug = form.attr('data');--}}
        {{--    var uri = "{{ route('admin.importedCommodities.updateOrderPayment', 'slug') }}";--}}
        {{--    uri = uri.replace('slug', slug);--}}
        {{--    $.ajax({--}}
        {{--        url: uri,--}}
        {{--        data: formdata,--}}
        {{--        type: 'POST',--}}
        {{--        headers: {--}}
        {{--            "X-CSRF-TOKEN": "{{ csrf_token() }}"--}}
        {{--        },--}}
        {{--        success: function (res) {--}}
        {{--            setTimeout(function () {--}}
        {{--                window.location.href = "/admin/importedCommodities?success_message=Data successfully save!";--}}
        {{--            });--}}
        {{--        },--}}
        {{--        error: function (response) {--}}
        {{--            errored(form, response);--}}
        {{--            // console.log(response);--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
    </script>

@endsection

