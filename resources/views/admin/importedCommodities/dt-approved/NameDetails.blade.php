
<small>Company: </small><span><b>{{ \Illuminate\Support\Str::title($data->company) }}</b></span><br>
<small>Company Address: </small><span>{{ \Illuminate\Support\Str::title($data->address) }}</span>
<hr style="margin: 0; width: 100%">

<div style="width: 100%" id="accordion">
    <p style="margin: 0">
        <a data-toggle="collapse" data-parent="#accordion" href="#more_details" id="toggleDetails">
            More details...
        </a>
    </p>
    <div id="more_details" class="collapse">
        <small>Company Representative: </small><span><b>{{ \Illuminate\Support\Str::title($data->name) }}</b></span><br>
        <small>Designation: </small><span>{{ \Illuminate\Support\Str::title($data->designation) }}</span><br>
        <small>Email: </small><span style="color: #15c">{{ $data->email }}</span><br>
        <small>Contact No.: </small><span>{{ $data->contact_no }}</span><br>
    </div>
</div>