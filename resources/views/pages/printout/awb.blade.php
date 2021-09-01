<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>AWB</title>
        <link href="{{asset('assets/gsa/css/boots.css')}}" rel="stylesheet" />
        <link href="" rel="stylesheet" />
        <script type="text/javascript" src="{{asset('assets/gsa/js/jquery.min.js')}}"></script>
        <style>
            @font-face {
                font-family: JUDUL__S;
                /*src: url('font/save/Caviar_Dreams_Bold.otf');  */
                src: url('{{asset('assets/gsa/css/CODE Bold.otf')}}');  

            }
            @font-face {
                font-family: couture;
                /*src: url('font/save/Caviar_Dreams_Bold.otf');  */
                src: url('{{asset('assets/gsa/css/couture-bld.otf')}}');  

            }
            @page {
                size: A6;
                margin: 0;
            }
            .couture{
                font-family:couture !important;
            }
            @media print {
                .no-print,
                .no-print * {
                    display: none !important;
                }
                html,
                body {
                    width: 99mm;
                    height: 149mm;
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
                .table-bordered th, .table-bordered td {
                    border: 1px solid black !important;
                }
            } 
            body {
                font-family:JUDUL__S;
                background-color: #000;
            }
            .table-bordered th, .table-bordered td {
                border: 1px solid black;
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
        @for($i = 1; $i <= $awb[0]->qty; $i++)
            <div class="card page">
                <div class="card-header  " style="padding:0px !important; display: flex;">  
                    <div class="col-7 text-center" style=" padding:1px;">
                        <img src='{{asset('assets/gsa/logo.jpg')}}' style="width:1.5cm;" class="col-">
                        <p class="col-12 font-weight-bold" style="font-size:0.2cm;padding:0px; margin:0px;">GLOBAL SERVICE ASIA</p>
                        <p class="col-12" style="font-size:0.2cm;padding:0px; margin:0px;">Komplek Ruko Pasar Wisata Bandara Juanda C 10 -11 (Pabean - Sedati Sidoarjo, Telp. 031-8680799 / Fax. 031-8680599)</p>                        
                        <table  class=" col-12 table-bordered"  style="font-size:0.4cm; border-right:0px !important;">
                            <tr>
                                <td class="couture" style="font-size:0.55cm;" colspan='2'><b>No. </b>{{ $awb[0]->noawb }}</td> 
                            </tr> 
                            <tr>
                                <td>Driver</td>
                                <td>{{ date('d F Y',strtotime($awb[0]->tanggal_awb)) }}</td>
                            </tr> 
                        </table>
                    </div>  
                    <div class="col-sm-5" style="padding:5px; padding-top:0.3cm;">
                        {!! QrCode::size(142)->generate($awb[0]->noawb); !!} 
                    </div>
                </div>
                <div class="card " > 
                    <div class="table-responsive-sm row" style="position: relative; margin:0px;">
                        <div class=" text-right" style="padding:0px;position:absolute; bottom:-10px; right:0px;font-size:0.7cm;">
                            {{ $i }}/{{ $awb[0]->qty }}
                        </div>
                        <table  class="couture col-12 table-bordered font-weight-bold"  style="font-size:0.35cm; margin-top:0.1cm;border-right:0px !important;">
                            <tr>
                                {{-- <th colspan='5'>Quantity:</th> --}}
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
                                <td>{{ $awb[0]->qty_kecil }}</td> 
                                <td>{{ $awb[0]->qty_sedang }}</td> 
                                <td>{{ $awb[0]->qty_besar }}</td> 
                                <td>{{ $awb[0]->qty_besarbanget }}</td> 
                                <td>{{ $awb[0]->qty_kg }}</td> 
                                <td>{{ $awb[0]->qty_doc }}</td> 
                            </tr> 
                        </table>
                        <table class=" table-bordered" style="font-size:0.3cm; width:100%;margin-bottom:0.1cm;margin-top:0.1cm;">
                            <tr>
                                <td style="width:25%; font-size:1.2cm;line-height:1.1cm;position:relative;" class="couture">
                                    <span class="font-weight-bold " style="position:absolute; top:-12px;right:5px;font-size:0.22cm;">KOTA ASAL</span>
                                    {{ $awb[0]->kota_asal_kode }}<br>
                                </td> 
                                <td style="width:25%; font-size:1.2cm;line-height:1.1cm;position:relative;" class="couture">
                                    <span class="font-weight-bold " style="position:absolute; top:-12px;right:5px;font-size:0.22cm;">KOTA TUJUAN</span>
                                    {{ $awb[0]->kota_tujuan_kode }}<br>
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
                                            <span style="font-size:0.4cm;">{{ $awb[0]->nama_pengirim }}<br></span>
                                        <span class="font-weight-bold" style="font-size:0.25cm;">ALAMAT:</span><br>
                                            <span style="font-size:0.4cm;">{{ $awb[0]->alamat_pengirim }}<br></span>
                                        <span class="font-weight-bold" style="font-size:0.25cm;">KODEPOS:</span><br>
                                            <span style="font-size:0.4cm;">{{ $awb[0]->kodepos_pengirim }}<br></span>
                                        <span class="font-weight-bold" style="font-size:0.25cm;">NO HP:</span><br>
                                            <span style="font-size:0.4cm;">{{ $awb[0]->notelp_pengirim }} </span>
                                            
                                        
                                    </td>   
                                    <td style="width:50%;padding:0.1cm;">
                                        <span class="font-weight-bold" style="font-size:0.25cm;">NAMA PENERIMA:</span><br>
                                            <span style="font-size:0.4cm;">{{ $awb[0]->nama_penerima }}<br></span>
                                        <span class="font-weight-bold" style="font-size:0.25cm;">ALAMAT:</span><br>
                                            <span style="font-size:0.4cm;">{{ $awb[0]->alamat_tujuan }}<br></span>
                                        <span class="font-weight-bold" style="font-size:0.25cm;">KODEPOS:</span><br>
                                            <span style="font-size:0.4cm;">{{ $awb[0]->kodepos_penerima }}<br></span>
                                        <span class="font-weight-bold" style="font-size:0.25cm;">NO HP:</span><br>
                                            <span style="font-size:0.4cm;">{{ $awb[0]->notelp_penerima }} </span>
                                    </td>    
                                </tr>
                            </thead> 
                        </table> 
                        <table class="table-striped table-bordered col-10" style='margin-top:0.1cm;'>
                            <thead>
                                <tr> 
                                    <td class='text-left' style="font-size:0.3cm;">
                                        <span style="font-weight:bold;">Keterangan</span><br>
                                        {{ $awb[0]->keterangan }}
                                    </td>
                                </tr>
                            </thead>
                        </table> 
                    </div> 
                </div> 
            </div> 
            @endfor
        <script type="text/javascript" src="{{asset('assets/gsa/js/bootstrap.bundle.min.js')}}"></script>
        <script type="text/javascript"></script>
    </body>
</html>
