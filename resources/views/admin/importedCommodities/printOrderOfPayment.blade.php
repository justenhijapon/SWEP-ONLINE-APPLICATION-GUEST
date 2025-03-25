<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Document</title>
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
        @media print {
            .no-print {
                display: none;
            }
        }
        table{
            width: 100%;
            td{
                /*border: 1px solid black;*/
            }
            border-collapse: collapse;

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
<div class="container">
    <div class="header">
{{--        <h2>Report Title</h2>--}}
    </div>
    <div class="content">
        <table>
            <tr>
                <td style="text-align: right">
                    Ref. No. STD-000
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
                    <h4 style="margin: 0">Amount in word</h4>
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <td style="text-align: center; border-bottom: grey solid 1px">
                    (P)
                </td>
                <td class="border-bottom border-right border-left" style="text-align: center; width: 3%; background-color: #C8DBF9"></td>
                <td style="text-align: center; width: 70%"></td>
            </tr>
        </table>

        <table style="font-size: 10px !important; margin-top: 20px">
            <tr>
                <td style="width: 3%"></td>
                <td></td>
                <td></td>
                <td style="width: 3%"></td>
                <td style="width: 3%"></td>
                <td></td>
                <td></td>
            </tr>

            <tr style="text-align: center;">
                <td colspan="3" style="border: grey solid 1px"><h4 style="margin: 0; background-color: #C8DBF9">CLEARANCE FEES (EXPORT & DOMESTIC)</h4></td>
                <td colspan="1" class="border-top"></td>
                <td colspan="3" style="border: grey solid 1px"><h4 style="margin: 0; background-color: #C8DBF9">CLEARANCE FEES (IMPORT)</h4></td>
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
                <td style="border: grey solid 1px">960.50/Application</td>
                <td style=""></td>
                <td style="border: grey solid 1px"></td>
                <td style="border: grey solid 1px">Molasses</td>
                <td style="border: grey solid 1px">600.00/M.T.</td>
            </tr>

            <tr style="text-align: left !important;">
                <td style="border: grey solid 1px"></td>
                <td style="border: grey solid 1px">Molasses</td>
                <td style="border: grey solid 1px">30.50/M.T.</td>
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
                            <td class="border-left border-bottom" style="width: 57%">Export Processing</td>
                            <td class="border-left border-bottom">2.50/Quedan</td>
                        </tr>

                        <tr>
                            <td class="border-left" ></td>
                            <td class="border-left">Stop/Lift Order</td>
                            <td class="border-left">2,000.00+10/Kilo</td>
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
                <td colspan="3" style="border: grey solid 1px; text-align: center!important;"><h4 style="margin: 0; background-color: #C8DBF9">SUGAR REQUIREMENTS</h4></td>
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
                <td style="border: grey solid 1px">Penalty for late Submission of Activity Report</td>
                <td style="border: grey solid 1px">5,000.00/Semester</td>
            </tr>

            <tr style="text-align: left !important;">
                <td colspan="3" style="border: grey solid 1px; text-align: center!important;"><h4 style="margin: 0; background-color: #C8DBF9">OTHER FEES</h4></td>
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
                <td class="border-all" style="text-align: right; width: 15%; background-color: #C8DBF9">.000</td>
                <td style="width: 3%"></td>
                <td class="border-all" style="text-align: center; width: 71%; background-color: #C8DBF9">BOC Entry No.</td>
            </tr>

            <tr>
                <td colspan="2" class="border-bottom" style="text-align: left; padding-left: 5%; width: 41%">METRIC TONS:</td>
                <td style="width: 3%"></td>
                <td class="border-all" style="text-align: center; width: 71%; background-color: #C8DBF9"></td>
            </tr>
        </table>

        <table style="margin-top: 20px">
            <tr>
                <td style="width: 30%; font-size: 11px;">CERTIFIED CORRECT:</td>
                <td style="width: 20%"></td>
                <td style="width: 30%; font-size: 11px;">APPROVED BY:</td>
                <td style="width: 20%"></td>
            </tr>
        </table>

        <table style="margin-top: 10px">
            <tr style="margin-top: 10px">
                <td style="width: 35%;font-size: 11px; padding: 8px; background-color: #C8DBF9"></td>
                <td style="width: 15%"></td>
                <td style="width: 35%; font-size: 11px; padding: 8px; background-color: #C8DBF9"></td>
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

        <h3 style="margin-left: 60% !important; margin-top: 5; margin-bottom: 0" class="no-margins">
            SRA O.R. NO.
        </h3>

        <table>
            <tr>
               <td rowspan="10" style="width: 40%">
                   <h4 style="margin: 0">
                       BUDGET & TREASURY DIVISION
                   </h4>
                   <img src="{{asset('images/output/SRA_DA_logo_400X400.png')}}" style="width: 150px">
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
    <div class="footer">
{{--        <p>Generated on {{ now()->format('Y-m-d') }}</p>--}}
    </div>
</div>
<button class="no-print" onclick="window.print()">Print</button>
</body>
</html>
