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
<div class="mdl-grid">
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-cell mdl-cell--4-col">
        <div id="mapid" style="width: 600px; height: 500px;"></div>
        <script>
            var mymap = L.map('mapid').setView([37.97999954223633, 23.72999954223633], 6);
            var district_boundary = new L.geoJson();
            district_boundary.addTo(mymap);

            $.ajax({
                dataType: "json",
                url: "assets/geoserver-GetFeature.application.json",
                success: function (data) {
                    $(data.features).each(function (key, data) {
                        district_boundary.addData(data);
                    });
                }
            }).error(function () {});
        </script>
    </div>
    <div class="mdl-layout-spacer"></div>

</div>

