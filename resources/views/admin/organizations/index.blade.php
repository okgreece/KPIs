@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Organizations</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/organizations/create') }}" class="btn btn-primary btn-xs" title="Add New Organization"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>  
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
                                @foreach($organizations as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->uri }}</td>
                                        <td>{{ $item->enabled }}</td>
                                        <td>
                                            <a href="{{ url('/admin/organizations/' . $item->id) }}" class="btn btn-success btn-xs" title="View Organization"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/organizations/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Organization"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/organizations', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Organization" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Organization',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $organizations->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
