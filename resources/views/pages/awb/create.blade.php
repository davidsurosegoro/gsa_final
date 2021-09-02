@extends('layouts.app')
@section('content')

<div class="card card-custom gutter-b example example-compact">
  <div class="card-header">
    <h3 class="card-title">Form Pengisian AWB </h3>
  </div>
  @if(!empty($alamat_tujuan_array))
    <input type="hidden" id="check_alamat_tujuan" value="1">
  @else
    <input type="hidden" id="check_alamat_tujuan" value="0">
  @endif
  @if(!empty($alamat_pengirim_array))
    <input type="hidden" id="check_alamat_pengirim" value="1">
  @else
    <input type="hidden" id="check_alamat_pengirim" value="0">
  @endif
<form class="form" method="POST" action="{{ url('awb/save')}}">
  {{ csrf_field() }}
  <input type="hidden" name="idawb" value="{{ $id }}">
  <div class="card-body">
    <div class="row">
        <div class="card-body mb-5">
          <h6 class="panel-title txt-dark" style="border-bottom:1px solid #EBEDF3;"><i class="flaticon-profile-1"> </i> Data Umum Pengiriman</h6>
          <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Customer</label>
                  <select id="customer" style="width:90%" class="select2 form-control" name="id_customer" required>
                    @if((int)Auth::user()->level == 1)
                      <option value="">--Pilih Customer--</option>
                      @foreach($customer as $c)
                        @if($c->id == $awb->id_customer)
                          <option value="{{ $c->id }}" selected>{{ $c->nama }}</option>
                        @else
                          <option value="{{ $c->id }}">{{ $c->nama }}</option>
                        @endif
                      @endforeach
                    @else
                    <option value="">--Pilih Customer--</option>
                      @if($id == 0)
                        <option value="{{ $customer->id }}">{{ $customer->nama }}</option>
                      @else
                        <option value="{{ $customer->id }}" selected>{{ $customer->nama }}</option>
                      @endif
                    @endif
                  </select>
                </div>
              </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Tanggal:</label>
                    <div class="input-group date">
                      <input name="tanggal_awb" type="text" class="form-control datepicker" value="{{ date('m/d/Y') }}" readonly="true" placeholder="Select date">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="la la-calendar-check-o"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
          </div>
      </div>
    </div>
    <div class="row">
      
      <div class="card-body">
        <h6 class="panel-title txt-dark"><i class="flaticon-shopping-basket"> </i>Data Jumlah Barang</h6>
          @if((int)Auth::user()->level !== 1 && $customer->can_access_satuan !== 1)
          <div class="row">
            <div class="col-lg-4">
              <div class="form-group">
                <label>Qty</label>
                <input type="number" class="form-control" value="{{ $awb->qty }}" name="qty" placeholder="Input jumlah koli kecil. . ." value="0">
              </div>
            </div>
          </div>
          @else
          <div class="row" id="qty-detail">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Qty Koli Kecil</label>
                <input type="number" class="form-control" value="{{ $awb->qty_kecil }}" name="qty_kecil" placeholder="Input jumlah koli kecil. . ." value="0">
              </div>
              <div class="form-group">
                <label>Qty Koli Sedang</label>
                <input type="number" class="form-control" value="{{ $awb->qty_sedang }}" name="qty_sedang" placeholder="Input jumlah koli sedang. . ." value="0">
              </div>
              
              <div class="form-group">
                <label>Qty Koli Besar</label>
                <input type="number" class="form-control" value="{{ $awb->qty_besar }}" name="qty_besar" placeholder="Input jumlah koli besar. . ." value="0">
              </div>
            </div>
            <div class="col-lg-6">
              
              <div class="form-group">
                <label>Qty Koli Besar Banget</label>
                <input type="number" class="form-control" value="{{ $awb->qty_besarbanget }}" name="qty_besar_banget" placeholder="Input jumlah koli besar_banget. . ." value="0">
              </div>
              <div class="form-group">
                <label>Qty Koli Kg</label>
                <input type="number" class="form-control" value="{{ $awb->qty_kg }}" name="qty_kg" placeholder="Input jumlah koli kg. . ." value="0">
              </div>
              <div class="form-group">
                <label>Qty Koli Dokumen</label>
                <input type="number" class="form-control" value="{{ $awb->qty_doc }}" name="qty_doc" placeholder="Input jumlah koli dokumen. . ." value="0">
              </div>
            </div>
          </div>
          <div class="row" id="customer-biasa">
              
            <div class="col-md-12">
              <div class="alert alert-custom alert-light-dark fade show mb-5" role="alert">
                <div class="alert-icon">
                  <i class="flaticon-warning"></i>
                </div>
                <div class="alert-text"><strong>INFO</strong> Customer yang anda pilih diatas adalah agen</div>
                <div class="alert-close">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                      <i class="ki ki-close"></i>
                    </span>
                  </button>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Qty</label>
                <input type="number" class="form-control" id="qty_biasa" value="{{ $awb->qty }}" name="qty" placeholder="Input jumlah koli kecil. . .">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Harga Total</label>
                <input type="text" class="form-control rupiah" id="harga_total" value="{{ $awb->harga_total }}" name="harga_total" placeholder="Input harga total. . ." >
              </div>
            </div>
          </div>
          @endif
      </div>
    </div>
    
    <div class="row">
      
      <div class="card-body">
        <h6 class="panel-title txt-dark"><i class="flaticon-truck"> </i>Data Penerima dan Pengirim</h6>
        <br>
        <div class="row">
          <div class="col-lg-6">
              <div class="form-group">
                <label>Nama Penerima</label>
                <input type="text" id="nama_penerima" class="form-control" value="{{ $awb->nama_penerima }}" name="nama_penerima" placeholder="Input Nama Penerima. . ." required>
              </div>
              <div class="form-group">
                <label>Alamat Tujuan Penerima</label>
                <select id="alamat_tujuan_auto" class="form-control mb-2" name="alamat_tujan_auto"> 
                  @if($id == 0)
                  <option value="manual">Input Alamat Manual</option>
                  @else
                      @foreach($master_alamat as $a):
                        @if($a->alamat == $awb->alamat_tujuan)
                          <option value="{{ $a->alamat }}" selected>{{ $a->labelalamat }}</option>
                        @else
                          <option value="{{ $a->alamat }}">{{ $a->labelalamat }} </option>
                        @endif
                      @endforeach
                      @if(!empty($alamat_tujuan_array))
                        <option value="manual">Input Alamat Manual</option>
                      @else
                        <option value="manual" selected>Input Alamat Manual</option>
                      @endif
                  @endif
              </select>
              <input type="text" class="form-control" id="alamat_tujuan" value="{{ $awb->alamat_tujuan }}" name="alamat_tujuan" placeholder="Input Alamat tujuan. . ." required>
              </div>
            <div class="form-group">
              <label>Kode Pos Penerima</label>
              <input type="text" id="kodepos_penerima" class="form-control" value="{{ $awb->kodepos_penerima }}" name="kodepos_penerima" placeholder="Input Kode Pos. . ." required>
            </div>
            <div class="form-group">
              <label>No Telp Penerima</label>
              <input type="text" id="notelp_penerima" class="form-control" value="{{ $awb->notelp_penerima }}" name="notelp_penerima" placeholder="Input Nomor Telp Penerima. . ." required>
            </div>
          </div>
          <div class="col-lg-6">
              <div class="form-group">
                <label>Nama Pengirim</label>
                <input type="text" id="nama_pengirim" class="form-control" value="{{ $awb->nama_pengirim }}" name="nama_pengirim" placeholder="Input Nama Pengirim. . ." required>
              </div>
              <div class="form-group">
                <label>Alamat Pengirim</label>
                {{-- <select id="alamat_pengirim_auto" class="form-control mb-2" name="alamat_pengirim_auto"> 
                    @if($id == 0)
                    <option value="manual">Input Alamat Manual</option>
                    @else
                      @foreach($master_alamat as $a):
                        @if($a->alamat == $awb->alamat_pengirim)
                          <option value="{{ $a->alamat }}" selected>{{ $a->labelalamat }}</option>
                        @else
                          <option value="{{ $a->alamat }}">{{ $a->labelalamat }} </option>
                        @endif
                      @endforeach
                      @if(!empty($alamat_pengirim_array))
                        <option value="manual">Input Alamat Manual</option>
                      @else
                        <option value="manual" selected>Input Alamat Manual</option>
                      @endif
                    @endif
                </select> --}}
                <input type="text" id="alamat_pengirim" class="form-control mb-2" value="{{ $awb->alamat_pengirim }}" name="alamat_pengirim" placeholder="Input Alamat Manual. . .">
              </div>
            <div class="form-group">
              <label>Kode Pos Pengirim</label>
              <input type="text" id="kodepos_pengirim" class="form-control" value="{{ $awb->kodepos_pengirim }}" name="kodepos_pengirim" placeholder="Input Kode Pos. . ." required>
            </div>
            <div class="form-group">
              <label>No Telp Pengirim</label>
              <input type="text" id="notelp_pengirim" class="form-control" value="{{ $awb->notelp_pengirim }}" name="notelp_pengirim" placeholder="Input Nomor Telp Pengirim. . ." required>
            </div>  
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      
      <div class="card-body">
        <h6 class="panel-title txt-dark"><i class="flaticon-truck"> </i>Data Pengiriman</h6>
        <br>
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label>Kota Asal</label>
              <select style="width:90%" class="select2 form-control" id="kota_asal" name="id_kota_asal" readonly="true" required >
                <option value="">--Pilih Kota Asal--</option>
                @foreach($kota as $c)
                  @if($id !== "0")
                    @if($c->id == $awb->id_kota_asal)
                      <option value="{{ $c->id }}" selected>{{ $c->nama }}</option>
                    @else
                    <option value="{{ $c->id }}">{{ $c->nama }}</option>
                    @endif
                  @else
                    @if($c->kode == "SUB")
                      <option value="{{ $c->id }}" selected>{{ $c->nama }}</option>
                    @else
                      <option value="{{ $c->id }}">{{ $c->nama }}</option>
                    @endif
                  @endif
                @endforeach
              </select>
            </div>
            @if((int)Auth::user()->level == 1)
            {{-- <div class="form-group">
              <label>Agen Asal</label>
              <select style="width:90%" class="select2 form-control"  id="agen_asal" name="id_agen_asal" required>
                <option value="">--Pilih Kota Asal Terlebih Dahulu--</option>
                
                @if($id !== "0")
                  <option value="{{ $agen_asal->id }}" selected>{{ $agen_asal->nama }}</option>
                @endif
              </select>
              <span class="form-text text-warning">Opsi Agen Asal akan muncul otomatis sesuai dengan pilihan Kota Asal</span>
           
            </div> --}}
            <div class="form-group">
              <label>Kota Transit</label>
              <select style="width:90%" class="select2 form-control" name="id_kota_transit" >
                <option value="">--Pilih Kota Transit--</option>
                @foreach($kota as $c)
                  @if($c->id == $awb->id_kota_transit)
                    <option value="{{ $c->id }}" selected>{{ $c->nama }}</option>
                  @else
                  <option value="{{ $c->id }}">{{ $c->nama }}</option>
                  @endif
                @endforeach
              </select>
            </div>
            @endif
            
            
            <div class="form-group">
              <label>Ada Faktur</label>
              <label class="checkbox checkbox-primary">
                @if($awb->ada_faktur == 1)
                <input type="checkbox" name="ada_faktur" checked="checked">
                @else
                <input type="checkbox" name="ada_faktur">
                @endif
                <span></span> Faktur Tersedia</label>
                <span class="form-text text-muted"></span>
            </div>
          </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Kota Tujuan</label>
                <select style="width:90%" class="select2 form-control" id="kota_tujuan" name="id_kota_tujuan" required>
                  <option value="">--Pilih Kota Tujuan--</option>
                  @foreach($kota as $c)
                    @if($c->id == $awb->id_kota_tujuan)
                      <option value="{{ $c->id }}" selected>{{ $c->nama }}</option>
                    @else
                    <option value="{{ $c->id }}">{{ $c->nama }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
              
            <div class="form-group">
              <label>Kecamatan Tujuan</label>
              <select style="width:90%" class="select2 form-control" id="kecamatan_tujuan" name="id_kecamatan_tujuan" required>
                <option value="">--Pilih Kecamatan Tujuan--</option>
                @if($awb->id == 0)
                  <option value="{{ $awb->id_kecamatan_tujuan }}">{{ $awb->nama_kecamatan_tujuan }} </option>
                @else
                  @foreach($kecamatan_tujuan as $k)
                    @if($k->id == $awb->id_kecamatan_tujuan)
                    <option value="{{ $k->id }}" selected>{{ $k->nama }} </option>
                    @else
                    <option value="{{ $k->id }}">{{ $k->nama }} </option>
                    @endif
                  @endforeach
                @endif
              </select>
            </div>
            @if((int)Auth::user()->level == 1)
            <div class="form-group">
              <label>Agen Tujuan</label>
              <select style="width:90%" class="select2 form-control" id="agen_tujuan" name="id_agen_penerima" required>
                <option value="">--Pilih  Kota Tujuan Terlebih Dahulu--</option>
                @if($id !== "0")
                @foreach($agen_master as $a)
                    @if($awb->id_agen_penerima == $a->agen_id)
                      <option value="{{ $a->agen_id }}" selected>{{ $a->agen_nama }}</option>
                      @else
                      <option value="{{ $a->agen_id }}">{{ $a->agen_nama }}</option>
                    @endif
                  @endforeach
                @endif
              </select>
              <span class="form-text text-warning">Opsi Agen Tujuan akan muncul otomatis sesuai dengan pilihan Kota Tujuan</span>
            </div>
            {{-- <div class="form-group">
              <label>Status Out Area </label>
              <label class="checkbox checkbox-danger">
                  @if($awb->charge_oa == 0)
                  <input type="checkbox" name="charge_oa">
                  @else
                  <input type="checkbox" name="charge_oa" checked="checked">
                  @endif
                <span></span>Kenakan Charge Out Area</label>
                <span class="form-text text-muted">Biaya Out Area Customer akan ditambahkan ketika dikenakan charge out area</span>
            </div> --}}
            @endif
          </div>

        </div>
        
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <label>Keterangan tambahan :</label>
              <textarea name="keterangan" rows="4" class="form-control"> {{ $awb->keterangan }}</textarea>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="card-footer d-flex justify-content-between">
    <button type="submit" class="btn btn-primary mr-2">SIMPAN</button>
  </div>
</form>
</div>
@endsection
@section('script')
<script>
  $('#customer-biasa').hide();
  // $('#kota_asal').on('change',function(){
  //   $.ajax({
  //     method:'POST',
  //     url:'{{ url("awb/filter-kota-agen") }}',
  //     data:{
  //       kota_id: $(this).val(),
  //       '_token': $('input[name=_token]').val()
  //     },
  //     success:function(data){
  //       console.log(data);
  //       $('#agen_asal').html(data.view);
  //     }
  //   })
  // })
  $('#kota_tujuan').on('change',function(){
    $.ajax({
      method:'POST',
      url:'{{ url("awb/filter-kota-agen") }}',
      data:{
        kota_id: $(this).val(),
        '_token': $('input[name=_token]').val()
      },
      success:function(data){
        console.log(data);
        $('#agen_tujuan').html(data.view);
        $('#kecamatan_tujuan').html(data.view_kecamatan);
      }
    })
  })

  $('#customer').on('change',function(){
    $.ajax({
      method:'POST',
      url:'{{ url("awb/filter-customer") }}',
      data:{
        customer_id: $(this).val(),
        '_token': $('input[name=_token]').val()
      },
      success:function(data){
        console.log(data.data);
        $('#nama_pengirim').val(data.data.nama)
        // $('#alamat_pengirim_auto').html(data.alamat)
        $('#alamat_tujuan_auto').html(data.alamat)
        $('#alamat_tujuan_auto').val('manual')
        $('#alamat_tujuan').val('')
        $('#nama_penerima').val('')
        $('#kodepos_penerima').val('')
        $('#notelp_penerima').val('')
        $('#alamat_pengirim').val(data.data.alamat)
        $('#kodepos_pengirim').val(data.data.kodepos)
        $('#notelp_pengirim').val(data.data.notelp)
        // if(data.count_alamat == 0){
        //   $('#alamat_pengirim').show()
        // }
        // else{
        //   $('#alamat_pengirim').hide()
        // }
        if(data.data.is_agen == 1){
          $('#customer-biasa').show()
          $('#qty-detail').hide()
          $("#harga_total").attr("required", "true");
          $("#qty_biasa").attr("required", "true");
        }
        else{
          $('#customer-biasa').hide()
          $('#qty-detail').show()
          $("#harga_total").removeAttr("required");
          $("#qty_biasa").removeAttr("required");
        }
      }
    })
  })

  $('#alamat_pengirim_auto').on('change',function(){
    var value = $(this).val()
    console.log(value)
    if(value == "manual"){
      // $('#alamat_pengirim').show()
      $('#alamat_pengirim').val('')
    }
    else{
      // $('#alamat_pengirim').hide()
      $('#alamat_pengirim').val(value)
    }
  })

  $('#alamat_tujuan_auto').on('change',function(){
    var value = $(this).val()
    console.log(value)
    if(value == "manual"){
      // $('#alamat_tujuan').show()
      $('#alamat_tujuan').val('')
      $('#nama_penerima').val('')
      $('#notelp_penerima').val('')
      $('#kodepos_penerima').val('')
    }
    else{
      // $('#alamat_tujuan').hide()
      $('#alamat_tujuan').val(value)
      $.ajax({
        method:'POST',
        url:'{{ url("awb/filter-data-penerima") }}',
        data:{
          alamat: $(this).val(),
          '_token': $('input[name=_token]').val()
        },
        success:function(data){
          $('#nama_penerima').val(data.customer.nama_penerima)
          $('#notelp_penerima').val(data.customer.no_hp)
          $('#kodepos_penerima').val(data.customer.kodepos)
        }

      });
      // $('#nama_penerima').val('')
      // $('#notelp_penerima').val('')
      // $('#kodepos_penerima').val('')
    }
  })
  
  $(document).ready(function(){
    if($('#check_alamat_tujuan').val() == 0){
      // $('#alamat_tujuan').show()
    }

    if($('#check_alamat_pengirim').val() == 0){
      // $('#alamat_pengirim').show()
    }
  })
</script>
@endsection