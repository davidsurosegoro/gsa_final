<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>TRACKING | GLOBAL SERVICE ASIA</title>
        <link rel="stylesheet" href="<?php echo e(asset('assets/gsa/fa/css/font-awesome.min.css')); ?>">
        <link href="<?php echo e(asset('assets/gsa/css/boots.css')); ?>" rel="stylesheet" />
        <!--begin::Global Theme Styles(used by all pages)-->
        <link href="<?php echo e(asset('assets/plugins/global/plugins.bundle.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/plugins/custom/prismjs/prismjs.bundle.css')); ?>" rel="stylesheet" type="text/css" /> 
        <link href="<?php echo e(asset('assets/css/style.bundle.css')); ?>" rel="stylesheet" type="text/css" />
        <style>
            .track_tbl td.track_dot {
                width: 50px;
                position: relative;
                padding: 0;
                text-align: center;
            }
            .track_tbl td.track_dot:after {
                content: "\f111";
                font-family: FontAwesome;
                position: absolute;
                margin-left: -5px;
                top: 11px;
            }
            .track_tbl td.track_dot span.track_line {
                background: #000;
                width: 3px;
                min-height: 50px;
                position: absolute;
                height: 101%;
            }
            .track_tbl tbody tr:first-child td.track_dot span.track_line {
                top: 22px;
                min-height: 25px;
            }
            .track_tbl tbody tr:last-child td.track_dot span.track_line {
                top: 0;
                min-height: 25px;
                height: 10%;
            }
        </style>
    </head>
    <body>         
        <div class="p-4 container">  
            <h3 class="col-12">GSA Order Tracking</h3>
                <div class="row"  style="background-color:rgb(198, 222, 255); padding:10px;padding-top:30px;padding-bottom:30px;border-radius:10px;box-shadow: -1px 1px 5px 0px rgba(0,0,0,0.37);
            -webkit-box-shadow: -1px 1px 5px 0px rgba(0,0,0,0.37);
            -moz-box-shadow: -1px 1px 5px 0px rgba(0,0,0,0.37);">   
                     <div class="col-sm-6 col-12 text-center" >
                        <div class="input-group text-center"> 
                            <input type="text" onkeydown="search(this)" id="kodeawb" name="kode"  onpaste="return false" pattern="[A-Za-z]" class="form-control" placeholder="MASUKAN KODE AWB/RESI">
                            <span class="input-group-btn">
                                <button onclick="openlink()" class="btn btn-success" type="button">Cari!</button>
                            </span>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 --> 
                </div><!-- /.col-lg-6 --> <br> 
            <div class="row">   
                <?php if(!empty($historyscanawb) && count($historyscanawb)>0): ?>
                    <div class="col-12 col-sm-8">                        
                        <table class="table table-responsive table-bordered track_tbl col-12  " style="background-color: white;">
                            <thead>
                                <tr>
                                    <th></th> 
                                    <th width="15%">Status</th>
                                    <th width="45%">Keterangan</th>
                                    <th width="25%">Date/Time</th>
                                    <th>Pengecek</th>
                                </tr>
                            </thead>                    
                                <?php $__currentLoopData = $historyscanawb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="active">
                                        <td class="track_dot">
                                            <span class="track_line"></span>
                                        </td> 
                                        <td class="text-center"> 
                                            <?php if($item->tipe == 'booked'): ?>
                                                <div type="button" class="btn btn-primary" style="background-color: rgb(144, 74, 191);border:1px solid rgb(144, 74, 191);">
                                                    <i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp;Booked
                                                </div> 
                                            <?php elseif($item->tipe == 'at-manifest'): ?>
                                                <div type="button" class="btn btn-warning">
                                                    <i class="fa fa-university" aria-hidden="true"></i>&nbsp;At-manifest
                                                </div> 
                                                <?php elseif($item->tipe == 'loaded'): ?>
                                                <div type="button" class="btn btn-primary">
                                                    <i class="fa fa-truck" aria-hidden="true"></i>&nbsp;Loaded
                                                </div> 
                                            <?php elseif($item->tipe == 'at-agen'): ?>
                                                <div type="button" class="btn btn-info">
                                                        <i class="fa fa-users" aria-hidden="true"></i>&nbsp;at-agen
                                                </div> 
                                            <?php elseif($item->tipe == 'delivery-by-courier'): ?>
                                                    <div type="button" class="btn btn-info">
                                                        <i class="fa fa-motorcycle" aria-hidden="true"></i>&nbsp;Delivery-by-courier
                                                    </div> 
                                            <?php elseif($item->tipe == 'complete'): ?>
                                                <div type="button" class="btn btn-success">
                                                    <i class="fa fa-check" aria-hidden="true"></i>&nbsp;Complete
                                                </div> 
                                            <?php endif; ?>
                                        </td>
                                        <td> 

                                            <?php if($item->tipe == 'booked'): ?>
                                                Order AWB dengan kode <b><?php echo e($item->kodeawb); ?> </b>telah dibuat oleh <b><?php echo e($item->namapembuat); ?></b>
                                            <?php elseif($item->tipe == 'at-manifest'): ?>
                                                Barang telah diterima di gudang pusat
                                            <?php elseif($item->tipe == 'loaded'): ?>
                                                Barang sedang dalam perjalanan menuju kota <b><?php echo e($item->namakotatujuan); ?></b> 
                                                <?php $__currentLoopData = $Detailqtyscanned; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($item->tipe == $detail->status): ?>
                                                    <br><span style="font-style: italic;">&nbsp;&nbsp;**koli ke-<?php echo e($detail->qty_ke); ?> = checked </span>
                                                        
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php elseif($item->tipe == 'at-agen'): ?>
                                                Barang telah diterima digudang kota <b><?php echo e($item->namakotatujuan); ?></b>  
                                            <?php elseif($item->tipe == 'delivery-by-courier'): ?>
                                                Barang sedang dibawa oleh delivery courier ke tujuan
                                                <?php $__currentLoopData = $Detailqtyscanned; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($item->tipe == $detail->status): ?>
                                                    <br><span style="font-style: italic;">&nbsp;&nbsp;**koli ke-<?php echo e($detail->qty_ke); ?> = checked </span>
                                                        
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php elseif($item->tipe == 'complete'): ?>
                                                Barang telah diterima Oleh <b><?php echo e($item->diterima_oleh); ?></b>
                                                <?php $__currentLoopData = $Detailqtyscanned; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($item->tipe == $detail->status): ?>
                                                    <br><span style="font-style: italic;">&nbsp;&nbsp;**koli ke-<?php echo e($detail->qty_ke); ?> = checked </span>
                                                        
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo e($item->created_at->format('j-F-Y')); ?><br>
                                            <b><?php echo e($item->created_at->format('(H:i)')); ?></b>
                                        </td>
                                        <td><?php echo e($item->namauser); ?></td>
                                    </tr> 
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table> 
                    </div>
                    <div class= "col-12 col-sm-4" style="background-color: white; padding:10px;margin-bottom:10px ;border:1px solid rgb(220, 220, 220) !Important;">
                        <table  class=" col-12 table-bordered"  style="font-size:0.4cm; border-right:0px !important;">
                            <tr>
                                <td class="text-center couture" style="font-size:0.55cm;" colspan='2'><b>No. </b><?php echo e($awb[0]->noawb); ?>

                                    <br><?php echo e($awb[0]->status_tracking); ?>

                                </td> 
                            </tr> 
                            <tr> 
                                <td class="text-center "><?php echo e(date('d F Y',strtotime($awb[0]->tanggal_awb))); ?></td>
                            </tr> 
                        </table>
                        <table  class="couture col-12 table-bordered font-weight-bold"  style="font-size:0.35cm; margin-top:0.1cm;border-right:0px !important;">
                            <tr>
                                
                            </tr>
                            <tr class="text-center">
                                <?php if(($awb[0]->qty_kecil == 0 && $awb[0]->qty_sedang == 0 && $awb[0]->qty_besar == 0 && $awb[0]->qty_besarbanget==0) && $awb[0]->qty>0): ?>
                                    
                                    <th width='16.6%'  >qty</th> 
                                <?php else: ?>

                                    <th width='16.6%'>K</th> 
                                    <th width='16.6%'>S</th> 
                                    <th width='16.6%'>B</th> 
                                    <th width='16.6%'>BB</th> 
                                    <th width='16.6%'>Kg</th> 
                                    <th width='16.6%'>Doc</th> 
                                <?php endif; ?>
                            </tr> 
                            <tr class="text-center">
                                <?php if(($awb[0]->qty_kecil == 0 && $awb[0]->qty_sedang == 0 && $awb[0]->qty_besar == 0 && $awb[0]->qty_besarbanget==0) && $awb[0]->qty>0): ?>
                                    <td><?php echo e($awb[0]->qty); ?></td> 
                                <?php else: ?>
                                    <td><?php echo e($awb[0]->qty_kecil); ?></td> 
                                    <td><?php echo e($awb[0]->qty_sedang); ?></td> 
                                    <td><?php echo e($awb[0]->qty_besar); ?></td> 
                                    <td><?php echo e($awb[0]->qty_besarbanget); ?></td> 
                                    <td><?php echo e($awb[0]->qty_kg); ?></td> 
                                    <td><?php echo e($awb[0]->qty_doc); ?></td> 
                                <?php endif; ?>
                            </tr> 
                        </table>
                        <table class=" table-bordered" style="font-size:0.3cm; width:100%;margin-bottom:0.1cm;margin-top:0.1cm;">
                            <tr>
                                <td style="width:25%; font-size:1.2cm;line-height:1.1cm;position:relative;" class="couture">
                                    <span class="font-weight-bold " style="position:absolute; top:-12px;right:5px;font-size:0.22cm;">KOTA ASAL</span>
                                    <?php echo e($awb[0]->kota_asal_kode); ?><br>
                                </td> 
                                <td style="width:25%; font-size:1.2cm;line-height:1.1cm;position:relative;" class="couture">
                                    <span class="font-weight-bold " style="position:absolute; top:-12px;right:5px;font-size:0.22cm;">KOTA TUJUAN</span>
                                    <?php echo e($awb[0]->kota_tujuan_kode); ?><br>
                                </td>  
                            </tr>
                        </table>
                        <table class="table-striped table-bordered" style="font-size:0.25cm; width:100%;">
                            <thead>
                                <tr>
                                    <th style="width:50%;">SHIPPER</th>  
                                    <th style="width:50%;">CONSIGNEE</th>  
                                </tr>
                                <tr style="height: 3cm; font-size:0.25cm;">
                                    <td style="width:50%;padding:0.1cm;">
                                        <span class="font-weight-bold" style="font-size:0.25cm;">NAMA PENGIRIM:</span><br>
                                            <span style="font-size:0.4cm;"><?php echo e($awb[0]->nama_pengirim); ?><br></span>
                                        <span class="font-weight-bold" style="font-size:0.25cm;">ALAMAT:</span><br>
                                            <span style="font-size:0.4cm;"><?php echo e($awb[0]->alamat_pengirim); ?><br></span>
                                        <span class="font-weight-bold" style="font-size:0.25cm;">KODEPOS:</span><br>
                                            <span style="font-size:0.4cm;"><?php echo e($awb[0]->kodepos_pengirim); ?><br></span>
                                        <span class="font-weight-bold" style="font-size:0.25cm;">NO HP:</span><br>
                                            <span style="font-size:0.4cm;"><?php echo e($awb[0]->notelp_pengirim); ?> </span>
                                            
                                        
                                    </td>   
                                    <td style="width:50%;padding:0.1cm;">
                                        <span class="font-weight-bold" style="font-size:0.25cm;">NAMA PENERIMA:</span><br>
                                            <span style="font-size:0.4cm;"><?php echo e($awb[0]->nama_penerima); ?><br></span>
                                        <span class="font-weight-bold" style="font-size:0.25cm;">ALAMAT:</span><br>
                                            <span style="font-size:0.4cm;"><?php echo e($awb[0]->alamat_tujuan); ?><br></span>
                                        <span class="font-weight-bold" style="font-size:0.25cm;">KODEPOS:</span><br>
                                            <span style="font-size:0.4cm;"><?php echo e($awb[0]->kodepos_penerima); ?><br></span>
                                        <span class="font-weight-bold" style="font-size:0.25cm;">NO HP:</span><br>
                                            <span style="font-size:0.4cm;"><?php echo e($awb[0]->notelp_penerima); ?> </span>
                                    </td>    
                                </tr>
                            </thead> 
                        </table> 
                        <?php if($awb[0]->keterangan != ''): ?>
                        <table class="table-striped table-bordered col-12" style='margin-top:0.1cm;'>
                            <thead>
                                <tr> 
                                    <td class='text-left' style="font-size:0.3cm;">
                                        <span style="font-weight:bold;">Keterangan</span><br>
                                        <?php echo e($awb[0]->keterangan); ?>

                                    </td>
                                </tr>
                            </thead>
                        </table>     
                        <?php endif; ?>
                        
                    </div>
                    
                <?php endif; ?>
            </div>
        </div>
    </body>
    
    <script src="<?php echo e(asset('assets/plugins/global/plugins.bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/custom/prismjs/prismjs.bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/forms/submit/jquery.form.js')); ?>"></script> 
    <script src="<?php echo e(asset('assets/js/pages/features/miscellaneous/sweetalert2.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/pages/features/miscellaneous/toastr.js')); ?>"></script> 
    <script src="<?php echo e(asset('assets/gsa/js/jquery-key-restrictions.js')); ?>"></script> 
         
    <script type="text/javascript"> 
        $(function(){
            $("#kodeawb").alphaNumericOnly();
        });

        toastr.options = {
              "closeButton": true,
              "debug": false,
              "newestOnTop": false,
              "progressBar": true,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "3000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }; 
        <?php if($statusada != ''): ?> 
            toastr.error("<?php echo e($statusada); ?>");
        <?php endif; ?>
        function search(kode){ 
            if(event.key === 'Enter') { 
                openlink()       
            }
        } 
        function openlink(){
            console.log($('#kodeawb').val().length)
            if($('#kodeawb').val().length>=8 && $('#kodeawb').val().length<=11){
                window.open( "<?php echo e(url('t/', '')); ?>"+"/"+$('#kodeawb').val()+"/t/1","_self");   
            }else{
                toastr.error("Kode AWB tidak valid!");
            }
        }
    </script>  
</html>  <?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/pages/tracking/tracking.blade.php ENDPATH**/ ?>