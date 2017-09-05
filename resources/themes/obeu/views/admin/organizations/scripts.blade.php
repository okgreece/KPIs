<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<script>
function dimensions(organization){        
        $(".overlay-loader").show();        
        $.ajax({
            type: "GET",
            url: "/admin/dimensions",
            data: {organization:organization.value},
            success: function (data) {
                var newselect = $("#dimensionPlaceholder");
                $(".overlay-loader").hide();
                newselect.html(data);
            }
        });
    }
    </script>