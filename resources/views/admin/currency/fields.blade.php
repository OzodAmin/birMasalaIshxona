<div class="nav-tabs-custom col-xs-12">

    <ul class="nav nav-tabs">
        <?php $key = 1;
        foreach( LaravelLocalization::getSupportedLocales() as $locale => $properties ): ?>
        <li class="{{ $key==1 ? 'active' : '' }}">
            <a href="#tab_{{ $key }}" data-toggle="tab">
                <span class="locale-title"><i class="fa fa-globe" aria-hidden="true"></i> {{ $properties['native'] }}</span>
            </a>
        </li>
        <?php $key++; endforeach; ?>
    </ul>

    <div class="tab-content">
        <?php $key = 1;
        foreach( LaravelLocalization::getSupportedLocales() as $locale => $properties ): ?>
        <div class="tab-pane {{ $key==1 ? 'active' : '' }}" id="tab_{{ $key }}">

            <div class="form-group col-sm-6">
                {!! Form::label($locale.'[title]', 'Заголовок:') !!}
                {{ Form::text(
                    $locale.'[title]',
                    isset($currency) ? $currency->translate($locale)->title : null,
                    ['class' => 'form-control'])
                }}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label($locale.'[slug]', 'URL:') !!}
                {{ Form::text(
                    $locale.'[slug]',
                    isset($currency) ? $currency->translate($locale)->slug : null,
                    ['class' => 'form-control',
                    'disabled' => isset($currency) ? null : 'true'])
                }}
            </div>
        </div>  
        <?php $key++; endforeach; ?>
    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('code', 'Код:') !!}
        {{ Form::text(
            'code',
            isset($currency) ? $currency->code : null,
            ['class' => 'form-control'])
        }}
    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('icon', 'Иконка:') !!}
        {{ Form::text('icon',
            isset($currency) ? $currency->icon : null,
            ['class' => 'form-control'])
        }}
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('measures.index') !!}" class="btn btn-default">Cancel</a>
    </div>
</div>
