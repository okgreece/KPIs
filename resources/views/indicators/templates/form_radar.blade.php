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
<script>
    $(document).ready(function () {
    $('select').material_select();
    });
    var counter2 = 0;
    var palette_size = 7;
    var colors = palette("tol-rainbow", palette_size);
    function update2(data) {
    var organization = $("#organization-select-radar option:selected")[0].value;
    $.ajax({
    type: "GET",
            url: "years",
            data: {organization: organization},
            success: function (data) {
            $("#year-radar").html(data);
            $('#year-radar > select').material_select();
            }
    });
    $.ajax({
    type: "GET",
            url: "phases",
            data: {organization: organization},
            success: function (data) {
            $("#phase-radar").html(data);
            $('#phase-radar > select').material_select();
            }
    });
    }
</script>
<div class='form'>
    <div class="row">
        <div class="input-field col l3 m12">
            <select id="organization-select-radar" onchange="update2(this)">     
                @foreach($organizations as $organization)
                <option value="{{$organization["value"]}}">{{$organization["label"]}}</option>
                @endforeach
            </select>
            <label>@lang('kpi/forms.organization')</label>
        </div>
        <div id="phase-radar" class="input-field col l3 m12">
            <select>
            </select>
        </div>
        <div id="year-radar" class="input-field col l3 m12">
            <select>
            </select>
        </div>

        <div class="input-field col l3 m12 valign-wrapper">
            <button onclick="radar()" class="btn-floatin btn-large waves-effect waves-light" type="submit" name="action">
                <i class="material-icons right">send</i>
            </button>
            <button id="addSeries2" onclick="addSeries2()" class="mdl-button mdl-js-button mdl-button--disabled mdl-button--fab mdl-button--colored waves-effect waves-light">
                <i class="material-icons">add</i>
            </button>
        </div>
    </div>
</div>
<script>
    function radar(organization = null, indicator = null, phase = null){
        if (organization == null) {
            var organization = $("#organization-select-radar option:selected")[0].value;
        }
        if (phase == null) {
            var phase = $("#phase-radar select option:selected")[0].value;
        }
        if (year == null) {
            var year = $("#year-radar select option:selected")[0].value;
        }
        $(".progress").removeClass("progress-hidden");
        
        $.ajax({
        type: "GET",
                url: "radar",
                data: {organization: organization, year:year, phase: phase},
                success: function (data) {
                    $(".radar").html(data);
                    $("#addSeries2").removeClass("mdl-button--disabled");
                    $(".progress").addClass("progress-hidden");
                    $("#radar-action-btn ul li a")[0].href = osLinkR;
                    $("#radar-action-btn ul li a")[2].href = osLinkE;
                    $("#radar-action-btn ul li a")[1].href = indigoLinkE;
                    $("#radar-action-btn ul li a")[3].href = indigoLinkR;
                    $("#radar-action-btn").show();
                }
        });
    }

    /*
     * TODO: sparse data fix with missing labels or not a so hackish style...
     */

    function addNulls(item, index, data){
        var chart = window.line;
        var diff = chart.data.labels.length - chart.data.datasets[index].data.length;
        if (diff > 0){
            var tempData = Array(diff).fill(null);
            chart.data.datasets[index].data = tempData.concat(chart.data.datasets[index].data);
        }
    }

    //code taken from SO
    function hex2rgba_convert(hex, opacity){
        r = parseInt(hex.substring(0, hex.length / 3), 16);
        g = parseInt(hex.substring(hex.length / 3, 2 * hex.length / 3), 16);
        b = parseInt(hex.substring(2 * hex.length / 3, 3 * hex.length / 3), 16);
        result = 'rgba(' + r + ',' + g + ',' + b + ',' + opacity / 100 + ')';
    return result;
    }


    function addSeries2(organization = null, indicator = null, phase = null){
        if ($("#addSeries2").hasClass("mdl-button--disabled")){
            return;
        }
    
        var organization = $("#organization-select-radar option:selected")[0].value;   
        var year = $("#year-radar  select option:selected")[0].value;  
        var phase = $("#phase-radar select option:selected")[0].value;  
        $(".progress").removeClass("progress-hidden");
        var counter3 = 0;
        $.ajax({
        type: "GET",
                url: "updateRadar",
                data: {organization: organization, year:year, phase: phase},
                success: function (data) {
                    $.each(data, function (){

                        this.original.backgroundColor = hex2rgba_convert(colors[counter2 % palette_size], 30);
                        this.original.borderColor = hex2rgba_convert(colors[counter2 % palette_size], 100);
                        if (counter3 == 0){
                            var chart = window.radarGraph0;
                        }
                        else if (counter3 == 1){
                            var chart = window.radarGraph1;
                        }
                        else if (counter3 == 2){
                            var chart = window.radarGraph2;
                        }
                        else if (counter3 == 3){
                            var chart = window.radarGraph3;
                        }
                        counter3++;
                        chart.data.datasets.push(this.original);
                        chart.update();
                    });
                    counter2++;
                    $(".progress").addClass("progress-hidden");
                    $("#radar-action-btn").hide();
                }
        });
    };
</script>

