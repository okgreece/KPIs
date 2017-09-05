<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="form-group updated">
    <label for="dimension" class="col-md-4 control-label">Dimension</label>
    <div class='col-md-6'>
    @if(isset($dimensions) && (sizeOf($dimensions) != 0 ))
    <select name="dimension" id="dimension" class="form-control">
        <option value="">Please Select a Dimension...</option>
        @foreach ($dimensions as $dimension)
            <option value="{{$dimension->dimension}}">{{$dimension->label}}</option>
        @endforeach
    </select>
    @else
        <p>No dimensions found</p>
    @endif
    </div>
</div>