<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>INVOICE</title> 
        <link rel="stylesheet" href="{{asset('assets/gsa/fa/css/font-awesome.min.css')}}">
        <link href="{{asset('assets/gsa/css/boots_a4.css')}}" rel="stylesheet" />
        <link href="" rel="stylesheet" />
        <script type="text/javascript" src="{{asset('assets/gsa/js/jquery.min.js')}}"></script>
        <style>
            .showonprint{
                display: none;
            }
            @page {
                size: A4;
                margin: 0;
            }
            @media print { 
                  tr,th,td {
                    page-break-inside: avoid !important;
                }
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
    <?php
        

        ?>
    <body oncontextmenu="return false" class="snippet-body" style="background-color:white;">
        <div class="printcontainer d-print-none no-print" onclick="window.print()">  <i class="fa fa-print" aria-hidden="true"></i>&nbsp;PRINT 
        </div>
            <div class="card page">
                @for ($i = 0; $i < 2; $i++)
                    
                
                <div class="card-header row" style="padding:0px !important; 
                @if($i==1)
                border-top:1px solid black;
                @endif
                "> 
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
                        <b style="font-size:0.4cm;">INVOICE</b>

                     </div>
                </div>
                <div class="card">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                           <table  style="font-size:0.35cm;">
                               <tr>
                                   <td><b>Customer </b></td>
                                   <td>:&nbsp;{{$awb[0]->nama_pengirim}}</td>
                               </tr>
                               <tr>
                                   <td><b>Alamat </b></td>
                                   <td>:&nbsp;{{$awb[0]->alamat_pengirim}}</td>
                               </tr>
                               <tr>
                                   <td><b>Telp/fax </b></td>
                                   <td>:&nbsp;{{$awb[0]->notelp_pengirim}}</td>
                               </tr>
                           </table>
                        </div>
                        <div class="col-sm-6">
                            <table  style="font-size:0.35cm;">
                                <tr>
                                    <td><b>No INV </b></td>
                                    <td>:&nbsp;{{$kodeinvawb}}</td>
                                </tr>
                                <tr>
                                    <td><b>Date </b></td>
                                    <td>:&nbsp;{{$awb[0]->tanggal_awb}}</td>
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
                                    @if ((int)$awb[0]->is_agen == 1)
                                        <th style="width:10%;">Transit</th>  
                                    @endif
                                    <th style="padding:5px;width:10%;">Tujuan</th>                                      
                                    <th style="padding:5px;width:10%;">Penerima</th>  
                                    <th style="padding:5px;width:10%;">Koli</th>  
                                    @if ((int)$awb[0]->is_agen == 0)
                                        <th style="padding:5px;width:5%;">Kg</th>  
                                        <th style="padding:5px;width:5%;">Doc</th>   
                                        <th style="padding:5px;width:10%;">KET</th>  
                                        <th style="padding:5px;width:10%;">Total Bayar</th>  
                                    @elseif ((int)$awb[0]->is_agen == 1)
                                        <th style="padding:5px;width:10%;">KET</th> 
                                        <th style="padding:5px;width:10%;">Harga Agen</th>  
                                        <th style="padding:5px;width:10%;">Biaya Handling</th>  
                                    @endif 
                                </tr>
                            </thead>
                            <tbody>  
                                <tr style="padding:0px;">
                                    <td class='text-center' style="padding:5px;padding-left:2px;">1</td>   
                                    <td style="padding:5px;padding-left:2px;">{{$awb[0]->tanggal_awb}}</td>  
                                    <td style="padding:5px;padding-left:2px;">{{$awb[0]->noawb}}</td>  
                                    <td style="padding:5px;padding-left:2px;">{{$awb[0]->kodemanifest}}</td>  
                                    <td style="padding:5px;padding-left:2px;">{{$awb[0]->kotaasal}}</td>   
                                    @if ((int)$awb[0]->is_agen == 1)
                                        <td style="padding:5px;padding-left:2px;">{{$awb[0]->kotatransit}}</td>  
                                    @endif
                                    <td style="padding:5px;padding-left:2px;">{{$awb[0]->kotatujuan}}
                                        @if ($awb[0]->labelalamat !== '' && $awb[0]->labelalamat !==null)                                        
                                            <br>(<i>{{$awb[0]->labelalamat}}</i>)
                                        @endif
                                    </td> 
                                    <td style="padding:5px;padding-left:2px;">{{$awb[0]->nama_penerima}}</td> 
                                    <td style="padding:5px;padding-left:2px;"> 
                                        {{$awb[0]->jumlah_koli}}
                                        
                                    </td>  
                                    <td style="padding:5px;padding-left:2px;">{{$awb[0]->qty_kg   }}</td> 
                                    <td style="padding:5px;padding-left:2px;">{{$awb[0]->qty_doc}}</td> 
                                    <td style="padding:5px;padding-left:2px;">{{$awb[0]->keterangan}}</td>  
                                    <td style="padding:5px;padding-left:2px; text-align:right;">
                                        @if((int)$awb[0]->id_customer==26 || (int)$awb[0]->id_kota_transit>0)
                                            @if($awb[0]->harga_gsa == 0)
                                                <b style="padding-left:5px;">{{number_format($awb[0]->total_harga, 0)}}</b>
                                            @else
                                                <b style="padding-left:5px;">{{number_format($awb[0]->harga_gsa, 0)}}</b>
                                            @endif
                                        @endif        
                                    </td>     
                                </tr>    
                                <tr style="padding:0px; background-color:#a1ffbc;"> 
                                    <td style="padding:5px;padding-left:2px;" colspan='
                                    @if ((int)$awb[0]->is_agen == 1)
                                        8
                                    @else
                                        7
                                    @endif
                                    ' class="text-right">Total Bayar</td>    
                                    <td style="padding:5px;padding-left:2px;font-weight:bold !important; text-align:right;" colspan="5">
                                        @if((int)$awb[0]->id_customer==26 || (int)$awb[0]->id_kota_transit>0)
                                            @if($awb[0]->harga_gsa == 0)
                                                <b style="padding-left:5px;">{{number_format($awb[0]->total_harga, 0)}}</b>
                                            @else
                                                <b style="padding-left:5px;">{{number_format($awb[0]->harga_gsa, 0)}}</b>
                                            @endif
                                        @endif            
                                    </td>                            
                                    
                                </tr>     
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered" >
                            <thead>
                                <tr> 
                                    <td class='text-center' style="font-size:0.35cm;">TERBILANG : 
                                        <span style="font-weight:bold; text-transform:uppercase;"> 
                                            @if((int)$awb[0]->id_customer==26 || (int)$awb[0]->id_kota_transit>0)
                                            @if($awb[0]->harga_gsa == 0)
                                                    {{App\Invoice::terbilang($awb[0]->total_harga)}}  
                                                @else
                                                    {{App\Invoice::terbilang($awb[0]->harga_gsa)}}  
                                                @endif
                                            @endif  
                                            Rupiah
                                        </span>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="row font-weight-bold" style="font-size:0.35cm;">
                        <div class="col-6 text-center">
                            DIKERJAKAN OLEH    <br><br><br><br><br>
                            {{Auth::user()->nama}}<br> 
                        </div> 
                        <div class="col-6 text-center">
                            MENGETAHUI    <br><br><br><br><br>
                             
                        </div> 
                    </div>
                </div>
                <div class="card-footer bg-white" style="font-size:0.35cm; display:none;">
                    <p class="mb-0" ><mark style="background-color:#cff;">* Pembayaran dengan Transfer ke BCA CABANG JUANDA a/n Global Service Asia Rek. 667 0230099</mark></p>
                    <p class="mb-0" ><mark style="background-color:#cff;">* Pembayaran maksimal 3 hari sejak invoice diterima.</mark></p>
                    <p class="mb-0" ><mark style="background-color:#cff;">* Pembayaran melalui Cek atau Giro dianggap LUNAS apabila sudah DIUANGKAN.</mark></p>
                </div>
                @endfor
            </div>
        <script type="text/javascript" src="{{asset('assets/gsa/js/bootstrap.bundle.min.js')}}"></script>
        <script type="text/javascript"></script>
    </body>
</html>
