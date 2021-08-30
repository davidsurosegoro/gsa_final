@extends('layouts.app')
@section('content')
<div class="card card-custom gutter-b example example-compact">
<div class="card-header">
    <h3 class="card-title">FORM BUAT DATA INVOICE </h3>
</div>
  
<div class="card-body">
    <div class="row">
        @foreach ($awb as $item)
        <div class="col-3">
            <div class="card col-12 bg-light" style="padding:0px;">
                <div class="card-body"  style="padding:10px;">
                    <span class="badge badge-warning"> {{$item->total}} AWB belum ditagihkan</span><br><br>
                    <h1  >
                        {{$item->kodecustomer}}
                    </h1>
                    <h5  >
                        {{$item->namacustomer}}
                    </h5><br>
                    <a href="{{url('master/invoice/edit/'.$item->idcustomer)}}" class="btn btn-primary">Buat Invoice</a>
                </div>
            </div>           
        </div>
        @endforeach
    </div>     
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