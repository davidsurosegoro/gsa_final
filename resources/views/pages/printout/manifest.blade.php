<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>MANIFEST</title>
        <link href="{{asset('assets/gsa/css/bootstrap.min.css')}}" rel="stylesheet" />
        <link href="" rel="stylesheet" />
        <script type="text/javascript" src="{{asset('assets/gsa/js/jquery.min.js')}}"></script>
        <style>
            @page {
                size: A4;
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
                width: 210mm;
                min-height: auto;
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
                    <div class="col-12 text-center font-weight-bold">
                        DAFTAR BARANG<br> 
                    </div>
                    <div class="col-3 text-center" style="margin-bottom:0.5cm;">
                        <img src='{{asset('assets/gsa/logo.jpg')}}' style="width:1.3cm;" class="col-">
                        <p class="col-12 font-weight-bold" style="font-size:0.25cm;padding:0px; margin:0px;">GLOBAL SERVICE ASIA</p>
                        <p class="col-12" style="font-size:0.18cm;padding:0px; margin:0px;">Komplek Ruko Pasar Wisata Bandara Juanda C 10 -11</p>
                        <p class="col-12" style="font-size:0.18cm;padding:0px; margin:0px;">Pabean - Sedati Sidoarjo, Telp. 031-8680799 / Fax. 031-8680599
                        </p>
                        
                    </div> 
                    <div class="col-sm-3" style="padding:0px;">
                        <table  class=" col-12 table-bordered"  style="font-size:0.23cm; margin-top:0.4cm; border-right:0px !important;">
                            <tr>
                                <td style="width:2.4cm;"><b>Asal </b></td>
                                <td>&nbsp;Surabaya</td>
                            </tr>
                            <tr>
                                <td style="width:2.4cm;"><b>Tgl Pengiriman </b></td>
                                <td>&nbsp;30 juni 2021</td>
                            </tr>
                            <tr>
                                <td style="width:2.4cm;"><b>Jumlah Kiriman</b></td>
                                <td>&nbsp;10</td>
                            </tr>
                            <tr>
                                <td style="width:2.4cm;"><b>Jumlah Koli</b></td>
                                <td>&nbsp;20</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-4" style="padding:0px;">
                        <table  class=" col-12 table-bordered"  style="font-size:0.23cm; margin-top:0.4cm;">
                            <tr>
                                <td style="width:3cm;"><b>Tujuan </b></td>
                                <td>&nbsp;Jember</td>
                            </tr>
                            <tr>
                                <td style="width:3cm;"><b>Didaftar & Dicek Oleh </b></td>
                                <td>&nbsp;David suro</td>
                            </tr>
                            <tr>
                                <td style="width:3cm;"><b>Dibawa Oleh (supir)</b></td>
                                <td>&nbsp;Rudi</td>
                            </tr>
                            <tr>
                                <td style="width:3cm;"><b>Diterima & Dicek Oleh(agen)</b></td>
                                <td>&nbsp;bambang</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-2" style="padding:10px; padding-top:15px;">
                        {!! QrCode::size(87)->generate('ItSolutionStuff.com'); !!} 
                    </div>
                </div>
                <div class="card"> 
                    <div class="table-responsive-sm">
                        <table class="table table-striped table-bordered" style="font-size:0.25cm;">
                            <thead>
                                <tr>
                                    <th style="width:1cm;">NO</th> 
                                    <th style="width:1cm;">AWB</th> 
                                    <th style="width:1cm;">PENGIRIM</th> 
                                    <th style="width:1cm;">PENERIMA</th> 
                                    <th style="width:1cm;">TUJUAN</th> 
                                    <th style="width:1cm;">KL</th> 
                                    <th style="width:1cm;">KG</th> 
                                    <th style="width:1cm;">D/P</th> 
                                    <th style="width:1cm;">NM.PENERIMA</th> 
                                    <th style="width:1cm;">TGL.TERIMA</th> 
                                    <th style="width:1cm;">KET</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="padding:0px;">
                                    <td style="padding:2px;">1</td>   
                                    <td style="padding:2px;">AWB0003</td> 
                                    <td style="padding:2px;" class='text-left'>David surosegoro</td> 
                                    <td style="padding:2px;" class='text-left'>Indra Prasetya</td> 
                                    <td style="padding:2px;">Malang</td> 
                                    <td style="padding:2px;" class='text-center'>3</td> 
                                    <td style="padding:2px;" class='text-center'>20</td> 
                                    <td style="padding:2px;"></td> 
                                    <td style="padding:2px;" class='text-left'>Yogi</td> 
                                    <td style="padding:2px;">5 mei 2021</td> 
                                    <td style="padding:2px;"></td> 
                                </tr>   
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered" >
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
