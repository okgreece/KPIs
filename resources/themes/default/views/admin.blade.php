@extends('layouts.app')

@section('title', "Dashboard")
@section('subtitle', 'Congfigure main aspects of KPIs App')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    Congfigure main aspects of KPIs App
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
