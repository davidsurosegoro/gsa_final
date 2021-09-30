
<?php $__env->startSection('content'); ?>
<div class="card card-custom gutter-b example example-compact">
<div class="card-header">
    <h3 class="card-title">FORM MANIFEST </h3>
</div>
<form class="form" method="POST"  action="<?php echo e(url('master/manifest/save')); ?>" >   
<?php ($total_kg      = 0); ?>   
<?php ($total_koli    = 0); ?>   
<?php ($total_doc     = 0); ?>   
<?php $__currentLoopData = $awb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
    <?php ($total_kg     += $item['qty_kg']); ?>
    <?php ($total_doc    += $item['qty_doc']); ?>
    <?php if($item->qty > 0 && $item->qty_kg == 0 && $item->qty_doc == 0): ?>
        <?php ($total_koli += $item->qty); ?>
    <?php else: ?>
        <?php ($total_koli +=$item->qtykoli); ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<input type="hidden" name="id" value="<?php echo e($manifest->id); ?>">
<div class="d-none ">
    tujuan:         <input type='text' name='id_kota_tujuan'        value='<?php echo e($kotatujuan[0]['id']); ?>'>
    asal:           <input type='text' name='id_kota_asal'          value='<?php echo e($kotaasal[0]['id']); ?>'> 
    agentujuan:     <input type='text' name='agen_tujuan'           value='<?php echo e($agentujuan[0]['id']); ?>'>
    dibuat:         <input type='text' name='dibuat_oleh'           value='<?php echo e(Auth::user()->id); ?>'> 
    kg:             <input type='text' name='jumlah_kg'             value='<?php echo e($total_kg); ?>'> 
    koli:           <input type='text' name='jumlah_koli'           value='<?php echo e($total_koli); ?>'> 
    doc:            <input type='text' name='jumlah_doc'            value='<?php echo e($total_doc); ?>'>  
</div>
<?php echo e(csrf_field()); ?>

<div class="card-body">
    <div class="row"> 
        <div class="form-group col-lg-3">
            <label>Kota asal:</label>
            <h3><?php echo e($kotaasal[0]['nama']); ?></h3>
        </div> 
        <div class="form-group col-lg-3">
            <label>Kota tujuan:</label>
            <h3><?php echo e($kotatujuan[0]['nama']); ?></h3>
        </div> 
        <div class="form-group col-lg-3">
            <label>dibuat oleh: </label>
            <h3><?php echo e(Auth::user()->username); ?></h3>
        </div> 
        <div class="form-group col-lg-3">
            <label>Tanggal:</label>
            <h3><?php echo e(Carbon\Carbon::now()->addHours(7)->toDateString()); ?></h3>
        </div> 
        
        <div class="form-group col-lg-3">
            <label>Dibawa oleh:</label>
            <input type="text" required class="form-control" name="supir" value="<?php echo e((old('supir') && old('supir') !='') ?old('supir'): $manifest->supir); ?>" />        
        </div>
        <div class="form-group col-lg-3">
            <label>Keterangan:</label>
            <textarea   class="form-control" name="keterangan" value="<?php echo e($manifest->keterangan); ?>" /><?php echo e((old('keterangan') && old('keterangan') !='') ?old('keterangan'): $manifest->keterangan); ?></textarea>
        </div>
        <div class="table-responsive-sm col-12">
            <table class="table table-striped table-bordered"  >
                <thead>
                    <tr>
                        <th  rowspan="2" class='text-center' style="width:10px;">NO</th> 
                        <th  rowspan="2" style="width:1cm;">AWB</th> 
                        <th  rowspan="2" style="width:150px;">PENGIRIM</th> 
                        <th  rowspan="2" style="width:1cm;">PENERIMA</th> 
                        <th  rowspan="2" style="width:1cm;">TUJUAN</th> 
                        <th  style="width:1cm;">KL</th> 
                        <th  style="width:1cm;">KG</th> 
                        <th  style="width:1cm;">doc</th>  
                        <th  rowspan="2" style="width:1cm;">KET</th> 
                    </tr>
                    <tr>
                        <td class="text-center"><?php echo e($total_koli); ?></td>
                        <td class="text-center"><?php echo e($total_kg); ?></td>
                        <td class="text-center"><?php echo e($total_doc); ?></td>
                    </tr> 
                </thead>
                <tbody>
                    <?php $__currentLoopData = $awb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="padding:0px;">
                        <td class='text-center' style="padding:5px;"><?php echo e($loop->index+1); ?></td>   
                        <td style="padding:5px;"><?php echo e($item->noawb); ?></td> 
                        <td style="padding:5px;" class='text-left'><?php echo e($item->namacust); ?></td> 
                        <td style="padding:5px;" class='text-left'><?php echo e($item->nama_penerima); ?></td> 
                        <td style="padding:5px;"><?php echo e($item->kotatujuan); ?></td> 
                        <td style="padding:5px;" class='text-center'>
                            <?php if(($item->qty_kecil == 0 && $item->qty_sedang == 0 && $item->qty_besar == 0 && $item->qty_besarbanget==0 && $item->qty_kg==0 && $item->qty_doc==0) && $item->qty>0): ?>
                                <?php echo e($item->qty); ?>

                            <?php else: ?>
                                <?php echo e($item->qtykoli); ?>   
                            <?php endif; ?>
                        </td> 
                        <td style="padding:5px;" class='text-center'><?php echo e($item->qty_kg); ?></td> 
                        <td style="padding:5px;" class='text-center'><?php echo e($item->qty_doc); ?></td>  
                        <td style="padding:5px;"><?php echo e($item->keterangan); ?></td> 
                    </tr>   
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                </tbody>
            </table>
             
        </div> 
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-lg-6">
                <button type="submit" id='simpanbutton' class="btn btn-primary mr-2">SIMPAN</button>
                <?php if($manifest->id == 0): ?><button type="reset" class="btn btn-secondary">Cancel</button><?php endif; ?>
            </div>
        </div>
    </div>
    </form>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/pages/master/manifest/edit.blade.php ENDPATH**/ ?>