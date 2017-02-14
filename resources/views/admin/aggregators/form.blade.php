<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    {!! Form::label('code', 'Code', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
        {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
    </div>
</div>
{!! Form::label('en_title', 'EN Title', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('en_title', isset($aggregator)?$aggregator->translate("en")->title:null, ['class' => 'form-control']) !!}
        {!! $errors->first('en_title', '<p class="help-block">:message</p>') !!}
    </div>
    {!! Form::label('en_description', 'EN Description', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('en_description', isset($aggregator)?$aggregator->translate("en")->description:null, ['class' => 'form-control']) !!}
        {!! $errors->first('en_description', '<p class="help-block">:message</p>') !!}
    </div>
    {!! Form::label('el_title', 'EL Title', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('el_title', isset($aggregator)?$aggregator->translate("el")->title:null, ['class' => 'form-control']) !!}
        {!! $errors->first('el_title', '<p class="help-block">:message</p>') !!}
    </div>
    {!! Form::label('el_description', 'EL Description', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('el_description', isset($aggregator)?$aggregator->translate("el")->description:null, ['class' => 'form-control']) !!}
        {!! $errors->first('el_description', '<p class="help-block">:message</p>') !!}
    </div>
<div class="form-group {{ $errors->has('included') ? 'has-error' : ''}}">
    {!! Form::label('included', 'Included', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('included', null, ['class' => 'form-control']) !!}
        {!! $errors->first('included', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('excluded') ? 'has-error' : ''}}">
    {!! Form::label('excluded', 'Excluded', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('excluded', null, ['class' => 'form-control']) !!}
        {!! $errors->first('excluded', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('codelist') ? 'has-error' : ''}}">
    {!! Form::label('codelist', 'Codelist', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('codelist', null, ['class' => 'form-control']) !!}
        {!! $errors->first('codelist', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>