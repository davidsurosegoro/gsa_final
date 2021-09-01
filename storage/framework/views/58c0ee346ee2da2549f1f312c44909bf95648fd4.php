
<?php $__env->startSection('content'); ?>
<div class="card card-custom gutter-b example example-compact">
<div class="card-header">
    <h3 class="card-title">FORM BUAT DATA INVOICE </h3>
</div>
  
<div class="card-body">
    <div class="row">
        <?php $__currentLoopData = $awb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-3">
            <div class="card col-12 bg-light" style="padding:0px;">
                <div class="card-body"  style="padding:10px;">
                    <span class="badge badge-warning"> <?php echo e($item->total); ?> AWB belum ditagihkan</span><br><br>
                    <h1  >
                        <?php echo e($item->kodecustomer); ?>

                    </h1>
                    <h5  >
                        <?php echo e($item->namacustomer); ?>

                    </h5><br>
                    <a href="<?php echo e(url('master/invoice/edit/'.$item->idcustomer)); ?>" class="btn btn-primary">Buat Invoice</a>
                </div>
            </div>           
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>     
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript"> </script>
<?php if(Session::get('message') == "kodesudahada"): ?>
<script type="text/javascript">
    toastr.error("Kode manifest sudah ada!");
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/pages/master/invoice/grouping.blade.php ENDPATH**/ ?>