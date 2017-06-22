<div class="form-group {{ $errors->has('prefix') ? 'has-error' : ''}}">
    {!! Form::label('prefix', 'Prefix', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('prefix', null, ['class' => 'form-control']) !!}
        {!! $errors->first('prefix', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('url') ? 'has-error' : ''}}">
    {!! Form::label('url', 'Url', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('url', null, ['class' => 'form-control']) !!}
        {!! $errors->first('url', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
