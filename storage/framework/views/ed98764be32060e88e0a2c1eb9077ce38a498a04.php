
<?php $__env->startSection('content'); ?>
<input type="hidden" id="map_name" value="<?php echo e($map_data->table_name); ?>">
<input type="hidden" id="table_name" value="<?php echo e($map_data->table_name); ?>">
<input type="hidden" id="srid" value="<?php echo e($map_data->srid); ?>">
<input type="hidden" id="cbo-menggambar" value="<?php echo e($map_data->table_name); ?>">
<input type="hidden" id="map_type" value="<?php echo e($map_data->type); ?>">
<div class="row mb-2" style="">
	<div class="col-md-12">
		<div class="card card-custom">
			<div class="d-flex flex-row justify-content-between mb-2">
				<div class="w-75 " >
					<button class="btn btn-danger" id="off-menggambars">
				        <i class="flaticon-cancel"> </i> Non-aktifkan Mode Menggambar      
				  	</button>
				  	<?php if($check_role == 1): ?>
				  	<button class="btn btn-outline-info" id="on-menggambars">
				        <i class="flaticon2-pen"> </i> Aktifkan Mode Menggambar
				  	 </button>
                    <button class="btn btn-outline-info" id="on-edit">
                        <i class="flaticon-edit"> </i> Aktifkan Mode Edit
                     </button>
				  	 <?php endif; ?>
				  	<button class="btn btn-outline-info" id="btn-view-all-map-data" data-toggle="modal" data-target="#modal-data">
				        <i class="fas fa-table"> </i> Buka Data Tabular
				  	 </button>
				</div>
				<div class="w-25" >
					<div class="form-group">
						<div class="input-icon search-brand">
							<input type="text" class="inputsearch form-control" placeholder="Search...">
							<span>
								<i class="flaticon2-search-1 icon-md"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div id="map" style="height:100vh;">
			</div>
		</div>
	</div>
</div>
<div id="popup" class="ol-popup" style="padding:0px; ">
		<div class="row" style="background-color: #5491B8; height: 22.5px;"></div>

   <a href="#" id="popup-closer" class="ol-popup-closer" style="color: white;"></a>
    
	<?php if($check_role == 1): ?>
    <div id="action_popup_button">
    <a href="#" id="popup-edit" class="ol-popup-edit" style="color:white;"> <i class="flaticon2-pen"  style="color:white;"> </i> </a>
    <a href="#" id="popup-delete" class="ol-popup-delete" style="color:white;"> <i class="flaticon2-trash"  style="color:white;"> </i> </a>
</div>
  <?php endif; ?>
   <table id="popup-content" style="padding:7.5px;">
   </table>
    <div id="popup-foto" style="padding-top:5px;">
<!--
        <img src="<?php echo e(asset('/img/surabaya.png')); ?>" class="img-thumbnail" width="75">
        <img src="<?php echo e(asset('/img/surabaya.png')); ?>" class="img-thumbnail" width="75">
        <img src="<?php echo e(asset('/img/surabaya.png')); ?>" class="img-thumbnail" width="75">
        <img src="<?php echo e(asset('/img/surabaya.png')); ?>" class="img-thumbnail" width="75">
-->
     </div>
</div>


 <div class="modal fade" id="modal-attr" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myLargeModalLabel">Tambah Attribut <span id="title-modal-add-attribut"> </span>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> </h5>
                                                    </div>
                                                    <div class="modal-body" id="form-modal-add-attribut">
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                <div class="modal fade" id="modal-edit-attribut" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h5 class="modal-title" id="myLargeModalLabel">Ubah Attribut Peta - <b id="title-modal-edit-attribut">A </b> </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row" id="form-modal-edit-attribut">
                                                        </div>
                                                       </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
    <div class="modal fade" id="modal-edit-attribut-edata" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h5 class="modal-title" id="myLargeModalLabel">Ubah Attribut Peta - <b id="title-modal-edit-attribut-edata">A </b> </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                      <center id="spinner-load-edit-edata">
                                                        <img src="<?php echo e(asset('img/spinner.gif')); ?>" >
                                                      </center>
                                                      <iframe id="edit_edata" height="600" width="100%" src="http://bappeko.surabaya.go.id/edata2018/api/data-master/view-data/wRAq2nu40a/178/2017/0600" name="iframe_modal"></iframe>
                                                    </div>
                                                    
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger text-left close-modal-attr-edata" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <div class="modal fade" id="modal-attr-edata" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close close-modal-attr-edata" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h5 class="modal-title" id="myLargeModalLabel">Tambah Attribut <span id="title-modal-add-attribut-edata"> </span> </h5>
                                                    </div>
                                                    <div class="modal-body" id="form-modal-add-attribut-edata">
                                                      <center id="spinner-load-edata">
                                                        <img src="<?php echo e(asset('img/spinner.gif')); ?>" >
                                                      </center>
                                                      <iframe id="insert_edata" height="600" width="100%" src="http://bappeko.surabaya.go.id/edata2018/api/data-master/view-data/wRAq2nu40a/178/2017/0600" name="iframe_modal"></iframe>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger text-left close-modal-attr-edata" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
<div class="modal fade" id="modal-data" >
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-diagonal bg-diagonal-primary bg-diagonal-r-light">
                <h5 class="modal-title text-white" style="z-index: 1;"> Data Peta <strong id="title-modal"></strong> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive" id="table-modal-all-attribut">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/js/map/show_layer.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/map/draw.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/map/help_tooltip.js')); ?>"></script>
<script type="text/javascript" src="//www.bing.com/api/maps/mapcontrol?key=AsOA1-Hwvc9YWsOAzbotwZUgT2niRNdkyo6KqELtZhHBLxrbEX70YLR3nXtpNrlA&amp;callback=loadMapScenario" async="" defer=""></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/peta_dinas/show_layer.blade.php ENDPATH**/ ?>