@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Panel</div>

                <div class="panel-body">
                    Congfigure main aspects of KPIs App
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
