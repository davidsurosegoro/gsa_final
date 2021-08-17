
<?php $__env->startSection('content'); ?>
<div class="row">
		<div class="col-sm-12 col-xs-12">
			<div class="alert alert-card alert-warning text-center" role="alert">Info! Mohon untuk mengisi nama peta tidak dengan tanda <b>'+','-','=','$','#','&','(',')'</b>, Terima kasih
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Form Upload Peta </h5>
													<div class="form-wrap">
														<form method="POST" action="<?php echo e(url('master/upload')); ?>" class="form" enctype="multipart/form-data">
															<?php echo e(csrf_field()); ?>

															<div class="form-group">
																<label class="control-label mb-10" for="exampleInputuname_1">Nama Peta</label>
																<div class="input-group">
																	<div class="input-group-addon"><i class="icon-map"></i></div>
																	<input type="text" name="nama_peta" class="form-control" id="txt_nama_peta" placeholder="nama peta. . ." required>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label mb-10" for="exampleInputuname_1">Urusan</label>
																<div class="input-group">
																	<div class="input-group-addon"><i class="icon-briefcase"></i></div>
																	<select name="urusan" class="select2 form-control" id="urusan" data-live-search="true" style="background-color:white;" required>
																		<option value="">--Pilih Urusan-- </option>
																		<?php $__currentLoopData = $urusan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																			<option value="<?php echo e($u->kode_urusan); ?>"><?php echo e($u->narasi_urusan); ?> </option>
																		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
																	</select>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label mb-10" for="exampleInputEmail_1">Tahun</label>
																<div class="input-group">
																	<div class="input-group-addon"><i class="icon-calender"></i></div>
																	<input type="number" name="tahun" class="form-control" id="exampleInputEmail_1" placeholder="2017" required>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label mb-10" for="exampleInputpwd_1">Type </label>
																<div class="input-group">
																	<div class="input-group-addon"><i class="icon-layers"></i></div>
																	<select class="form-control" name="type">
						                                                <option value="Point">Point</option>
						                                                <option value="LineString">LineString</option>
						                                                <option value="Polygon">Polygon</option>
																	</select>
																</div>
															</div>
															
															<div class="form-group">
																<label class="control-label mb-10" for="exampleInputpwd_1">SRID  </label>
																<div class="input-group">
																	<div class="input-group-addon"><i class="icon-layers"></i></div>
																	<select class="select2 form-control" name="srid">
						                                                <option value="900913">EPSG:900913 / WGS-84: Google Web Mercator (meter)</option>
								<option value="3857">EPSG:3857 / WGS-84: Web Mercator (meter)</option>
								<option value="23836">EPSG:23836 / DGN-95: TM3 Zone 49.2 (meter)</option>
								<option value="32749">EPSG:32749 / WGS-84: UTM Zone 49S (meter)</option>
								<option value="4326">EPSG:4326 / WGS-84 (derajat)</option>
																	</select>
																</div>
															</div>
														
															<div class="form-group">
															 <label class="control-label mb-10" for="exampleInputpwd_1">Upload SHP </label>
															 <div class="input-group">
																	<div class="input-group-addon"><i class="fa fa-file-archive-o"></i></div>
																	<input type="file" class="form-control" name="shp" accept=".shp" required>
																</div>
															</div>

															<div class="form-group">
															 <label class="control-label mb-10" for="exampleInputpwd_1">Upload SHX </label>
															 <div class="input-group">
																	<div class="input-group-addon"><i class="fa fa-file-archive-o"></i></div>
																	<input type="file" class="form-control" name="shx" accept=".shx" required>
																</div>
															</div>

															<div class="form-group">
															 <label class="control-label mb-10" for="exampleInputpwd_1">Upload DBF </label>
															 <div class="input-group">
																	<div class="input-group-addon"><i class="fa fa-file-archive-o"></i></div>
																	<input type="file" class="form-control" name="dbf" accept=".dbf" required>
																</div>
															</div>

															<div class="form-group">
															 <label class="control-label mb-10" for="exampleInputpwd_1">Upload PRJ </label>
															 <div class="input-group">
																	<div class="input-group-addon"><i class="fa fa-file-archive-o"></i></div>
																	<input type="file" class="form-control" name="prj" accept=".prj" required >
																</div>
															</div>
															<button type="submit" class="btn btn-success mr-10">Simpan</button>
														</form>
													</div>
												</div>
											</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/master_peta/create.blade.php ENDPATH**/ ?>