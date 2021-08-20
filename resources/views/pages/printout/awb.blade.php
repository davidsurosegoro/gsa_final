<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>AWB</title>
        <link href="{{asset('assets/gsa/css/bootstrap.min.css')}}" rel="stylesheet" />
        <link href="" rel="stylesheet" />
        <script type="text/javascript" src="{{asset('assets/gsa/js/jquery.min.js')}}"></script>
        <style>
            @page {
                size: A6;
                margin: 0;
            }
            @media print {
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
                width: 100mm;
                max-height: 100mm;
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
                <div class="card-header  container" style="padding:0px !important; display: flex;">  
                    <div class="col-3 text-center" style="margin-bottom:0.5cm;padding:1px;">
                        <img src='{{asset('assets/gsa/logo.jpg')}}' style="width:1.3cm;" class="col-">
                        <p class="col-12 font-weight-bold" style="font-size:0.2cm;padding:0px; margin:0px;">GLOBAL SERVICE ASIA</p>
                        <p class="col-12" style="font-size:0.15cm;padding:0px; margin:0px;">Komplek Ruko Pasar Wisata Bandara Juanda C 10 -11 (Pabean - Sedati Sidoarjo, Telp. 031-8680799 / Fax. 031-8680599)</p>                        
                    </div> 
                    <div class="col-sm-5" style="padding:0px;">
                        <table  class=" col-12 table-bordered"  style="font-size:0.2cm; margin-top:0.2cm; border-right:0px !important;">
                            <tr>
                                <td style="font-size:0.4cm;" colspan='2'><b>No. </b>030123</td> 
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
                        <table  class=" col-12 table-bordered"  style="font-size:0.23cm; margin-top:0.1cm; border-right:0px !important;">
                            <tr>
                                <th colspan='5'>Quantity:</th>
                            </tr>
                            <tr class="text-center">
                                <th width='20%'>K</th> 
                                <th width='20%'>S</th> 
                                <th width='20%'>B</th> 
                                <th width='20%'>BB</th> 
                                <th width='20%'>Kg</th> 
                            </tr> 
                            <tr class="text-center">
                                <td>2</td> 
                                <td>0</td> 
                                <td>4</td> 
                                <td>0</td> 
                                <td>0</td> 
                            </tr> 
                        </table>
                    </div> 
                    <div class="col-sm-4" style="padding:5px; padding-top:0.2cm;">
                        {!! QrCode::size(105)->generate('ItSolutionStuff.com'); !!} 
                    </div>
                </div>
                <div class="card"> 
                    <div class="table-responsive-sm">
                        <table class=" table-bordered" style="font-size:0.3cm; width:100%;margin-bottom:0.1cm;margin-top:0.1cm;">
                            <tr>
                                <td style="width:25%">
                                    <span class="font-weight-bold">KOTA ASAL</span><br>
                                    SURABAYA<br>
                                </td> 
                                <td style="width:25%">
                                    <span class="font-weight-bold">KOTA TUJUAN</span><br>
                                    SITUBONDO<br>
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
                                        <span class="font-weight-bold">NAMA PENGIRIM:</span><br>
                                            David surosegoro<br>
                                        <span class="font-weight-bold">ALAMAT:</span><br>
                                            Jl. gayungkebonsari manunggal c10<br>
                                        <span class="font-weight-bold">KODEPOS:</span><br>
                                            60226<br>
                                        <span class="font-weight-bold">NO HP:</span><br>
                                            08151651564 
                                            
                                        
                                    </td>   
                                    <td style="width:50%;">
                                        <span class="font-weight-bold">NAMA PENERIMA:</span><br>
                                            Indra Prasetya<br>
                                        <span class="font-weight-bold">ALAMAT:</span><br>
                                            Jl. gayungkebonsari manunggal c10<br>
                                        <span class="font-weight-bold">KODEPOS:</span><br>
                                            60226<br>
                                        <span class="font-weight-bold">NO HP:</span><br>
                                            08151651564 
                                    </td>    
                                </tr>
                            </thead> 
                        </table> 
                        <table class="table-striped table-bordered" style='margin-top:0.1cm;'>
                            <thead>
                                <tr> 
                                    <td class='text-left' style="font-size:0.22cm;">
                                        <span style="font-weight:bold;">Keterangan</span><br>
                                        In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div> 
                </div> 
            </div>
        <script type="text/javascript" src="{{asset('assets/gsa/js/bootstrap.bundle.min.js')}}"></script>
        <script type="text/javascript"></script>
    </body>
</html>
