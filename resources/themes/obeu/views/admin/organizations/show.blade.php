@extends('layouts.app')

@section('title', 'Organizations')
@section('subtitle', 'Enable or Disable Organizations to show on your Dashboard.')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Organization {{ $organization->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/organizations') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/organizations/' . $organization->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Organization"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/organizations', $organization->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Organization" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Organization',
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
                                        <td>{{ $organization->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Uri </th>
                                        <td> {{ $organization->uri }} </td>
                                    </tr>
                                    <tr>
                                        <th> Enabled </th>
                                        <td> {{ $organization->enabled }} </td>
                                    </tr>
                                    <tr>
                                        <th> Label </th>
                                        <td> {{ $organization->geonamesInstance->label }} </td>
                                    </tr>
                                    <tr>
                                        <th> Population </th>
                                        <td> {{ $organization->geonamesInstance->population }} </td>
                                    </tr>
                                    <tr>
                                        <th> Dimension </th>
                                        <td> {{ $organization->dimension }} </td>
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
