        {!! BootForm::text('Code', 'code') !!}
        {!! TranslatableBootForm::text('Title', 'title') !!}
        {!! TranslatableBootForm::text('Description', 'description') !!}
        {!! BootForm::textarea('Included', 'included') !!}
        {!! BootForm::textarea('Excluded', 'excluded') !!}
        {!! BootForm::text('Codelist', 'codelist') !!}
        {!! BootForm::submit('Submit') !!}
