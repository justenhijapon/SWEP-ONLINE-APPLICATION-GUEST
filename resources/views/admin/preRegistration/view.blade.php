<div class="modal-header">
    <h4 class="modal-title">Pre-Registration ID:<code>{{$preReg->slug}}</code></h4>
</div>
<div class="modal-body">
    <div class="row">
        {!! __form::a_textbox( 6,'Username','username', 'text', 'Username',$preReg->username, 'readonly')!!}
        {!! __form::a_textbox( 6,'Password','password', 'text', 'Password',$preReg->password, 'readonly')!!}
        {!! __form::a_textbox( 4,'Last Name','lastName', 'text', 'Last Name',$preReg->last_name, 'readonly')!!}
        {!! __form::a_textbox( 4,'First Name','firstName', 'text', 'First Name',$preReg->first_name, 'readonly')!!}
        {!! __form::a_textbox( 4,'Middle Name','middleName', 'text', 'Middle Name',$preReg->middle_name, 'readonly')!!}
        {!! __form::a_textbox( 4,'Phone Number','phoneNumber', 'text', 'Phone Number',$preReg->phone, 'readonly')!!}
        {!! __form::a_textbox( 4,'Email Address','email', 'text', 'Email Address',$preReg->email, 'readonly')!!}
        {!! __form::a_textbox( 4,'Birthday','birthday', 'date', 'Birthday',$preReg->birthday, 'readonly')!!}
        <div class="col-sm-12 m-t-lg">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Address
                </div>
                <div class="panel-body">
                    <div class="row">
                        {!! __form::a_textbox( 4,'Street No./Lot No./Subd./Bldg.','street', 'text', 'Street',$preReg->street, 'readonly')!!}
                        {!! __form::a_textbox( 4,'Barangay','barangay', 'text', 'Barangay',$preReg->barangay, 'readonly')!!}
                        {!! __form::a_textbox( 4,'Municipality/City','city', 'text', 'Municipality/City',$preReg->city, 'readonly')!!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 m-t-lg">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Business Information
                </div>
                <div class="panel-body">
                    <div class="row">
                        {!! __form::a_textbox( 12,'Business Name','businessName', 'text', 'Business Name',$preReg->business_name, 'readonly')!!}
                        {!! __form::a_textbox( 4,'TIN','businessTin', 'text', 'TIN',$preReg->business_tin, 'readonly')!!}
                        {!! __form::a_textbox( 4,'Business Contact','businessPhone', 'text', 'Business Contact',$preReg->business_phone, 'readonly')!!}
                        {!! __form::a_textbox( 4,'Position','position', 'text', 'Position',$preReg->position, 'readonly')!!}
                        {!! __form::a_textbox( 4,'Street No./Lot No./Subd./Bldg.','businessStreet', 'text', 'Street',$preReg->business_street, 'readonly')!!}
                        {!! __form::a_textbox( 4,'Barangay','businessBarangay', 'text', 'Barangay',$preReg->business_barangay, 'readonly')!!}
                        {!! __form::a_textbox( 4,'Municipality/City','businessCity', 'text', 'Municipality/City',$preReg->business_city, 'readonly')!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light approved" data="{{$preReg->slug}}">Approve</button>
</div>