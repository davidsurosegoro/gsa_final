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
                                <td style="width:2.4cm;"><b>NO.</b></td>
                                <td>&nbsp;{{$manifest->kode}}</td>
                            </tr>
                            <tr>
                                <td style="width:2.4cm;"><b>Asal </b></td>
                                <td>&nbsp;{{$manifest->namakotaasal}}-({{$manifest->kodekotaasal}})</td>
                            </tr>
                            <tr>
                                <td style="width:2.4cm;"><b>Tgl Pengiriman </b></td>
                                <td>&nbsp;{{$manifest->tanggal_manifest}}</td>
                            </tr>
                            <tr>
                                <table class="col-12 table-bordered text-center" style="font-size:0.28cm;">
                                    <tr>
                                        <td class="font-weight-bold">Koli</td>
                                        <td class="font-weight-bold">Kg</td>
                                        <td class="font-weight-bold">Doc</td>
                                    </tr>
                                    <tr>
                                        <td>{{$manifest->jumlah_koli}}</td>
                                        <td>{{$manifest->jumlah_kg}}</td>
                                        <td>{{$manifest->jumlah_doc}}</td>
                                    </tr>
                                </table> 
                            </tr> 
                        </table>
                    </div>
                    <div class="col-sm-4" style="padding:0px;">
                        <table  class=" col-12 table-bordered"  style="font-size:0.23cm; margin-top:0.4cm;">
                            <tr>
                                <td style="width:3cm;"><b>Tujuan </b></td>
                                <td>&nbsp;{{$manifest->namakotatujuan}}-({{$manifest->kodekotatujuan}})</td>
                            </tr>
                            <tr>
                                <td style="width:3cm;"><b>Dicetak Oleh </b></td>
                                <td>&nbsp;{{ Auth::user()->nama }}</td>
                            </tr>
                            <tr>
                                <td style="width:3cm;"><b>Dibawa Oleh (supir)</b></td>
                                <td>&nbsp;{{$manifest->supir}}</td>
                            </tr>
                            <tr>
                                <td style="width:3cm;"><b>Diterima & Dicek Oleh(agen)</b></td>
                                <td>&nbsp;{{$manifest->namaagen}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-2" style="padding:10px; padding-top:15px;">
                        {!! QrCode::size(87)->generate($manifest->kode); !!} 
                    </div>
                </div>
                <div class="card"> 
                    <div class="table-responsive-sm">
                        <table class="table table-striped table-bordered" style="font-size:0.25cm;">
                            <thead>
                                <tr>
                                    <th style="width:0.5cm;padding:0.1cm;">NO</th> 
                                    <th style="width:1cm;padding:0.1cm;">AWB</th> 
                                    <th style="width:2cm;padding:0.1cm;">PENGIRIM</th> 
                                    <th style="width:1cm;padding:0.1cm;">PENERIMA</th> 
                                    <th style="width:1cm;padding:0.1cm;">TUJUAN</th> 
                                    <th style="width:0.5cm;padding:0.1cm;">KL</th> 
                                    <th style="width:0.5cm;padding:0.1cm;">KG</th> 
                                    <th style="width:0.5cm;padding:0.1cm;">Doc</th> 
                                    <th style="width:1cm;padding:0.1cm;">NM.PENERIMA</th>  
                                    <th style="width:1cm;padding:0.1cm;">KET</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($awb as $item)
                                <tr style="padding:0px;">
                                    <td class='text-center' style="padding:5px;">{{ $loop->index+1 }}</td>   
                                    <td style="padding:5px;">{{$item->noawb}}</td> 
                                    <td style="padding:5px;" class='text-left'>{{$item->namacust}}</td> 
                                    <td style="padding:5px;" class='text-left'>{{$item->nama_penerima}}</td> 
                                    <td style="padding:5px;">{{$item->kotatujuan}}</td> 
                                    <td style="padding:5px;" class='text-center'>
                                        @if ($item->qty > 0 && $item->qtykoli == 0)
                                            {{$item->qty}}
                                        @else
                                            {{$item->qtykoli}}   
                                        @endif
                                    </td> 
                                    <td style="padding:5px;" class='text-center'>{{$item->qty_kg}}</td> 
                                    <td style="padding:5px;" class='text-center'>{{$item->qty_doc}}</td> 
                                    <td style="padding:5px;">{{$item->nama_penerima}}</td>  
                                    <td style="padding:5px;">{{$item->keterangan}}</td> 
                                </tr>   
                                @endforeach   
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered" >
                            <thead>
                                <tr> 
                                    <td class='text-left' style="font-size:0.22cm;padding:0.1cm;">
                                        <span style="font-weight:bold;">Keterangan</span><br>
                                        {{$manifest->keterangan}}
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
