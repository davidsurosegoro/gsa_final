
<?php $__env->startSection('content'); ?>
<div class="card card-custom gutter-b example example-compact">
<div class="card-header">
    
    <h3 class="col- card-title">
        FORM CREATE DATA MANIFEST 
        &nbsp;
        <span onclick="location.reload();" class="col- btn btn-default  text-center">
        <i class="fa fa-refresh text-center"></i></span>
       
    </h3>
    
</div>
  
<div class="card-body">
    <div class="row"> 
        <div class="col-12 alert alert-warning bg-warning" role="alert">
            -Pastikan qty detail di awb sudah terisi<br>
            -Pastikan agen di awb sudah terpilih <br>
            -AWB yang masuk di manifest, adalah awb dibawah jam <b><?php echo e(App\Applicationsetting::getJamMinim()); ?> : 00</b>, dan AWB-AWB di hari sebelum hari ini
        </div>
        <?php $__currentLoopData = $awb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-2" style="margin-top:10px;">
            <div class="card col-12 bg-light" style="padding:0px;">
                <div class="card-body"  style="padding:10px;">
                    <h5><?php echo e($item->total); ?> AWB</h5>
                    <h5>
                        <span class="badge badge-dark"><i class="fas fa-user-friends" style="color:white;"></i>&nbsp;(AGEN)<?php echo e($item->agentujuan); ?></span>
                    </h5>
                    <h2 class="card-title">
                        <?php echo e($item->kotaasal); ?> 
                            &nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i> &nbsp; 
                        <?php echo e($item->kotatujuan); ?> 
                    </h2>
                    <a href="<?php echo e(url('master/manifest/edit/'.$item->idkotaasal.'/'.$item->idkotatujuan.'/'.$item->idagentujuan)); ?>" class="btn btn-primary">Buat Manifest</a>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/pages/master/manifest/grouping.blade.php ENDPATH**/ ?>