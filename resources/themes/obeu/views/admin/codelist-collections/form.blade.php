{!! $codelists !!}
{!! TranslatableBootForm::text('Title', 'title') !!}
{!! TranslatableBootForm::text('Description', 'description') !!}


@if( Route::currentRouteName() === "codelist-collections.edit")
	{!! BootForm::text('Included', 'included', $codelistcollection->included)->disable() !!}
	{!! BootForm::text('Excluded', 'excluded', $codelistcollection->excluded)->disable() !!}
	<a onclick="editConcepts()">Edit Included/Excluded Instances</a>
	<script>
        function editConcepts(){
            var editForm = $("#codelist")[0];
            getConcepts(editForm);
        }
	</script>
@endif

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
