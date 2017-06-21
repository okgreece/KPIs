@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">RDF Namespace {{ $rdfnamespace->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/rdf-namespaces') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/rdf-namespaces/' . $rdfnamespace->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit RDF Namespace"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/rdfnamespaces', $rdfnamespace->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete RDF Namespace" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete RDF Namespace',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $rdfnamespace->id }}</td>
                                    </tr>
                                    <tr><th> Prefix </th><td> {{ $rdfnamespace->prefix }} </td></tr><tr><th> Url </th><td> {{ $rdfnamespace->url }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
