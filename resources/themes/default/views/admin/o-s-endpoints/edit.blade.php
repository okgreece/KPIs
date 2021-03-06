@extends('layouts.app')

@section('title', 'OS Endpoints')
@section('subtitle', 'Define OS Endpoint to be used for further data visualizations.')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit OS Endpoint #{{ $osendpoint->id }}</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/o-s-endpoints') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        {!! Form::model($osendpoint, [
                            'method' => 'PATCH',
                            'url' => ['/admin/o-s-endpoints', $osendpoint->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}
                        @include ('admin.o-s-endpoints.form', ['submitButtonText' => 'Update'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
