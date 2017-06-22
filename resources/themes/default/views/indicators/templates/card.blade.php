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
<div class="demo-card-wide mdl-card mdl-shadow--2dp indicator-card card">
    <div class="card-content">
        <span class="card-title activator grey-text text-darken-4">{{$indicator_title}}
            <i class="material-icons description-icon">info</i>
        </span>
    </div>
    <div class="mdl-card__media activator">
        <div id="{{$indicator_id}}">
        </div>
    </div>
    @if(Route::currentRouteName() == "embed")
        @include("embed/embedCardActions")
    @else
        @include("indicators/templates.cardActions")
    @endif
    <div class="card-reveal">
        <span class="card-title grey-text text-darken-4">@lang('kpi/messages.ind_description')<i class="material-icons right">close</i></span>
        <div class="mdl-card__supporting-text">
            {{$indicator_description}}
        </div>
    </div>
</div>