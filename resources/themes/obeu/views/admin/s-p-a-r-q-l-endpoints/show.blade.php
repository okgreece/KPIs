@extends('layouts.app')

@section('title', 'SPARQL Endpoints')
@section('subtitle', 'Define SPARQL Endpoint to be used.')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">SPARQL Endpoint {{ $sparqlendpoint->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/s-p-a-r-q-l-endpoints') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/s-p-a-r-q-l-endpoints/' . $sparqlendpoint->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit SPARQL Endpoint"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/sparqlendpoints', $sparqlendpoint->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete SPARQL Endpoint',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $sparqlendpoint->id }}</td>
                                    </tr>
                                    <tr><th> Uri </th><td> {{ $sparqlendpoint->uri }} </td></tr><tr><th> Enabled </th><td> {{ $sparqlendpoint->enabled }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
