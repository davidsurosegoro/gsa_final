<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>MANIFEST</title>
        <link href="{{asset('assets/gsa/css/boots.css')}}" rel="stylesheet" />
        <link href="" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('assets/gsa/fa/css/font-awesome.min.css')}}">
        <script type="text/javascript" src="{{asset('assets/gsa/js/jquery.min.js')}}"></script>
        <style>
            table, th, td {
                border: 1px solid black;
            }
            .showonprint{
                display: none;
            }
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
                .showonprint{
                    display: block !important;
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
                font-family:sans-serif;
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
        <div class="printcontainer d-print-none" onclick="window.print()">  <i class="fa fa-print" aria-hidden="true"></i>&nbsp;PRINT 
        </div>
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
                        @if ($manifest->status=='checked')
                            <h2><button type="button" class=" d-print-none btn btn-default">{{$manifest->status}}</button></h2>                        
                        @elseif ($manifest->status=='delivering')
                            <h2><button type="button" class=" d-print-none btn btn-primary">{{$manifest->status}}</button></h2>                        
                        @elseif ($manifest->status=='arrived')
                            <h2><button type="button" class=" d-print-none btn btn-success">{{$manifest->status}}</button></h2>
                        @endif
                        
                    </div> 
                    <div class="col-sm-3" style="padding:0px;">
                        <table  class=" col-12 "  style="font-size:0.33cm; margin-top:0.4cm; border-right:0px !important;">
                            <tr>
                                <td ><b>NO.</b></td>
                                <td>&nbsp;{{$manifest->kode}}</td>
                            </tr>
                            <tr>
                                <td ><b>Asal </b></td>
                                <td>&nbsp;{{$manifest->namakotaasal}}-({{$manifest->kodekotaasal}})</td>
                            </tr>
                            <tr>
                                <td ><b>Tujuan </b></td>
                                <td>&nbsp;{{$manifest->namakotatujuan}}-({{$manifest->kodekotatujuan}})</td>
                            </tr>  
                        </table>
                    </div>
                    <div class="col-sm-4" style="padding:0px;">
                        <table  class=" col-12 "  style="font-size:0.33cm; margin-top:0.4cm;">
                            <tr>
                                <td style="width:3cm;"><b>Tgl </b></td>
                                <td>&nbsp;{{$manifest->tanggal_manifest}}</td>
                            </tr>
                            <tr>
                                <td style="width:3cm;"><b>Dicetak Oleh </b></td>
                                <td>&nbsp;{{ Auth::user()->nama }}</td>
                            </tr>
                            <tr>
                                <td style="width:3cm;"><b>Supir</b></td>
                                <td>&nbsp;{{$manifest->supir}}</td>
                            </tr>
                            <tr>
                                <td style="width:3cm;"><b>Diterima agen</b></td>
                                <td>&nbsp;{{$manifest->discan_diterima_oleh_nama}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-2" style="padding:10px; padding-top:15px;">
                        {!! QrCode::size(87)->generate(url('/t/'.$manifest->kode)); !!}
                    </div>
                </div>
                <div class="card"> 
                    <div class="">
                        <table class="" style="font-size:0.4cm;width:100%;">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="width:0.5cm;padding:0.1cm;">NO</th> 
                                    <th rowspan="2" style="width:1cm;padding:0.1cm;">AWB</th> 
                                    <th rowspan="2" style="width:2cm;padding:0.1cm;">PENGIRIM</th> 
                                    <th rowspan="2" style="width:1cm;padding:0.1cm;">PENERIMA</th> 
                                    <th rowspan="2" style="width:1cm;padding:0.1cm;">TUJUAN</th> 
                                    <th  style="width:0.5cm;padding:0.1cm;">KL</th> 
                                    <th  style="width:0.5cm;padding:0.1cm;">KG</th> 
                                    <th  style="width:0.5cm;padding:0.1cm;">Doc</th> 
                                    {{-- <th rowspan="2" style="width:1cm;padding:0.1cm;">NM.PENERIMA</th>   --}}
                                    <th rowspan="2" style="width:2cm;padding:0.1cm;">KET</th> 
                                </tr>
                                <tr>
                                    <td class="text-center">{{$manifest->jumlah_koli}}</td>
                                    <td class="text-center">{{$manifest->jumlah_kg}}</td>
                                    <td class="text-center">{{$manifest->jumlah_doc}}</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($awb as $item)
                                <?php
                                    $qty_umum = $item->qty;
                                    if($item->qty_kecil > 0 || $item->qty_sedang > 0 || $item->qty_besar > 0 || $item->qty_besarbanget > 0){
                                        $qty_umum = $item->qty_kecil + $item->qty_sedang + $item->qty_besar + $item->qty_besarbanget;
                                    }
                                    if($item->qty_kg > 0){
                                        $qty_umum = 1;
                                    }
                                    if($item->qty_doc > 0){
                                        $qty_umum = $item->qty_doc;
                                    }
                                ?>
                                <tr style="padding:0px;">
                                    <td class='text-center' style="padding:5px;">{{ $loop->index+1 }}</td>   
                                    <td style="padding:5px;">
                                        <a href="{{ url('t/'.$item['noawb'].'/t/0')}}" target="_blank" class="d-print-none">{{$item->noawb}}</a>
                                        <span class="showonprint">{{$item->noawb}}</span>
                                    </td> 
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
                                    {{-- <td style="padding:5px;">{{$item->nama_penerima}} </td>   --}}
                                    <td style="padding:5px;position:relative !important;">
                                        {{$item->keterangan}}{{$item->qtyloaded}}
                                        
                                            <div class="d-print-none totalbarangmasuk" 
                                                @if ($qty_umum - $item->qtyloaded == 0)                                            
                                                    style="background-color: #27ae60;"
                                                @else
                                                    style="background-color: #d02626;"
                                                @endif
                                                >
                                                 masuk ke truck {{$item->qtyloaded}} dari {{ $qty_umum}} barang
                                            </div>
                                    </td> 
                                </tr>   
                                @endforeach   
                            </tbody>
                        </table>
                        <table class="table table-striped " >
                            <thead>
                                <tr> 
                                    <td class='text-left' style="font-size:0.35cm;padding:0.1cm;">
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
