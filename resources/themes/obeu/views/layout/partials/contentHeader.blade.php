<?php
/*
 * The MIT License
 *
 * Copyright 2017 Sotiris Karampatakis Open Knowledge Greece.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
?>
<!-- Simple header with scrollable tabs. -->
<header class="mdl-layout__header">
    <div class="progress progress-hidden">
            <div class="indeterminate"></div>
    </div>
    <!-- Tabs -->
    <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
        <a id="tab-1" href="#scroll-tab-1" class="mdl-layout__tab is-active">@lang('kpi/navigation.home')</a>
        <a id="tab-2" href="#scroll-tab-2" class="mdl-layout__tab">@lang('kpi/navigation.dashboard')</a>
        <a id="tab-3" href="#scroll-tab-3" class="mdl-layout__tab">@lang('kpi/navigation.compare')</a>
        <a id="tab-4" href="#scroll-tab-4" class="mdl-layout__tab">@lang('kpi/navigation.yearly')</a>
        <a id="tab-5" href="#scroll-tab-5" class="mdl-layout__tab">@lang('kpi/navigation.radar')</a>
        <a id="tab-6" href="#about-page" class="mdl-layout__tab">@lang('kpi/navigation.about')</a>
        <div class='spacer'></div>
        <div class="language-switch">
            @foreach(config('lang-detector.languages') as $language)
                <a href="/lang/{{$language}}" title="Switch Language to {{$language}}" class="mdl-layout__tab"><span class="flag-icon flag-icon-{{$language}}"></span></a>
            @endforeach
        </div>
    </div>
</header>