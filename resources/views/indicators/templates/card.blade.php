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
<div class="demo-card-wide mdl-card mdl-shadow--2dp indicator-card">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">{{$indicator_title}}</h2>
    </div>
    <div class="mdl-card__media">
        <div id="{{$indicator_id}}">
        </div>
    </div>
    <div class="mdl-card__supporting-text">
        {{$indicator_description}}
    </div>
    <div class="mdl-card__actions mdl-card--border">
        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
            Compare
        </a>
        <a onclick="yearly({{ltrim($indicator_id,"indicator")}})" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
            Yearly Change
        </a>
    </div>
    <div class="mdl-card__menu">
        <!-- Right aligned menu below button -->
        <button id="demo-menu-lower-right-{{$indicator_id}}"
                class="mdl-button mdl-js-button mdl-button--icon">
            <i class="material-icons">share</i>
        </button>
        <button id="demo-menu-lower-right-{{$indicator_id}}"
                class="mdl-button mdl-js-button mdl-button--icon">
            <i class="material-icons">code</i>
        </button>
    </div>
</div>
