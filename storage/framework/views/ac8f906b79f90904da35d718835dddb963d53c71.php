<?php if(count($kota) > 0): ?>
<?php $__currentLoopData = $kota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($k['agen_id']); ?>"><?php echo e($k['agen_nama']); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
<option value="">Tidak Ada Agen di Kota Yang Anda Pilih</option>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/pages/awb/ajax/filter_kota_agen.blade.php ENDPATH**/ ?>