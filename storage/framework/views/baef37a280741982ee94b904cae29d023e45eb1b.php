
<?php $__env->startSection('content'); ?>
<div class="card card-custom gutter-b example example-compact">
<div class="card-header">
    <h3 class="card-title">FORM UBAH DATA KOTA </h3>
</div>
<form class="form" method="POST" action="<?php echo e(url('master/alamat/save')); ?>" 
>      
<input type="hidden" name="id" value="<?php echo e($alamat->id); ?>">
<?php echo e(csrf_field()); ?>

<div class="card-body">
    <div class="row">
        <div class="form-group col-lg-6">
            <label>Label Alamat:</label>
            <input type="hidden"   class="form-control" id='oa' name="oa" value="<?php echo e((old('oa') && old('oa') !='') ?old('oa'): $alamat->oa); ?>" />        
            <input type="text" required class="form-control" name="labelalamat" value="<?php echo e((old('labelalamat') && old('labelalamat') !='') ?old('labelalamat'): $alamat->labelalamat); ?>" />        
        </div>
        <div class="form-group col-lg-6">
            <label>Alamat:</label>
            <input type="text" required class="form-control" name="alamat" value="<?php echo e((old('alamat') && old('alamat') !='') ?old('alamat'): $alamat->alamat); ?>" />        
        </div>  
        <div class="form-group col-lg-6">
            <label>kodepos:</label>
            <input type="text" required class="form-control" name="kodepos" value="<?php echo e((old('kodepos') && old('kodepos') !='') ?old('kodepos'): $alamat->kodepos); ?>" />        
        </div> 
        <div class="form-group col-lg-6">
            <label>Kota:</label>
            <select type="text" required class="form-control select2 required" id='kota' name="idkota" >
                <?php $__currentLoopData = $kota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($k->id == $alamat->idkota ): ?>
                        <option value="<?php echo e($k->id); ?>" selected><?php echo e($k->nama); ?> </option>
                    <?php else: ?>
                        <option value="<?php echo e($k->id); ?>"><?php echo e($k->nama); ?> </option>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
        </div> 
        <div class="form-group col-lg-6">
            <label>Kecamatan:</label>
            <select required class="form-control" id='kecamatan' name="kecamatan" >
                <option class=" " value="" selected>Pilih - Kecamatan </option>
                <?php $__currentLoopData = $kecamatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($k->nama == $alamat->kecamatan ): ?>
                        <option oa = "<?php echo e($k->oa); ?>" class="kotashow kota_<?php echo e($k->idkota); ?>" value="<?php echo e($k->nama); ?>" selected><?php echo e($k->nama); ?> </option>
                    <?php else: ?>
                        <option oa = "<?php echo e($k->oa); ?>" class="kotashow kota_<?php echo e($k->idkota); ?>" value="<?php echo e($k->nama); ?>"><?php echo e($k->nama); ?> </option>
                   <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
        </div> 
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-lg-6">
                <button type="submit" id='simpanbutton' class="btn btn-primary mr-2">SIMPAN</button>
                <?php if($alamat->id == 0): ?><button type="reset" class="btn btn-secondary">Cancel</button><?php endif; ?>
            </div>
        </div>
    </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript"> 
    // $('.kotashow').hide() 
    showkecamatan()
    $('#kota').change(function(){
        showkecamatan()       
        $('#kecamatan').val('');
        $('#oa').val(0)
    })
   function showkecamatan(){
        var id=$('#kota').val();
        $('.kotashow').hide();
        $('.kota_'+id).show();
   }
   $('#kecamatan').change(function(){
       $('#oa').val($('option:selected', this).attr('oa'))
   })
</script>
<?php if(Session::get('message') == "kodesudahada"): ?>
<script type="text/javascript">
    toastr.error("Kode kota sudah ada!");
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/pages/master/alamat/edit.blade.php ENDPATH**/ ?>