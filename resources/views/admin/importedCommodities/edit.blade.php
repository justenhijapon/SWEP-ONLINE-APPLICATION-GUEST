@extends('admin-layouts.modal-content', ['form_id'=> 'edit_form', 'slug'=>$data->slug])

@section('modal-header')

     <code>{{$data->slug}}</code> | Application Preview
     <span class="pull-right" style="padding-right: 20px">
          <div class="pull-right" style="padding-right: 20px">
{{--                <button type="submit"--}}
{{--                        id="receivedBtn"--}}
{{--                        class="btn {{ $data->received == 1 ? 'btn-success' : 'btn-info' }} btn-md"--}}
{{--                       {{ $data->received == 1 ? 'disabled' : '' }}>--}}
{{--                       {{ $data->received == 1 ? 'Received' : 'Mark as Received' }}--}}
{{--               </button>--}}

{{--               <button type="submit"--}}
{{--                       id="receivedBtn"--}}
{{--                       class="btn {{ $data->revoked == 1 ? 'btn-danger' : ($data->received == 1 ? 'btn-success' : 'btn-info') }} btn-md"--}}
{{--                   {{ $data->revoked == 1 || $data->received == 1 ? 'disabled' : '' }}>--}}
{{--                   {{ $data->revoked == 1 ? 'Take Back' : ($data->received == 1 ? 'Approved' : 'Mark as Approved') }}--}}
{{--               </button>--}}

             <button type="submit"
                     id="receivedBtn"
                     class="btn mr-1 w-auto {{ $data->revoked == 1 ? 'btn-danger' : ($data->received == 1 ? 'btn-success' : 'btn-info') }} btn-md"
                     {{ $data->revoked == 1 || $data->received == 1 || $dataOP->verify == 0 ? 'disabled' : '' }}
                     @if($data->revoked == 1 || $data->received == 1 || $dataOP->verify == 0)
                          data-toggle="tooltip" data-placement="bottom" title="Update the Order of Payment First"
                   @endif>
                   {{ $data->revoked == 1 ? 'Take Backed' : ($data->received == 1 ? 'Approved' : 'Mark as Approved') }}
               </button>

          </div>
     </span>
@if($dataOP->verify = 0)

          <br>
          <span class="pull-right"><code><small>Update the Order of Payment First</small></code></span>
@endif

@endsection

@section('modal-body')

          <!-- Hidden input to send 'received' status when form submits -->
          <input type="hidden" name="received" id="receivedInput" value="1">
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
               font-size: 13px;
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
     <div class="row">
          <div class="col-md-12">
               <div style="height: 800px; width: 100%; overflow: auto; border: 2px solid #e1edf7; padding-left: 20px; padding-bottom: 20px">

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
                              <td style="width: 85%">
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
                              <td>Company (Consignee) Name: <b style="font-weight: 100 !important;">{{$data->company}}</b></td>
                         </tr>
                         <tr>
                              <td>TIN: <b>{{$data->tin}}</b></td>
                         </tr>
                         <tr>
                              <td>Business Address: <b>{{$data->address}}</b></td>
                         </tr>
                         <tr>
                              <td>Commodity: <b>{{$data->commodity}}</b></td>
                         </tr>
                         <tr>
                              <td>H.S. Code: <b>{{$data->h_s_code}}</b></td>
                         </tr>
                         <tr>
                              <td>Volume (Net Weight in Kilograms): <b>{{$data->volume}}</b></td>
                         </tr>
                         <tr>
                              <td>Quantity and Packaging (Ex: Can, Drum, Bag, Carton, Etc.):  <b>{{$data->quantity_mt}} {{$data->packaging}}</b></td>
                         </tr>
                         <tr>
                              <td>Bill of Landing No.: <b>{{$data->bill_landing_no}}</b></td>
                         </tr>
                         <tr>
                              <td>Vessel Name: <b>{{$data->vessel_name}}</b></td>
                         </tr>
                         <tr>
                              <td>Country of Origin:  <b>{{$data->country_origin}}</b></td>
                         </tr>
                         <tr>
                              <td>Port of Entry: <b>{{$data->port_entry}}</b></td>
                         </tr>
                         <tr>
                              <td>Company Representative: <b>{{$data->name}}</b></td>
                         </tr>
                         <tr>
                              <td>Designation: <b>{{$data->designation}}</b></td>
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
{{--                    <table class="" style="margin-top: 20px;">--}}
{{--                         <tr>--}}
{{--                              <td style="padding-bottom: 30px">Date: {{ \Carbon\Carbon::parse($data->date)->format('F d, Y') }}</td>--}}
{{--                         </tr>--}}
{{--                         <tr>--}}
{{--                              <td><h4 style="margin: 0">PABLO LUIS S. AZCONA</h4></td>--}}
{{--                         </tr>--}}
{{--                         <tr>--}}
{{--                              <td>The Administrator</td>--}}
{{--                         </tr>--}}
{{--                         <tr>--}}
{{--                              <td>Sugar Regulatory Administration</td>--}}
{{--                         </tr>--}}
{{--                         <tr>--}}
{{--                              <td>North Ave., Diliman, Quezon City</td>--}}
{{--                         </tr>--}}
{{--                    </table>--}}

{{--                    <table style="margin-top: 20px">--}}
{{--                         <tr>--}}
{{--                              <td style="width: 15%">SUBJECT:</td>--}}
{{--                              <td style="width: 85%">--}}
{{--                                   <h4 style="margin: 0; text-align: justify">--}}
{{--                                        APPLICATION FOR CLEARANCE FOR THE RELEASE OF IMPORTED COMMODITIES--}}
{{--                                        UNDER TARIFF HEADING 1702 (OTHER SUGARS) AND 1704 (SUGAR--}}
{{--                                        CONFECTIONERY)--}}
{{--                                   </h4>--}}
{{--                              </td>--}}
{{--                         </tr>--}}
{{--                    </table>--}}

{{--                    <table style="margin-top: 20px">--}}
{{--                         <tr>--}}
{{--                              <td style="text-align: justify">--}}
{{--                                   We Would like to request for the issuance of Clearance for the Release of Imported Commodities under--}}
{{--                                   Tariff Headings 1702 and 1704 with the following information, to wit:--}}
{{--                              </td>--}}
{{--                         </tr>--}}
{{--                    </table>--}}

{{--                    <table style="margin-top: 20px">--}}
{{--                         <tr>--}}
{{--                              <td style="width: 125px">Quantity in MT</td>--}}
{{--                              <td style="width: 5px">:</td>--}}
{{--                              <td>{{$data->quantity_mt}}</td>--}}
{{--                         </tr>--}}
{{--                         <tr>--}}
{{--                              <td style="width: 125px">Bill of Lading No.</td>--}}
{{--                              <td style="width: 5px">:</td>--}}
{{--                              <td>{{$data->bill_landing_no}}</td>--}}
{{--                         </tr>--}}
{{--                         <tr>--}}
{{--                              <td style="width: 125px">Product Description</td>--}}
{{--                              <td style="width: 5px">:</td>--}}
{{--                              <td>{{$data->prod_description}}</td>--}}
{{--                         </tr>--}}
{{--                         <tr>--}}
{{--                              <td style="width: 125px">Country of Origin</td>--}}
{{--                              <td style="width: 5px">:</td>--}}
{{--                              <td>{{$data->country_origin}}</td>--}}
{{--                         </tr>--}}
{{--                         <tr>--}}
{{--                              <td style="width: 125px">Port of Discharge</td>--}}
{{--                              <td style="width: 5px">:</td>--}}
{{--                              <td>{{$data->port_discharge}}</td>--}}
{{--                         </tr>--}}
{{--                         <tr>--}}
{{--                              <td style="width: 125px">Purpose of Importation</td>--}}
{{--                              <td style="width: 5px">:</td>--}}
{{--                              <td>{{$data->purpose_importation}}</td>--}}
{{--                         </tr>--}}
{{--                    </table>--}}

{{--                    <table style="margin-top: 20px">--}}
{{--                         <tr>--}}
{{--                              <td>Attached are the required documents, to wit:</td>--}}
{{--                         </tr>--}}
{{--                    </table>--}}

{{--                    <table style="margin-top: 20px">--}}
{{--                         <tr>--}}
{{--                              <td style="width: 5px; padding-left: 20px; padding-right: 10px;">1.</td>--}}
{{--                              <td>Bill of Lading</td>--}}
{{--                         </tr>--}}
{{--                         <tr>--}}
{{--                              <td style="width: 5px; padding-left: 20px; padding-right: 10px;">2.</td>--}}
{{--                              <td>Commercial Invoice</td>--}}
{{--                         </tr>--}}
{{--                         <tr>--}}
{{--                              <td style="width: 5px; padding-left: 20px; padding-right: 10px;">3.</td>--}}
{{--                              <td>Packing List</td>--}}
{{--                         </tr>--}}
{{--                         <tr>--}}
{{--                              <td style="width: 5px; padding-left: 20px; padding-right: 10px;">4.</td>--}}
{{--                              <td>Certificate of Origin</td>--}}
{{--                         </tr>--}}
{{--                         <tr>--}}
{{--                              <td style="width: 5px; padding-left: 20px; padding-right: 10px;">5.</td>--}}
{{--                              <td>Certificate of Analysis</td>--}}
{{--                         </tr>--}}
{{--                         <tr>--}}
{{--                              <td style="width: 5px; padding-left: 20px; padding-right: 10px;">6.</td>--}}
{{--                              <td>Notarized Declaration of GMO and Non-GMO</td>--}}
{{--                         </tr>--}}
{{--                         <tr>--}}
{{--                              <td style="width: 5px; padding-left: 20px; padding-right: 10px;">7.</td>--}}
{{--                              <td>Import Declaration (once available)</td>--}}
{{--                         </tr>--}}
{{--                    </table>--}}

{{--                    <table style="margin-top: 20px">--}}
{{--                         <tr>--}}
{{--                              <td>--}}
{{--                                   I understand that my failure to comply with Sugar Order No. 6, Series if 2023-2024 and other orders,--}}
{{--                                   resolutions and circulars of SRA shall be accordingly dealt with SRA's existing rules and penalties.--}}
{{--                              </td>--}}
{{--                         </tr>--}}
{{--                    </table>--}}

{{--                    <table style="margin-top: 20px">--}}
{{--                         <tr>--}}
{{--                              <td>Sincerely,</td>--}}
{{--                         </tr>--}}
{{--                    </table>--}}

{{--                    <table style="margin-top: 20px">--}}
{{--                         <tr><td>{{$data->name}}</td></tr>--}}
{{--                         <tr><td>{{$data->designation}}</td></tr>--}}
{{--                         <tr><td>{{$data->company}}</td></tr>--}}
{{--                         <tr><td>{{$data->tin}}</td></tr>--}}
{{--                         <tr><td>{{$data->contact_no}}</td></tr>--}}
{{--                    </table>--}}

{{--                    <table style="margin-top: 20px">--}}
{{--                         <tr>--}}
{{--                              <td colspan="" style="width: 330px; padding-left: 50px">SUBSCRIBED AND SWORN to before me this</td>--}}
{{--                              <td colspan="3" style="border-bottom: solid black 1px; width: 300px"></td>--}}
{{--                              <td style="width: 5px;">at</td>--}}
{{--                              <td style="width: 100px; border-bottom: solid black 1px"></td>--}}
{{--                         </tr>--}}
{{--                    </table>--}}
{{--                    <table>--}}
{{--                         <tr>--}}
{{--                              <td style="width: 280px">affiant exhibiting to me his Proof of Identity:</td>--}}
{{--                              <td colspan="" style="width: 200px; border-bottom: solid black 1px;"></td>--}}
{{--                              <td style="width: 60px">issued by</td>--}}
{{--                              <td colspan="2" style="width: 150px; border-bottom: solid black 1px;"></td>--}}
{{--                         </tr>--}}
{{--                    </table>--}}

{{--                    <table style="margin-top: 20px">--}}
{{--                         <tr>--}}
{{--                              <td>Doc. No.</td>--}}
{{--                              <td style="width: 30px; border-bottom: solid black 1px"></td>--}}
{{--                         </tr>--}}
{{--                         <tr>--}}
{{--                              <td>Page No.</td>--}}
{{--                              <td style="width: 30px; border-bottom: solid black 1px"></td>--}}
{{--                         </tr>--}}
{{--                         <tr>--}}
{{--                              <td>Book No.</td>--}}
{{--                              <td style="width: 30px; border-bottom: solid black 1px"></td>--}}
{{--                         </tr>--}}
{{--                         <tr>--}}
{{--                              <td colspan="2">Series of</td>--}}
{{--                         </tr>--}}
{{--                    </table>--}}
               </div>
          </div>
     </div>

          <!-- Submit button inside the form -->

@endsection

@section('modal-footer')

@endsection

<style>
     .swal2-button-custom {
          font-size: 1.3rem !important;
          padding: 10px 10px !important;
          border: none;
          border-radius: 5px;
     }

     .confirm-custom {
          background-color: #007bff !important; /* Bootstrap Primary */
          color: #fff !important;
     }

     .cancel-custom {
          background-color: #dc3545 !important; /* Bootstrap Danger */
          color: #fff !important;
     }

     .success-custom {
          background-color: #28a745 !important; /* Bootstrap Success */
          color: #fff !important;
     }
</style>

@section('scripts')

<script>
     $("body").on('submit', "#edit_form", function (e) {
          e.preventDefault(); // Prevent default form submission

          var form = $(this);
          var formdata = form.serialize();
          var slug = form.attr('data');
          var uri = "{{ route('admin.importedCommodities.update', 'slug') }}".replace('slug', slug);

          Swal.fire({
               title: "<strong style='font-size: 2.5rem;'>Are you sure?</strong>",
               html: "<div style='font-size: 1.8rem;'>Make sure all details in the application are accurate and all required attachments are valid before proceeding.</div>",
               icon: "warning",
               width: 600,
               showCancelButton: true,
               customClass: {
                    confirmButton: 'swal2-confirm swal2-button-custom confirm-custom',
                    cancelButton: 'swal2-cancel swal2-button-custom cancel-custom'
               },
               buttonsStyling: false, // Required for customClass to apply
               confirmButtonText: "Yes, Approve it!",
               cancelButtonText: "Cancel"
          }).then((result) => {
               if (result.isConfirmed) {
                    loading_btn(form); // Custom loading state
                    $.ajax({
                         url: uri,
                         data: formdata,
                         type: 'PATCH',
                         success: function (res) {
                              Swal.fire({
                                   title: "<strong style='font-size: 2.5rem;'>Success!</strong>",
                                   html: "<div style='font-size: 1.8rem;'>Application has been Approved.</div>",
                                   icon: "success",
                                   width: 450,
                                   confirmButtonText: "OK",
                                   customClass: {
                                        confirmButton: 'swal2-button-custom success-custom'
                                   },
                                   buttonsStyling: false
                              }).then(() => {
                                   window.location.href = "/admin/importedCommodities?success_message=Application Approved!";
                              });
                         },
                         error: function (response) {
                              errored(form, response); // Custom error handler
                              console.log(response);
                         }
                    });
               }
          });
     });



     {{--     @if(\Illuminate\Support\Facades\Request::has('success_message'))--}}
{{--     notify('{{\Illuminate\Support\Facades\Request::get('success_message')}}', 'success');--}}
{{--     window.history.pushState({},document.title,'/admin/importedCommodities')--}}
{{--     @endif--}}

     {{--$("body").on('submit', "#edit_form", function (e) {--}}
     {{--     e.preventDefault(); // Prevent default form submission--}}
     {{--     var form = $(this);--}}
     {{--     var formdata = form.serialize();--}}
     {{--     var slug = form.attr('data');--}}
     {{--     var uri = "{{ route('admin.importedCommodities.update', 'slug') }}";--}}
     {{--     uri = uri.replace('slug', slug);--}}
     {{--     swal({--}}
     {{--          title: "Are you sure?",--}}
     {{--          text: "Make sure all details in the application are accurate and all required attachments are valid before proceeding.",--}}
     {{--          type: "warning",--}}
     {{--          showCancelButton: true,--}}
     {{--          confirmButtonColor: "#3085d6",--}}
     {{--          cancelButtonColor: "#d33",--}}
     {{--          confirmButtonText: "Yes, receive it!",--}}
     {{--          cancelButtonText: "Cancel",--}}
     {{--          closeOnConfirm: false--}}
     {{--     }, function (isConfirm) {--}}
     {{--          if (isConfirm) {--}}
     {{--               // Proceed with the AJAX request--}}
     {{--               loading_btn(form);--}}
     {{--               $.ajax({--}}
     {{--                    url: uri,--}}
     {{--                    data: formdata,--}}
     {{--                    type: 'PATCH',--}}
     {{--                    success: function (res) {--}}
     {{--                         setTimeout(function () {--}}
     {{--                              window.location.href = "/admin/importedCommodities?success_message=Application Received!";--}}
     {{--                         });--}}
     {{--                    },--}}
     {{--                    error: function (response) {--}}
     {{--                         errored(form, response);--}}
     {{--                         console.log(response);--}}
     {{--                    }--}}
     {{--               });--}}
     {{--          }--}}
     {{--     });--}}
     {{--});--}}
</script>

@endsection