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
                    width: 95mm;
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
                $qty_umum = 1;
            }
            if($awb[0]->qty_doc > 0){
                $qty_umum = $awb[0]->qty_doc;
            } 
        ?>
        @for($i = 1; $i <= $qty_umum; $i++)
            <div class="card page">
                <div class="card-header  " style="padding:0px !important; display: flex;">  
                    <div class="col-7 text-center" style=" padding:1px;position:relative;">
                        @if ($awb[0]->ada_faktur == 1)                                            
                        <span style="border:1px solid black; width:1.5cm; position:absolute; top:0px; left:0px;" class="col-">Faktur</span>
                        @endif
                        <img src='{{asset('assets/gsa/logo.jpg')}}' style="width:1.5cm;" class="col-">
                        <p class="col-12 font-weight-bold" style="font-size:0.2cm;padding:0px; margin:0px;">GLOBAL SERVICE ASIA</p>
                        <p class="col-12" style="font-size:0.2cm;padding:0px; margin:0px;">Komplek Ruko Pasar Wisata Bandara Juanda C 10 -11 (Pabean - Sedati Sidoarjo, Telp. 031-8680799 / Fax. 031-8680599)</p>                        
                        <table  class=" col-12 table-bordered"  style="font-size:0.4cm; border-right:0px !important;">
                            <tr>
                                <td class="couture" style="font-size:0.55cm;line-height: 6mm;" colspan='2'><b>No. </b>{{ $awb[0]->noawb }}</td> 
                            </tr> 
                            <tr> 
                                <td>{{ date('d F Y',strtotime($awb[0]->tanggal_awb)) }}</td>
                            </tr> 
                        </table>
                    </div>  
                    <div class="col-sm-5" style="padding:5px; padding-top:0.3cm;">
                        {!! QrCode::size(140)->generate(url('/t/'.$awb[0]->noawb.'/t/'.$i)); !!} 
                    </div>
                </div>
                <div class="card " > 
                    <div class=" row" style="position: relative; margin:0px;">
                        <div class=" text-right" style="padding:0px;position:absolute; bottom:-10px; right:0px;font-size:0.7cm;">
                            {{ $i }}/{{$qty_umum }}
                        </div>
                        <table  class="couture col-12 table-bordered font-weight-bold"  style="font-size:0.35cm; margin-top:0.1cm;border-right:0px !important;">
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
                                <tr class="text-center">
                                    <td>{{ $awb[0]->qty_kecil }}</td> 
                                    <td>{{ $awb[0]->qty_sedang }}</td> 
                                    <td>{{ $awb[0]->qty_besar }}</td> 
                                    <td>{{ $awb[0]->qty_besarbanget }}</td> 
                                    <td>{{ $awb[0]->qty_kg }}</td> 
                                    <td>{{ $awb[0]->qty_doc }}</td> 
                                </tr>
                            @endif
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
                                
                                <tr style="height: 3cm; font-size:0.25cm;">
                                    <td style="width:50%;padding:0.1cm;">
                                        <span class="font-weight-bold" style="font-size:0.25cm;">NAMA PENGIRIM:</span><br>
                                            <span style="font-size:0.4cm; letter-spacing:0.2mm;">{{ $awb[0]->nama_pengirim }}<br></span>
                                        <span class="font-weight-bold" style="font-size:0.25cm;">ALAMAT:</span><br>
                                            <span style="font-size:0.4cm; letter-spacing:0.2mm;">{{ $awb[0]->alamat_pengirim }}<br></span>
                                        <span class="font-weight-bold" style="font-size:0.25cm;">KODEPOS:</span>
                                            <span style="font-size:0.4cm; letter-spacing:0.2mm;">{{ $awb[0]->kodepos_pengirim }}<br></span>
                                        <span class="font-weight-bold" style="font-size:0.25cm;">NO HP:</span>
                                            <span style="font-size:0.4cm; letter-spacing:0.2mm;">{{ $awb[0]->notelp_pengirim }} </span>
                                            
                                        
                                    </td>   
                                    <td style="width:50%; ">
                                        <span class="font-weight-bold" style="font-size:0.25cm;">NAMA PENERIMA:</span><br>
                                            <span style="font-size:0.4cm; letter-spacing:0.2mm;">{{ $awb[0]->nama_penerima }}<br></span>
                                        <span class="font-weight-bold" style="font-size:0.25cm;">ALAMAT:</span><br>
                                            <span style="font-size:0.4cm; letter-spacing:0.2mm;">{{ $awb[0]->alamat_tujuan }}<br></span>
                                        <span class="font-weight-bold" style="font-size:0.25cm;">KODEPOS:</span>
                                            <span style="font-size:0.4cm; letter-spacing:0.2mm;">{{ $awb[0]->kodepos_penerima }}<br></span>
                                        <span class="font-weight-bold" style="font-size:0.25cm;">NO HP:</span>
                                            <span style="font-size:0.4cm; letter-spacing:0.2mm;">{{ $awb[0]->notelp_penerima }} </span>
                                    </td>    
                                </tr>
                            </thead> 
                        </table> 
                        @if($awb[0]->keterangan)
                            <table class="table-striped table-bordered col-10" style='margin-top:0.1cm;'>
                                <thead>
                                    <tr> 
                                        <td class='text-left' style="font-size:0.25cm;position:relative;">
                                            <span style="position:absolute; padding-left:2px;right:0px; top:0px;font-weight:bold;border-left:1px solid black;border-bottom:1px solid black;">Keterangan</span>
                                            <span style="font-size:0.5cm;">{{ $awb[0]->keterangan }}</span>
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
                        // if(data.statussuccess)  {
                        //     // toastr.success( data.statussuccess) 
                        //     // $('#modalpenerima').modal('hide');
                        //     // $('#diterima_oleh'      ).val('')
                        // }  
                        if(data.status != ''){

                            alert(data.status)
                        }
                        window.print();      
                        // scanner.start() 
                    }
                }) 
            }
        </script>
    </body>
</html>
