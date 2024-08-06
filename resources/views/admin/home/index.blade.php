@extends('admin-layouts.main-layout')

@section('content')
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{$op->count()}}</h3>

                            <p>Total Transactions</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{$opPaid->count()}}</h3>
                            <p>Paid Transactions</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{$opUnpaid->count()}}</h3>

                            <p>Unpaid Transactions</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Transaction Chart</h3>
                        </div>
                        <div class="box-body">
                            <canvas id="pieChart" style="height:250px"></canvas>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Transaction report (Select specific date range)</h3>
                        </div>
                        <div class="box-body">
                            <form id="">
                                @csrf
                                {!! __form::a_textbox( 6,'From','from', 'date', 'From','', '')!!}
                                {!! __form::a_textbox( 6,'To','to', 'date', 'To','', '')!!}
                                <div class="form-group col-md-6">
                                    <button type="button" class="btn btn-primary" id="btnPrint">Print</button>
                                </div>
                                <iframe hidden id="printIframe" src="">

                                </iframe>
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Daily Transaction Report</h3>
                        </div>
                        <div class="box-body">
                            <form id="">
                                @csrf
                                <div class="form-group col-md-6 " id="fg-daily">
                                    <label for="daily">Date</label>
                                    <input class="form-control " id="daily" name="daily" type="date" value="" placeholder="Date">
                                    <button type="button" class="btn btn-primary" id="btnPrintDaily" style="margin-top: 10px;">Print</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Transaction Report By Client</h3>
                        </div>
                        <div class="box-body">
                            <form id="">
                                @csrf
                                <div class="col-md-6 form-group m-t-sm">
                                    <label><strong>Select Client:</strong></label>
                                    <select class="form-control form-control-lg" name="client" id="client">
                                        <option disabled="" selected>Select</option>
                                        @if(count($client)> 0)
                                            @foreach($client as $key => $slug)
                                                <option value="{{$key}}">{{$slug['business_name']}} - {{$slug['last_name']}}, {{$slug['first_name']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <button type="button" class="btn btn-primary" id="btnPrintClient" style="margin-top: 10px;">Print</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </section>
@endsection
@section('scripts')
    <script>
        var paidPercent = ({{$opPaid->count()}} / {{$op->count()}}) * 100;
        var unpaidPercent = ({{$opUnpaid->count()}} / {{$op->count()}}) * 100;
        $(function () {

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {
        value    : Math.round((paidPercent + Number.EPSILON) * 100) / 100,
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'PAID'
      },
      {
        value    : Math.round((unpaidPercent + Number.EPSILON) * 100) / 100,
        color    : '#f39c12',
        highlight: '#f39c12',
        label    : 'UNPAID'
      }
    ]
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)

  })
        $("body").on('click', '#btnPrint', function() {
            var printRoute = "{{route('printTransactionReport')}}";
            var newPrintRoute = printRoute + "?from=" + $("#from").val() + "&to=" + $("#to").val();
            $("#printIframe").attr('src', newPrintRoute);
            setTimeout(printIframe, 500);
        })

        $("body").on('click', '#btnPrintDaily', function() {
            var printRoute = "{{route('printTransactionReportDaily')}}";
            var newPrintRoute = printRoute + "?daily=" + $("#daily").val();
            $("#printIframe").attr('src', newPrintRoute);
            setTimeout(printIframe, 500);
        })

        $("body").on('click', '#btnPrintClient', function() {
            var printRoute = "{{route('printTransactionReportClient')}}";
            var newPrintRoute = printRoute + "?client=" + $("#client").val();
            $("#printIframe").attr('src', newPrintRoute);
            setTimeout(printIframe, 500);
        })

        function printIframe(){
            $("#printIframe").get(0).contentWindow.print();
        }
</script>
@endsection