
<?php $__env->startSection('content'); ?>
<div class="card card-custom">
  <div class="card-header flex-wrap border-0 pt-6 pb-0">
    <div class="card-title">
      <h3 class="card-label">Data AWB
      <span class="d-block text-muted pt-2 font-size-sm">Data AWB</span></h3>
    </div>
    <div class="card-toolbar">
      <a href="<?php echo e(url('awb/create')); ?>" class="btn btn-primary font-weight-bolder">
      <i class="la la-plus"></i>Buat AWB Baru</a>
    </div>
  </div>
  <div class="card-body">
      <div class="table-responsive">
        <table id="datatables" class="table table-striped table-hover table-bordered">
          <thead>
            <tr>
              <th>No AWB</th>
              <th>Pengirim</th>
              <th>Kota Asal</th>
              <th>Kota Tujuan</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
        </table>
      </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
  
  $('#datatables').DataTable({
	    processing: true,
	    serverSide: false,
	    paging:true,
	    ajax: '<?php echo e(url('awb/datatables')); ?>',
	    columns: [
	    {data: 'noawb', name:'noawb'},
	    {data: 'nama_pengirim', name:'nama_pengirim'},
	    {data: 'kota_asal', name:'kota_asal'},
	    {data: 'kota_tujuan', name:'kota_tujuan'},
	    {data: 'tanggal_awb', name:'tanggal_awb'},
	    {data: 'status_tracking', name:'status_tracking'},
	    {data: 'aksi', name:'aksi'},
	],
	 "order": [[ 1, "asc" ]],
   });
</script>

<?php if(Session::get('message') == "created"): ?>
    <script type="text/javascript">
        toastr.success("AWB Baru Berhasil ditambahkan!");
    </script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gsa_final\resources\views/pages/awb/index.blade.php ENDPATH**/ ?>