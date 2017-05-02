@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Aggregators</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/aggregators/create') }}" class="btn btn-primary btn-xs" title="Add New Aggregator"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Code </th><th> Included </th><th> Excluded </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($aggregators as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->code }}</td><td>{{ str_replace(',', ', ',$item->included) }}</td><td>{{ str_replace(',', ', ',$item->excluded) }}</td>
                                        <td>
                                            <a href="{{ url('/admin/aggregators/' . $item->id) }}" class="btn btn-success btn-xs" title="View Aggregator"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/aggregators/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Aggregator"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/aggregators', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Aggregator" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Aggregator',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $aggregators->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection