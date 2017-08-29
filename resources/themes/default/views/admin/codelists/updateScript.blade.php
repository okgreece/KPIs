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
    function updateCodelists(data) {
        $(".overlay-loader").show();
        if(data.value == "0"){
            getCodelists(data.value);
        }
        else if (data.value == "1")
        {
            getCodelists(data.value);
        }
        else if (data.value == "2")
        {
            $("#codelistPlaceholder > .updated").remove();
        }
        else if(data.value == ""){
            $("#codelistPlaceholder > .updated").remove();
        }
    }

    function getCodelists(type){
        $(".updated").remove();
        $.ajax({
            type: "GET",
            url: "/admin/codelists",
            data: {type:type, func:"getCollections"},
            success: function (data) {
                var newselect = $("#codelistPlaceholder");
                $(".overlay-loader").hide();
                newselect.html(data);
            }
        });
    }

    function getCollections(data){
        $("#instancePlaceholder > .updated").remove();
        $(".overlay-loader").show();
        $.ajax({
            type: "GET",
            url: "/admin/collections",
            data: {codelist : data.value},
            success: function (data) {
                var newselect = $("#instancePlaceholder");
                $(".overlay-loader").hide();
                newselect.html(data);
            }
        });
    }

    function getLocalCollections(){
        $("#instancePlaceholder > .updated").remove();
        $(".overlay-loader").show();
        $.ajax({
            type: "GET",
            url: "/admin/localcollections",
            success: function (data) {
                var newselect = $("#instancePlaceholder");
                $(".overlay-loader").hide();
                newselect.html(data);
            }
        });
    }

    function getContinents(){
        $("#continentPlaceholder > .updated").remove();
        $(".overlay-loader").show();
        $.ajax({
            type: "GET",
            url: "/admin/geonames/continents",
            success: function (data) {
                var newselect = $("#continentPlaceholder");
                $(".overlay-loader").hide();
                newselect.html(data);
            }
        });
    }

    function getCountries(){
        $("#countryPlaceholder > .updated").remove();
        $(".overlay-loader").show();
        $.ajax({
            type: "GET",
            url: "/admin/geonames/countries",
            success: function (data) {
                var newselect = $("#countryPlaceholder");
                $(".overlay-loader").hide();
                newselect.html(data);
            }
        });
    }

    function getAdm1(country){
        $("#adm1Placeholder > .updated").remove();
        $(".overlay-loader").show();
        $.ajax({
            type: "GET",
            url: "/admin/geonames/adm1",
            data: {country:country.value},
            success: function (data) {
                var newselect = $("#adm1Placeholder");
                $(".overlay-loader").hide();
                newselect.html(data);
            }
        });
    }

    function getAdm2(country){
        $("#adm2Placeholder > .updated").remove();
        $(".overlay-loader").show();
        $.ajax({
            type: "GET",
            url: "/admin/geonames/adm2",
            data: {adm1:adm1.value},
            success: function (data) {
                var newselect = $("#adm2Placeholder");
                $(".overlay-loader").hide();
                newselect.html(data);
            }
        });
    }

    function getAdm3(country){
        $("#adm3Placeholder > .updated").remove();
        $(".overlay-loader").show();
        $.ajax({
            type: "GET",
            url: "/admin/geonames/adm3",
            data: {adm2:adm2.value},
            success: function (data) {
                var newselect = $("#adm3Placeholder");
                $(".overlay-loader").hide();
                newselect.html(data);
            }
        });
    }

    function getAdm4(country){
        $("#adm4Placeholder > .updated").remove();
        $(".overlay-loader").show();
        $.ajax({
            type: "GET",
            url: "/admin/geonames/adm4",
            data: {adm3:adm3.value},
            success: function (data) {
                var newselect = $("#adm4Placeholder");
                $(".overlay-loader").hide();
                newselect.html(data);
            }
        });
    }

    function getConcepts(data){
        $("#conceptPlaceholder > .updated").remove();
        $(".overlay-loader").show();
        $.ajax({
            type: "GET",
            url: "/admin/codelist",
            data: {codelist: data.value},
            success: function (data) {
                var newselect = $("#conceptPlaceholder");
                $(".overlay-loader").hide();
                newselect.html(data);

            },
            complete: function(data){
                $("select#included").treeMultiselect(
                    {
                        searchable: true,
                        sortable: false,
                        startCollapsed: true,
                        allowBatchSelection: false
                    });
                $("select#excluded").treeMultiselect(
                    {
                        searchable: true,
                        sortable: false,
                        startCollapsed: true,
                        allowBatchSelection: false
                    });
            }
        });
    }
</script>
