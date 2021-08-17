<form class="d-flex flex-column" method="POST" action="#" id="frm-analisa-buffer">
                                <div class="form-group">
                                    <label class="control-label col-md-4">
                                        Radius :
                                    </label>
                                    <div class="input-group col-md-8">
                                        <input type="number" class="form-control" name="radius_buffer" id="radius_buffer" required>
                                        <div class="input-group-addon">
                                            (meter)
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-4">
                                        Warna :
                                    </label>

                                    <div id="colorpicker-buffer" class="col-md-8 input-group" data-color="rgb(241, 138, 49)">
                                        <input type="text" class="form-control input-lg" id="background-buffer" name="background-buffer" required>
                                          <span class="input-group-append">
                                            <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                          </span>
                                    </div>
                            </div>
                            <div class="col-md-offset-2">
                                <button class="btn btn-md btn-primary" type="submit" id="btn-buffer"><i class="zmdi zmdi-check-all"></i> TERAPKAN </button>
                                <button class="btn btn-md btn-outline-danger" type="button" id="clear-buffer"><i class="zmdi zmdi-refresh"> </i> CLEAR BUFFER </button>
                            </div>
                        </form><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/analisa/modal_setting/buffer.blade.php ENDPATH**/ ?>