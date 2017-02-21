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
    var counter = 0;
    var palette_size = 7;
    var colors = palette("tol-rainbow", palette_size);

    function updateYear(data) {
        var organization = $("#organization-select-year option:selected")[0].value;
        $.ajax({
            type: "GET",
            url: "phases",
            data: {organization: organization},
            success: function (data) {
                $("#phase-year").html(data);
                $('#phase-year > select').material_select();
            }
        });

    }
</script>
<div class='form'>
    <div class="row">
        <div class="input-field col s3">
            <select id="organization-select-year" onchange="updateYear(this)">     
                @foreach($organizations as $organization)
                <option value="{{$organization["value"]}}">{{$organization["label"]}}</option>
                @endforeach
            </select>
            <label>Organization</label>
        </div>
        <div id="phase-year" class="input-field col s3">
            <select>
            </select>
        </div>
        <div id="indicator-year" class="input-field col s3">
            @include('indicators.templates.indicator')
        </div>
        <div class="input-field col s3 valign-wrapper">
            <button onclick="evolution()" class="btn-floatin btn-large waves-effect waves-light" type="submit" name="action">Submit
                <i class="material-icons right">send</i>
            </button>
            <button id="addSeries" onclick="addSeries()" class="mdl-button mdl-js-button mdl-button--disabled mdl-button--fab mdl-button--colored waves-effect waves-light">
                <i class="material-icons">add</i>
            </button>
        </div>
        <div class="input-field col s3 valign-wrapper">
            
        </div>
    </div>
    <div id="year-progress" style="display: none" class='row'>

        <div class="progress">
            <div class="indeterminate"></div>
        </div>

    </div>
</div>
<script>
    function evolution(organization = null, indicator = null, phase = null){
        if (organization == null) {
            var organization = $("#organization-select-year option:selected").val();
        }
        if (indicator == null) {
            var indicator = $("#indicator-select-year option:selected").val();
        }
        if (phase == null) {
            var phase = $("#phase-year  select option:selected").val();
        }
        $("#year-progress").show();
        $("#addSeries").removeClass("mdl-button--disabled");
        $.ajax({
            type: "GET",
            url: "evolution",
            data: {organization: organization, indicatorID: indicator, phase: phase},
            success: function (data) {
                $(".evolution").html(data);
                $("#year-progress").hide();
            }
        });
        organization,phase,indicator = null;
    }
    
    /*
     * TODO: sparse data fix with missing labels or not a so hackish style...
     */
    
    function addNulls(item, index, data){
        var chart = window.line;
        var diff = chart.data.labels.length - chart.data.datasets[index].data.length;
        if(diff>0){
          var tempData = Array(diff).fill(null);
          chart.data.datasets[index].data = tempData.concat(chart.data.datasets[index].data);
        }
    }
    
    //code taken from SO
    function hex2rgba_convert(hex,opacity){
        r = parseInt(hex.substring(0, hex.length/3), 16);
        g = parseInt(hex.substring(hex.length/3, 2*hex.length/3), 16);
        b = parseInt(hex.substring(2*hex.length/3, 3*hex.length/3), 16);

        result = 'rgba('+r+','+g+','+b+','+opacity/100+')';
        return result;
    }
    
        
    function addSeries(){
        if($("#addSeries").hasClass("mdl-button--disabled")){
            return ;
        }        
        var organization = $("#organization-select-year option:selected").val();
        var indicator = $("#indicator-select-year option:selected").val();
        var phase = $("#phase-year  select option:selected").val();
        $("#year-progress").show();
        var chart = window.line;
        $.ajax({
            type: "GET",
            url: "update",
            data: {organization: organization, indicatorID: indicator, phase: phase},
            success: function (data) {
                //console.log(chart);
                if(chart.data.labels.length != data.labels.length){
                    var diff = chart.data.labels.length - data.labels.length;
                    if(diff>0){
                      var tempData = Array(diff).fill(null);
                      data.datasets.data = tempData.concat(data.datasets.data);
                      //console.log(1);
                    }
                    else{
                        chart.data.labels;
                        var tempLabels = Array((diff)*(-1)).fill(0).map((e,i)=>String(i+2005));
                        var newLabels = tempLabels.concat(chart.data.labels);
                        chart.data.labels = newLabels
                        chart.data.datasets.forEach(addNulls);
                        //console.log(2);
                    }
            };
            data.datasets.backgroundColor = hex2rgba_convert(colors[counter%palette_size], 30);
            data.datasets.borderColor = hex2rgba_convert(colors[counter%palette_size], 100)
            chart.data.datasets.push(data.datasets);
            chart.update();
            counter++;
            $("#year-progress").hide();
        }
    });
    };
</script>

