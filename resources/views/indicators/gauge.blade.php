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
<div class="demo-card-wide mdl-card mdl-shadow--2dp">
  <div class="mdl-card__title">
    <h2 class="mdl-card__title-text">Welcome</h2>
  </div>
    <div class="mdl-card__media">
        <div id="{{$gauge_id}}">
            
        </div>
    </div>
  <div class="mdl-card__supporting-text">
    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
    Mauris sagittis pellentesque lacus eleifend lacinia...
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      Get Started
    </a>
  </div>
  <div class="mdl-card__menu">
    <!-- Right aligned menu below button -->
<button id="demo-menu-lower-right-{{$gauge_id}}"
        class="mdl-button mdl-js-button mdl-button--icon">
  <i class="material-icons">more_vert</i>
</button>

<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
    for="demo-menu-lower-right-{{$gauge_id}}">
  <li class="mdl-menu__item">Some Action</li>
  <li class="mdl-menu__item">Another Action</li>
  <li disabled class="mdl-menu__item">Disabled Action</li>
  <li class="mdl-menu__item">Yet Another Action</li>
</ul>
  </div>
</div>


<script>
    function gaugeColor(reverse){
        if(reverse){
            return ["#a9d70b", "#f9c802", "#ff0000"];
        }
        else{
            return ["#ff0000", "#f9c802", "#a9d70b"];
        }
    }
//      var normalColor = ["#ff0000", "#f9c802", "#a9d70b"];
//      var reverseColor = ["#a9d70b", "#f9c802", "#ff0000"];
      var g = new JustGage({
        id: "{{$gauge_id}}",
        value: {{$value}},
        min: 0,
        max: 100,
        symbol: "%",
        levelColors: gaugeColor({{$reverse}}),        
        title: "{{$gauge_title}}"
      });
</script>

