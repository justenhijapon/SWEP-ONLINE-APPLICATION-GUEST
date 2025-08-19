
<small>Company: </small><span><b>{{ \Illuminate\Support\Str::title($data->company) }}</b></span><br>
<small>Company Address: </small><span>{{ \Illuminate\Support\Str::title($data->address) }}</span>
<hr style="margin: 0; width: 100%">

<div style="width: 100%" id="accordion">
    <p style="margin: 0">
        <a data-toggle="collapse" data-parent="#accordion" href="#more_details-{{$data->slug}}" id="toggleDetails">
             More details...
        </a>
    </p>
    <div id="more_details-{{$data->slug}}" class="collapse">
        <small>Company Representative: </small><span><b>{{ \Illuminate\Support\Str::title($data->name) }}</b></span><br>
        <small>Designation: </small><span>{{ \Illuminate\Support\Str::title($data->designation) }}</span><br>
        <small>Email: </small><span style="color: #15c">{{ $data->email }}</span><br>
        <small>Contact No.: </small><span>{{ $data->contact_no }}</span><br>
    </div>
</div>


{{--<script>--}}
{{--    document.addEventListener("DOMContentLoaded", function () {--}}
{{--        const toggleLink = document.getElementById("toggleDetails");--}}
{{--        const toggleIcon = document.getElementById("toggleIcon");--}}

{{--        $('#more_details').on('shown.bs.collapse', function () {--}}
{{--            toggleLink.innerHTML = '<span id="toggleIcon">▼</span> Less details...';--}}
{{--        });--}}

{{--        $('#more_details').on('hidden.bs.collapse', function () {--}}
{{--            toggleLink.innerHTML = '<span id="toggleIcon">^</span> More details...';--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}