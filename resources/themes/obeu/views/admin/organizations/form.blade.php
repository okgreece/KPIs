<div class="form-group {{ $errors->has('uri') ? 'has-error' : ''}}">
    {!! Form::label('uri', 'Uri', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('uri', $availableOrganizations, null, ['class' => 'form-control', 'placeholder' => 'Pick an organization...']) !!}
        {!! $errors->first('uri', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('enabled') ? 'has-error' : ''}}">
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

<div class="form-group {{ $errors->has('linked') ? 'has-error' : ''}}">
    {!! Form::label('linked', 'Linked', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <div class="checkbox">
    <label>{!! Form::radio('linked', '1', null, ['onclick' => 'showTextInput()']) !!} Yes</label>
</div>
<div class="checkbox">
    <label>{!! Form::radio('linked', '0', null, ['onclick' => 'getContinents()']) !!} No</label>
</div>
        {!! $errors->first('linked', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div id="continentPlaceholder">
    
</div>

<div id="countryPlaceholder">
    
</div>

<div id="adm1Placeholder">
    
</div>

<div id="adm2Placeholder">
    
</div>

<div id="adm3Placeholder">
    
</div>

<div id="adm4Placeholder">

</div>

<div class="overlay-loader">
	<div class="loader">
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
	</div>
</div>
</br>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
