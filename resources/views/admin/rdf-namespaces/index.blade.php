@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">RDF Namespaces</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/rdf-namespaces/create') }}" class="btn btn-primary btn-xs" title="Add New RDF Namespace"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th>Prefix</th><th>Url</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($rdfnamespaces as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->prefix }}</td><td>{{ $item->url }}</td>
                                        <td>
                                            <a href="{{ url('/admin/rdf-namespaces/' . $item->id) }}" class="btn btn-success btn-xs" title="View RDF Namespace"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/rdf-namespaces/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit RDF Namespace"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/rdf-namespaces', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete RDF Namespace" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete RDF Namespace',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $rdfnamespaces->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
