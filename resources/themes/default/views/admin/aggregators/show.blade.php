@extends('layouts.app')

@section('title', 'Aggregators')
@section('subtitle', 'Define Aggregators, the ingredient of indicators!.')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')
            <div class="col-md-9">
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
                                        <th> ID</th>
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
                                    @foreach(config('translatable.locales') as $locale)
                                    <tr> 
                                        <th> Title {{$locale}} </th>
                                        <td> {{ $aggregator->translate($locale)->title }} </td>
                                    </tr>
                                    <tr>
                                        <th> Description {{$locale}} </th>
                                        <td> {{ $aggregator->translate($locale)->description }} </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <th> Codelist </th>
                                        <td> {{ $aggregator->codelist }} </td>
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