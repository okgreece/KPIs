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
<div class="mdl-grid home">
    <div class="row">
    @include('pages.partials.card', ['header' => trans('kpi/frontpage.dashboard'), 'button' => trans('kpi/buttons.go'), 'icon' => "dashboard" , 'href' => "#tab-2" , 'link' => false])

    @include('pages.partials.card', ['header' => trans('kpi/frontpage.yearly'), 'button' => trans('kpi/buttons.go'), 'icon' => "timeline", 'href' => "#tab-4" , 'link' => false])

    @include('pages.partials.card', ['header' => trans('kpi/frontpage.api'), 'button' => trans('kpi/buttons.go'), 'icon' => "http", 'href' => "/api/documentation", 'link' => true])
    </div>
</div>
<div class="mdl-grid home">     
  <iframe width="560" height="400" src="https://www.youtube.com/embed/FY6lPuxlbOQ?rel=0" frameborder="0" allowfullscreen></iframe>       
</div>
<script>
    function clickTab(tab){
        mytab = $(tab);
        mytab.click();
    }
</script>