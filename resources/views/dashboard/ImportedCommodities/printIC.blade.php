<!DOCTYPE html>
<html>
<head>
   <title>Print</title>
    <style>

        @media print {
            @page {
                size: A4;
                margin: 0;
            }
            .content-container {
                width: 105mm; /* Half the width of A4 */
                height: 148.5mm; /* Half the height of A4 */
                margin: 0 auto; /* Center the content container */
                transform: scale(0.5); /* Scale down the content */
                transform-origin: top left; /* Ensure scaling starts from the top left */
            }
        }


        .no-break {
            break-inside: avoid; /* Prevents breaking inside this element */
        }


         .indent {
             text-indent: 30px;
             text-align: justify;
         }
        .underline {
            display: inline-block;
            border-bottom: 1px solid black;
            width: 130px;
        }
        .underline1 {
            display: inline-block;
            border-bottom: 1px solid black;
            width: 128px;
        }
        .witness-table {
            width: 100%;
            margin-top: 20px;
            table-layout: fixed;
        }
        .affiant-line {
            text-align: center;
            /*padding-right: 60px;*/
            padding-left: 350px;
            margin-top: 30px;
        }
        .label_a {
            font-size: 15px;
        }





        table{
            margin-top: 0;
            margin-left: 96px;
            margin-right: 96px;

        }
        table, td {
            /*border: 1px solid pink;*/
            /*border-right: solid blue 1px;*/
            border-collapse: collapse;
            /*border: 1px solid black;*/
            color:black;
            /*font-family: Cambria;*/
        }
        td{
            /*width: 100px;*/
            word-wrap: break-word;
            word-break: normal;
            /*font-weight: bold;*/
            font-size: 15px;
        }
    </style>
</head>
    <body class="white-bg no-break" style="margin-top: 100px;">

    <table style="width: 100%;">
        <tr>
            <td>Form SRA-00</td>
        </tr>
        <tr>
            <td>Revised, March 2025</td>
        </tr>
    </table>

    <table style="margin-top: 20px; width: 100%;">
        <tr>
            <td style="width: 10%"></td>
            <td style="width: 90%;">
                <h4 style="margin: 0;">
                    {{--                        APPLICATION FOR CLEARANCE TO RELEASE OTHER SUGAR COMMODITY--}}
                    Clearance for Release of Imported Commodities Under Tariff Headings 1702
                    <br>
                    (Other Sugar) and 1702 (Sugar Confectionery)
                </h4>
            </td>
        </tr>
    </table>
        <table style="margin-top: 20px">
{{--            <tr>--}}
{{--                <td style="padding-bottom: 30px">Date: {{ \Carbon\Carbon::parse($data->date)->format('F d, Y') }}</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td><h4 style="margin: 0">PABLO LUIS S. AZCONA</h4></td>--}}
{{--            </tr>--}}
            <tr>
                <td style="text-transform: uppercase; font-weight: bold">The Administrator</td>
            </tr>
            <tr>
                <td style="font-weight: bold">Sugar Regulatory Administration</td>
            </tr>
            <tr>
                <td>North Avenue, Diliman, Quezon City</td>
            </tr>
            <tr>
                <td>P.O. Box 90 U.P. Diliman</td>
            </tr>
            <tr>
                <td>Quezon City 1101</td>
            </tr>
        </table>

    <table style="margin-top: 10px">
        <tr>
            <td style="text-indent: 40px">Attention:</td>
            <td style="text-indent: 40px"><h4>REGULATION DEPARTMENT</h4></td>
        </tr>
    </table>

    <table style="margin-top: 10px">
        <tr>
            <td>Sir/Madam:</td>
        </tr>
    </table>

    <table style="margin-top: 10px">
        <tr>
                <td style="text-indent: 40px"> I hereby apply for the clearance to release of other sugar commodities with the following information:</td>
        </tr>
    </table>

    <table style="margin-top: 10px">
        <tr>
            <td>Company (Consignee) Name: <b>{{\Illuminate\Support\Str::title($data->company)}}</b></td>
        </tr>
        <tr>
            <td>TIN: <b>{{$data->tin}}</b></td>
        </tr>
        <tr>
            <td>Business Address: <b>{{\Illuminate\Support\Str::title($data->address)}}</b></td>
        </tr>
        <tr>
            <td>Commodity: <b>{{\Illuminate\Support\Str::title($data->commodity)}}</b></td>
        </tr>
        <tr>
            <td>H.S. Code: <b>{{$data->h_s_code}}</b></td>
        </tr>
        <tr>
            <td>Volume (Net Weight in Kilograms): <b>{{$data->volume}}</b></td>
        </tr>
        <tr>
            <td>Quantity and Packaging (Ex: Can, Drum, Bag, Carton, Etc.):  <b>{{$data->quantity_mt}} {{\Illuminate\Support\Str::title($data->packaging)}}</b></td>
        </tr>
        <tr>
            <td>Bill of Landing No.: <b>{{$data->bill_landing_no}}</b></td>
        </tr>
        <tr>
            <td>Vessel Name: <b>{{\Illuminate\Support\Str::title($data->vessel_name)}}</b></td>
        </tr>
        <tr>
            <td>Country of Origin:  <b>{{\Illuminate\Support\Str::title($data->country_origin)}}</b></td>
        </tr>
        <tr>
            <td>Port of Entry: <b>{{\Illuminate\Support\Str::title($data->port_entry)}}</b></td>
        </tr>
        <tr>
            <td>Company Representative: <b>{{\Illuminate\Support\Str::title($data->name)}}</b></td>
        </tr>
        <tr>
            <td>Designation: <b style="text-transform: capitalize">{{$data->designation}}</b></td>
        </tr>
        <tr>
            <td>Cellphone No.: <b>{{$data->contact_no}}</b></td>
        </tr>

    </table>

    <table style="margin-top: 20px">
        <tr>
            <td style=" text-align: justify; text-indent: 40px">
                I hereby certify that the above information is true and correct; all documents submitted in support to
                this application are either original or true copies of the original; any misrepresentation and/ or manifestation
                of fraud in this application shall be subject for disapproval and black listing of our company and the understand.
            </td>
        </tr>
    </table>

    <table style="margin-top: 20px">
        <tr>
            <td style=" text-align: justify; text-indent: 40px">
                  Further, I hereby undertake to faithfully abide and comply with all existing Sugar Order and other
                resolutions, circulars, rules and regulation of SRA on sugar importation.

            </td>
        </tr>
    </table>

        <table style="margin-top: 20px">
            <tr>
                <td style="text-align: justify">
                    IN WITNESS WHEREOF, I have hereunto affixed my hand this
                    <span class="underline1">&nbsp;</span> at <span class="underline1">&nbsp;</span>, Philippines.
                </td>
            </tr>
        </table>

{{--    <table style="margin-top: 20px">--}}
{{--        <tr>--}}
{{--            <td></td>--}}
{{--        </tr>--}}
{{--    </table>--}}


    <div class="affiant-line">
        <p><span class="underline">&nbsp;</span><br>
            <span class="label_a">Affiant</span></p>
    </div>




{{--    <table style="margin-top: 20px">--}}
{{--        <tr><td>{{$data->name}}</td></tr>--}}
{{--        <tr><td>{{$data->designation}}</td></tr>--}}
{{--        <tr><td>{{$data->company}}</td></tr>--}}
{{--        <tr><td>{{$data->tin}}</td></tr>--}}
{{--        <tr><td>{{$data->contact_no}}</td></tr>--}}
{{--    </table>--}}

    <table style="margin-top: 20px;">
        <tr>
            <td style="text-indent: 40px; text-align: justify">
                SUBSCRIBED AND SWORN TO before me this <span class="underline">&nbsp;</span> at <span class="underline">&nbsp;</span> affiant
            </td>
        </tr>
        <tr>
            <td style="text-align: justify">
                exhibiting to me his Proof of Identity: <span class="underline">&nbsp;</span> issued at <span class="underline">&nbsp;</span>.
            </td>
        </tr>
    </table>

{{--    <table style="margin-top: 20px">--}}
{{--        <tr>--}}
{{--            <td colspan="2" style="width: 200px; padding-left: 50px">SUBSCRIBED AND SWORN to before me this</td>--}}
{{--            <td colspan="2" style="border-bottom: solid black 1px; width: 220px"></td>--}}
{{--            <td style="width: 5px;">at</td>--}}
{{--            <td style="width: 100px; border-bottom: solid black 1px"></td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td style="width: 240px">affiant exhibiting to me his Proof of Identity:</td>--}}
{{--            <td colspan="2" style="width: 100px; border-bottom: solid black 1px;"></td>--}}
{{--            <td style="width: 50px">issued by</td>--}}
{{--            <td colspan="2" style="width: 50px; border-bottom: solid black 1px;"></td>--}}
{{--        </tr>--}}
{{--    </table>--}}

    <table style="width: 100%; margin-top: 20px;">
        <tr>
            <td class="label_a">
                Doc. No.:<br>
                Page No.:<br>
                Book No.:<br>
                Series of
            </td>
        </tr>
    </table>


</body>
</html>
