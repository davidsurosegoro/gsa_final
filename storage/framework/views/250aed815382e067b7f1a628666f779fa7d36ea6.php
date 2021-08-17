<form action="#" class="d-flex flex-column" id="frm-filter-peta" method="POST">
                            <div class="form-group">
                                <label class="control-label col-md-4">
                                    Attribut :
                                </label>
                                <div class="col-md-12">
                                    <select class="select2 form-control attribut_filter" data-live-search="true" id="attribut_filter_filter" name="attribut_filter" required="" style="width: 100%">
                                        <option value="">
                                            --Pilih Attribut--
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">
                                    Operator :
                                </label>
                                <div class="col-md-12">
                                    <select class="select2 form-control" id="operator_filter" name="operator_filter" required="" style="width: 100%">
                                        <option value="">
                                            --Pilih Operator--
                                        </option>
                                        <option value="<">
                                            Kurang Dari ( < )
                                        </option>
                                        <option value=">">
                                            Lebih Dari ( > )
                                        </option>
                                        <option value="=">
                                            Sama Dengan ( = )
                                        </option>
                                        <option value="!=">
                                            Tidak Sama Dengan ( != )
                                        </option>
                                        <option value="like">
                                            Mendekati String ( LIKE )
                                        </option>
                                        <option value="<=">
                                            Kurang Dari Sama Dengan ( <= )
                                        </option>
                                        <option value=">=">
                                            Lebih Dari Sama Dengan ( >= )
                                        </option>
                                        <option value="IS NOT NULL">
                                            Tidak Kosong ( is not null )
                                        </option>
                                        <option value="IS NULL">
                                            Kosong ( is null )
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">
                                    Value :
                                </label>
                                <div class="col-md-12">
                                    <input class="form-control" id="value_filter" name="value_filter" placeholder="nilai filter. . ." required="" type="text">
                                </div>
                            </div>
                            <div class="card-body exs mb-5">
                            	<div class="form-group">
		                            <label class="checkbox">
            							<input id="chk-filter-tambahan-query" name="filter_query_is_aktif" type="checkbox">
            								<span></span>
		                                        <i class="fa fa-filter">
		                                        </i>
		                                   Aktifkan Filter Tambahan
        							</label>
		                        </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">
                                    Penghubung :
                                </label>
                                <div class="col-md-12">
                                    <select class="select2 form-control" id="penghubung_filter" name="penghubung_filter" style="width: 100%">
                                        <option value="">
                                            --Pilih Penghubung--
                                        </option>
                                        <option value="OR">
                                            Atau (OR)
                                        </option>
                                        <option value="AND">
                                            Dan (AND)
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <select class="select2 form-control attribut_filter" data-live-search="true" id="attribut_filter_tambahan" name="attribut_filter_tambahan" readonly="true" style="width: 100%">
                                    <option value="">
                                        --Pilih Attribut--
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">
                                    Operator :
                                </label>
                                <div class="col-md-12">
                                    <select class="select2 form-control" id="operator_filter_tambahan" name="operator_filter_tambahan" style="width: 100%">
                                        <option value="">
                                            --Pilih Operator--
                                        </option>
                                        <option value="<">
                                            Kurang Dari ( < )
                                        </option>
                                        <option value=">">
                                            Lebih Dari ( > )
                                        </option>
                                        <option value="=">
                                            Sama Dengan ( = )
                                        </option>
                                        <option value="!=">
                                            Tidak Sama Dengan ( != )
                                        </option>
                                        <option value="like">
                                            Mendekati String ( LIKE )
                                        </option>
                                        <option value="<=">
                                            Kurang Dari Sama Dengan ( <= )
                                        </option>
                                        <option value=">=">
                                            Lebih Dari Sama Dengan ( >= )
                                        </option>
                                        <option value="IS NOT NULL">
                                            Tidak Kosong ( is not null )
                                        </option>
                                        <option value="IS NULL">
                                            Kosong ( is null )
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">
                                    Value :
                                </label>
                                <div class="col-md-12">
                                    <input class="form-control" id="value_filter_tambahan" name="value_filter_tambahan" placeholder="nilai filter. . ." readonly="true" type="text">
                                </div>
                            </div>
                            <div id="attr-data-filter">
                            </div>
                        	</div>

                            <div class="col-md-offset-2">
                                <button class="btn btn-md btn-primary" type="submit">
                                    FILTER PETA
                                </button>
                                <button class="btn btn-md btn-outline-danger" id="btn-reset-filter" type="button">
                                    <i class="flaticon2-refresh">
                                    </i>
                                    RESET
                                </button>
                            </div>
                        </form><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/analisa/modal_setting/filter.blade.php ENDPATH**/ ?>