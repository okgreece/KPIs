@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Aggregator {{ $aggregator->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('admin/aggregators/' . $aggregator->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Aggregator"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/aggregators', $aggregator->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Aggregator',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $aggregator->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Code </th>
                                        <td> {{ $aggregator->code }} </td>
                                    </tr>
                                    <tr>
                                        <th> Included </th>
                                        <td> {{ $aggregator->included }} </td>
                                    </tr>
                                    <tr>
                                        <th> Excluded </th>
                                        <td> {{ $aggregator->excluded }} </td>
                                    </tr>
                                    <tr>
                                        <th> Title EN </th>
                                        <td> {{ $aggregator->translate('en')->title }} </td>
                                    </tr>
                                    <tr>
                                        <th> Description EN </th>
                                        <td> {{ $aggregator->translate('en')->description }} </td>
                                    </tr>
                                    <tr>
                                        <th> Title EL </th>
                                        <td> {{ $aggregator->translate('el')->title }} </td>
                                    </tr>
                                    <tr>
                                        <th> Title EN </th>
                                        <td> {{ $aggregator->translate('el')->description }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection