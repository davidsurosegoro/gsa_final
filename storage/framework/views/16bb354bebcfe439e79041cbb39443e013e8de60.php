
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-4 col-xl-4 mb-5">
        <div class="card card-custom bg-diagonal bg-diagonal-primary bg-diagonal-r-info rounded">
            <div class="card-body text-center">
                <a href="javascript:void(0)" class="text-hover-dark">
                    <span class="svg-icon svg-icon-primary svg-icon-6x">
                        <i class="icon-6x flaticon2-print text-light">
                        </i>
                    </span>
                </a>
                <br>
                    <a class="text-light text-hover-dark font-weight-bold font-size-h4 mb-3" href="javascript:void(0)">
                        Cetak Surat Pernyataan
                    </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card card-custom">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table-bordered table-hovered" id="table-simbada">
						<thead>
							<tr>
								<th>PD</th>
								<th>Jenis Barang</th>
								<th>Register</th>
								<th>Luas</th>
								<th>Tahun</th>
								<th>Alamat</th>
								<th>Nomor Sertifikat</th>
								<th>Penggunaan</th>
								<th>Nilai Perolehan</th>
								<th>Aksi</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
	$('#table-simbada').DataTable({
		processing: true,
            serverSide: false,
            paging:true,
            ajax: '<?php echo e(url('simbada/datatables')); ?>',
             columns: [
            {data: 'pd', name:'pd'},
            {data: 'jenis_barang', name:'jenis_barang'},
            {data: 'register', name:'register'},
            {data: 'luas', name:'luas'},
            {data: 'tahun', name:'tahun'},
            {data: 'alamat', name:'alamat'},
            {data: 'no_sertifikat', name:'no_sertifikat'},
            {data: 'penggunaan', name:'penggunaan'},
            {data: 'nilai_perolehan', name:'nilai_perolehan'},
            {data: 'aksi', name:'aksi'}
        ],
	});

    function lihatPeta(id){
        window.open('<?php echo e(url('popup/simbada')); ?>/'+id, 'Preview Simbada', 'toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1024, height=700');
    }

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/simbada/index.blade.php ENDPATH**/ ?>