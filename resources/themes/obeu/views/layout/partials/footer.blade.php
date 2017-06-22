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
<footer class="mdl-mini-footer {{$screen_size}}">
    <div class="mdl-mini-footer__left-section">
    <div class="mdl-logo">
        <a href="//okfn.gr">
            <img id="okfgr-footer-logo" class="footer-logo" src="{{asset("images/okfn-white-logo.png")}}"></img>
        </a>
        
    </div>
    <div class="mdl-logo">
        <a href="//openbudgets.eu">
            <img id="obeu-footer-logo" class="footer-logo" src="{{asset("images/openbudgets_logo-white.png")}}"></img>
        </a>
        
    </div>    
    <strong>Copyright © {{date("Y")}} <a href="http://www.okfn.gr">OKF GREECE</a>.</strong> 
      <span> @lang('kpi/messages.copyright')</span>
  </div>
</footer>