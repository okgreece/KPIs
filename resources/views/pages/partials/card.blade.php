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
<div class="demo-card-event mdl-card mdl-shadow--6dp">
  
     <div class="mdl-card__title mdl-card__title-text">
        <h4>
      {{$header}}
    </h4>
    
    
  </div>
    <div class="mdl-card__title">
   
        <i class="material-icons card-icon">{{$icon}}</i>  
        
    </div>
    
  <div class="mdl-card__actions mdl-card--border">
    <a onclick="clickTab('{{$href}} span')" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      {{$button}}
    </a>
<!--    <div class="mdl-layout-spacer"></div>
    <i class="material-icons">event</i>-->
  </div>
</div>