<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    {!! Form::label('code', 'Code', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
        {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
    </div>
    {!! Form::label('title', 'EN Title', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('en_title', isset($group)?$group->translate("en")->title:null, ['class' => 'form-control']) !!}
        {!! $errors->first('en_title', '<p class="help-block">:message</p>') !!}
    </div>
    {!! Form::label('code', 'EN Description', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('en_description', isset($group)?$group->translate("en")->description:null, ['class' => 'form-control']) !!}
        {!! $errors->first('en_description', '<p class="help-block">:message</p>') !!}
    </div>
    {!! Form::label('title', 'EL Title', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('el_title', isset($group)?$group->translate("el")->title:null, ['class' => 'form-control']) !!}
        {!! $errors->first('el_title', '<p class="help-block">:message</p>') !!}
    </div>
    {!! Form::label('code', 'EL Description', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('el_description', isset($group)?$group->translate("el")->description:null, ['class' => 'form-control']) !!}
        {!! $errors->first('el_description', '<p class="help-block">:message</p>') !!}
    </div>    
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>