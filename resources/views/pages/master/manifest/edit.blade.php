@extends('layouts.app')
@section('content')
<div class="card card-custom gutter-b example example-compact">
<div class="card-header">
    <h3 class="card-title">FORM MANIFEST </h3>
</div>
<form class="form" method="POST"  action="{{url('master/manifest/save')}}" >   
@php($total_kg      = 0)   
@php($total_koli    = 0)   
@php($total_doc     = 0)   
@foreach ($awb as $item) 
    @php($total_kg     += $item['qty_kg'])
    @php($total_doc    += $item['qty_doc'])
    @if ($item->qty > 0 && $item->qtykoli == 0)
        @php($total_koli += $item->qty)
    @else
        @php($total_koli +=$item->qtykoli)
    @endif
@endforeach
<input type="hidden" name="id" value="{{ $manifest->id }}">
<div class="d-none ">
    tujuan:       <input type='text' name='id_kota_tujuan'          value='{{$kotatujuan[0]['id']}}'>
    asal:     <input type='text' name='id_kota_asal'          value='{{$kotaasal[0]['id']}}'>
    dibuat:     <input type='text' name='dibuat_oleh'           value='{{ Auth::user()->id}}'> 
    kg:         <input type='text' name='jumlah_kg'             value='{{$total_kg}}'> 
    koli:       <input type='text' name='jumlah_koli'           value='{{$total_koli}}'> 
    doc:        <input type='text' name='jumlah_doc'            value='{{$total_doc}}'>  
</div>
{{ csrf_field() }}
<div class="card-body">
    <div class="row"> 
        <div class="form-group col-lg-3">
            <label>Kota asal:</label>
            <h3>{{$kotaasal[0]['nama']}}</h3>
        </div> 
        <div class="form-group col-lg-3">
            <label>Kota tujuan:</label>
            <h3>{{$kotatujuan[0]['nama']}}</h3>
        </div> 
        <div class="form-group col-lg-3">
            <label>dibuat oleh: </label>
            <h3>{{ Auth::user()->username}}</h3>
        </div> 
        <div class="form-group col-lg-3">
            <label>Tanggal:</label>
            <h3>{{ Carbon\Carbon::now()->addHours(7)->toDateString()}}</h3>
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
                    <td>{{$total_koli}}</td>
                    <td>{{$total_kg}}</td>
                    <td>{{$total_doc}}</td>
                <tr>
            </table>
        </div>
        <div class="form-group col-lg-3">
            <label>Dibawa oleh:</label>
            <input type="text" required class="form-control" name="supir" value="{{ (old('supir') && old('supir') !='') ?old('supir'): $manifest->supir  }}" />        
        </div>
        <div class="form-group col-lg-3">
            <label>Keterangan:</label>
            <textarea   class="form-control" name="keterangan" value="{{ $manifest->keterangan}}" />{{ (old('keterangan') && old('keterangan') !='') ?old('keterangan'): $manifest->keterangan  }}</textarea>
        </div>
        <div class="table-responsive-sm col-12">
            <table class="table table-striped table-bordered"  >
                <thead>
                    <tr>
                        <th class='text-center' style="width:10px;">NO</th> 
                        <th style="width:1cm;">AWB</th> 
                        <th style="width:150px;">PENGIRIM</th> 
                        <th style="width:1cm;">PENERIMA</th> 
                        <th style="width:1cm;">TUJUAN</th> 
                        <th style="width:1cm;">KL</th> 
                        <th style="width:1cm;">KG</th> 
                        <th style="width:1cm;">doc</th> 
                        <th style="width:1cm;">D/P</th>  
                        <th style="width:1cm;">KET</th> 
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
                        <td style="padding:5px;"></td>  
                        <td style="padding:5px;">{{$item->keterangan}}</td> 
                    </tr>   
                    @endforeach   
                </tbody>
            </table>
             
        </div> 
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-lg-6">
                <button type="submit" id='simpanbutton' class="btn btn-primary mr-2">SIMPAN</button>
                @if ($manifest->id == 0)<button type="reset" class="btn btn-secondary">Cancel</button>@endif
            </div>
        </div>
    </div>
    </form>
</div>
@endsection
@section('script')
<script type="text/javascript"> </script>
@if(Session::get('message') == "kodesudahada")
<script type="text/javascript">
    toastr.error("Kode manifest sudah ada!");
</script>
@endif
@endsection