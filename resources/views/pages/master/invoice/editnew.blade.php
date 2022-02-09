@extends('layouts.app')
@section('content')
<div class="card card-custom gutter-b example example-compact">
<div class="card-header">
    <h3 class="card-title">FORM INVOICE. </h3>
</div>
<form class="form" method="POST"  action="{{url('master/invoice/save')}}" >   
<?php
    $total_kg               = 0;
    $total_koli             = 0;
    $total_doc              = 0;
    $total_oa               = 0;
    $total_bayarall         = 0; 
    $total_komisi_transit   = (100 - ($agenasal->presentasetransit))/100;
    // $total_komisi_transit   = (100 - (int)App\Applicationsetting::checkappsetting('komisi_agen_asal') )/100;
    $total_komisi_agentosub = ((int)App\Applicationsetting::checkappsetting('agentosub_komisi_gsa'))/100;
?>
{{-- @foreach ($awb as $item) 
    @php($total_kg     += $item['qty_kg'])
    @php($total_doc    += $item['qty_doc'])
    @if ($item->qty > 0 && $item->qty_kg == 0 && $item->qty_doc == 0)
        @php($total_koli += $item->qty)
    @else
        @php($total_koli +=$item->qtykoli)
    @endif
    @php($total_oa          += $item->idr_oa)
    @if ($customer->is_agen == 1)
        @php($total_bayarall    += $item->total_harga * (((int)$item->id_kota_transit>0) ?   $total_komisi_transit : $total_komisi_agentosub )    )
    @else
        @php($total_bayarall    += $item->total_harga)
    @endif
@endforeach --}}
<input type="hidden" name="id" value="{{ $invoice->id }}">
<div class=" d-none"> 
    dibuat:             <input type='text' name='mengetahui_oleh'  id='mengetahui_oleh'   value='{{ Auth::user()->id}}'> 
    idcustomer:         <input type='text' name='id_customer'      id='id_customer'       value='{{$customer->id}}'> 
    kg:                 <input type='text' name='total_kg'         id='total_kg'          value='{{$total_kg}}'> 
    koli:               <input type='text' name='total_koli'       id='total_koli'        value='{{$total_koli}}'> 
    doc:                <input type='text' name='total_doc'        id='total_doc'         value='{{$total_doc}}'>  
    harga:              <input type='text' name='total_harga'      id='total_harga'       value='{{$total_bayarall}}'>  
    OA:                 <input type='text' name='total_oa'         id='total_oa'          value='{{$total_oa}}'>    
</div>
{{ csrf_field() }}
<div class="card-body">
    <div class="row"> 
        <div class="form-group col-lg-3">
            <label>Customer  : </label>
            <h4>{{$customer->nama}}</h4>
        </div> 
        <div class="form-group col-lg-3">
            <label>Alamat: </label>
            <h4>{{$customer->alamat}}</h4>
        </div> 
        <div class="form-group col-lg-3">
            <label>No Telp: </label>
            <h4>{{$customer->notelp}}</h4>
        </div> 
        <div class="form-group col-lg-3">
            <label>Tanggal:</label>
            <h4>{{ Carbon\Carbon::now()->addHours(7)->toDateString()}}</h4>
        </div> 
        <div class="form-group col-lg-3">
            <label>Dikerjakan oleh: </label>
            <h4>{{ Auth::user()->username}}</h4>
        </div> 
        <div class="form-group col-lg-3">
            <label>Total:</label>
            <table class="table  table-bordered">
                <tr>
                    <th>koli</th>
                    <th>kg</th>
                    <th>doc</th>
                <tr>
                <tr>
                    <td id="total_koli_td">{{$total_koli}}</td>
                    <td id="total_kg_td">{{$total_kg}}</td>
                    <td id="total_doc_td">{{$total_doc}}</td>
                <tr>
            </table>
        </div>
        <div class="form-group col-lg-3">
            <label>Keterangan:</label>
            <textarea   class="form-control" name="keterangan" value="{{ $invoice->keterangan}}" />{{ (old('keterangan') && old('keterangan') !='') ?old('keterangan'): $invoice->keterangan  }}</textarea>
        </div>
        <div class="table-responsive-sm col-12">
            <table class="table table-striped table-bordered"  >
                <thead>
                    <tr>
                        <th style="width:10px;">
                            <input type="checkbox" class="pilihsemuaawb" name="checkall" checked="checked"> 
                        </th> 
                        <th class='text-center' style="width:10px;">NO</th> 
                        <th style="width:10%;">TANGGAL</th>  
                        <th style="width:7%;">AWB</th>  
                        <th style="width:10%;">No.Manifest</th>  
                        <th style="width:10%;">ASAL</th>  
                        
                        @if ((int)$customer->is_agen == 1)
                            <th style="width:10%;">Transit</th>  
                        @endif
                        <th style="width:10%;">Tujuan</th>  
                        <th style="width:10%;">Penerima</th> 
                        <th style="width:10%;">Koli</th>  
                        
                        @if ((int)$customer->is_agen == 0)
                            <th style="width:5%;">Kg</th>  
                            <th style="width:5%;">Doc</th>   
                            <th style="width:10%;">KET</th> 
                            <th style="width:8%;">Biaya OA</th>  
                            <th style="width:10%;">Total Bayar</th>  
                        @elseif ((int)$customer->is_agen == 1)
                            <th style="width:10%;">KET</th> 
                            <th style="width:8%;">Harga Agen</th>  
                            <th style="width:10%;">Biaya Handling</th>  
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($awb as $item)
                    <tr style="padding:0px; @if($item['total_harga'] <= 0)background-color: #ffadad; @endif"  >
                        <td>
                            <input type="checkbox" class="pilihawb" name="servis[]" value="{{$item->id}}" id="idawb_{{$item->id}}"          checked="checked"> 
                            <input type="hidden"    name="ids[]"    value="id_awb_{{ $item->id}}" > 
                        </td>   
                        <td class='text-center' style="padding:5px;">{{ $loop->index+1 }}</td>   
                        <td style="padding:5px;">{{$item->tanggal_awb}}</td>  
                        <td style="padding:5px;">{{$item->noawb}}</td>  
                        <td style="padding:5px;">{{$item->kodemanifest}}</td>  
                        <td style="padding:5px;">{{$item->kotaasal}}</td>   
                        
                        @if ((int)$customer->is_agen == 1)
                            <td style="width:10%;">{{$item->kotatransit}}</td>  
                        @endif
                        <td style="padding:5px;">{{$item->kotatujuan}}</td> 
                        <td style="padding:5px;">{{$item->diterima_oleh}}</td> 
                        <td style="padding:5px;">
                            @if(($item->qty_kecil == 0 && $item->qty_sedang == 0 && $item->qty_besar == 0 && $item->qty_besarbanget==0 && $item->qty_kg==0 && $item->qty_doc==0) && $item->qty>0)
                            {{$item->qty}}
                            @else
                            <table style="table" style="background-color:white;">
                                <tr style="background-color:white;">
                                    <td style="padding:5px; font-weight:bold;">K</td>
                                    <td style="padding:5px; font-weight:bold;">S</td>
                                    <td style="padding:5px; font-weight:bold;">B</td>
                                    <td style="padding:5px; font-weight:bold;">BB</td>
                                </tr>                                    
                                <tr style="background-color:white;">
                                    <td style="padding:5px;">{{$item->qty_kecil}}</td>
                                    <td style="padding:5px;">{{$item->qty_sedang}}</td>
                                    <td style="padding:5px;">{{$item->qty_besar}}</td>
                                    <td style="padding:5px;">{{$item->qty_besarbanget}}</td>
                                </tr>    
                            </table>    
                            @endif
                        </td> 
                        @if ((int)$customer->is_agen == 0)
                            <td style="padding:5px;">{{$item->qty_kg}}</td> 
                            <td style="padding:5px;">{{$item->qty_doc}}</td> 
                            <td style="padding:5px;">{{$item->keterangan}}</td>                             
                            <td style="padding:5px;">{{number_format($item->idr_oa)}}</td> 
                            <td style="padding:5px;">{{number_format($item->total_harga, 0) }}</td> 
                            
                        @elseif ((int)$customer->is_agen == 1)
                            <td style="padding:5px;">{{$item->keterangan}}</td>               
                            <td style="padding:5px;">{{number_format($item->total_harga, 0) }}</td> 
                            <th style="width:10%;">
                                {{number_format(($item->total_harga * (((int)$item->id_kota_transit>0) ?   $total_komisi_transit : $total_komisi_agentosub )), 0) }}
                            </th>  
                        @endif
                    </tr>   
                    @endforeach 
                    <tr style="padding:0px; background-color:#a1ffbc;"> 
                        <td style="padding:5px;" colspan='
                        
                        @if ((int)$customer->is_agen == 1)
                            9
                        @else
                            8
                        @endif
                        ' class="text-right"><h4>TOTAL <br>
                        
                            <span class="font-weight-bold text-uppercase font-italic">({{App\Invoice::terbilang($total_bayarall)}} Rupiah)</span></h4></td>   
                        <td style="padding:5px;font-weight:bold !important;" id="total_koli_bottom"><h4>{{$total_koli}}</h4></td>   
                        @if ((int)$customer->is_agen == 0)
                            <td style="padding:5px;font-weight:bold !important;" id="total_kg_bottom" ><h4>{{$total_kg}}</h4></td>   
                            <td style="padding:5px;font-weight:bold !important;" id="total_doc_bottom" ><h4>{{$total_doc}}</h4></td>   
                            <td style="padding:5px;font-weight:bold !important;"><h4></h4></td> 
                            <td style="padding:5px;font-weight:bold !important;" id="total_oa_bottom" ><h4>{{number_format($total_oa, 0) }}</h4></td> 
                        @elseif ((int)$customer->is_agen == 1)
                            <td style="padding:5px;font-weight:bold !important;"><h4></h4></td> 
                            <th style="width:10%;"></th>  
                        @endif
                        <td style="padding:5px;font-weight:bold !important;" id="total_bayar_bottom"><h4>{{number_format($total_bayarall, 0) }}</h4></td>                             
                    </tr>     
                </tbody>
            </table>
             
        </div> 
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-lg-6">
                <button type="submit" id='simpanbutton' class="btn btn-primary mr-2">SIMPAN</button>
                @if ($invoice->id == 0)<button type="reset" class="btn btn-secondary">Cancel</button>@endif
            </div>
        </div>
    </div>
    </form>
</div>
@endsection
@section('script')
<script type="text/javascript">

    $('form').submit(function () {
        var awb                     = <?= json_encode($awb) ?>;
        var adayangdicentang        = false;
        for (var i = 0 ; i < awb.length; i++){
            if($("#idawb_"+awb[i]['id']).prop('checked')==true){
                adayangdicentang = true;
            }
        }
        if(adayangdicentang==true){
            return true;
        }else{
            $('#simpanbutton').attr("disabled", false);
            alert('Harap pilih AWB yang akan ditagihkan !')
            return false;
        }
    });

    hitung()
    $('.pilihawb').click(function(){
        hitung();
    })
    $('.pilihsemuaawb').click(function(){
        var trueorfalse = ($(this).prop('checked')==true) ? true :false;        
        $('.pilihawb').prop('checked', trueorfalse);
        hitung();
    })
    function hitung(){       
        var awb                     = <?= json_encode($awb) ?>;
        var total_komisi_transit    = <?= $total_komisi_transit ?>;
        var total_komisi_agentosub  = <?= $total_komisi_agentosub ?>;
        var customer                = <?= $customer ?>;
        var total_kg                = 0;
        var total_koli              = 0;
        var total_doc               = 0;
        var total_oa                = 0;
        var total_bayarall          = 0; 
        var _adayangfalse           = true;
        for (var i = 0 ; i < awb.length; i++){
            if($("#idawb_"+awb[i]['id']).prop('checked')==true){
                total_kg     += Number(awb[i]['qty_kg'])
                total_doc    += Number(awb[i]['qty_doc'])
                if (awb[i]['qty'] > 0 && awb[i]['qty_kg'] == 0 && awb[i]['qty_doc'] == 0){
                    total_koli +=Number( awb[i]['qty'])
                }
                else{
                    total_koli +=Number(awb[i]['qtykoli'])
                }
                total_oa          += Number(awb[i]['idr_oa']);
                if (customer['is_agen'] == 1){
                    // console.log(((Number(awb[i]['id_kota_transit'])>0) ?   total_komisi_transit : total_komisi_agentosub )    )
                    total_bayarall    += Number(awb[i]['total_harga']) * ((Number(awb[i]['id_kota_transit'])>0) ?   Number(total_komisi_transit) : Number(total_komisi_agentosub) )    
                }
                else{
                    total_bayarall    += Number(awb[i]['total_harga'])
                }
            }
            else{
                _adayangfalse = false;
            }

        } 
        $('.pilihsemuaawb').prop('checked', _adayangfalse);
        $('#total_kg'       ).val(total_kg)
        $('#total_koli'     ).val(total_koli)
        $('#total_doc'      ).val(total_doc)
        $('#total_harga'    ).val(total_bayarall)
        $('#total_oa'       ).val(total_oa)

        $("#total_koli_td"  ).html(total_koli)
        $("#total_kg_td"    ).html(total_kg)
        $("#total_doc_td"   ).html(total_doc)

        $("#total_bayar_bottom" ).html(total_bayarall)
        $("#total_koli_bottom"  ).html(total_koli)
        $("#total_kg_bottom"    ).html(total_kg)
        $("#total_doc_bottom"   ).html(total_doc)
        $("#total_oa_bottom"    ).html(total_oa)
    } 
</script>
@if(Session::get('message') == "kodesudahada")
<script type="text/javascript">
    toastr.error("Kode manifest sudah ada!");
</script>
@endif
@endsection