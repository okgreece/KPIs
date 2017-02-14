@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Group {{ $group->id }}</div>
                <div class="panel-body">

                    <a href="{{ url('admin/groups/' . $group->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Group"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                    {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['admin/groups', $group->id],
                    'style' => 'display:inline'
                    ]) !!}
                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Group',
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
                                    <td>{{ $group->id }}</td>
                                </tr>
                                <tr>
                                    <th> Code </th>
                                    <td> {{ $group->code }} </td>
                                </tr>
                                <tr>
                                    <th> Title EN </th>
                                    <td> {{ $group->translate('en')->title }} </td>
                                </tr>
                                <tr>
                                    <th> Description EN </th>
                                    <td> {{ $group->translate('en')->description }} </td>
                                </tr>
                                <tr>
                                    <th> Title EL </th>
                                    <td> {{ $group->translate('el')->title }} </td>
                                </tr>
                                <tr>
                                    <th> Description EL </th>
                                    <td> {{ $group->translate('el')->description }} </td>
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