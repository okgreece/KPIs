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
</script>
<div class="container">
    <div class='grid'>
        <div id="row-1" class="row">
            <div id="fixed-dimension-1" class="input-field col s12 m6 l6">
                <select onchange="getConcepts(this, 1)" id="fixed-select-1">
                    <option value="" selected disabled>Select a dimension</option>
                    <option value="year">Year</option>
                    <option value="indicatorID">Indicator</option>
                    <option value="phase">Phase</option>
                    <option value="organization">Organization</option>
                </select>
                <label>Fixed dimension 1</label>
            </div>
            <div id="fixed-value-1" class="input-field col s12 m6 l6">
                <select>
                    
                </select>
            </div>
            
        </div>
        <div style="display: none" id="row-2" class="row">
            <div id="fixed-dimension-2" class="input-field col s12 m6 l6">
                <select onchange="getConcepts(this, 2)" id="fixed-select-2">
                    <option value="" selected disabled>Select a dimension</option>
                    <option value="year">Year</option>
                    <option value="indicatorID">Indicator</option>
                    <option value="phase">Phase</option>
                    <option value="organization">Organization</option>
                </select>
                <label>Fixed dimension 2</label>
            </div>
            <div id="fixed-value-2" class="input-field col s12 m6 l6">
                <select>
                    
                </select>
            </div>
        </div>
        <div style="display: none" id="row-3" class="row">
            <div id="fixed-dimension-3" class="input-field col s12 m6 l6">
                <select onchange="getConcepts(this, 3)" id="fixed-select-3">
                    <option value="" selected disabled>Select a dimension</option>
                    <option value="year">Year</option>
                    <option value="indicatorID">Indicator</option>
                    <option value="phase">Phase</option>
                    <option value="organization">Organization</option>
                </select>
                <label>Fixed dimension 3</label>
            </div>
            <div id="fixed-value-3" class="input-field col s12 m6 l6">
                <select>
                    
                </select>
            </div>
            
        </div>
        <div class="row">
            
            <div class="input-field col s12 m12 l12 center-align">
                <button id="compare-submit-button" onclick="compare()" class="btn-floatin btn-large waves-effect waves-light" disabled type="submit" name="action">Submit
                    <i class="material-icons right">send</i>
                </button>
            </div>
           
        </div>
        <div id="compare-progress" style="display: none"class='row'>

            <div class="progress">
                <div class="indeterminate"></div>
            </div>

        </div>

    </div>

</div>
<script>
    function compare() {
        var dimensions = [
            {dimension:$("#fixed-select-1 option:selected")[0].value, value:$("#fixed-value-1 > .select-wrapper > select option:selected")[0].value},
            {dimension:$("#fixed-select-2 option:selected")[0].value, value:$("#fixed-value-2 option:selected")[0].value},
            {dimension:$("#fixed-select-3 option:selected")[0].value, value:$("#fixed-value-3 option:selected")[0].value}
        ];
        $("#compare-progress").show();
        var free = $("#fixed-select-3 option:enabled").val();
        $.ajax({
            type: "GET",
            url: "compare",
            data: {dimensions:dimensions, free:free},
            success: function (data) {
                $(".compare").html(data);
                $("#compare-progress").hide();
            }
        });
    }
    
    function getConcepts(select, id){
        var dimension = select.value;
        //console.log(data.id);
        $.ajax({
            type: "GET",
            url: "dimension",
            data: {dimension: dimension},
            success: function (data) {
                $("#fixed-value-"+ id).html(data);
                $("#fixed-value-" + id + ' > select').material_select();
            }
        });
        if(id == 1){
            $("#fixed-select-2 option[value = '" + dimension +  "']" ).prop("disabled", true);
            $("#fixed-select-3 option[value = '" + dimension +  "']" ).prop("disabled", true);
            $("#fixed-select-2").material_select();
            $("#fixed-select-3").material_select();
            $("#row-2").show("slow");
        }
        if(id == 2){
            $("#fixed-select-3 option[value = '" + dimension +  "']" ).prop("disabled", true);
            $("#fixed-select-3").material_select();
            $("#row-3").show("slow");  
            $("#compare-submit-button").prop("disabled", false);
        }
        if(id == 3){
            
            $("#fixed-select-3 option[value = '" + dimension +  "']" ).prop("disabled", true);
            $("#fixed-select-3").material_select();            
        }
        
    }
</script>