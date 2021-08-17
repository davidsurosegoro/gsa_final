
<?php $__env->startSection('content'); ?>
<ul class="sticky-toolbar nav flex-column pl-2 pr-2 pt-3 pb-3 mt-4">
			<!--begin::Item-->
			<li class="nav-item mb-2" id="kt_demo_panel_toggle" data-toggle="tooltip" title="" data-placement="right" data-original-title="Menu Layer, Kategorisasi & Overlay">
				<a class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" href="#" id="kt_quick_panel_toggle">
					<i class="flaticon-layers"></i>
				</a>
			</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="nav-item mb-2" data-toggle="tooltip" title="" data-placement="left" data-original-title="Mode Mengukur">
				<a class="btn btn-sm btn-icon-warning btn-bg-light btn-icon-warning btn-hover-warning" href="javascript:void(0)" data-toggle="modal" data-target="#modal-mengukur">
					<i class="flaticon2-gear"></i>
				</a>
			</li>
			<!--end::Item-->
		</ul>
<div id="kt_quick_panel" class="offcanvas offcanvas-left pt-5 pb-10">
			<!--begin::Header-->
			<div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5" kt-hidden-height="44" style="">
				<ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary flex-grow-1 px-10" role="tablist">
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#overlay_layer_tab">Overlay</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#layer_default_tab">Layer Default</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#kategorisasi_tab">Kategorisasi</a>
					</li>
				</ul>
				<div class="offcanvas-close mt-n1 pr-5">
					<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_panel_close">
						<i class="ki ki-close icon-xs text-muted"></i>
					</a>
				</div>
			</div>
			<!--end::Header-->
			<!--begin::Content-->
			<div class="offcanvas-content px-10">
				<div class="tab-content">
					<!--begin::Tabpane-->
					<div class="tab-pane fade pt-3 pr-5 mr-n5 scroll" id="overlay_layer_tab" role="tabpanel" style="height: 347px; overflow: hidden;">
						<form class="form-horizontal" id="frm-add-layer">
                             <div class="form-group">
                                 <label class="control-label col-md-12">
                                        Pilih Layer :
                                  </label>
                                    <div class="col-md-12">
										<select class="form-control select2" id="layers">
											 <option value="" required>------Pilih Layer------</option>
                                                <?php if(Auth::user()->user_level == 7 || Auth::user()->user_level == 1): ?>
                                                   <?php $__currentLoopData = $map; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($u->table_name); ?>"><?php echo e($u->nama_peta); ?> </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $merged_map; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($u->table_name); ?>"><?php echo e($u->nama_peta); ?> </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
										</select>
									</div>
								</div>
                                 <button class="btn btn-success btn-sm" type="submit">
                                    <i class="fa fa-plus"> </i> TAMBAH OVERLAY
                                </button>
						</form>
						<div class="row mt-2">
							<div class="col-md-12 col-sm-12" id="list-layer">
							</div>
						</div>
					</div>
					<div class="tab-pane show pt-2 pr-5 mr-n5 scroll active" id="layer_default_tab" role="tabpanel" style="height: 347px; overflow: hidden;">

						<div class="d-flex align-items-center mb-2" >
						    <div class="d-flex flex-column font-weight-bold">
						        <span class="text-dark mb-1 font-size-lg"><img class="mr-5" src="<?php echo e(asset('assets/img/default/lapangan_default.png')); ?>" style="width:18px;" />

						        	<a href="javascript:void(0)" class="text-hover-primary">
						        		<i class="fa fa-eye" onClick="toggleClass($(this), 'fa-eye fa-eye-slash');toggleHideLayer($(this),'lapangan_olahraga')"> </i>
						        	</a>
							        <a href="javascript:void(0)" class="text-hover-primary mr-2"  data-toggle="modal" data-target=".modal-setting" onclick="openDialog('lapangan_olahraga')">
										<i class="flaticon2-settings"> </i>
									</a>
						         Lapangan Olahraga
								</span>
						    </div>
						</div>

						<div class="d-flex align-items-center mb-2" >
						    <div class="d-flex flex-column font-weight-bold">
						        <span class="text-dark mb-1 font-size-lg"><img class="mr-5" src="<?php echo e(asset('assets/img/default/swalayan_default.png')); ?>" style="width:18px;" />

						        	<a href="javascript:void(0)" class="text-hover-primary">
						        		<i class="fa fa-eye" onClick="toggleClass($(this), 'fa-eye fa-eye-slash');toggleHideLayer($(this),'toko_swalayan')"> </i>
						        	</a>
							        <a href="javascript:void(0)" class="text-hover-primary mr-2"  data-toggle="modal" data-target=".modal-setting" onclick="openDialog('toko_swalayan')">
										<i class="flaticon2-settings"> </i>
									</a>
						         Toko Swalayan
								</span>
						    </div>
						</div>

						<div class="d-flex align-items-center mb-2" >
						    <div class="d-flex flex-column font-weight-bold">
						        <span class="text-dark mb-1 font-size-lg"><img class="mr-5" src="<?php echo e(asset('assets/img/default/sentra_default.png')); ?>" style="width:18px;" />

						        	<a href="javascript:void(0)" class="text-hover-primary">
						        		<i class="fa fa-eye" onClick="toggleClass($(this), 'fa-eye fa-eye-slash');toggleHideLayer($(this),'sentra_wisata_kuliner_2020')"> </i>
						        	</a>
							        <a href="javascript:void(0)" class="text-hover-primary mr-2"  data-toggle="modal" data-target=".modal-setting" onclick="openDialog('sentra_wisata_kuliner_2020')">
										<i class="flaticon2-settings"> </i>
									</a>
						         Sentra Wisata Kuliner
								</span>
						    </div>
						</div>

						<div class="d-flex align-items-center mb-2" >
						    <div class="d-flex flex-column font-weight-bold">
						        <span class="text-dark mb-1 font-size-lg"><img class="mr-5" src="<?php echo e(asset('assets/img/default/objek_wisata_default.png')); ?>" style="width:18px;" />

						        	<a href="javascript:void(0)" class="text-hover-primary">
						        		<i class="fa fa-eye" onClick="toggleClass($(this), 'fa-eye fa-eye-slash');toggleHideLayer($(this),'objek_wisata')"> </i>
						        	</a>
							        <a href="javascript:void(0)" class="text-hover-primary mr-2"  data-toggle="modal" data-target=".modal-setting" onclick="openDialog('objek_wisata')">
										<i class="flaticon2-settings"> </i>
									</a>
						         Objek Wisata 
								</span>
						    </div>
						</div>

						<div class="d-flex align-items-center mb-2" >
						    <div class="d-flex flex-column font-weight-bold">
						        <span class="text-dark mb-1 font-size-lg"><img class="mr-5" src="<?php echo e(asset('assets/img/default/terminal_default.png')); ?>" style="width:18px;" />

						        	<a href="javascript:void(0)" class="text-hover-primary">
						        		<i class="fa fa-eye" onClick="toggleClass($(this), 'fa-eye fa-eye-slash');toggleHideLayer($(this),'terminal')"> </i>
						        	</a>
							        <a href="javascript:void(0)" class="text-hover-primary mr-2"  data-toggle="modal" data-target=".modal-setting" onclick="openDialog('terminal')">
										<i class="flaticon2-settings"> </i>
									</a>
						         Terminal 
								</span>
						    </div>
						</div>

						<div class="d-flex align-items-center mb-2" >
						    <div class="d-flex flex-column font-weight-bold">
						        <span class="text-dark mb-1 font-size-lg"><img class="mr-5" src="<?php echo e(asset('assets/img/default/puskesmas_default.png')); ?>" style="width:18px;" />

						        	<a href="javascript:void(0)" class="text-hover-primary">
						        		<i class="fa fa-eye" onClick="toggleClass($(this), 'fa-eye fa-eye-slash');toggleHideLayer($(this),'puskesmas')"> </i>
						        	</a>
							        <a href="javascript:void(0)" class="text-hover-primary mr-2"  data-toggle="modal" data-target=".modal-setting" onclick="openDialog('puskesmas')">
										<i class="flaticon2-settings"> </i>
									</a>
						         Puskesmas 
								</span>
						    </div>
						</div>

						<div class="d-flex align-items-center mb-2" >
						    <div class="d-flex flex-column font-weight-bold">
						        <span class="text-dark mb-1 font-size-lg"><img class="mr-5" src="<?php echo e(asset('assets/img/default/rutilahu_default.png')); ?>" style="width:18px;" />

						        	<a href="javascript:void(0)" class="text-hover-primary">
						        		<i class="fa fa-eye" onClick="toggleClass($(this), 'fa-eye fa-eye-slash');toggleHideLayer($(this),'rutilahu')"> </i>
						        	</a>
							        <a href="javascript:void(0)" class="text-hover-primary mr-2"  data-toggle="modal" data-target=".modal-setting" onclick="openDialog('rutilahu')">
										<i class="flaticon2-settings"> </i>
									</a>
						         Rutilahu 
								</span>
						    </div>
						</div>
						<div class="d-flex align-items-center mb-2" >
						    <div class="d-flex flex-column font-weight-bold">
						        <span class="text-dark mb-1 font-size-lg"><img class="mr-5" src="<?php echo e(asset('assets/img/default/smp_default.png')); ?>" style="width:18px;" />

						        	<a href="javascript:void(0)" class="text-hover-primary">
						        		<i class="fa fa-eye" onClick="toggleClass($(this), 'fa-eye fa-eye-slash');toggleHideLayer($(this),'smp')"> </i>
						        	</a>
							        <a href="javascript:void(0)" class="text-hover-primary mr-2"  data-toggle="modal" data-target=".modal-setting" onclick="openDialog('smp')">
										<i class="flaticon2-settings"> </i>
									</a>
						         SMP 
								</span>
						    </div>
						</div>
						<div class="d-flex align-items-center mb-2" >
						    <div class="d-flex flex-column font-weight-bold">
						        <span class="text-dark mb-1 font-size-lg"><img class="mr-5" src="<?php echo e(asset('assets/img/default/sd_default.png')); ?>" style="width:18px;" />

						        	<a href="javascript:void(0)" class="text-hover-primary">
						        		<i class="fa fa-eye" onClick="toggleClass($(this), 'fa-eye fa-eye-slash');toggleHideLayer($(this),'sd')"> </i>
						        	</a>
							        <a href="javascript:void(0)" class="text-hover-primary mr-2"  data-toggle="modal" data-target=".modal-setting" onclick="openDialog('sd')">
										<i class="flaticon2-settings"> </i>
									</a>
						         SD 
								</span>
						    </div>
						</div>
				</div>
					<!--end::Tabpane-->
					<!--begin::Tabpane-->
					<div class="tab-pane fade pt-3 pr-5 mr-n5 scroll ps" id="kategorisasi_tab" role="tabpanel" style="height: 700px; overflow: hidden;">
						<div class="alert alert-warning alert-dismissable alert-style-1">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <i class="i-Information"></i> Layer yang anda pilih akan berubah warna sesuai dengan masing- masing kategori yang dimiliki masing- masing data didalam peta
                                        </div>
                    <form class="d-flex flex-column" id="frm-categorized">
                    <div class="form-group">
                        <label class="control-label col-md-4"> Layer : </label>
                        <div class="col-md-12">
                            <select class="form-control" id="cbo-categorized" required=""><option value="lapangan_olahraga"> lapangan_olahraga </option><option value="toko_swalayan"> toko_swalayan </option><option value="sentra_wisata_kuliner_2020"> sentra_wisata_kuliner_2020 </option><option value="objek_wisata"> objek_wisata </option><option value="terminal"> terminal </option><option value="puskesmas"> puskesmas </option><option value="rutilahu"> rutilahu </option><option value="smp"> smp </option><option value="sd"> sd </option></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4"> Kolom : </label>
                        <div class="col-md-12">
                            <select class="form-control" id="cbo-kolom" required="">
                                <option value="">--Pilih Kolom--</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4"> Attribut Label : </label>
                        <div class="col-md-12">
                            <select class="form-control" id="cbo-attr-categorized">
                                <option value="">--Tidak Ditampilkan--</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                    	<label class="checkbox">
							<input id="chk-luasan-categorized" type="checkbox" name="chk-luasan-categorized" value="yes"><span></span>
							<span></span>Tampilkan luasan per kategori
						</label>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit"> <i class="fa fa-check-circle-o"> </i> SIMPAN </button>
                    </div>
                    </form>
				</div>
					<!--end::Tabpane-->
				</div>
			</div>
			<!--end::Content-->
		</div>
<div id="map" style="height:100vh;">
</div>

<div id="popup" class="ol-popup" style="padding:0px; ">
		<div class="row" style="background-color: #5491B8; height: 22.5px;"></div>

   <a href="#" id="popup-closer" class="ol-popup-closer" style="color: white;"></a>
    <?php if(Auth::user()->user_level == 5 || Auth::user()->user_level == 7 ): ?>
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

<?php echo $__env->make('pages.analisa.modal_setting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('pages.analisa.modal_mengukur', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">

    $('#cp-background-poly').colorpicker({});
    $('#cp-background-point').colorpicker({});
    $('#cp-background-line').colorpicker({});
    $('#cp-border-poly').colorpicker({});
    $('#font-color').colorpicker({});
    $('#colorpicker-buffer').colorpicker({});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.analisa.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/analisa/index.blade.php ENDPATH**/ ?>