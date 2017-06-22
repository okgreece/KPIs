@extends('layouts.app')

@section('title', 'Aggregator Instances')
@section('subtitle', 'Define Aggregators Instances, that little comparison enablers!')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Aggregator Instance #{{ $aggregatorinstance->id }}</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/aggregator-instances') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        {!! BootForm::open()->action( route('aggregator-instances.update', $aggregatorinstance))->put()->id('aggInstanceSelector') !!}
                        {!! BootForm::bind($aggregatorinstance) !!}
                        @include ('admin.aggregator-instances.form', ['submitButtonText' => 'Update'])

                        {!! BootForm::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection