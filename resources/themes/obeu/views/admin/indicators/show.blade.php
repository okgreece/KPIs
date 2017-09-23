@extends('layouts.app')

@section('title', 'Indicators')
@section('subtitle', 'Define indicators to be shown.')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Indicator {{ $indicator->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('admin/indicators/' . $indicator->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Indicator"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/indicators', $indicator->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Indicator',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $indicator->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Indicator </th>
                                        <td> {{ $indicator->indicator }} </td>
                                    </tr>
                                    <tr>
                                        <th> Title </th>
                                        <td> {{ $indicator->title }} </td>
                                    </tr>
                                    <tr>
                                        <th> Description </th>
                                        <td> {{ $indicator->description }} </td>
                                    </tr>
                                    <tr>
                                        <th> Enabled </th>
                                        <td> {{ $indicator->enabled }} </td>
                                    </tr>
                                    <tr>
                                        <th> Direction </th>
                                        <td> {{ $indicator->direction() }} </td>
                                    </tr>                                    
                                    <tr>
                                        <th> Group </th>
                                        <td> {{ $indicator->indicatorGroup->title }} </td>
                                    </tr>
                                    <tr>
                                        <th> Numerator </th>
                                        <td> {{ $indicator->num->title }} </td>
                                    </tr>
                                    <tr>
                                        <th> Denominator </th>
                                        <td> {{ $indicator->denom->title }} </td>
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