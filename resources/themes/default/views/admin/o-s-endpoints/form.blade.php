<div class="form-group {{ $errors->has('uri') ? 'has-error' : ''}}">
    {!! Form::label('uri', 'Uri', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('uri', null, ['class' => 'form-control']) !!}
        {!! $errors->first('uri', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('enabled') ? 'has-error' : ''}}">
    {!! Form::label('enabled', 'Enabled', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <div class="checkbox">
    <label>{!! Form::radio('enabled', '1') !!} Yes</label>
</div>
<div class="checkbox">
    <label>{!! Form::radio('enabled', '0', true) !!} No</label>
</div>
        {!! $errors->first('enabled', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
