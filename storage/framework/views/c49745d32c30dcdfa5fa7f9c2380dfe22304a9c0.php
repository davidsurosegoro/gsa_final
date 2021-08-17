 <form class="form-horizontal" method="POST" id="frm-proses-query" action="<?php echo e(url('ajax/analisa/query')); ?>">
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="table_name" id="table_name" value="">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Attribut : </label>
                                    <div class="col-md-10">
                                        <select class="select2 form-control" name="attribut_query" id="attribut_query" style="width: 100%">
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Hitungan : </label>
                                    <div class="col-md-10">
                                    <select name="hitungan" class="select2 form-control" style="width: 100%" required>
                                        <option value="">
                                            --Pilih Metode Hitungan--
                                        </option> 
                                        <option value="count_all">COUNT (Hitung semua data) </option>
                                        <option value="sum">SUM </option>
                                        <option value="avg">AVERAGE </option>
                                        <option value="max">MAX </option>
                                        <option value="min">MIN </option>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Group By Kecamatan : </label>
                                    <div class="col-md-8">
                                    <select name="group_kecamatan" id="group_kecamatan" class="select2 form-control" data-live-search="true" style="width: 100%">
                                        <option value="null">
                                            --Pilih Kecamatan--
                                        </option> 
                                        <?php $__currentLoopData = $master_kecamatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($kec->gid); ?>"> <?php echo e($kec->layer_1); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    </div>
                                </div>
                                <div class="separator-block"></div>
                                <div class="col-md-offset-1">
                                        
                                    </div>
                                <div class="card-body exs mb-2">
                               
                            	<div class="form-group">
		                            <label class="checkbox">
            							<input id="chk-filter-tambahan" name="filter_query_is_aktif" type="checkbox">
            								<span></span>
		                                        <i class="fa fa-filter">
		                                        </i>
		                                   Aktifkan Filter Tambahan
        							</label>
		                        </div>
                                <hr class="light-grey-hr">
                                <div class="form-group">
                                  <label class="control-label col-md-2">Attribut :</label>
                                  <div class="col-md-8">
                                    <select class="select2 form-control attribut_filter" name="attribut_filter_query" data-live-search="true" id="attribut_filter" readonly="true" style="width: 100%"> </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-2">Operator :</label>
                                  <div class="col-md-8">
                                    <select class="select2 form-control" name="operator_filter_query" id="operator_filter_query" required="" tabindex="-98" readonly="true" style="width: 100%">
                                        <option value="">--Pilih Operator-- </option>
                                        <option value="<">Kurang Dari ( &lt; )</option>
                                        <option value=">">Lebih Dari ( &gt; )</option>
                                        <option value="=">Sama Dengan ( = )</option>
                                        <option value="!=">Tidak Sama Dengan ( != )</option>
                                        <option value="like">Mendekati String ( LIKE )</option>
                                        <option value="<=">Kurang Dari Sama Dengan ( &lt;= )</option>
                                        <option value=">=">Lebih Dari Sama Dengan ( &gt;= )</option>
                                        <option value="IS NOT NULL">Tidak Kosong ( is not null )</option>
                                        <option value="IS NULL">Kosong ( is null )</option>
                                    </select>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-2" >
                                        Value :
                                    </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" placeholder="nilai filter. . ." name="value_filter_query" id="value_filter_query" readonly="readonly">
                                  </div>
                                </div>
                              </div>
                                <div class="row">
                                    <div class="ml-5">
                                    <button class="btn btn-outline-primary" type="submit"> <i class="zmdi zmdi-assignment-check"></i> PROSES QUERY </button>
                                    </div>
                                </div>

                                  <div class="card-body">
                                    <p> * Catatan Query <strong> SUM,AVG,MIN & MAX </strong> hanya dapat digunakan untuk tipe data <strong> numeric/angka </strong> </p>
                                    <div class="row">
                                      <label class="control-label col-md-3" >
                                            Hasil Query
                                        </label>
                                      <div class="col-md-6">
                                        <button type="button" class="btn btn-outline-info" id="hasil_query">
                                            -
                                        </button>
                                      </div>
                                    </div>
                                  </div>
                            </form><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/analisa/modal_setting/query.blade.php ENDPATH**/ ?>