<div class="modal modal-sticky " id="modal-mengukur">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-diagonal bg-diagonal-primary bg-diagonal-r-light">
                <h5 class="modal-title text-white" style="z-index: 1;">
                    <i class="fas fa-ruler text-white"> </i> Mode Mengukur
                </h5>
                <button class="close" data-dismiss="modal" type="button">
                    <i aria-hidden="true" class="ki ki-close">
                    </i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-2">
                            Tipe :
                        </label>
                        <div class="col-md-6">
                            <select class="form-control" id="cbo-mengukur">
                                <option value="Polygon">
                                    Area/ Luasan (Polygon)
                                </option>
                                <option value="LineString">
                                    Panjang/ Jarak (LineString)
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary col-md-offset-3" data-dismiss="modal" id="on-mengukur" type="button">
                            <i class="flaticon2-contract"></i>
                            Aktifkan
                        </button>

                        <button class="btn btn-danger" id="off-mengukur" type="button">
                          <i class="flaticon2-close"></i> Non Aktifkan Mode Mengukur
                        </button>
                        <button class="btn btn-success" data-dismiss="modal" id="clear-mengukur" type="button">
                            <i class="flaticon2-refresh"></i>
                            Clear
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/analisa/modal_mengukur.blade.php ENDPATH**/ ?>