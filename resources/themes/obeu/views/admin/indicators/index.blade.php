@extends('layouts.app')

@section('title', 'Indicators')
@section('subtitle', 'Define indicators to be shown.')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Indicators</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/indicators/create') }}" class="btn btn-primary btn-xs" title="Add New Indicator"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Indicator </th><th> Group </th><th> Enabled </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($indicators as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->indicatorGroup->title }}</td>
                                        <td>{{ $item->enabled }}</td>
                                        <td>
                                            <a href="{{ url('/admin/indicators/' . $item->id) }}" class="btn btn-success btn-xs" title="View Indicator"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/indicators/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Indicator"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/indicators', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Indicator" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Indicator',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $indicators->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection