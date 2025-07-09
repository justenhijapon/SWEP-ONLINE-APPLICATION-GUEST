<div class="modal-header">
    <h5 class="modal-title"><code>{{$data->slug}}</code> <span class="">Print Preview</span></h5>
</div>

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
        font-size: 14px;
        font-family: Cambria;
        color: black;
    }




    table{
        margin-top: 0;
        margin-left: 40px;
        margin-right: 65px;

    }
    table, td {
        /*border: 1px solid pink;*/
        /*border-right: solid blue 1px;*/
        border-collapse: collapse;
        /*border: 1px solid black;*/
        color:black;
        font-family: Cambria;
    }
    td{
        /*width: 100px;*/
        word-wrap: break-word;
        word-break: normal;
        /*font-weight: bold;*/
        font-size: 13px;
    }
</style>
<div class="modal-body">
    <p style="margin-bottom: 30px"><code>Instruction:</code> Before printing, ensure that the paper used is A4 size (8.27" x 11.69") and pre-printed <br>  with the importer's letterhead.
{{--    <p style="margin-bottom: 30px">Please print using A4 paper size (8.27" x 11.69") with letterhead of importer--}}
        <span class="pull-right" style="padding-right: 20px">
           <button type="button" class="btn btn-success btn-lg btn-outline print_btn" data="{{$data->slug}}" id="printBtn{{$data->slug}}"><i class="fa fa-print"></i> Print</button>
        </span>
    </p>
    <div style="height: 800px; width: 100%; overflow: auto; border: 2px solid #e1edf7; padding-left: 20px">

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
                <td style="width: 15%"></td>
                <td style="width: 85%;">
                    <h4 style="margin: 0;">
                        APPLICATION FOR CLEARANCE TO RELEASE OTHER SUGAR COMMODITY
                    </h4>
                </td>
            </tr>
        </table>

        <table style="margin-top: 20px">

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
                <td>Sir:</td>
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

        <div class="affiant-line">
            <p><span class="underline">&nbsp;</span><br>
                <span class="label_a">Affiant</span></p>
        </div>

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

    </div>


</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>


<script>




</script>