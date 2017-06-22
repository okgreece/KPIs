@extends('layouts.app')

@section('title', 'Local Codelist Collections')
@section('subtitle', 'Define local codelist collections to be used on aggregation calculations.')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Codelist Collection {{ $codelistcollection->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/codelist-collections') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/codelist-collections/' . $codelistcollection->id . '/edit') }}" title="Edit CodelistCollection"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/codelistcollections', $codelistcollection->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete CodelistCollection',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $codelistcollection->id }}</td>
                                    </tr>
                                    <tr><th> Codelist </th><td> {{ $codelistcollection->codelist }} </td></tr><tr><th> Included </th><td> {{ $codelistcollection->included }} </td></tr><tr><th> Excluded </th><td> {{ $codelistcollection->excluded }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
