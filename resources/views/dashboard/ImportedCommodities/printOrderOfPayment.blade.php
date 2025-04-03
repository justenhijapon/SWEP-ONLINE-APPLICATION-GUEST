<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Print Order of Payment</title>
    <style>
        @page {
            size: A4;
            margin: 20mm;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 210mm; /* A4 width */
            min-height: 297mm; /* A4 height */
            padding: 20mm;
            box-sizing: border-box;
        }
        .header, .footer {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .content {
            text-align: justify;
            font-size: 12px;
        }
        /*@media print {*/
        /*    .no-print {*/
        /*        display: none;*/
        /*    }*/
        /*}*/

        @media print {
            body {
                -webkit-print-color-adjust: exact; /* For Chrome and Safari */
                print-color-adjust: exact; /* For Firefox */
            }

        }


        table{
            width: 100%;
            border-collapse: collapse;
            td{
                /*border: 1px solid black;*/
            }

            .border-top{
                border-top: grey solid 1px;
            }

            .border-bottom{
                border-bottom: grey solid 1px;
            }
            .border-right{
                border-right: grey solid 1px;
            }
            .border-left{
                border-left: grey solid 1px;
            }
            .border-all{
                border: grey solid 1px;
            }
        }
    </style>
</head>
    <body>
        <div class="">
            <div class="content">
                <div style="break-after: page">
                    <table>
                        <tr>
                            <td style="text-align: right">
                                Ref. No. STD-{{$data->reference_no}}
                            </td>
                        </tr>
                    </table>

                    <table>
                        <tr>
                            <td style="text-align: center">
                                <h2>ORDER OF PAYMENT</h2>
                            </td>
                        </tr>
                    </table>

                    <table>
                        <tr>
                            <td style="text-align: right; width: 80%">
                                Date:
                            </td>
                            <td style="text-align: center; background-color: #C8DBF9" class="border-top border-left border-right">
                                1/06/2025
                            </td>
                        </tr>
                    </table>

                    <table>
                        <tr>
                            <td style="width: 5%">TO:</td>
                            <td colspan="" style="text-align: center; border: grey solid 1px; background-color: #C8DBF9; text-transform: uppercase">
                                {{$data->fullname}}
                            </td>
                        </tr>
                    </table>

                    <table>
                        <tr>
                            <td style="text-align: center;">
                                Please pay to SUGAR REGULATORY ADMINISTRATION, Budget & Treasury Division the amount of
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; border-bottom: grey solid 1px">
                                <h4 style="margin: 0; text-transform: uppercase">{{\App\Core\Helpers\Helpers::amount_to_words($data->amount) ?? 'Null'}}</h4>
            {{--                    <h4 style="margin: 0">{{$data->amount_in_word}}</h4>--}}
                            </td>
                        </tr>
                    </table>

                    <table>
                        <tr>
                            <td style="text-align: center; border-bottom: grey solid 1px; font-family: 'DejaVu Sans Mono', Sans-Serif">
                                (₱ {{number_format($data->amount, 2)}})
                            </td>
                            <td class="border-bottom border-right border-left" style="text-align: center; width: 3%; background-color: #C8DBF9"></td>
                            <td style="text-align: center; width: 70%"></td>
                        </tr>
                    </table>

                    <table style="font-size: 9px !important; margin-top: 20px">
                        <tr>
                            <td style="width: 3%"></td>
                            <td style="width: 25%"></td>
                            <td style="width: 15%"></td>
                            <td style="width: 3%"></td>
                            <td style="width: 3%"></td>
                            <td style="width: 36%"></td>
                            <td style="width: 15%"></td>
                        </tr>

                        <tr style="text-align: center;">
                            <td colspan="3" style="border: grey solid 1px"><h4 style="height: 15px; margin: 0; background-color: #C8DBF9; display: flex; align-items: center; justify-content: center;">CLEARANCE FEES (EXPORT & DOMESTIC)</h4></td>
                            <td colspan="1" class="border-top"></td>
                            <td colspan="3" style="border: grey solid 1px"><h4 style=" height: 15px; margin: 0; background-color: #C8DBF9; display: flex; align-items: center; justify-content: center;">CLEARANCE FEES (IMPORT)</h4></td>
                        </tr>

                        <tr style="text-align: left !important;">
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Regular Swapping</td>
                            <td style="border: grey solid 1px">3.00/Lkg-Bag</td>
                            <td style=""></td>
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Premix Commodities (Sucrose 0%/Undetectable)</td>
                            <td style="border: grey solid 1px">300.00/Application</td>
                        </tr>

                        <tr style="text-align: left !important;">
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Advance Swapping</td>
                            <td style="border: grey solid 1px">5.00/Lkg-Bag</td>
                            <td style=""></td>
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Premix Commodities (Sucrose > 65%/Sucrose Content)</td>
                            <td style="border: grey solid 1px">37.75/Lkg</td>
                        </tr>

                        <tr style="text-align: left !important;">
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Reclassification</td>
                            <td style="border: grey solid 1px">3.00/Lkg-Bag</td>
                            <td style=""></td>
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Premix Commodities (Sucrose < 65%/Sucrose Content)</td>
                            <td style="border: grey solid 1px">11.90/Lkg</td>
                        </tr>

                        <tr style="text-align: left !important;">
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Advance Refining</td>
                            <td style="border: grey solid 1px">5.00/Lkg-Bag</td>
                            <td style=""></td>
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Refined Sugar</td>
                            <td style="border: grey solid 1px">33.00/Lkg</td>
                        </tr>

                        <tr style="text-align: left !important;">
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Switching</td>
                            <td style="border: grey solid 1px">1.50/Lkg-Bag</td>
                            <td style=""></td>
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Raw Sugar</td>
                            <td style="border: grey solid 1px">30.00/Lkg</td>
                        </tr>

                        <tr style="text-align: left !important;">
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Reinstatement</td>
                            <td style="border: grey solid 1px">15.00/Lkg-Bag</td>
                            <td style=""></td>
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">HFCS</td>
                            <td style="border: grey solid 1px">600.00/M.T.</td>
                        </tr>

                        <tr style="text-align: left !important;">
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Replenishment</td>
                            <td style="border: grey solid 1px">5.00/Lkg-Bag</td>
                            <td style=""></td>
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Crystalline Fructose</td>
                            <td style="border: grey solid 1px">720.00/M.T.</td>
                        </tr>

                        <tr style="text-align: left !important;">
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Certificate of Origin</td>
                            <td style="border: grey solid 1px">0.50/Lkg-Bag</td>
                            <td style=""></td>
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Other Sugar & Sugar Confectionery</td>
                            <td style="border: grey solid 1px">3.00/Lkg-Bag</td>
                        </tr>

                        <tr style="text-align: left !important;">
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Muscovado</td>
                            <td style="border: grey solid 1px">960.00/Application</td>
                            <td style=""></td>
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Molasses</td>
                            <td style="border: grey solid 1px">600.00/M.T.</td>
                        </tr>

                        <tr style="text-align: left !important;">
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Molasses</td>
                            <td style="border: grey solid 1px">30.00/M.T.</td>
                            <td style=""></td>
                            <td colspan="3" style="border: grey solid 1px; text-align: center!important;"><h4 style="margin: 0; background-color: #C8DBF9">MONITORING FEES</h4></td>
                        </tr>

                        <tr style="text-align: left !important;">
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">"A" or US Quota Sugar</td>
                            <td style="border: grey solid 1px">50.00/M.T.</td>
                            <td style=""></td>
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Imported Refined Sugar (CBW / PEZA)</td>
                            <td style="border: grey solid 1px">25.00/Lkg-Bag</td>
                        </tr>

                        <tr style="text-align: left !important;">
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">"D" or World Market Sugar</td>
                            <td style="border: grey solid 1px">50.00/M.T.</td>
                            <td style=""></td>
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Local (CBW /PEZA)</td>
                            <td style="border: grey solid 1px">25.00/Lkg-Bag</td>
                        </tr>

                        <tr style="text-align: left !important;">
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Reclassification/Conversion</td>
                            <td style="border: grey solid 1px">10.00/Lkg-Bag</td>
                            <td style=""></td>
                            <td colspan="3" style="border: grey solid 1px; text-align: center!important;"><h4 style="margin: 0; background-color: #C8DBF9">LICENSE/REGISTRATION FEES</h4></td>
                        </tr>

                        <tr style="text-align: left !important;">
                            <td colspan="3" class="border" style="border-collapse: collapse; padding: 0 !important;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <tr>
                                        <td class="border-left border-bottom" style="width: 7%"></td>
                                        <td class="border-left border-bottom" style="width: 58%">Export Processing</td>
                                        <td class="border-left border-bottom" style="width: 35%">2.50/Quedan</td>
                                    </tr>

                                    <tr>
                                        <td class="border-left" ></td>
                                        <td class="border-left">Stop/Lift Order</td>
                                        <td class="border-left">2,000.00+0.10/Kilo</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="border-left"></td>
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">International Sugar, Fructose, Other Sugar & Sugar Confectionery and Molasses Trader</td>
                            <td style="border: grey solid 1px">20,000.00/Application</td>
                        </tr>



                        <tr style="text-align: left !important;">
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Revalidation of Quedan</td>
                            <td style="border: grey solid 1px">5.00/Quedan</td>
                            <td style=""></td>
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Domestic Sugar and Molasses Trader</td>
                            <td style="border: grey solid 1px">15,000.00/Application</td>
                        </tr>

                        <tr style="text-align: left !important;">
                            <td colspan="3" style="border: grey solid 1px; text-align: center!important; ">
                                <h4 style="margin: 0; background-color: #C8DBF9; height: 10px; display: flex; align-items: center; justify-content: center;">SUGAR REQUIREMENTS</h4>
                            </td>
                            <td style=""></td>
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Bioethanol Registration</td>
                            <td style="border: grey solid 1px">2,000.00/Application</td>
                        </tr>

                        <tr style="text-align: left !important;">
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Certification of Sugar Requirements</td>
                            <td style="border: grey solid 1px">5,000.00/Application</td>
                            <td style=""></td>
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Muscovado Trader/Producer</td>
                            <td style="border: grey solid 1px">6,000.00/Application</td>
                        </tr>

                        <tr style="text-align: left !important;">
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Additional Allocation(Food Processor)</td>
                            <td style="border: grey solid 1px">3,000.00/Application</td>
                            <td style=""></td>
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Penalty for Late Submission of Activity Report</td>
                            <td style="border: grey solid 1px">5,000.00/Semester</td>
                        </tr>

                        <tr style="text-align: left !important;">
                            <td colspan="3" style="border: grey solid 1px; text-align: center!important; ">
                                <h4 style="margin: 0; background-color: #C8DBF9; height: 10px; display: flex; align-items: center; justify-content: center;">OTHER FEES</h4>
                            </td>
                            <td style=""></td>
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Warehouse Registration</td>
                            <td style="border: grey solid 1px">2,000.00/Application</td>
                        </tr>

                        <tr style="text-align: left !important;">
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Transfer/Change of Ownership</td>
                            <td style="border: grey solid 1px">4.50/Lkg-Bag</td>
                            <td style=""></td>
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Organic Muscovado Trader</td>
                            <td style="border: grey solid 1px">18,000.00/Application</td>
                        </tr>

                        <tr style="text-align: left !important;">
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Amendment of Clearance</td>
                            <td style="border: grey solid 1px">50.00/Application</td>
                            <td style=""></td>
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Milling License Fee</td>
                            <td style="border: grey solid 1px">0.05/short ton</td>
                        </tr>

                        <tr style="text-align: left !important;">
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">SRA Production Bulletin</td>
                            <td style="border: grey solid 1px">300.00/Copy</td>
                            <td style=""></td>
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Others:</td>
                            <td style="border: grey solid 1px"></td>
                        </tr>

                        <tr style="text-align: left !important;">
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px">Shipping Permit</td>
                            <td style="border: grey solid 1px">3.00/Lkg-Bag</td>
                            <td class="border-bottom"></td>
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px"></td>
                            <td style="border: grey solid 1px"></td>
                        </tr>
                    </table>

                    <table style="margin-top: 5px">
                        <tr>
                            <td colspan="3"></td>
                            <td style="text-align: left;">Note:</td>
                        </tr>

                        <tr>
                            <td class="border-bottom" style="text-align: left; padding-left: 5%; width: 26%">Lkg-Bags:</td>
                            <td class="border-all" style="text-align: right; width: 15%; background-color: #C8DBF9">{{$data->lkg_bags}}.000</td>
                            <td style="width: 3%"></td>
                            <td class="border-all" style="text-align: center; width: 71%; background-color: #C8DBF9">{{$data->boc_entry_no}}</td>
                        </tr>

                        <tr>
                            <td  class="border-bottom" style="text-align: left; padding-left: 5%; width: 26%">METRIC TONS:</td>
                            <td  class="border-bottom" style="text-align: right; padding-left: 5%; width: 15%">{{$data->metric_tons}}</td>
                            <td style="width: 3%"></td>
                            <td class="border-all" style="text-align: center; width: 71%; background-color: #C8DBF9">{{$data->boc_entry_note}}</td>
                        </tr>
                    </table>

                    <table style="margin-top: 30px">
                        <tr>
                            <td style="width: 30%; font-size: 9px;">CERTIFIED CORRECT:</td>
                            <td style="width: 20%"></td>
                            <td style="width: 30%; font-size: 9px;">APPROVED BY:</td>
                            <td style="width: 20%"></td>
                        </tr>
                    </table>

                    <table style="margin-top: 20px">
                        <tr style="margin-top: 10px">
                            <td style="width: 35%; height: 12px; font-size: 12px; padding: 2px; background-color: #C8DBF9; text-align: center; text-transform: capitalize">{{$data->certified_correct}}</td>
                            <td style="width: 15%"></td>
                            <td style="width: 35%; font-size: 12px; padding: 2px; background-color: #C8DBF9; text-align: center; text-transform: capitalize">{{$data->approved_by}}</td>
                            <td style="width: 15%"></td>
                        </tr>

                        <tr style="margin-top: 10px">
                            <td style="width: 35%;font-size: 9px; text-align: center; padding: 3px">Authorized/SPRO Representative</td>
                            <td style="width: 15%"></td>
                            <td style="width: 35%; font-size: 9px; text-align: center; padding: 3px">Authorized Approving Officer</td>
                            <td style="width: 15%"></td>
                        </tr>
                    </table>

                    <hr style="padding: 0; margin: 0">

                    <h3 style="margin-left: 60% !important; margin-top: 5px; margin-bottom: 0" class="no-margins">
                        SRA O.R. NO.
                    </h3>

                    <table>
                        <tr>
                           <td rowspan="10" style="width: 40%">
                               <h4 style="margin: 0">
                                   BUDGET & TREASURY DIVISION
                               </h4>
{{--                               <img src="{{asset('images/output/SRA_DA_logo_400X400.png')}}" style="width: 150px">--}}
                               <img src="{{ public_path('images/output/SRA_DA_logo_400X400.png') }}" style="width: 150px">
                           </td>
                        </tr>
                        <tr>
                            <td style="width: 3%"></td>
                            <td style="width: 15%; border-bottom: grey solid 2px"></td>
                            <td style="width: 15%"></td>
                            <td class="border-bottom" style="text-align: left; width: 20%">DATE:</td>
                        </tr>

                        <tr>
                            <td colspan="4" style="padding: 5px"></td>
                        </tr>

                        <tr>
                            <td class="border-all"></td>
                            <td colspan="2" class="border-all">CASH</td>
                            <td class="border-all" style="background-color: #C8DBF9"></td>
                        </tr>

                        <tr>
                            <td colspan="4" style="padding: 5px"></td>
                        </tr>

                        <tr>
                            <td class="border-all"></td>
                            <td colspan="2" class="border-all">BANK:</td>
                            <td class="border-all" style="background-color: #C8DBF9"></td>
                        </tr>

                        <tr>
                            <td class=""></td>
                            <td colspan="2" class="border-all">Check #</td>
                            <td class="border-all" style="background-color: #C8DBF9"></td>
                        </tr>

                        <tr>
                            <td class=""></td>
                            <td colspan="2" class="border-all">DATE</td>
                            <td class="border-all" style="background-color: #C8DBF9"></td>
                        </tr>

                        <tr>
                            <td class=""></td>
                            <td colspan="2" class="border-all">AMOUNT</td>
                            <td class="border-all" style="background-color: #C8DBF9"></td>
                        </tr>

                        <tr>
                            <td class=""></td>
                            <td colspan="2" class="border-all">TOTAL:</td>
                            <td class="border-all" style=""></td>
                        </tr>
                    </table>

                    <table style="margin-top: 10px">
                        <tr>
                            <td style="padding-left: 60%; font-size: 10px">
                                FM-REG-STD-037, Rev.04
                            </td>
                        </tr>

                        <tr>
                            <td style="padding-left: 60%; font-size: 10px">
                                Effectivity Date: January 24, 2025
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
