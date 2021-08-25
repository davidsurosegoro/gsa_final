<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>AWB</title>
        <link href="<?php echo e(asset('assets/gsa/css/bootstrap.min.css')); ?>" rel="stylesheet" />
        <link href="" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo e(asset('assets/gsa/js/jquery.min.js')); ?>"></script>
        <style>
            @page  {
                size: A6;
                margin: 0;
            }
            @media  print {
                .no-print,
                .no-print * {
                    display: none !important;
                }
                html,
                body {
                    width: 98mm;
                    height: 150mm;
                }
                .page {
                    margin: 0px !important;
                    border: 0px !important;
                    border-radius: initial;
                    width: initial;
                    min-height: initial;
                    height: auto !important;
                    box-shadow: initial;
                    background: initial;
                    page-break-after: always;
                    width:100% !important;
                }
            } 
            body {
                background-color: #000;
            }

            .padding {
                padding: 2rem !important;
            }

            .card {
                margin-bottom: 30px;
                border: none; 
            }

            .card-header {
                background-color: #fff;
                border-bottom: 1px solid #e6e6f2;
            }

            h3 {
                font-size: 20px;
            }

            h5 {
                font-size: 15px;
                line-height: 26px;
                color: #3d405c;
                margin: 0px 0px 15px 0px;
                font-family: "Circular Std Medium";
            }

            .text-dark {
                color: #3d405c !important;
            }
            .page {
                width: 100mm;
                max-height: 150mm;
                height: 150mm;
                padding: 1mm;
                margin: 10mm auto;
                border: 1px #D3D3D3 solid;
                border-radius: 5px;
                background: white;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
                box-shadow: 8px 17px 38px -13px rgba(0,0,0,0.75);
                -webkit-box-shadow: 8px 17px 38px -13px rgba(0,0,0,0.75);
                -moz-box-shadow: 8px 17px 38px -13px rgba(0,0,0,0.75);
            }
        </style>
    </head>
    <body oncontextmenu="return false" class="snippet-body" style="background-color:white;">
            <div class="card page">
                <div class="card-header  " style="padding:0px !important; display: flex;">  
                    <div class="col-7 text-center" style=" padding:1px;">
                        <img src='<?php echo e(asset('assets/gsa/logo.jpg')); ?>' style="width:1.5cm;" class="col-">
                        <p class="col-12 font-weight-bold" style="font-size:0.2cm;padding:0px; margin:0px;">GLOBAL SERVICE ASIA</p>
                        <p class="col-12" style="font-size:0.2cm;padding:0px; margin:0px;">Komplek Ruko Pasar Wisata Bandara Juanda C 10 -11 (Pabean - Sedati Sidoarjo, Telp. 031-8680799 / Fax. 031-8680599)</p>                        
                        <table  class=" col-12 table-bordered"  style="font-size:0.27cm; border-right:0px !important;">
                            <tr>
                                <td style="font-size:0.5cm;" colspan='2'><b>No. </b>0000030123</td> 
                            </tr>
                            <tr>
                                <td style="width:2.4cm;"><b>PICKUP BY </b></td>
                                <td style="width:2.4cm;"><b>TANGGAL</b></td> 
                            </tr>
                            <tr>
                                <td>Anton Driver</td>
                                <td>30-SEPTEMBER-2021</td>
                            </tr> 
                        </table>
                    </div> 
                    
                    <div class="col-sm-5" style="padding:5px; padding-top:0.3cm;">
                        <?php echo QrCode::size(142)->generate('ItSolutionStuff.com');; ?> 
                    </div>
                </div>
                <div class="card " > 
                    <div class="table-responsive-sm row" style="position: relative; margin:0px;">
                        <div class=" text-right" style="padding:0px;position:absolute; bottom:0px; right:0px;font-size:0.7cm;">
                            6/10
                        </div>
                        <table  class=" col-12 table-bordered"  style="font-size:0.35cm; margin-top:0.1cm;border-right:0px !important;">
                            <tr>
                                
                            </tr>
                            <tr class="text-center">
                                <th width='16.6%'>K</th> 
                                <th width='16.6%'>S</th> 
                                <th width='16.6%'>B</th> 
                                <th width='16.6%'>BB</th> 
                                <th width='16.6%'>Kg</th> 
                                <th width='16.6%'>Doc</th> 
                            </tr> 
                            <tr class="text-center">
                                <td>2</td> 
                                <td>0</td> 
                                <td>4</td> 
                                <td>0</td> 
                                <td>0</td> 
                                <td>1</td> 
                            </tr> 
                        </table>
                        <table class=" table-bordered" style="font-size:0.3cm; width:100%;margin-bottom:0.1cm;margin-top:0.1cm;">
                            <tr>
                                <td style="width:25%; font-size:1cm;line-height:1cm;position:relative;">
                                    <span class="font-weight-bold" style="position:absolute; top:-12px;right:5px;font-size:0.22cm;">KOTA ASAL</span>
                                    SUB<br>
                                </td> 
                                <td style="width:25%; font-size:1cm;line-height:1cm;position:relative;">
                                    <span class="font-weight-bold" style="position:absolute; top:-12px;right:5px;font-size:0.22cm;">KOTA TUJUAN</span>
                                    MLG<br>
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
                                    <td style="width:50%;">
                                        <span class="font-weight-bold" style="font-size:0.22cm;">NAMA PENGIRIM:</span><br>
                                            <span style="font-size:0.35cm;">David surosegoro<br><span>
                                        <span class="font-weight-bold" style="font-size:0.22cm;">ALAMAT:</span><br>
                                            <span style="font-size:0.35cm;">Jl. gayungkebonsari manunggal c10<br><span>
                                        <span class="font-weight-bold" style="font-size:0.22cm;">KODEPOS:</span><br>
                                            <span style="font-size:0.35cm;">60226<br><span>
                                        <span class="font-weight-bold" style="font-size:0.22cm;">NO HP:</span><br>
                                            <span style="font-size:0.35cm;">08151651564 <span>
                                            
                                        
                                    </td>   
                                    <td style="width:50%;">
                                        <span class="font-weight-bold" style="font-size:0.22cm;">NAMA PENERIMA:</span><br>
                                            <span style="font-size:0.35cm;">Indra Prasetya<br><span>
                                        <span class="font-weight-bold" style="font-size:0.22cm;">ALAMAT:</span><br>
                                            <span style="font-size:0.35cm;">Jl. gayungkebonsari manunggal c10<br><span>
                                        <span class="font-weight-bold" style="font-size:0.22cm;">KODEPOS:</span><br>
                                            <span style="font-size:0.35cm;">60226<br><span>
                                        <span class="font-weight-bold" style="font-size:0.22cm;">NO HP:</span><br>
                                            <span style="font-size:0.35cm;">08151651564 <span>
                                    </td>    
                                </tr>
                            </thead> 
                        </table> 
                        <table class="table-striped table-bordered col-10" style='margin-top:0.1cm;'>
                            <thead>
                                <tr> 
                                    <td class='text-left' style="font-size:0.24cm;">
                                        <span style="font-weight:bold;">Keterangan</span><br>
                                        In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div> 
                </div> 
            </div>
        <script type="text/javascript" src="<?php echo e(asset('assets/gsa/js/bootstrap.bundle.min.js')); ?>"></script>
        <script type="text/javascript"></script>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/pages/printout/awb.blade.php ENDPATH**/ ?>