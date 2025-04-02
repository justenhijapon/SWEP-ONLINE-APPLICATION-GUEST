
<style>
    .btn-group button {
        white-space: nowrap; /* Prevents text wrapping */
        min-width: 55px; /* Adjust based on button size */
    }
</style>

<div class="btn-group d-flex flex-wrap w-auto">
{{--    <a href="{{ route('admin.importedCommodities.printOrderOfPayment', $data->slug) }}" class="btn btn-info order_payment_btn mr-1 w-auto"--}}
{{--       target="_blank" rel="noopener noreferrer">--}}
{{--        Print Preview--}}
{{--    </a>--}}

    <a href="{{ route('admin.importedCommodities.printOrderOfPayment', $data->slug) }}"
       class="btn btn-default order_payment_btn mr-1 w-auto" data-toggle="modal"
       title="Print"
       onclick="printPreview(event, this)">
        <li class="fa fa-print"></li>
    </a>

    <button type="button" data="{{ $data->slug }}" class="btn btn-default order_payment_btn mr-1 w-auto"
            style=""
            data-toggle="modal" data-target="#OrderPayment_form" title="Edit">
        <li class="fa fa-edit"></li>
    </button>



</div>





