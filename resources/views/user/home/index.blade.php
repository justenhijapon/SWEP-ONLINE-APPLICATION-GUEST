@extends('layouts.admin-master')

@section('content')
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="col-md-3">
            <h2>Welcome {{Auth::guard('web')->user()->first_name}}</h2>
        </div>
    </div>
@endsection