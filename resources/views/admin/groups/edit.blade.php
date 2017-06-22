@extends('layouts.app')

@section('title', 'Indicator Groups')
@section('subtitle', 'Define indicators groups to be shown.')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Group {{ $group->id }}</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        {!! BootForm::open()->action( route('groups.update', $group))->put() !!}
                        {!! BootForm::bind($group) !!}
                        @include ('admin.groups.form', ['submitButtonText' => 'Update'])
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection