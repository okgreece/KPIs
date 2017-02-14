<div class="form-group {{ $errors->has('indicator') ? 'has-error' : ''}}">
    {!! Form::label('indicator', 'Indicator', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('indicator', null, ['class' => 'form-control']) !!}
        {!! $errors->first('indicator', '<p class="help-block">:message</p>') !!}
    </div>
</div>
{!! Form::label('en_title', 'EN Title', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('en_title', isset($indicator)?$indicator->translate("en")->title:null, ['class' => 'form-control']) !!}
        {!! $errors->first('en_title', '<p class="help-block">:message</p>') !!}
    </div>
    {!! Form::label('en_description', 'EN Description', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('en_description', isset($indicator)?$indicator->translate("en")->description:null, ['class' => 'form-control']) !!}
        {!! $errors->first('en_description', '<p class="help-block">:message</p>') !!}
    </div>
    {!! Form::label('el_title', 'EL Title', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('el_title', isset($indicator)?$indicator->translate("el")->title:null, ['class' => 'form-control']) !!}
        {!! $errors->first('el_title', '<p class="help-block">:message</p>') !!}
    </div>
    {!! Form::label('el_description', 'EL Description', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('el_description', isset($indicator)?$indicator->translate("el")->description:null, ['class' => 'form-control']) !!}
        {!! $errors->first('el_description', '<p class="help-block">:message</p>') !!}
    </div>
<div class="form-group {{ $errors->has('group') ? 'has-error' : ''}}">
    {!! Form::label('group', 'Group', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('group', $groups, ['class' => 'form-control']) !!}
        {!! $errors->first('group', '<p class="help-block">:message</p>') !!}
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
</div><div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    {!! Form::label('type', 'Type', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('type', ['Percent', ' Number', ' Bar Chart'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('nominator') ? 'has-error' : ''}}">
    {!! Form::label('nominator', 'Nominator', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('nominator', $aggregators, ['class' => 'form-control']) !!}
        {!! $errors->first('nominator', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('denominator') ? 'has-error' : ''}}">
    {!! Form::label('denominator', 'Denominator', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('denominator', $aggregators, ['class' => 'form-control']) !!}
        {!! $errors->first('denominator', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>