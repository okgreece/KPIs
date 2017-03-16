@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Sparqlendpoints</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/s-p-a-r-q-l-endpoints/create') }}" class="btn btn-success btn-sm" title="Add New SPARQLEndpoint">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/s-p-a-r-q-l-endpoints', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th>Uri</th><th>Enabled</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($sparqlendpoints as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->uri }}</td><td>{{ $item->enabled }}</td>
                                        <td>
                                            <a href="{{ url('/admin/s-p-a-r-q-l-endpoints/' . $item->id) }}" title="View SPARQLEndpoint"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/s-p-a-r-q-l-endpoints/' . $item->id . '/edit') }}" title="Edit SPARQLEndpoint"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/s-p-a-r-q-l-endpoints', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete SPARQLEndpoint',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $sparqlendpoints->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
