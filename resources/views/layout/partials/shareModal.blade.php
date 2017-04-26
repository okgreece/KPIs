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
<div id="shareModal" class="modal">
    <div class="modal-content">
      <h4>@lang('kpi/shareModal.header')</h4>
      <p>@lang('kpi/shareModal.body')</p>
      <ul class="share-modal-buttons">
          
      </ul>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">@lang('kpi/shareModal.close')</a>
    </div>
</div>
<script>
    function updateModal(indicator){
        var shareButtons = $(".share-modal-buttons");
        var organization = $("#organization-select option:selected")[0].value;
        var year = $("#year-select option:selected")[0].value;
        var phase = $("#phase-select option:selected")[0].value;
        var api = "/api/v1/indicators/";
        var host = "{{env('APP_URL')}}";
        var url = host + api + indicator + "/" + "value?" + "organization=" + organization + "&phase=" + phase + "&year=" + year;
        shareButtons.html('');
        shareButtons.append('<li><a href="' + url + '" target="_blank"><i class="material-icons">&#xE902;</i> API</a></li>');
        var modal = $("#shareModal");
        modal.modal();
        modal.modal("open");
    }
</script>

