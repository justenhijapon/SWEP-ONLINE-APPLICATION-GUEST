<small class="text-navy">
    {{ \Carbon\Carbon::parse($event['data']->submission_date)->diffForHumans() }}
</small>