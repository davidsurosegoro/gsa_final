
<input type="hidden" id="map_type">
<input type="hidden" id="map_name">
<input type="hidden" id="map_title">
<form id="frm-styling-point" enctype="multipart/form-data" >
    <input type="hidden" name="map_type" value="point">
    <div class="form-group">
        <label class="control-label col-md-2">Background color : </label>
        <div class="col-md-4 input-group" id="cp-background-point">
            <input type="text" value="#bf7c98" class="form-control" name="color_start" id="background-point" >
            <span class="input-group-text colorpicker-input-addon"><i></i></span>
        </div>
    </div>
   
    <div class="form-group">
        <label class="control-label col-md-2">Point Shape : </label>
        <div class="col-md-4">
            <select class="form-control" name="point_shape" id="point-shape"> 
                <option value="circle" selected>Circle </option>
                <option value="square">Square </option>
                <option value="triangle">Triangle </option>
                <option value="star">Star </option>
                <option value="cross">Cross </option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2"> Point Size : </label>
        <div class="col-md-4">
            <input class="form-control" name="size_start" type="number" id="point-size" value="12">
        </div>
    </div>
</form>
<form  id="frm-styling-polygon"  >
    <div class="form-group">
        <label>Background color : </label>
        <div id="cp-background-poly" class="col-md-4 input-group">
            <input type="text" value="#bf7c98" class="form-control" name="background" id="background-polygon" >
            <span class="input-group-text colorpicker-input-addon"><i></i></span>
        </div>
    </div>
    <div class="form-group">
        <label>Transparansi : </label>
        <div class="col-md-4 input-group">
            <input type="number" step=".1" max="1" min="0.1" value="0.5" class="form-control" id="opacity-polygon">
        </div>
            <span class="form-text text-muted">Transparansi 0.1 - 1</span>
    </div>
    <div class="form-group">
        <label>Lebar Garis Tepi : </label>
        <div class="col-md-4 input-group">
            <input type="number" class="form-control" max="5" value="1" id="border-width-polygon">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2">Warna Garis Tepi : </label>
        <div id="cp-border-poly" class="col-md-6 input-group" >
            <input type="text" value="#474242" name="garis_tepi" class="form-control"  id="border-color-polygon" > 
              <span class="input-group-append">
                <span class="input-group-text colorpicker-input-addon"><i></i></span>
              </span>
        </div>
    </div>
</form>


<form class="form-horizontal" id="frm-styling-line"  >
    <div class="form-group">
        <label class="control-label col-md-2">Background color : </label>
        <div  id="cp-background-line" class="col-md-4 input-group">
            <input type="text" value="#bf7c98" class="form-control" id="background-line" >
            <span class="input-group-append">
                <span class="input-group-text colorpicker-input-addon"><i></i></span>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2">Lebar Garis Tepi : </label>
        <div class="col-md-4 input-group">
            <input type="number" value="1" max="5" class="form-control" id="border-width-line">
        </div>
    </div>
</form>
<div class="d-flex flex-column card-body exs mb-5">
    <div class="form-group">
        <label class="checkbox">
            <input id="chk-label-attr" type="checkbox">
                <span></span>
               Tampilkan Attribut Label
        </label>
    </div>
    <div class="form-group">
        <label class="control-label col-md-4">Attribut : </label>
        <div class="col-md-6">
            <select class="form-control" id="attribut-value" readonly="true">
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-4">Color : </label>
        <div id="font-color" class="col-md-6 input-group" >
            <input type="text" class="form-control" id="attribut-color-label"   readonly="true" value="#fe3c3c">
            <span class="input-group-append">
                <span class="input-group-text colorpicker-input-addon"><i></i></span>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-4">Font Size : </label>
        <div class="col-md-6">
            <input type="number" class="form-control" value="12" id="attribut-font-size" readonly="true">
        </div>
    </div>
</div>


<div class="col-md-offset-2">
    <button class="btn btn-md btn-outline-primary" id="btn-change-style" type="submit">
        <i class="zmdi zmdi-brush"></i> Ubah Style Peta
    </button>
</div><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/analisa/modal_setting/styling.blade.php ENDPATH**/ ?>