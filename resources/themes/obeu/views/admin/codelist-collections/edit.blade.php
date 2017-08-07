@extends('layouts.app')

@section('title', 'Local Codelist Collections')
@section('subtitle', 'Define local codelist collections to be used on aggregation calculations.')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Codelist Collection #{{ $codelistcollection->id }}</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/codelist-collections') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($codelistcollection, [
                            'method' => 'PATCH',
                            'url' => ['/admin/codelist-collections', $codelistcollection->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('admin.codelist-collections.form', ['codelists' => $codelists , 'submitButtonText' => 'Update'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection