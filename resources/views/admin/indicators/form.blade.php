        {!! BootForm::text('Indicator Code','indicator') !!}
        {!! TranslatableBootForm::text('Title', 'title') !!}
        {!! TranslatableBootForm::text('Description', 'description') !!}
        {!! BootForm::select('Group', 'group')->options($groups) !!}
        {!! BootForm::inlineRadio('Enabled', 'enabled', 1) !!}
        {!! BootForm::inlineRadio('Disabled', 'enabled', 0) !!}
        </br>
        {!! BootForm::inlineRadio('Forward', 'reverse', 0) !!}
        {!! BootForm::inlineRadio('Reverse', 'reverse', 1) !!}
        {!! BootForm::select('Type', 'type', ['Percent', 'Number', 'Bar Chart']) !!}
        {!! BootForm::select('Numerator', 'numerator')->options($aggregators) !!}
        {!! BootForm::select('Denominator', 'denominator')->options($aggregators) !!}
        {!! Form::submit('Submit') !!}