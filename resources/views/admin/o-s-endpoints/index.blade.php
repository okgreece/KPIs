@extends('layouts.app')

@section('title', 'OS Endpoints')
@section('subtitle', 'Define OS Endpoint to be used for further data visualizations.')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">OS Endpoints</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/o-s-endpoints/create') }}" class="btn btn-primary btn-xs" title="Add New OS Endpoint"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
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
                                @foreach($osendpoints as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->uri }}</td><td>{{ $item->enabled }}</td>
                                        <td>
                                            <a href="{{ url('/admin/o-s-endpoints/' . $item->id) }}" class="btn btn-success btn-xs" title="View OS Endpoint"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/o-s-endpoints/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit OS Endpoint"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/o-s-endpoints', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete OS Endpoint" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete OSEndpoint',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $osendpoints->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
