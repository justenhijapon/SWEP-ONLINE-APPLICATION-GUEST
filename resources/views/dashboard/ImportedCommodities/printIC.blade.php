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
            font-size: 13px;
        }
    </style>
</head>
    <body class="white-bg no-break" style="margin-top: 200px;">
        <table class="">
            <tr>
                <td style="padding-bottom: 30px">Date: {{ \Carbon\Carbon::parse($data->date)->format('F d, Y') }}</td>
            </tr>
            <tr>
                <td><h4 style="margin: 0">PABLO LUIS S. AZCUNA</h4></td>
            </tr>
            <tr>
                <td>The Administrator</td>
            </tr>
            <tr>
                <td>Sugar Regulatory Administration</td>
            </tr>
            <tr>
                <td>North Ave., Diliman, Quezon City</td>
            </tr>
        </table>

        <table style="margin-top: 20px">
            <tr>
                <td style="width: 15%">SUBJECT:</td>
                <td style="width: 85%">
                    <h4 style="margin: 0; text-align: justify">
                        APPLICATION FOR CLEARANCE FOR THE RELEASE OF IMPORTED COMMODITIES
                        UNDER TARIFF HEADING 1702 (OTHER SUGARS) AND 1704 (SUGAR
                        CONFECTIONERY)
                    </h4>
                </td>
            </tr>
        </table>

        <table style="margin-top: 20px">
            <tr>
               <td style="text-align: justify">
                   We Would like to request for the issuance of Clearance for the Release of Imported Commodities under
                   Tariff Headings 1702 and 1704 with the following information, to wit:
               </td>
            </tr>
        </table>

        <table style="margin-top: 20px">
            <tr>
                <td style="width: 125px">Quantity in MT</td>
                <td style="width: 5px">:</td>
                <td>{{$data->quantity_mt}}</td>
            </tr>
            <tr>
                <td style="width: 125px">Bill of Lading No.</td>
                <td style="width: 5px">:</td>
                <td>{{$data->bill_landing_no}}</td>
            </tr>
            <tr>
                <td style="width: 125px">Product Description</td>
                <td style="width: 5px">:</td>
                <td>{{$data->prod_description}}</td>
            </tr>
            <tr>
                <td style="width: 125px">Country of Origin</td>
                <td style="width: 5px">:</td>
                <td>{{$data->country_origin}}</td>
            </tr>
            <tr>
                <td style="width: 125px">Port of Discharge</td>
                <td style="width: 5px">:</td>
                <td>{{$data->port_discharge}}</td>
            </tr>
            <tr>
                <td style="width: 125px">Purpose of Importation</td>
                <td style="width: 5px">:</td>
                <td>{{$data->purpose_importation}}</td>
            </tr>
        </table>

        <table style="margin-top: 20px">
            <tr>
                <td>Attached are the required documents, to wit:</td>
            </tr>
        </table>

        <table style="margin-top: 20px">
            <tr>
                <td style="width: 5px; padding-left: 20px; padding-right: 10px;">1.</td>
                <td>Bill of Lading</td>
            </tr>
            <tr>
                <td style="width: 5px; padding-left: 20px; padding-right: 10px;">2.</td>
                <td>Commercial Invoice</td>
            </tr>
            <tr>
                <td style="width: 5px; padding-left: 20px; padding-right: 10px;">3.</td>
                <td>Packing List</td>
            </tr>
            <tr>
                <td style="width: 5px; padding-left: 20px; padding-right: 10px;">4.</td>
                <td>Certificate of Origin</td>
            </tr>
            <tr>
                <td style="width: 5px; padding-left: 20px; padding-right: 10px;">5.</td>
                <td>Certificate of Analysis</td>
            </tr>
            <tr>
                <td style="width: 5px; padding-left: 20px; padding-right: 10px;">6.</td>
                <td>Notarized Declaration of GMO and Non-GMO</td>
            </tr>
            <tr>
                <td style="width: 5px; padding-left: 20px; padding-right: 10px;">7.</td>
                <td>Import Declaration (once available)</td>
            </tr>
        </table>

    <table style="margin-top: 20px">
        <tr>
            <td>
                I understand that my failure to comply with Sugar Order No. 6, Series if 2023-2024 and other orders,
                resolutions and circulars of SRA shall be accordingly dealt with SRA's existing rules and penalties.
            </td>
        </tr>
    </table>

    <table style="margin-top: 20px">
        <tr>
            <td>Sincerely,</td>
        </tr>
    </table>

    <table style="margin-top: 20px">
        <tr><td>{{$data->name}}</td></tr>
        <tr><td>{{$data->designation}}</td></tr>
        <tr><td>{{$data->company}}</td></tr>
        <tr><td>{{$data->tin}}</td></tr>
        <tr><td>{{$data->contact_no}}</td></tr>
    </table>

    <table style="margin-top: 20px">
        <tr>
            <td colspan="2" style="width: 200px; padding-left: 50px">SUBSCRIBED AND SWORN to before me this</td>
            <td colspan="2" style="border-bottom: solid black 1px; width: 220px"></td>
            <td style="width: 5px;">at</td>
            <td style="width: 100px; border-bottom: solid black 1px"></td>
        </tr>
        <tr>
            <td style="width: 240px">affiant exhibiting to me his Proof of Identity:</td>
            <td colspan="2" style="width: 100px; border-bottom: solid black 1px;"></td>
            <td style="width: 50px">issued by</td>
            <td colspan="2" style="width: 50px; border-bottom: solid black 1px;"></td>
        </tr>
    </table>

    <table style="margin-top: 20px">
        <tr>
            <td>Doc. No.</td>
            <td style="width: 30px; border-bottom: solid black 1px"></td>
        </tr>
        <tr>
            <td>Page No.</td>
            <td style="width: 30px; border-bottom: solid black 1px"></td>
        </tr>
        <tr>
            <td>Book No.</td>
            <td style="width: 30px; border-bottom: solid black 1px"></td>
        </tr>
        <tr>
            <td colspan="2">Series of</td>
        </tr>
    </table>


</body>
</html>
