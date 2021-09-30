
<?php $__env->startSection('content'); ?>
<div class="card card-custom gutter-b example example-compact">
<div class="card-header">
    <h3 class="card-title">FORM INVOICE </h3>
</div>
<form class="form" method="POST"  action="<?php echo e(url('master/invoice/save')); ?>" >   
<?php
    $total_kg          = 0;
    $total_koli        = 0;
    $total_doc         = 0;
    $total_oa          = 0;
    $total_bayarall    = 0; 
?>
<?php $__currentLoopData = $awb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
    <?php ($total_kg     += $item['qty_kg']); ?>
    <?php ($total_doc    += $item['qty_doc']); ?>
    <?php if($item->qty > 0 && $item->qty_kg == 0 && $item->qty_doc == 0): ?>
        <?php ($total_koli += $item->qty); ?>
    <?php else: ?>
        <?php ($total_koli +=$item->qtykoli); ?>
    <?php endif; ?>
    <?php ($total_oa          += $item->idr_oa); ?>
    <?php if($customer->is_agen == 1): ?>
        <?php ($total_bayarall    += $item->total_harga * (((int)$item->id_kota_transit>0) ?   0.4 : 0.3 )    ); ?>
    <?php else: ?>
        <?php ($total_bayarall    += $item->total_harga); ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<input type="hidden" name="id" value="<?php echo e($invoice->id); ?>">
<div class="  d-none "> 
    dibuat:             <input type='text' name='mengetahui_oleh'       value='<?php echo e(Auth::user()->id); ?>'> 
    idcustomer:         <input type='text' name='id_customer'           value='<?php echo e($customer->id); ?>'> 
    kg:                 <input type='text' name='total_kg'              value='<?php echo e($total_kg); ?>'> 
    koli:               <input type='text' name='total_koli'            value='<?php echo e($total_koli); ?>'> 
    doc:                <input type='text' name='total_doc'             value='<?php echo e($total_doc); ?>'>  
    harga:              <input type='text' name='total_harga'           value='<?php echo e($total_bayarall); ?>'>  
    OA:                 <input type='text' name='total_oa'              value='<?php echo e($total_oa); ?>'>    
</div>
<?php echo e(csrf_field()); ?>

<div class="card-body">
    <div class="row"> 
        <div class="form-group col-lg-3">
            <label>Customer: </label>
            <h4><?php echo e($customer->nama); ?></h4>
        </div> 
        <div class="form-group col-lg-3">
            <label>Alamat: </label>
            <h4><?php echo e($customer->alamat); ?></h4>
        </div> 
        <div class="form-group col-lg-3">
            <label>No Telp: </label>
            <h4><?php echo e($customer->notelp); ?></h4>
        </div> 
        <div class="form-group col-lg-3">
            <label>Tanggal:</label>
            <h4><?php echo e(Carbon\Carbon::now()->addHours(7)->toDateString()); ?></h4>
        </div> 
        <div class="form-group col-lg-3">
            <label>Dikerjakan oleh: </label>
            <h4><?php echo e(Auth::user()->username); ?></h4>
        </div> 
        <div class="form-group col-lg-3">
            <label>Total:</label>
            <table class="table  table-bordered">
                <tr>
                    <th>koli</th>
                    <th>kg</th>
                    <th>doc</th>
                <tr>
                <tr>
                    <td><?php echo e($total_koli); ?></td>
                    <td><?php echo e($total_kg); ?></td>
                    <td><?php echo e($total_doc); ?></td>
                <tr>
            </table>
        </div>
        <div class="form-group col-lg-3">
            <label>Keterangan:</label>
            <textarea   class="form-control" name="keterangan" value="<?php echo e($invoice->keterangan); ?>" /><?php echo e((old('keterangan') && old('keterangan') !='') ?old('keterangan'): $invoice->keterangan); ?></textarea>
        </div>
        <div class="table-responsive-sm col-12">
            <table class="table table-striped table-bordered"  >
                <thead>
                    <tr>
                        <th class='text-center' style="width:10px;">NO</th> 
                        <th style="width:10%;">TANGGAL</th>  
                        <th style="width:7%;">AWB</th>  
                        <th style="width:10%;">No.Manifest</th>  
                        <th style="width:10%;">ASAL</th>  
                        
                        <?php if((int)$customer->is_agen == 1): ?>
                            <th style="width:10%;">Transit</th>  
                        <?php endif; ?>
                        <th style="width:10%;">Tujuan</th>  
                        <th style="width:10%;">Penerima</th> 
                        <th style="width:10%;">Koli</th>  
                        
                        <?php if((int)$customer->is_agen == 0): ?>
                            <th style="width:5%;">Kg</th>  
                            <th style="width:5%;">Doc</th>   
                            <th style="width:10%;">KET</th> 
                            <th style="width:8%;">Biaya OA</th>  
                            <th style="width:10%;">Total Bayar</th>  
                        <?php elseif((int)$customer->is_agen == 1): ?>
                            <th style="width:10%;">KET</th> 
                            <th style="width:8%;">Harga Agen</th>  
                            <th style="width:10%;">Biaya Handling</th>  
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $awb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="padding:0px; <?php if($item['total_harga'] <= 0): ?>background-color: #ffadad; <?php endif; ?>"  >
                        <td class='text-center' style="padding:5px;"><?php echo e($loop->index+1); ?></td>   
                        <td style="padding:5px;"><?php echo e($item->tanggal_awb); ?></td>  
                        <td style="padding:5px;"><?php echo e($item->noawb); ?></td>  
                        <td style="padding:5px;"><?php echo e($item->kodemanifest); ?></td>  
                        <td style="padding:5px;"><?php echo e($item->kotaasal); ?></td>   
                        
                        <?php if((int)$customer->is_agen == 1): ?>
                            <td style="width:10%;"><?php echo e($item->kotatransit); ?></td>  
                        <?php endif; ?>
                        <td style="padding:5px;"><?php echo e($item->kotatujuan); ?></td> 
                        <td style="padding:5px;"><?php echo e($item->diterima_oleh); ?></td> 
                        <td style="padding:5px;">
                            <?php if(($item->qty_kecil == 0 && $item->qty_sedang == 0 && $item->qty_besar == 0 && $item->qty_besarbanget==0 && $item->qty_kg==0 && $item->qty_doc==0) && $item->qty>0): ?>
                            <?php echo e($item->qty); ?>

                            <?php else: ?>
                            <table style="table" style="background-color:white;">
                                <tr style="background-color:white;">
                                    <td style="padding:5px; font-weight:bold;">K</td>
                                    <td style="padding:5px; font-weight:bold;">S</td>
                                    <td style="padding:5px; font-weight:bold;">B</td>
                                    <td style="padding:5px; font-weight:bold;">BB</td>
                                </tr>                                    
                                <tr style="background-color:white;">
                                    <td style="padding:5px;"><?php echo e($item->qty_kecil); ?></td>
                                    <td style="padding:5px;"><?php echo e($item->qty_sedang); ?></td>
                                    <td style="padding:5px;"><?php echo e($item->qty_besar); ?></td>
                                    <td style="padding:5px;"><?php echo e($item->qty_besarbanget); ?></td>
                                </tr>    
                            </table>    
                            <?php endif; ?>
                        </td> 
                        <?php if((int)$customer->is_agen == 0): ?>
                            <td style="padding:5px;"><?php echo e($item->qty_kg); ?></td> 
                            <td style="padding:5px;"><?php echo e($item->qty_doc); ?></td> 
                            <td style="padding:5px;"><?php echo e($item->keterangan); ?></td>                             
                            <td style="padding:5px;"><?php echo e(number_format($item->idr_oa)); ?></td> 
                            <td style="padding:5px;"><?php echo e(number_format($item->total_harga, 0)); ?></td> 
                            
                        <?php elseif((int)$customer->is_agen == 1): ?>
                            <td style="padding:5px;"><?php echo e($item->keterangan); ?></td>               
                            <td style="padding:5px;"><?php echo e(number_format($item->total_harga, 0)); ?></td> 
                            <th style="width:10%;">
                                <?php echo e(number_format(($item->total_harga * (((int)$item->id_kota_transit>0) ?   0.4 : 0.3 )), 0)); ?>

                            </th>  
                        <?php endif; ?>
                    </tr>   
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                    <tr style="padding:0px; background-color:#a1ffbc;"> 
                        <td style="padding:5px;" colspan='
                        
                        <?php if((int)$customer->is_agen == 1): ?>
                            8
                        <?php else: ?>
                            7
                        <?php endif; ?>
                        ' class="text-right"><h4>TOTAL <br>
                        
                            <span class="font-weight-bold text-uppercase font-italic">(<?php echo e(App\Invoice::terbilang($total_bayarall)); ?> Rupiah)</span></h4></td>   
                        <td style="padding:5px;font-weight:bold !important;"><h4><?php echo e($total_koli); ?></h4></td>   
                        <?php if((int)$customer->is_agen == 0): ?>
                            <td style="padding:5px;font-weight:bold !important;"><h4><?php echo e($total_kg); ?></h4></td>   
                            <td style="padding:5px;font-weight:bold !important;"><h4><?php echo e($total_doc); ?></h4></td>   
                            <td style="padding:5px;font-weight:bold !important;"><h4></h4></td> 
                            <td style="padding:5px;font-weight:bold !important;"><h4><?php echo e(number_format($total_oa, 0)); ?></h4></td> 
                            <td style="padding:5px;font-weight:bold !important;"><h4><?php echo e(number_format($total_bayarall, 0)); ?></h4></td>                             
                        <?php elseif((int)$customer->is_agen == 1): ?>
                            <td style="padding:5px;font-weight:bold !important;"><h4></h4></td> 
                            <th style="width:10%;"></th>  
                            <td style="padding:5px;font-weight:bold !important;"><h4><?php echo e(number_format($total_bayarall, 0)); ?></h4></td>                             
                        <?php endif; ?>
                    </tr>     
                </tbody>
            </table>
             
        </div> 
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-lg-6">
                <button type="submit" id='simpanbutton' class="btn btn-primary mr-2">SIMPAN</button>
                <?php if($invoice->id == 0): ?><button type="reset" class="btn btn-secondary">Cancel</button><?php endif; ?>
            </div>
        </div>
    </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript"> 
 
</script>
<?php if(Session::get('message') == "kodesudahada"): ?>
<script type="text/javascript">
    toastr.error("Kode manifest sudah ada!");
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/pages/master/invoice/edit.blade.php ENDPATH**/ ?>