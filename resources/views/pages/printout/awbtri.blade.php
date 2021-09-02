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
                size: 21cm 29.7cm;
                margin: 0;
            }
            @media print {
                .no-print,
                .no-print * {
                    display: none !important;
                }  html, body {
                            width: 210mm;
                            height: 297mm; 
                    }
                .page { 
                    margin: 0px !important;
                    border: 0px !important;
                    height: 297mm !important; 
                    border-radius: initial;
                    box-shadow: initial;
                    background: initial;
                    page-break-after: always;
                    width:100% !important;
                }
                .height33{ 
                    margin-top:2mm !important;
                    height:95mm !important;
                    border:1px solid black !important;
                }
            } 
            body {
                background-color: #000;
            } 
            .card {
                /* margin-bottom: 30px; */
                border: none; 
            }

            .card-header {
                background-color: #fff;
                border-bottom: 1px solid #e6e6f2;
            }
 
            .height33{
                height:33% ;
                border:1px solid black;
            }
            .page {
                width: 210mm; 
                height: 297mm;
                padding: 1mm;
                margin: 10mm auto;
                border: 1px #D3D3D3 solid;
                border-radius: 5px; 
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
                box-shadow: 8px 17px 38px -13px rgba(0,0,0,0.75);
                -webkit-box-shadow: 8px 17px 38px -13px rgba(0,0,0,0.75);
                -moz-box-shadow: 8px 17px 38px -13px rgba(0,0,0,0.75);
            }
        </style>
    </head>
    <body  class="snippet-body" style="background-color:white;">
            <div class="card page">
                @for ($i = 0; $i < 3; $i++)
                <div class="height33">                        
                    <div class="card-header  " style="padding:0px !important; display: flex;">  
                        <div class="col-5 row text-center" style=" padding:1px;margin:0px;">
                            <img src='{{asset('assets/gsa/logo.jpg')}}'   style='width:1.1cm;height:1.3cm;' class="col-3">
                            <p class="col-8 font-weight-bold text-left" style="font-size:0.25cm;padding:0px; margin:0px;">GLOBAL SERVICE ASIA<br>Komplek Ruko Pasar Wisata Bandara Juanda C 10 -11 (Pabean - Sedati Sidoarjo, Telp. 031-8680799 / Fax. 031-8680599)</p>                        
                            <table  class=" col-12 table-bordered"  style="font-size:0.27cm; border-right:0px !important;">
                                <tr style="padding:0px;">
                                    <td style="font-size:0.5cm;line-height:0.4cm;" colspan='2'><b>No. </b>{{ $awb[0]->noawb }}</td> 
                                </tr>
                                <tr>
                                    <td style="width:2.4cm;line-height:0.2cm;"><b>PICKUP BY </b></td>
                                    <td style="width:2.4cm;line-height:0.2cm;"><b>TANGGAL</b></td> 
                                </tr>
                                <tr>
                                    <td style="line-height:0.2cm;">Driver</td>
                                    <td style="line-height:0.2cm;">{{ date('d-F-Y',strtotime($awb[0]->tanggal_awb)) }}</td>
                                </tr> 
                            </table>
                        </div>  
                        <div class="col-2 text-center" style=" ">
                            <table class=" table-bordered" style="font-size:0.3cm; width:100%; ">
                                <tr>
                                    <td style="width:25%; height:1.3cm;font-size:1cm;line-height:0cm;position:relative;">
                                        <span class="font-weight-bold" style="position:absolute; top:0.1cm;right:1px;font-size:0.22cm;">KOTA ASAL</span>
                                        {{ $awb[0]->kota_asal_kode }}<br>
                                    </td> 
                                </tr>
                                <tr>
                                    <td style="width:25%; height:1.3cm;font-size:1cm;line-height:0cm;position:relative;">
                                        <span class="font-weight-bold" style="position:absolute; top:0.1cm;right:1px;font-size:0.22cm;">KOTA TUJUAN</span>
                                        {{ $awb[0]->kota_tujuan_kode }}<br>
                                    </td>  
                                </tr>
                            </table>
                        </div>
                        <div class="col-2 text-center" >
                            {!! QrCode::size(95)->generate($awb[0]->noawb ); !!} 
                        </div>
                        <table class="table-striped table-bordered col-3"  >
                            <thead>
                                <tr> 
                                    <td class='text-left' style="font-size:0.24cm;">
                                        <span style="font-weight:bold;">Keterangan</span><br>
                                        {{ $awb[0]->keterangan }}
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card " style="margin-top:0.2cm;"> 
                        <div class=" row" style="position: relative;margin:0px; "> 
                            <div class="col-6 " style="padding:0px;">
                                <table class="table-striped table-bordered" style="font-size:0.25cm; width:100%;">
                                    <thead>
                                        <tr>
                                            <th style="width:50%;">SHIPPER</th>  
                                            <th style="width:50%;">CONSIGNEE</th>  
                                        </tr>
                                        <tr style="height: 3cm; font-size:0.25cm;">
                                            <td style="width:50%;">
                                                <span class="font-weight-bold" style="font-size:0.22cm;">NAMA PENGIRIM:</span><br>
                                                    <span style="font-size:0.35cm;">{{ $awb[0]->nama_pengirim }}<br><span>
                                                <span class="font-weight-bold" style="font-size:0.22cm;">ALAMAT:</span><br>
                                                    <span style="font-size:0.35cm;">{{ $awb[0]->alamat_pengirim }}<br><span>
                                                <span class="font-weight-bold" style="font-size:0.22cm;">KODEPOS:</span><br>
                                                    <span style="font-size:0.35cm;">{{ $awb[0]->kodepos_pengirim }}<br><span>
                                                <span class="font-weight-bold" style="font-size:0.22cm;">NO HP:</span><br>
                                                    <span style="font-size:0.35cm;">{{ $awb[0]->notelp_pengirim }} <span>
                                                    
                                                
                                            </td>   
                                            <td style="width:50%;">
                                                <span class="font-weight-bold" style="font-size:0.22cm;">NAMA PENERIMA:</span><br>
                                                    <span style="font-size:0.35cm;">{{ $awb[0]->nama_penerima }}<br><span>
                                                <span class="font-weight-bold" style="font-size:0.22cm;">ALAMAT:</span><br>
                                                    <span style="font-size:0.35cm;">{{ $awb[0]->alamat_tujuan }}<br><span>
                                                <span class="font-weight-bold" style="font-size:0.22cm;">KODEPOS:</span><br>
                                                    <span style="font-size:0.35cm;">{{ $awb[0]->kodepos_penerima }}<br><span>
                                                <span class="font-weight-bold" style="font-size:0.22cm;">NO HP:</span><br>
                                                    <span style="font-size:0.35cm;">{{ $awb[0]->notelp_penerima }} <span>
                                            </td>    
                                        </tr>
                                    </thead> 
                                </table> 
                            </div>
                            
                            <div class="col-6" style="padding:0px;">
                                <table  class="col-12 table-bordered"  style="font-size:0.35cm; border-right:0px !important;">
                                    <tr>
                                        {{-- <th colspan='5'>Quantity:</th> --}}
                                    </tr>
                                    <tr class="text-center">
                                        @if($awb[0]->is_agen == 1)
                                            <th width='100%'>QTY</th> 
                                        @else
                                            <th width='16.6%'>K</th> 
                                            <th width='16.6%'>S</th> 
                                            <th width='16.6%'>B</th> 
                                            <th width='16.6%'>BB</th> 
                                            <th width='16.6%'>Kg</th> 
                                            <th width='16.6%'>Doc</th>
                                        @endif 
                                    </tr> 
                                    <tr class="text-center">
                                        @if($awb[0]->is_agen == 1)
                                        <td>{{ $awb[0]->qty }}</td> 
                                        @else
                                        <td>{{ $awb[0]->qty_kecil }}</td> 
                                        <td>{{ $awb[0]->qty_sedang }}</td> 
                                        <td>{{ $awb[0]->qty_besar }}</td> 
                                        <td>{{ $awb[0]->qty_besarbanget }}</td> 
                                        <td>{{ $awb[0]->qty_kg }}</td> 
                                        <td>{{ $awb[0]->qty_doc }}</td> 
                                        @endif
                                    </tr> 
                                </table>
                                <table  class="col-12  "  style="font-size:0.35cm; border-right:0px !important;">
                                    <tr>
                                        {{-- <th colspan='5'>Quantity:</th> --}}
                                    </tr>
                                    <tr class="text-center">
                                        <th width='33.3%' style="padding-top:4cm;">MARKETING<br>(David suro)</th> 
                                        <th width='33.3%' style="padding-top:4cm;">CUSTOMER<br>(David suro)</th> 
                                        <th width='33.3%' style="padding-top:4cm;">PENERIMA<br>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</th>  
                                    </tr>  
                                </table>
                            </div> 
                        </div> 
                    </div> 
                </div>
                
                @endfor
            </div>
        <script type="text/javascript" src="{{asset('assets/gsa/js/bootstrap.bundle.min.js')}}"></script>
        <script type="text/javascript"></script>
    </body>
</html>
