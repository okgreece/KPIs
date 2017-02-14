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
@include('indicators.gauge_script')
<div class="mdl-grid dashboard">
    

@component('indicators.gauge')
    @slot('indicator_id')
        gauge1
    @endslot
    
    @slot('indicator_value')
        67
    @endslot
    
    @slot('indicator_reverse')
        false
    @endslot
    
    @slot('indicator_title')
        demo
    @endslot
    @slot('indicator_description')
        demo description
    @endslot

@endcomponent
@component('indicators.gauge')
    @slot('indicator_id')
        gauge2
    @endslot
    
    @slot('indicator_value')
        54
    @endslot
    
    @slot('indicator_reverse')
        true
    @endslot
    
    @slot('indicator_title')
        demo2
    @endslot
    @slot('indicator_description')
        demo description
    @endslot

@endcomponent

@component('indicators.gauge')
    @slot('indicator_id')
        gauge3
    @endslot
    
    @slot('indicator_value')
        10
    @endslot
    
    @slot('indicator_reverse')
        true
    @endslot
    
    @slot('indicator_title')
        demo3
    @endslot
    @slot('indicator_description')
        demo description
    @endslot

@endcomponent

@component('indicators.gauge')
    @slot('indicator_id')
        gauge4
    @endslot
    
    @slot('indicator_value')
        90
    @endslot
    
    @slot('indicator_reverse')
        false
    @endslot
    
    @slot('indicator_title')
        demo4
    @endslot
    @slot('indicator_description')
        demo description
    @endslot

@endcomponent

</div>