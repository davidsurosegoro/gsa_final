<?php $__currentLoopData = $alamat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <option value="<?php echo e($a->alamat); ?>"><?php echo e($a->labelalamat); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<option value="manual">Input Alamat Manual </option><?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/pages/awb/ajax/cbo_alamat.blade.php ENDPATH**/ ?>