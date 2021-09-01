<?php if(count($kecamatan) == 0): ?>
<option value="">Data Kecamatan Belum Tersedia</option>
<?php else: ?>
<?php $__currentLoopData = $kecamatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($k->id); ?>"><?php echo e($k->nama); ?> </option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/pages/awb/ajax/filter_kecamatan.blade.php ENDPATH**/ ?>