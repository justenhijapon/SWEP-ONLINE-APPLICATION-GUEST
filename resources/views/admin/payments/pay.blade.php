<form id="paidForm">
<div class="modal-header">
    <h3 class="modal-title"><code>Payment</code></h3>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            @csrf
                {!! __form::a_textbox( 4,'ID ','slug', 'text', '',$op, 'readonly')!!}
                {!! __form::a_textbox( 8,'OR Number','orNumber', 'text', 'OR #','', '')!!}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary pull-right paid_btn">Pay</button>
    <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Close</button>
</div>
</form>
