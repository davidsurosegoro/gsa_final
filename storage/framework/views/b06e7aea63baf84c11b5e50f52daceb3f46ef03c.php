<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>INVOICE</title>
        <link href="<?php echo e(asset('assets/gsa/css/bootstrap.min.css')); ?>" rel="stylesheet" />
        <link href="" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo e(asset('assets/gsa/js/jquery.min.js')); ?>"></script>
        <style>
            @page  {
                size: A4;
                margin: 0;
            }
            @media  print {
                .no-print,
                .no-print * {
                    display: none !important;
                }
                html,
                body {
                    width: 210mm;
                    height: 297mm;
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
                width: 210mm;
                min-height: 297mm;
                padding: 5mm;
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
                <div class="card-header row" style="padding:0px !important;"> 
                    <div class="col-2">
                        <img src='<?php echo e(asset('assets/gsa/logo.jpg')); ?>' style="width:2.5cm;">
                    </div>
                    <div class="col-9">
                        <table style="font-size:0.35cm;text-left;"> 
                            <tr>
                                <td><b>GLOBAL SERVICE ASIA ( GSA CARGO )</b></td>
                            </tr>
                            <tr>
                                <td>Komplek Ruko Pasar Wisata Bandara Juanda C 10 -11</td>
                            </tr>
                            <tr>
                                <td>Pabean - Sedati Sidoarjo, Telp. 031-8680799 / Fax. 031-8680599</td>
                            </tr>
                        </table>
                     </div>
                     <div class="col-12 text-right">
                        <b style="font-size:0.4cm;">REKAPITULASI TAGIHAN</b>

                     </div>
                </div>
                <div class="card">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                           <table  style="font-size:0.35cm;">
                               <tr>
                                   <td><b>Customer </b></td>
                                   <td>:&nbsp;David Suro</td>
                               </tr>
                               <tr>
                                   <td><b>Alamat </b></td>
                                   <td>:&nbsp;Jl gayung kebonsari manunggal C10</td>
                               </tr>
                               <tr>
                                   <td><b>Telp/fax </b></td>
                                   <td>:&nbsp;0813548643</td>
                               </tr>
                           </table>
                        </div>
                        <div class="col-sm-6">
                            <table  style="font-size:0.35cm;">
                                <tr>
                                    <td><b>No Invoice </b></td>
                                    <td>:&nbsp;18/INV/GSA/06/2021</td>
                                </tr>
                                <tr>
                                    <td><b>Date </b></td>
                                    <td>:&nbsp;19 August 2021</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-striped table-bordered" style="font-size:0.25cm;">
                            <thead>
                                <tr>
                                    <th style="width:1cm;">NO</th>
                                    <th style="width:4cm;">TANGGAL</th>
                                    <th style="width:1.8cm;">No. AWB</th>
                                    <th style="width:2.4cm;">No. MANIFEST</th>
                                    <th style="width:2.8cm;">TUJUAN</th>
                                    <th style="width:2.8cm;">JENIS <br>BARANG</th>
                                    <th style="width:1.2cm;">KOLI</th>
                                    <th style="width:2cm;">BERAT<br>(KG)</th>
                                    <th style="width:2.8cm;">HARGA<br>(Rp./KG)</th>
                                    <th style="width:2cm;">BIAYA OA</th>
                                    <th style="width:3cm;">TOTAL BAYAR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td> 
                                    <td>12-agustus-2020</td> 
                                    <td class='text-center'>AWB0003</td> 
                                    <td class='text-center'>3124</td> 
                                    <td>Malang</td> 
                                    <td>Kosmetik</td> 
                                    <td class='text-center'>3</td> 
                                    <td class='text-center'>B</td> 
                                    <td>40.000</td> 
                                    <td>0</td> 
                                    <td>120.000</td> 
                                </tr>  
                                <tr>
                                    <td>1</td> 
                                    <td>12-agustus-2020</td> 
                                    <td class='text-center'>AWB0003</td> 
                                    <td class='text-center'>3124</td> 
                                    <td>Malang</td> 
                                    <td>Kosmetik</td> 
                                    <td class='text-center'>3</td> 
                                    <td class='text-center'>B</td> 
                                    <td>40.000</td> 
                                    <td>0</td> 
                                    <td>120.000</td> 
                                </tr>  
                                <tr>
                                    <td>1</td> 
                                    <td>12-agustus-2020</td> 
                                    <td class='text-center'>AWB0003</td> 
                                    <td class='text-center'>3124</td> 
                                    <td>Malang</td> 
                                    <td>Kosmetik</td> 
                                    <td class='text-center'>3</td> 
                                    <td class='text-center'>B</td> 
                                    <td>40.000</td> 
                                    <td>0</td> 
                                    <td>120.000</td> 
                                </tr>   
                                <tr>
                                    <td colspan='6' class="text-right font-weight-bold" style="font-size:0.35cm;">TOTAL BAYAR</td> 
                                    <td>9</td> 
                                    <td></td> 
                                    <td></td> 
                                    <td>0</td> 
                                    <td>360.000</td> 
                                </tr> 
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered" >
                            <thead>
                                <tr> 
                                    <td class='text-center' style="font-size:0.35cm;">TERBILANG : <span style="font-weight:bold;">TIGA RATUS ENAM PULUH RIBU RUPIAH</span></td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="row font-weight-bold" style="font-size:0.35cm;">
                        <div class="col-6 text-center">
                            DIKERJAKAN OLEH    <br><br><br><br><br>
                            David Surosegoro<br>
                            Programmer
                        </div> 
                        <div class="col-6 text-center">
                            MENGETAHUI    <br><br><br><br><br>
                            INDRA PRASETYA<br>
                            Programmer
                        </div> 
                    </div>
                </div>
                <div class="card-footer bg-white" style="font-size:0.35cm;">
                    <p class="mb-0" ><mark style="background-color:#cff;">* Pembayaran dengan Transfer ke BCA CABANG JUANDA a/n Global Service Asia Rek. 667 0230099</mark></p>
                    <p class="mb-0" ><mark style="background-color:#cff;">* Pembayaran maksimal 3 hari sejak invoice diterima.</mark></p>
                    <p class="mb-0" ><mark style="background-color:#cff;">* Pembayaran melalui Cek atau Giro dianggap LUNAS apabila sudah DIUANGKAN.</mark></p>
                </div>
            </div>
        <script type="text/javascript" src="<?php echo e(asset('assets/gsa/js/bootstrap.bundle.min.js')); ?>"></script>
        <script type="text/javascript"></script>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/pages/printout/invoice.blade.php ENDPATH**/ ?>