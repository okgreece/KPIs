@extends('layouts.app')

@section('title', 'Indicators')
@section('subtitle', 'Define indicators to be shown.')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Indicator {{ $indicator->id }}</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        {!! BootForm::open()->action( route('indicators.update', $indicator))->put() !!}
                        {!! BootForm::bind($indicator) !!}
                        @include ('admin.indicators.form', ['submitButtonText' => 'Update'])
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection