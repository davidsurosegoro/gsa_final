<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>AWB</title>
        <link href="{{asset('assets/gsa/css/boots.css')}}" rel="stylesheet" />
        <link href="" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('assets/gsa/fa/css/font-awesome.min.css')}}">
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
                size: 78mm 98mm;
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
                    width: 76mm;
                    height: 99mm;
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
            /* Chrome, Safari, Edge, Opera */
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
            }

            /* Firefox */
            input[type=number] {
            -moz-appearance: textfield;
            }
            .text-dark {
                color: #3d405c !important;
            }
            .page {
                width: 78mm;
                max-height: 100mm;
                height: 100mm;
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
        <div class="printcontainer d-print-none" 
            @if($awb[0]->status_tracking==='booked')
                onclick="updatetomanifest()"
            @else
                onclick="window.print()"                
            @endif    
        >
            <i class="fa fa-print" aria-hidden="true"></i>&nbsp;PRINT 
        </div>
        <div class="statuscontainer d-print-none" > Status =
            {{$awb[0]->status_tracking}}
        </div> 
        <?php
            $qty_umum = $awb[0]->qty;
            if($awb[0]->qty_kecil > 0 || $awb[0]->qty_sedang > 0 || $awb[0]->qty_besar > 0 || $awb[0]->qty_besarbanget > 0){
                $qty_umum = $awb[0]->qty_kecil + $awb[0]->qty_sedang + $awb[0]->qty_besar + $awb[0]->qty_besarbanget;
            }
            if($awb[0]->qty_kg > 0){
                $qty_umum = ($awb[0]->jumlah_koli == 0) ? 1 : $awb[0]->jumlah_koli;
            }
            if($awb[0]->qty_doc > 0){
                $qty_umum = $awb[0]->qty_doc;
            } 
        ?>
        @for($i = 1; $i <= $qty_umum; $i++)
            <div class="card page" style="position:relative !important;">
                <div class=" text-right" style="padding:0px;position:absolute; bottom:0px; right:2mm;font-size:0.4cm;">
                    {{ $i }}/{{$qty_umum }}
                </div>
                <div class="card-header  " style="padding:0px !important; display: flex; height: 29.5mm;">  
                    <div class="col-7 text-center" style=" padding:0px;position:relative;">
                        @if ($awb[0]->ada_faktur == 1)                                            
                        <span style="border:1px solid black; letter-spacing:0.01cm;width:auto;font-size:0.3cm; position:absolute; top:0px; left:0px;" class="col-">Faktur</span>
                        @endif
                        <img src='{{asset('assets/gsa/logo.jpg')}}' style="width:1cm;" class="col-">
                        <p class="col-12 font-weight-bold" style="font-size:0.15cm;padding:0px; margin:0px;">GLOBAL SERVICE ASIA</p>
                        <p class="col-12" style="font-size: 0.154cm;padding: 0px;margin: 0px;line-height: 0.2cm;">
                            Komplek Ruko Pasar Wisata Bandara Juanda C 10 -11 (Pabean - Sedati Sidoarjo, Telp. 031-8680799 / Fax. 031-8680599)
                        </p>                        
                        <table  class=" col-12 table-bordered"  style="font-size:0.25cm; border-right:0px !important;">
                            <tr>
                                <td class="couture" style="letter-spacing: 0.03cm;font-size:0.4cm;line-height: 5.3mm;" colspan='2'>{{ $awb[0]->noawb }}</td> 
                            </tr> 
                            <tr> 
                                <td style="letter-spacing: 0.05cm;padding-bottom:0px;">{{ date('d F Y',strtotime($awb[0]->tanggal_awb)) }}</td>
                            </tr> 
                        </table>
                    </div>  
                    <div class="col-sm-5" style="padding:5px; padding-top:0cm; padding-bottom:0cm;">
                        {!! QrCode::size(110)->generate(url('/t/'.$awb[0]->noawb.'/t/'.$i)); !!} 
                    </div>
                </div>
                <div class="card " > 
                    <div class=" row" style="position: relative; margin:0px;">
                        
                        <table  class="couture 
                            
                        @if ($awb[0]->noref)        
                        col-7 
                        @else
                        col-12 
                        @endif        

                                table-bordered font-weight-bold"  style="font-size:0.25cm;line-height:0.25cm; border-right:0px !important;">
                            <tr>
                                {{-- <th colspan='5'>Quantity:</th> --}}
                            </tr>
                            @if($awb[0]->is_agen == 1)
                                <tr class="text-center">
                                    <th> QTY</th>
                                </tr>
                                <tr class="text-center">
                                    <td>{{ $awb[0]->qty }}</td>
                                </tr>
                            @else
                                <tr class="text-center">
                                    <th width='16.6%'>K</th> 
                                    <th width='16.6%'>S</th> 
                                    <th width='16.6%'>B</th> 
                                    <th width='16.6%'>BB</th> 
                                    <th width='16.6%'>Kg</th> 
                                    <th width='16.6%'>Doc</th> 
                                </tr> 
                                <tr class="text-center" style="line-height: 3mm;">
                                    <td>{{ $awb[0]->qty_kecil }}</td> 
                                    <td>{{ $awb[0]->qty_sedang }}</td> 
                                    <td>{{ $awb[0]->qty_besar }}</td> 
                                    <td>{{ $awb[0]->qty_besarbanget }}</td> 
                                    <td>
                                        @if($awb[0]->id_customer==26 && $awb[0]->jumlah_koli>1)
                                            <input type='number' value="{{ $awb[0]->qty_kg }}" style="width:100%;text-align:center;border:0px;">
                                        @else
                                            {{ $awb[0]->qty_kg }}
                                        @endif
                                    </td> 
                                    <td>{{ $awb[0]->qty_doc }}</td> 
                                </tr>
                            @endif
                        </table>
                        @if ($awb[0]->noref)
                            
                            <table  class="couture col-5 table-bordered font-weight-bold"  style="font-size:0.25cm;line-height:0.25cm; border-right:0px !important;">
                                <tr>
                                    <th class="text-center">
                                        No Referensi
                                    </th>
                                </tr>
                                <tr class="text-center">
                                    <td>{{ $awb[0]->noref }}</td> 
                                </tr>
                            </table>
                        @endif
                        <table class=" table-bordered" style="font-size:0.3cm; width:100%;margin-bottom:0mm;margin-top:0cm;">
                            <tr>
                                <td style="width:25%; font-size:0.7cm;line-height:0.6cm;position:relative;" class="couture">
                                    <span class="font-weight-bold " style="position:absolute; line-height:1mm;top:1mm;right:0.1mm;font-size:0.2cm;">KOTA ASAL</span>
                                    {{ $awb[0]->kota_asal_kode }}<br>
                                </td> 
                                <td style="width:25%; font-size:0.7cm;line-height:0.6cm;position:relative;" class="couture">
                                    <span class="font-weight-bold " style="position:absolute; line-height:1mm;top:1mm;right:0.1mm;font-size:0.2cm;">KOTA TUJUAN</span>
                                    {{ $awb[0]->kota_tujuan_kode }}<br>
                                </td>  
                            </tr>
                        </table>
                        <table class="table-striped table-bordered" style="font-size:0.25cm; width:100%;">
                            <thead>
                                
                                <tr style="height: 3cm; font-size:0.25cm;">
                                    <td style="width:50%;padding:0.1cm;">
                                        <span class="font-weight-bold" style="font-size:0.15cm;letter-spacing:0.03cm; line-height:1mm;">NAMA PENGIRIM:</span><br>
                                            <span style="font-size:0.28cm;line-height:1mm; letter-spacing:0.2mm;">{{ $awb[0]->nama_pengirim }}<br></span>
                                        <span class="font-weight-bold" style="font-size:0.15cm;letter-spacing:0.03cm; line-height:1mm;">ALAMAT:</span> 
                                            <span style="font-size:0.28cm;line-height:1mm; letter-spacing:0.2mm;">{{ $awb[0]->alamat_pengirim }}<br></span>
                                        <span class="font-weight-bold" style="font-size:0.15cm;letter-spacing:0.03cm; line-height:1mm;">KODEPOS:</span>
                                            <span style="font-size:0.28cm;line-height:1mm; letter-spacing:0.2mm;">{{ $awb[0]->kodepos_pengirim }}<br></span>
                                        <span class="font-weight-bold" style="font-size:0.15cm;letter-spacing:0.03cm; line-height:1mm;">NO HP:</span>
                                            <span style="font-size:0.28cm;line-height:1mm; letter-spacing:0.2mm;">{{ $awb[0]->notelp_pengirim }} </span>
                                            
                                        
                                    </td>   
                                    <td style="width:50%; padding:0.1cm;">
                                        <span class="font-weight-bold" style="font-size:0.15cm;letter-spacing:0.03cm; line-height:1mm;">NAMA PENERIMA:</span><br>
                                            <span style="font-size:0.28cm;line-height:1mm; letter-spacing:0.2mm;">{{ $awb[0]->nama_penerima }}<br></span>
                                        <span class="font-weight-bold" style="font-size:0.15cm;letter-spacing:0.03cm; line-height:1mm;">ALAMAT:</span> 
                                            <span style="font-size:0.28cm;line-height:1mm; letter-spacing:0.2mm;">{{ $awb[0]->alamat_tujuan }}<br></span>
                                        <span class="font-weight-bold" style="font-size:0.15cm;letter-spacing:0.03cm; line-height:1mm;">KODEPOS:</span>
                                            <span style="font-size:0.28cm;line-height:1mm; letter-spacing:0.2mm;">{{ $awb[0]->kodepos_penerima }}<br></span>
                                        <span class="font-weight-bold" style="font-size:0.15cm;letter-spacing:0.03cm; line-height:1mm;">NO HP:</span>
                                            <span style="font-size:0.28cm;line-height:1mm; letter-spacing:0.2mm;">{{ $awb[0]->notelp_penerima }} </span>
                                    </td>    
                                </tr>
                            </thead> 
                        </table> 
                        @if($awb[0]->keterangan)
                            <table class="table-striped table-bordered col-" style='margin-top:0.1cm; width:87%;'>
                                <thead>
                                    <tr> 
                                        <td class='text-left' style="font-size:0.25cm;position:relative;">
                                            <span style="position:absolute; padding-left:2px;right:0px; top:0px;font-weight:bold;border-left:1px solid black;border-bottom:1px solid black;">Keterangan</span>
                                            <span style="padding-left:0.1cm;font-size:0.6cm;line-height:7mm;letter-spacing:0.01cm;">{{ $awb[0]->keterangan }}</span>
                                        </td>
                                    </tr>
                                </thead>
                            </table> 
                        @endif
                        
                    </div> 
                </div> 
            </div> 
            @endfor 
        <script type="text/javascript" src="{{asset('assets/gsa/js/bootstrap.bundle.min.js')}}"></script>
        <script type="text/javascript">
            jQuery(document).bind("keyup keydown", function(e){
                if(e.ctrlKey && e.keyCode == 80){
                    return false;
                }
            });
            function updatetomanifest(){
                $.ajax({
                    method  :'POST',
                    url     :'{{ url('awb/updatetomanifest') }}',
                    data    :{
                        id              : "{{ $awb[0]->id }}",
                        '_token'        : "{{ csrf_token() }}" 
                    },
                    success:function(data){  
                        if(data.status != ''){

                            alert(data.status)
                        }
                        window.print();       
                    }
                }) 
            }
        </script>
    </body>
</html>
