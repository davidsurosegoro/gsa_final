

<?php $__env->startSection('content'); ?>
<div class="row">
<?php $__currentLoopData = $pd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-sm-4 mb-5">
<div class="card card card-custom ">
	<div class="card-body">
		<div class="d-flex align-items-center">
													<div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
														<div class="symbol-label" style="background-image:url('<?php echo e(asset('assets/img/government.png')); ?>')"></div>
														<i class="symbol-badge bg-success"></i>
													</div>
													<div>
														<a href="<?php echo e(url('peta-dinas/show/'.$p->skpd_kode)); ?>" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary"><?php echo e($p->skpd_nama); ?></a>
														<div class="mt-2">
															<a href="<?php echo e(url('peta-dinas/show/'.$p->skpd_kode)); ?>" class="btn btn-sm btn-primary font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">Total Peta <?php echo e($p->tot); ?> </a>
														</div>
													</div>
												</div>
	</div>
</div>
</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/peta_dinas/index.blade.php ENDPATH**/ ?>