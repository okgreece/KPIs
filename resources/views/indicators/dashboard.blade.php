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
@include('indicators.templates.gauge_script')
@include('indicators.templates.number_script')
@include('indicators.templates.form')
<div class="dashboard">
    <div class="grid">
        <div class="row">
            <div class="card-panel teal center-align">
                <span class="white-text">Select an organization to start.
                </span>
            </div>
        </div>
    </div>
</div>
<script>
    function yearly(id){
        clickTab("#tab-4 span");
        $(".evolution").html("");
        var organization = $("#organization-select option:selected")[0].value;
        document.getElementById("organization-select-year").value = organization;
        updateYear();
        var phase = $("#phase-select option:selected")[0].value;
        document.getElementById("phase-select").value = phase;
        document.getElementById("indicator-select-year").value = id;
        evolution(organization, id, phase);
    }
</script>