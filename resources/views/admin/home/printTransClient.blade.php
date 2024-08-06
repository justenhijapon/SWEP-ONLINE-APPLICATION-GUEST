<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SRA | Transaction Print</title>
    <link href="{{asset('template/inspinia/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/inspinia/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('template/inspinia/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('template/inspinia/css/style.css')}}" rel="stylesheet">
</head>

<body class="white-bg">
<div class="wrapper wrapper-content p-xl">
    <div class="ibox-content p-xl">
        <div class="row">
            <div class="col-sm-6">
                <img alt="image" class="rounded-circle" src="{{asset('images/sra_logo_sm.png')}}"/>
                <address>
                    <strong>Sugar Regulatory Administration</strong><br>
                    Sugar Center Bldg., North Avenue,<br>
                    Diliman, Quezon City<br>
                    <abbr title="Phone">P:</abbr> 09123456789
                </address>
            </div>
            <div class="col-sm-6 text-right">
                <h4>Order of Payments</h4>
                <p>
                    <span><strong>Client:</strong>{{$client->business_name}} - {{$client->last_name}}, {{$client->first_name}} {{$client->middle_name}}</span>
                </p>
            </div>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Amount (Php)</th>
            </tr>
            </thead>
            <tbody id="">
            @if(count($op)> 0)
                @foreach($op as $key1 => $ID)
                    <tr id="">
                        <td width="20%">
                            <label>{{$ID->slug}}</label>
                        </td>
                        <td width="65%">
                            <label>{{$ID->transaction_type}}</label>
                        </td>
                        <td class="text-right" width="15%">
                            <label>{{number_format($ID->total_amount,2)}}</label>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('template/inspinia/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('template/inspinia/js/popper.min.js')}}"></script>
<script src="{{asset('template/inspinia/js/bootstrap.js')}}"></script>
<script src="{{asset('template/inspinia/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('template/inspinia/js/inspinia.js')}}"></script>
<script type="text/javascript">
    //$(document).ready(function(){
     //  printIframe();
    //})

</script>
</body>
</html>
