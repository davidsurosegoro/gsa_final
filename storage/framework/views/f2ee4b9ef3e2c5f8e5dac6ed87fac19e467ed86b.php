
<?php $__env->startSection('content'); ?>
<div class="card card-custom gutter-b example example-compact">
  <div class="card-header">
    <h3 class="card-title">FORM UBAH DATA KOTA </h3>
  </div>
<form class="form" method="POST" 
    <?php if($kota->id == 0): ?>
        action="<?php echo e(url('master/kota/save')); ?>"
    <?php else: ?>
        action="<?php echo e(url('master/kota/update')); ?>"
    <?php endif; ?>    
  >      
  <input type="hidden" name="id" value="<?php echo e($kota->id); ?>">
  <?php echo e(csrf_field()); ?>

  <div class="card-body">
    
    <div class="row">
        <div class="form-group col-lg-6">
            <label>Kode Kota:</label>
            <input type="text" required class="form-control" name="kode" value="<?php echo e((old('kode') && old('kode') !='') ?old('kode'): $kota->kode); ?>" />        
        </div> 
        <div class="form-group col-lg-6">
            <label>Nama Kota:</label>
            <input type="text" required class="form-control" name="nama" value="<?php echo e((old('nama') && old('nama') !='') ?old('nama'): $kota->nama); ?>" />        
        </div>
        <div class="form-group col-lg-6">
            <label>Keterangan:</label>
            <textarea   class="form-control" name="keterangan" value="<?php echo e($kota->keterangan); ?>" /><?php echo e((old('keterangan') && old('keterangan') !='') ?old('keterangan'): $kota->keterangan); ?></textarea>
        </div> 
       
    </div>
  <div class="card-footer">
   <div class="row">
    <div class="col-lg-6">
     <button type="submit" id='simpanbutton' class="btn btn-primary mr-2">SIMPAN</button>
     <?php if($kota->id == 0): ?><button type="reset" class="btn btn-secondary">Cancel</button><?php endif; ?>
    </div>
   </div>
  </div>
 </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    $(document).ready(function() {
         
    })
    
    
</script>

<?php if(Session::get('message') == "kodesudahada"): ?>
    <script type="text/javascript">
        toastr.error("Kode kota sudah ada!");
    </script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/pages/master/kota/edit.blade.php ENDPATH**/ ?>