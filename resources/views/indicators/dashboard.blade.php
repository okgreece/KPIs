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
@component('indicators.gauge')
    @slot('gauge_id')
        gauge1
    @endslot
    
    @slot('value')
        67
    @endslot
    
    @slot('reverse')
        false
    @endslot
    
    @slot('gauge_title')
        demo
    @endslot

@endcomponent
@component('indicators.gauge')
    @slot('gauge_id')
        gauge2
    @endslot
    
    @slot('value')
        54
    @endslot
    
    @slot('reverse')
        true
    @endslot
    
    @slot('gauge_title')
        demo2
    @endslot

@endcomponent

@component('indicators.gauge')
    @slot('gauge_id')
        gauge3
    @endslot
    
    @slot('value')
        10
    @endslot
    
    @slot('reverse')
        true
    @endslot
    
    @slot('gauge_title')
        demo3
    @endslot

@endcomponent

@component('indicators.gauge')
    @slot('gauge_id')
        gauge4
    @endslot
    
    @slot('value')
        90
    @endslot
    
    @slot('reverse')
        true
    @endslot
    
    @slot('gauge_title')
        demo4
    @endslot

@endcomponent