
<?php $__env->startSection('content'); ?>
<div class="row">
		<div class="col-sm-12 col-xs-12">
			<div class="alert alert-card alert-warning text-center" role="alert">Info! Mohon untuk mengisi nama peta tidak dengan tanda <b>'+','-','=','$','#','&','(',')'</b>, Terima kasih
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Form Buat Peta </h5>
					<div class="row">
												<div class="col-sm-12 col-xs-12">
													<div class="form-wrap">
														<form method="POST" action="<?php echo e(url('master/upload/custom')); ?>" class="form" enctype="multipart/form-data">
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
																	<select name="urusan" class="select2 form-control" id="urusan" style="background-color:white;" required>
																		<option value="">--Pilih Urusan-- </option>
																		<?php $__currentLoopData = $urusan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																			<option value="<?php echo e($u->kode_urusan); ?>"><?php echo e($u->narasi_urusan); ?> </option>
																		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
																	</select>
																</div>
															</div>
															<?php if(Auth::user()->id == 1): ?>
															<div class="form-group">
																<label class="control-label mb-10" for="exampleInputuname_1">Perangkat Daerah : </label>
																<div class="input-group">
																	<div class="input-group-addon"><i class="icon-briefcase"></i></div>
																	<select name="pd" class="select2 form-control" id="pd" data-live-search="true" style="background-color:white;" required>
																		<option value="">--Pilih PD-- </option>
																		<?php $__currentLoopData = $pd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																			<option value="<?php echo e($p->kode); ?>"><?php echo e($p->skpd_nama); ?> </option>
																		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
																	</select>
																</div>
															</div>
															<?php endif; ?>
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
															<div class="card-body exs">
											<h6 class="panel-title txt-dark"><i class="icon-map"> </i> Attribut Peta</h6> <br>
											<div class="alert alert-warning alert-dismissable alert-style-1">
												<i class="zmdi zmdi-alert-circle-o"></i>Info! Anda tidak perlu menambahkan attribut id,kecamatan dan kelurahan, karena secara default sudah terbuat otomatis.
											</div>
											<div id="frmattribut1" class="form-horizontal attributs">
															<div class="form-group">
																<label class="control-label col-md-2">Nama Attribut : </label>
																<div class="row">
																	<div class="col-md-6">
																		<input type="text" name="attribut[1][nama_attribut]" id="nama_attribut1" class="form-control" placeholder="masukkan nama attribut. . ." required>
																	</div>
																	<div class="col-md-2">

												                		<button type="button" class="btn btn-danger btn-sm delete_attributs" id="delete_attribut1"> <i class="fa fa-trash"></i> </button> 
																	</div>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-md-2">Tipe Attribut : </label>
																	<div class="col-md-6">
																		<select class="form-control" name="attribut[1][tipe_attribut]" id="tipe_attribut1" required>
																			<option value="character varying(254)">Character Varying </option>
																			<option value="double precision">Decimal </option>
																			<option value="bigint">Integer </option>
																			<option value="date">Tanggal </option>
																		</select>
																	</div>
															</div>
														</div>
															<div class="form-group">
																<button id="tambah-attribut" type="button" class="col-md-offset-6 btn btn-md btn-primary">
																	<i class="ti-plus"> </i>Tambah Attribut
																</button>
															</div>
														</div>
														<br>
															<!--
															<div class="form-group">
																<label class="control-label mb-10" for="exampleInputpwd_1">SRID  </label>
																<div class="input-group">
																	<div class="input-group-addon"><i class="icon-lock"></i></div>
																	<select class="form-control" name="srid">
						                                                <option value="900913">EPSG:900913 / WGS-84: Google Web Mercator (meter)</option>
								<option value="3857">EPSG:3857 / WGS-84: Web Mercator (meter)</option>
								<option value="23836">EPSG:23836 / DGN-95: TM3 Zone 49.2 (meter)</option>
								<option value="32749">EPSG:32749 / WGS-84: UTM Zone 49S (meter)</option>
								<option value="4326">EPSG:4326 / WGS-84 (derajat)</option>
																	</select>
																</div>
															</div>
														-->
															<button type="submit" class="btn btn-success mr-10">Simpan</button>
														</form>
													</div>
												</div>
											</div>
				</div>
			</div>
		</div>
	</div>
	<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>


<?php if(Session::get('message') == "error"): ?>
    <script type="text/javascript">
        toastr.error("Gagal Membuat Peta Karena nama peta sudah ada");
    </script>
<?php endif; ?>
<script type="text/javascript">
	if ($('.attributs').length <= 1) {
            $('.delete_attributs').hide();
            $('#delete_attribut1').hide();
      }
  	$('#tambah-attribut').click(function(){
        var numb = $('.attributs').length;

        var newNumb = numb + 1;
        var newElemb = $('#frmattribut' + numb).clone().attr('id', 'frmattribut' + newNumb);

        newElemb.find('#nama_attribut' + numb).attr('id', 'nama_attribut' + newNumb).attr('name', 'attribut[' + newNumb + '][nama_attribut]').val('');
        newElemb.find('#tipe_attribut' + numb).attr('id', 'tipe_attribut' + newNumb).attr('name', 'attribut[' + newNumb + '][tipe_attribut]').val('');

        newElemb.find('#delete_attribut' + numb).attr('id', 'delete_attribut' + newNumb).attr('onclick', 'removeAttribut("#frmattribut' + newNumb + '")').show();

        $('#frmattribut' + numb).after(newElemb);

      });

    function removeAttribut(val,id){
        $(val).remove();
        $('input[name="delete_attribut[' + id + ']"]').val(id);
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/master_peta/create_custom.blade.php ENDPATH**/ ?>