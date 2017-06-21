{!! BootForm::select('Related Aggregator', 'aggregator_id')->options($aggregators) !!}
{!! BootForm::select('Type', 'type', ["" => "Please select an Aggregator Instance Type...", 'Codelist', 'Local Collection', 'Property'])->onchange('updateCodelists(this)') !!}
<div id="codelistPlaceholder">
    
</div>

<div id="instancePlaceholder">
    
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
{!! Form::submit('Submit') !!}