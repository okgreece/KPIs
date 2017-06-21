{!! $codelists !!}
{!! TranslatableBootForm::text('Title', 'title') !!}
{!! TranslatableBootForm::text('Description', 'description') !!}

<div id="conceptPlaceholder">
    
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
{!! BootForm::submit(isset($submitButtonText) ? $submitButtonText : 'Create') !!}
