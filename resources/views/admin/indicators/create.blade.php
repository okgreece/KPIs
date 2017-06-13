@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Indicator</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! BootForm::open()->action( route('indicators.store')) !!}
                        @include ('admin.indicators.form')
                        {!! BootForm::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection