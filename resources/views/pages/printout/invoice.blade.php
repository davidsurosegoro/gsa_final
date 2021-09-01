<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>INVOICE</title>
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
                        <img src='{{asset('assets/gsa/logo.jpg')}}' style="width:2.5cm;">
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
                                   <td>:&nbsp;{{$invoice->namacustomer}}</td>
                               </tr>
                               <tr>
                                   <td><b>Alamat </b></td>
                                   <td>:&nbsp;{{$invoice->alamatcustomer}}</td>
                               </tr>
                               <tr>
                                   <td><b>Telp/fax </b></td>
                                   <td>:&nbsp;{{$invoice->notelpcustomer}}</td>
                               </tr>
                           </table>
                        </div>
                        <div class="col-sm-6">
                            <table  style="font-size:0.35cm;">
                                <tr>
                                    <td><b>No Invoice </b></td>
                                    <td>:&nbsp;{{$invoice->kode}}</td>
                                </tr>
                                <tr>
                                    <td><b>Date </b></td>
                                    <td>:&nbsp;{{$invoice->tanggal_invoice}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-striped table-bordered" style="font-size:0.25cm;">
                            <thead>
                                <tr>
                                    <th class='text-center' style="padding:5px;width:10px;">NO</th> 
                                    <th style="padding:5px;width:10%;">TANGGAL</th>  
                                    <th style="padding:5px;width:7%;">AWB</th>  
                                    <th style="padding:5px;width:10%;">No.Manifest</th>  
                                    <th style="padding:5px;width:10%;">ASAL</th>  
                                    <th style="padding:5px;width:10%;">Tujuan</th>  
                                    <th style="padding:5px;width:10%;">Koli</th>  
                                    <th style="padding:5px;width:5%;">Kg</th>  
                                    <th style="padding:5px;width:5%;">Doc</th>   
                                    <th style="padding:5px;width:10%;">KET</th> 
                                    <th style="padding:5px;width:8%;">Biaya OA</th>  
                                    <th style="padding:5px;width:10%;">Total Bayar</th>  
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($awb as $item)
                                <tr style="padding:0px;">
                                    <td class='text-center' style="padding:5px;">{{ $loop->index+1 }}</td>   
                                    <td style="padding:5px;">{{$item->tanggal_awb}}</td>  
                                    <td style="padding:5px;">{{$item->noawb}}</td>  
                                    <td style="padding:5px;">{{$item->kodemanifest}}</td>  
                                    <td style="padding:5px;">{{$item->kotaasal}}</td>   
                                    <td style="padding:5px;">{{$item->kotatujuan}}</td> 
                                    <td style="padding:5px;">
                                        @if(($item->qty_kecil == 0 && $item->qty_sedang == 0 && $item->qty_besar == 0 && $item->qty_besarbanget==0) && $item->qty>0)
                                        {{$item->qty}}
                                        @else
                                        <table style="table" style="background-color:white;">
                                            <tr style="background-color:white;">
                                                <td style="padding:5px;padding-top:0px;padding-bottom:0px; font-weight:bold;">K</td>
                                                <td style="padding:5px;padding-top:0px;padding-bottom:0px; font-weight:bold;">S</td>
                                                <td style="padding:5px;padding-top:0px;padding-bottom:0px; font-weight:bold;">B</td>
                                                <td style="padding:5px;padding-top:0px;padding-bottom:0px; font-weight:bold;">BB</td>
                                            </tr>                                    
                                            <tr style="background-color:white;">
                                                <td style="padding:5px;padding-top:0px;padding-bottom:0px;">{{$item->qty_kecil}}</td>
                                                <td style="padding:5px;padding-top:0px;padding-bottom:0px;">{{$item->qty_sedang}}</td>
                                                <td style="padding:5px;padding-top:0px;padding-bottom:0px;">{{$item->qty_besar}}</td>
                                                <td style="padding:5px;padding-top:0px;padding-bottom:0px;">{{$item->qty_besarbanget}}</td>
                                            </tr>    
                                        </table>    
                                        @endif
                                    </td> 
                                    <td style="padding:5px;">{{$item->qty_kg}}</td> 
                                    <td style="padding:5px;">{{$item->qty_doc}}</td> 
                                    <td style="padding:5px;">{{$item->keterangan}}</td> 
                                    <td style="padding:5px; text-align:right;">{{number_format($item->idr_oa)}}</td> 
                                    <td style="padding:5px; text-align:right;">{{number_format($item->total_harga, 0) }}</td> 
                                </tr>   
                                @endforeach 
                                <tr style="padding:0px; background-color:#a1ffbc;"> 
                                    <td style="padding:5px;" colspan='6' class="text-right">Total Bayar</td>   
                                    <td style="padding:5px;font-weight:bold !important;">{{$invoice->total_koli}}</td>   
                                    <td style="padding:5px;font-weight:bold !important;">{{$invoice->total_kg}}</td>   
                                    <td style="padding:5px;font-weight:bold !important;">{{$invoice->total_doc}}</td>   
                                    <td style="padding:5px;font-weight:bold !important;"></td>   
                                    <td style="padding:5px;font-weight:bold !important; text-align:right;">{{number_format($invoice->total_oa, 0) }}</td> 
                                    <td style="padding:5px;font-weight:bold !important; text-align:right;">{{number_format($invoice->total_harga, 0) }}</td> 
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
                            {{$invoice->namauser}}<br> 
                        </div> 
                        <div class="col-6 text-center">
                            MENGETAHUI    <br><br><br><br><br>
                            {{$invoice->namauser}}<br> 
                        </div> 
                    </div>
                </div>
                <div class="card-footer bg-white" style="font-size:0.35cm;">
                    <p class="mb-0" ><mark style="background-color:#cff;">* Pembayaran dengan Transfer ke BCA CABANG JUANDA a/n Global Service Asia Rek. 667 0230099</mark></p>
                    <p class="mb-0" ><mark style="background-color:#cff;">* Pembayaran maksimal 3 hari sejak invoice diterima.</mark></p>
                    <p class="mb-0" ><mark style="background-color:#cff;">* Pembayaran melalui Cek atau Giro dianggap LUNAS apabila sudah DIUANGKAN.</mark></p>
                </div>
            </div>
        <script type="text/javascript" src="{{asset('assets/gsa/js/bootstrap.bundle.min.js')}}"></script>
        <script type="text/javascript"></script>
    </body>
</html>
