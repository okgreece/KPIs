@extends('layouts.app')

@section('title', 'Aggregators')
@section('subtitle', 'Define Aggregators, the ingredient of indicators!.')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Aggregator {{ $aggregator->id }}</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! BootForm::open()->action( route('aggregators.update', $aggregator))->put() !!}
                        {!! BootForm::bind($aggregator) !!}
                        @include ('admin.aggregators.form', ['submitButtonText' => 'Update'])

                        {!! BootForm::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection