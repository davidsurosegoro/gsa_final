
<?php $__env->startSection('content'); ?>
<div class="card card-custom gutter-b example example-compact">
  <div class="card-header">
    <h3 class="card-title">FORM TAMBAH DATA CUSTOMER </h3>
  </div>
<form class="form" method="POST" action="<?php echo e(url('master/customer/update')); ?>">
  <input type="hidden" value="<?php echo e($customer->id); ?>" name="id">
  <?php echo e(csrf_field()); ?>

  <div class="card-body">
   <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <label>Nama Customer:</label>
        <input type="text" class="form-control"  value="<?php echo e($customer->nama); ?>" name="nama" placeholder="Input nama customer. . . " required/>
      </div>
      
      <div class="form-group">
        <label>Kota:</label>
        <select type="text" class="form-control select2" name="idkota" >
          <?php $__currentLoopData = $kota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <?php if($k->id == $customer->idkota ): ?>
             <option value="<?php echo e($k->id); ?>" selected><?php echo e($k->nama); ?> </option>
             <?php else: ?>
             <option value="<?php echo e($k->id); ?>"><?php echo e($k->nama); ?> </option>
             <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
    <div class="form-group">
     <label>Alamat Customer:</label>
     <input type="text" class="form-control"  value="<?php echo e($customer->alamat); ?>" name="alamat" placeholder="Input alamat customer. . ." required/>
   </div>
   <div class="form-group">
     <label>Nomor Telepon Customer:</label>
      <input type="text" class="form-control"  value="<?php echo e($customer->notelp); ?>" name="notelp" placeholder="Input nomor telepon customer. . ." required/>
    </div>
    
    <div class="form-group">
      <label>Kode Customer:</label>
       <input type="text" class="form-control" value="<?php echo e($customer->kode); ?>" name="kode" placeholder="Input kode customer. . ." required/>
     </div>
     
     <div class="form-group">
      <label>Kode Pos Customer:</label>
      <input type="text" class="form-control" name="kodepos" value="<?php echo e($customer->kodepos); ?>" placeholder="Input kodepos customer. . ." />
    </div>

     <div class="form-group">
      <label>Rekening:</label>
       <input type="text" class="form-control"  value="<?php echo e($customer->rekening); ?>" name="rekening" placeholder="Input Nomor Rekening. . ."/>
     </div>

     <div class="form-group">
      <label>Bank :</label>
       <input type="text" class="form-control"  value="<?php echo e($customer->bank); ?>" name="bank" placeholder="Input bank. . ."/>
     </div>
     
     <div class="form-group">
      <label>Rekening Atas Nama (a/n):</label>
       <input type="text" name="rekeningatasnama"  value="<?php echo e($customer->rekeningatasnama); ?>" class="form-control" placeholder="Input Nomor Atas Nama Rekening. . ."/>
     </div>
   </div>
   <div class="col-lg-6">
     
    <div class="form-group">
      <label>Harga Koli Kecil:</label>
      <input type="text" class="form-control rupiah"  value="<?php echo e($customer->harga_koli_k); ?>" name="harga_koli_k" placeholder="Input harga koli kecil. . ." required/>
    </div>
    <div class="form-group">
      <label>Harga Koli Sedang:</label>
      <input type="text" class="form-control rupiah"  value="<?php echo e($customer->harga_koli_s); ?>" name="harga_koli_s" placeholder="Input harga koli sedang. . ." required/>
    </div>
    
    <div class="form-group">
      <label>Harga Koli Besar:</label>
      <input type="text" class="form-control rupiah"  value="<?php echo e($customer->harga_koli_b); ?>" name="harga_koli_b" placeholder="Input harga koli besar. . ." required/>
    </div>
    
    <div class="form-group">
      <label>Harga Koli Besar banget:</label>
      <input type="text" class="form-control rupiah"  value="<?php echo e($customer->harga_koli_bb); ?>" name="harga_koli_bb" placeholder="Input harga koli besar banget. . ." required/>
    </div>
    
    
    <div class="form-group">
      <label>Jenis Out Area</label>
      <div class="radio-inline">
        <label class="radio">
          <?php if( $customer->jenis_out_area == "shipment" ): ?>
          <input type="radio" name="jenis_out_area" value="shipment" checked="checked" required>
          <span></span>Per Shipment</label>
          <label class="radio">
          <input type="radio" name="jenis_out_area" value="resi" required>
          <span></span>Per Resi</label>
          <label class="radio">
          <input type="radio" name="jenis_out_area" value="koli" required>
          <span></span>Per Koli</label>
        <?php elseif( $customer->jenis_out_area == "resi" ): ?>
          <input type="radio" name="jenis_out_area" value="shipment" required>
          <span></span>Per Shipment</label>
          <label class="radio">
          <input type="radio" name="jenis_out_area" value="resi" checked="checked" required>
          <span></span>Per Resi</label>
          <label class="radio">
          <input type="radio" name="jenis_out_area" value="koli" required>
          <span></span>Per Koli</label>
        <?php else: ?>
          <input type="radio" name="jenis_out_area" value="shipment" required>
          <span></span>Per Shipment</label>
          <label class="radio">
          <input type="radio" name="jenis_out_area" value="resi" required>
          <span></span>Per Resi</label>
          <label class="radio">
          <input type="radio" name="jenis_out_area" value="koli" checked="checked" required>
          <span></span>Per Koli</label>
        <?php endif; ?>
      </div>
      <span class="form-text text-muted">Pilih Jenis Out Area</span>
    </div>

    <div class="form-group">
      <label>Harga Out Area:</label>
       <input type="text" class="form-control rupiah"  value="<?php echo e($customer->harga_oa); ?>" name="harga_oa" placeholder="Input Harga Out Area. . ." required/>
     </div>

    <div class="form-group">
      <label>Harga per Kg:</label>
       <input type="text" class="form-control rupiah"  value="<?php echo e($customer->harga_kg); ?>" name="harga_kg" placeholder="Input harga per Kg. . ." required/>
     </div>

    <div class="form-group">
      <label>Harga per Dokumen:</label>
       <input type="text" class="form-control rupiah"  value="<?php echo e($customer->harga_doc); ?>" name="harga_doc" placeholder="Input harga_doc. . ." required/>
     </div>
     
     <div class="form-group">
      <label>Hak Akses Mengubah Satuan</label>
      <div class="checkbox-inline">
        <label class="checkbox checkbox-lg">
          
          <?php if($customer->can_access_satuan): ?>
        <input name="access" type="checkbox" checked="checked">
        <?php else: ?>
        <input name="access" type="checkbox">
        <?php endif; ?>
        <span></span>Berikan hak akses</label>
      </div>
      <span class="form-text text-muted">Centang untuk memberikan hak akses untuk mengubah satuan</span>
    </div>
    
    <div class="form-group">
      <label>Customer ini adalah agen</label>
      <div class="checkbox-inline">
        <label class="checkbox checkbox-lg"> 
          <?php if($customer->is_agen): ?>
        <input name="is_agen" type="checkbox" checked="checked">
        <?php else: ?>
        <input name="is_agen" type="checkbox">
        <?php endif; ?>
        <span></span>Ya</label>
      </div>
      <span class="form-text text-muted">Centang untuk menandai customer ini sebagai agen</span>
    </div>

   </div>
  </div>
  <div class="card-footer">
   <div class="row">
    <div class="col-lg-6">
     <button type="submit" class="btn btn-primary mr-2">SIMPAN</button>
     <button type="reset" class="btn btn-secondary">Cancel</button>
    </div>
   </div>
  </div>
 </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/pages/master/customer/edit.blade.php ENDPATH**/ ?>