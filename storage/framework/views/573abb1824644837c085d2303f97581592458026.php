<div class="row">
  <div class="col-md-6">
    <table class="table table-bordered table-hover table-striped">
      <tr>
        <th>Nomor AWB</th>
        <td><?php echo e($awb->noawb); ?></td>
      </tr> 
      <tr>
        <th>Tanggal AWB</th>
        <td><?php echo e(date('d F Y',strtotime($awb->tanggal_awb) )); ?></td>
      </tr>
    </table>
  </div>
  <div class="col-md-6">
    <table class="table table-bordered table-hover table-striped">
    <tr>
        <th colspan="6" class="text-center">Qty </th>
    </tr>
    <?php if($awb->is_agen == 1): ?>
    <tr>
      <th class="text-center"><u><?php echo e($awb->qty); ?> </u></th>
    </tr>
    <?php else: ?>
    <tr>
      <th>Kecil</th>
      <th>Sedang</th>
      <th>Besar</th>
      <th>BB</th>
      <th>Kg</th>
      <th>Doc</th>
    </tr>
    <tr>
      <th><?php echo e($awb->qty_kecil); ?></th>
      <th><?php echo e($awb->qty_sedang); ?></th>
      <th><?php echo e($awb->qty_besar); ?></th>
      <th><?php echo e($awb->qty_besarbanget); ?></th>
      <th><?php echo e($awb->qty_kg); ?></th>
      <th><?php echo e($awb->qty_doc); ?></th>
    </tr>
    <?php endif; ?>
  </table>
</div>
  
</div>
<div class="row">
  <div class="col-md-6">
    <table class="table table-bordered table-hover table-striped">
      <tr>
        <th>Nama Pengirim</th>
        <td><?php echo e($awb->nama_pengirim); ?></td>
      </tr> 
      <tr>
        <th>Alamat Pengirim</th>
        <td><?php echo e($awb->alamat_pengirim); ?></td>
      </tr>
      <tr>
        <th>No Telp Pengirim</th>
        <td><?php echo e($awb->notelp_pengirim); ?></td>
      </tr>
      <tr>
        <th>Kodepos Pengirim</th>
        <td><?php echo e($awb->kodepos_pengirim); ?></td>
      </tr>
    </table>
  </div>
  <div class="col-md-6">
      <table class="table table-bordered table-hover table-striped">
        <tr>
          <th>Nama Penerima</th>
          <td><?php echo e($awb->nama_penerima); ?></td>
        </tr> 
        <tr>
          <th>Alamat Penerima</th>
          <td><?php echo e($awb->alamat_tujuan); ?></td>
        </tr>
        <tr>
          <th>No Telp Penerima</th>
          <td><?php echo e($awb->notelp_penerima); ?></td>
        </tr>
        <tr>
          <th>Kodepos Penerima</th>
          <td><?php echo e($awb->kodepos_penerima); ?></td>
        </tr>
      </table>
  </div>
</div>

  
<div class="row">
  <div class="col-md-12">
    <table class="table table-bordered table-striped table-hover">
      <tr>
        <th>Kota Asal</th>
        <td><?php echo e($kota_asal->nama); ?> (<?php echo e($kota_asal->kode); ?>)</td>
      </tr>
      
      <tr>
        <th>Kota Tujuan</th>
        <td><?php echo e($kota_tujuan->nama); ?> (<?php echo e($kota_tujuan->kode); ?>)</td>
      </tr>
    </table>
  </div>
</div><?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/pages/awb/ajax/show.blade.php ENDPATH**/ ?>