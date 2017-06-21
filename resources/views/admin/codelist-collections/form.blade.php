{!! $codelists !!}

<div class="form-group {{ $errors->has('included') ? 'has-error' : ''}}">
    {!! Form::label('included', 'Included', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('included', null, ['class' => 'form-control']) !!}
        {!! $errors->first('included', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('excluded') ? 'has-error' : ''}}">
    {!! Form::label('excluded', 'Excluded', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('excluded', null, ['class' => 'form-control']) !!}
        {!! $errors->first('excluded', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
