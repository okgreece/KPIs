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
        @if(Route::currentRouteName() === "embed")
            var organization = "{{$urls->organization}}";
            var organizationL = "{{$indicator->organization}}";
            var organizationLabel = encodeURIComponent(organizationL.replace(" ", " #"));
            var year = "{{$urls->year}}";
            var yearL = "{{$indicator->year}}";
            var phase = "{{$urls->phase}}";
        @else
            var organization = $("#organization-select option:selected")[0].value;
            var organizationL = $("#organization-select option:selected")[0].text;
            var organizationLabel = encodeURIComponent(organizationL.replace(" ", " #"));
            var year = $("#year-select option:selected")[0].value;
            var yearL = $("#year-select option:selected")[0].text;
            var phase = $("#phase-select option:selected")[0].value;
        @endif

        var api = "/api/v1/indicators/";
        var host = "{{env('APP_URL')}}";
        var url = host + api + indicator + "/" + "value?" + "organization=" + organization + "&phase=" + phase + "&year=" + year;
        var embed = host + "/embed?" + "indicator=" + indicator + "&organization=" + organization + "&phase=" + phase + "&year=" + year;
        var shortURL = $.ajax({
            type: "GET",
            url: host + "/tinyURL",
            data: {url:embed},
            success: function (data) {
                console.log(data);
                shareButtons.html('');
                shareButtons.append('<div class="row"><span class="myLabel" for="textarea1">Link</span><div class="input-field col s12"><textarea readonly rows="1" id="textarea1" class="myTextArea">' + data + '</textarea></div></div>');
                shareButtons.append('<div class="row"><span class="myLabel" for="textarea2">Embed</span><div class="input-field col s12"><textarea readonly id="textarea2" class="myTextArea">&ltiframe src="' + data + '" height="330" width="330" frameborder="0" scrolling="no"&gtYou need an iframes capable browser to view this content.&lt/iframe&gt</textarea></div></div>');
                var twitter = document.createElement('a');
                twitter.innerHTML = "<i class='fa fa-twitter' aria-hidden='true'></i> Twitter";
                twitter.title = "@lang('kpi/shareModal.twitter')";
                twitter.className = "waves-effect waves-light btn";
                twitter.href = "https://twitter.com/intent/tweet?url=" + data + "&text=%23" + organizationLabel + "%20%23" + yearL + "%20%23transparency%20%23opendata%20%23" + indicator ;
                shareButtons.append(twitter);
                //shareButtons.append("<a title=' class='waves-effect waves-light btn' href='https://twitter.com/intent/tweet?url=" + data + "&text=%23" + organizationLabel + "%20%23" + yearL + "%20%23transparency%20%23opendata%20%23" + indicator + "><i class='fa fa-twitter' aria-hidden='true'></i> Twitter</a>");
                
                shareButtons.append('<a title="@lang("kpi/shareModal.facebook")" class="waves-effect waves-light btn" href="https://www.facebook.com/sharer/sharer.php?u=' + data + '"><i class="fa fa-facebook-official" aria-hidden="true"></i> Facebook</a>');
                shareButtons.append('<a title="@lang("kpi/shareModal.api")" class="waves-effect waves-light btn" href="' + url + '" target="_blank">API</a>');
                var modal = $("#shareModal");
                modal.modal();                
                modal.modal("open");
                    }
        });
    }
</script>
