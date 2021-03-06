@extends('layouts.app')

@section('title', 'Aggregator Instances')
@section('subtitle', 'Define Aggregators Instances, that little comparison enablers!')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Aggregator Instance {{ $aggregatorinstance->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/aggregator-instances') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/aggregator-instances/' . $aggregatorinstance->id . '/edit') }}" title="Edit AggregatorInstance"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/aggregatorinstances', $aggregatorinstance->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete AggregatorInstance',
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
                                        <td>{{ $aggregatorinstance->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Type </th>
                                        <td> {{ $aggregatorinstance->type() }} </td>
                                    </tr>
                                    <tr>
                                        <th> Codelist </th>
                                        <td> <a target="_blank"  href="{{ $aggregatorinstance->codelist }}">{{ $aggregatorinstance->codelist() }} </a></td>
                                    </tr>
                                    <tr>
                                        <th> Related Aggregator </th>
                                        <td> <a target="_blank" href="{{route("aggregators.show", ["aggregator" => $aggregatorinstance->aggregator->id])}}"> {{ $aggregatorinstance->aggregator->title }} </a></td>
                                    </tr>
                                    <tr>
                                        <th> Related Collection </th>
                                        <td> <a target="_blank" href="{{route("codelist-collections.show", ["collection" => $aggregatorinstance->collection->id])}}"> {{ $aggregatorinstance->collection->title }} </a> </td>
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
