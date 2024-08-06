<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Landbank LinkBiz Portal</title>
    @include('layouts.css-plugins')
    <style>
        body {
            background: #f5f5f5
        }
        .rounded {
            border-radius: 1rem
        }
        .nav-pills .nav-link {
            color: #555
        }
        .nav-pills .nav-link.active {
            color: white
        }
        input[type="radio"] {
            margin-right: 5px
        }
        .bold {
            font-weight: bold
        }
    </style>
</head>
<body>
<div class="container py-5">
    <!-- For demo purpose -->
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-6">LandBank LinkBiz Portal</h1>
        </div>
    </div> <!-- End -->
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card ">
                <div class="card-header">
                    <h3 class="pb-2 text-xl-center mb-lg-3" style="color: #1499f9">Sugar Regulatory Administration</h3>
                    <form id="submit-form" name="submit-form" method="post" role="form">
                        @csrf
                        <div class="error-container"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input class="form-control form-control-name" name="trxnamt" id="trxnamt" placeholder="" type="text" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Merchant Code</label>
                                    <input class="form-control form-control-name" name="merchantcode" id="merchantcode" placeholder="" type="text" value="0495" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Bank Code</label>
                                    <input class="form-control form-control-name" name="bankcode" id="bankcode" placeholder="" type="text" value="B000" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>trxndetails</label>
                                    <input class="form-control form-control-name" name="trxndetails" id="trxndetails" placeholder="" type="text" value="SRA ROPP" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Transaction ID</label>
                                    <input class="form-control form-control-name" name="trandetail1" id="trandetail1" placeholder="" type="text" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Client Business Name</label>
                                    <input class="form-control form-control-name" name="trandetail2" id="trandetail2" placeholder="" type="text" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Transaction Type</label>
                                    <input class="form-control form-control-name" name="trandetail3" id="trandetail3" placeholder="" type="text" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Client Email Address</label>
                                    <input class="form-control form-control-name" name="trandetail4" id="trandetail4" placeholder="" type="text" required>
                                </div>
                            </div>
                            <div class="text-right"><br>
                                <button class="btn btn-primary solid blank" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>

                    <table class="table">
                        <tbody>
                        <tr>
                            <td width="20%">Transaction ID</td>
                            <td width="5%">:</td>
                            <td width="75%" style="font-weight: 600" class="font-weight-bold"> {{$response->slug}}</td>
                        </tr>
                        <tr>
                            <td width="20%">Transaction Type</td>
                            <td width="5%">:</td>
                            <td width="75%"style="font-weight: 600" class="font-weight-bold"> {{$response->transaction_type}}</td>
                        </tr>
                        <tr>
                            <td width="20%">Amount to pay</td>
                            <td width="5%">:</td>
                            <td width="75%" style="font-size: larger; font-weight: 600" class="font-weight-bold"> {{number_format($response->total_amount,2)}}</td>
                        </tr>
                        <tr>
                            <td width="20%">Payor</td>
                            <td width="5%">:</td>
                            <td width="75%"style="font-weight: 600" class="font-weight-bold"> {{$user->business_name}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                        <!-- Credit card form tabs -->
                        <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                            <li class="nav-item"> <a data-toggle="pill" href="#paypal" class="nav-link active"> <i class="fa fa-paypal mr-2"></i>LandBank Account </a> </li>
                            <li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link "> <i class="fa fa-credit-card mr-2"></i>BancNet Card </a> </li>
                        </ul>
                    </div> <!-- End -->
                    <!-- Credit card form content -->
                    <div class="tab-content">
                        <!-- credit card info-->
                        <div id="credit-card" class="tab-pane fade pt-3">
                            <form role="form" onsubmit="event.preventDefault()">
                                <h6 class="pb-2"><code>Any BancNet Card</code></h6>
                                <div class="form-group"> <label for="username">
                                        <h6>Card Owner</h6>
                                    </label> <input type="text" name="username" placeholder="Card Owner Name" required class="form-control "> </div>
                                <div class="form-group"> <label for="cardNumber">
                                        <h6>Card number</h6>
                                    </label>
                                    <div class="input-group"> <input type="text" name="cardNumber" placeholder="Valid card number" class="form-control " required>
                                        <div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fa fa-cc-visa mx-1"></i> <i class="fa fa-cc-mastercard mx-1"></i> <i class="fa fa-cc-amex mx-1"></i> </span> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group"> <label><span class="hidden-xs">
                                                    <h6>Expiration Date</h6>
                                                </span></label>
                                            <div class="input-group"> <input type="number" placeholder="MM" name="" class="form-control" required> <input type="number" placeholder="YY" name="" class="form-control" required> </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                            </label> <input type="text" required class="form-control"> </div>
                                    </div>
                                </div>
                                <div class="card-footer"> <button type="button" class="subscribe btn btn-primary btn-block shadow-sm"> Confirm Payment </button>
                            </form>
                        </div>
                    </div> <!-- End -->
                    <!-- Paypal info -->
                    <div id="paypal" class="tab-pane fade pt-3 show active">
                        <h6 class="pb-2"><code>Pay with your LandBank Account</code></h6>
                        <div class="form-group">
                            <label for="username">
                                <h6>Account Name</h6>
                            </label>
                            <input type="text" name="accountName" placeholder="Account Name" required class="form-control ">
                        </div>
                        <div class="form-group">
                            <label for="username">
                                <h6>Account Number</h6>
                            </label>
                            <input type="text" name="accountNumber" placeholder="Account Number" required class="form-control ">
                        </div>
                        <p> <button type="button" class="btn btn-primary "><i class="fa fa-paypal mr-2"></i> Make payment</button> </p>
                    </div> <!-- End -->
                    <!-- End -->
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.js-plugins')
</body>
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $(function () {
        $('form#submit-form').on('submit', function (event) {
            $.ajax({
                type: 'post',
                url: "{{route('dashboard.payments.payToLandbank')}}",
                data: $('form').serialize(),
                success: function (response) {
                    console.log(response);
                    var message = response[2];
                    if(response[0] == '00'){
                        window.open(response[1], '_blank');
                        swal({
                            title: "Success!",
                            text: message,
                            type: "success"
                        });
                    }
                    else {
                        swal({
                            title: "Error!",
                            text: message,
                            type: "warning"
                        });
                    }
                },
                error: function(response){
                    console.log(response);
                }
            });
            event.preventDefault();
        });
    });
</script>
</html>