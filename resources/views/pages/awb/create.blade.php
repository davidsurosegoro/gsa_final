@extends('layouts.app')
@section('content')

<div class="card card-custom gutter-b example example-compact">
  <div class="card-header"
    @if ($hilang =="hilang")
        style="background-color:#f64e60;"        
    @endif
  >
    <h3 class="card-title">Form Pengisian AWB 
      @if ($hilang =="hilang")
      <br>
        No Referensi AWB {{$awb->noawb}}
      @endif

    </h3>
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
  <input type="hidden" name="hilang" value="{{ $hilang }}">
  @if($hilang == "hilang")
  <input type="hidden" name="referensi" value="{{ $awb->noawb }}">
  @else
  <input type="hidden" name="referensi" value="">
  @endif
  <div class="card-body">
    <div class="row">
        <div class="card-body mb-5">
          <h6 class="panel-title txt-dark" style="border-bottom:1px solid #EBEDF3;"><i class="flaticon-profile-1"> </i> Data Umum Pengiriman</h6>
          <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="font-weight-bold">Customer</label>
                  <select id="customer" style="width:90%" class="select2 select_readonly form-control" name="id_customer" required>
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
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="font-weight-bold">Tanggal:</label>
                  <div class="input-group date">
                    @if($id == 0)
                    <input name="tanggal_awb" type="text" class="form-control datepicker" value="{{ date('m/d/Y') }}" readonly="true" placeholder="Select date">
                    @else
                      @if($hilang == "hilang")
                      <input name="tanggal_awb" type="text" class="form-control" value="{{ date('m/d/Y',strtotime($awb->tanggal_awb)) }}" readonly="true" placeholder="Select date">
                      @else
                      <input name="tanggal_awb" type="text" class="form-control datepicker" value="{{ date('m/d/Y',strtotime($awb->tanggal_awb)) }}" readonly="true" placeholder="Select date">
                      @endif
                    @endif
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="la la-calendar-check-o"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="font-weight-bold">Ada Faktur</label>
                  <label class="checkbox checkbox-primary" >
                    @if($awb->ada_faktur == 1)
                    <input type="checkbox" name="ada_faktur" checked="checked" class="is_readonly">
                    @else
                    <input type="checkbox" name="ada_faktur" class="is_readonly">
                    @endif
                    <span></span> &nbsp;Faktur Tersedia</label>
                    <span class="form-text text-muted"></span>
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
                <label class="font-weight-bold">Qty</label>
                <input type="number" class="form-control" value="{{ $awb->qty }}" name="qty" placeholder="Input jumlah koli kecil. . ." value="0">
              </div>
            </div>
          </div>
          @else
          <div class="row" id="row-jenis-koli">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="font-weight-bold">Jenis quantity (kl,kg,doc)</label>
                  <select class="form-control" id="jenis_koli" name="jenis_koli" required>
                    <option value="">--Pilih Jenis Koli--</option>
                    @if($awb->jenis_koli == "koli")
                      <option value="koli" selected>Koli</option>
                      <option value="dokumen">Dokumen</option>
                      <option value="kg">Kilogram (Kg)</option>
                    @elseif($awb->jenis_koli == "dokumen")
                      <option value="koli">Koli</option>
                      <option value="dokumen" selected>Dokumen</option>
                      <option value="kg">Kilogram (Kg)</option>
                    @elseif($awb->jenis_koli == "kg")
                      <option value="koli">Koli</option>
                      <option value="dokumen">Dokumen</option>
                      <option value="kg" selected>Kilogram (Kg)</option>
                    @else
                      <option value="koli">Koli</option>
                      <option value="dokumen">Dokumen</option>
                      <option value="kg">Kilogram (Kg)</option>
                    @endif
                  </select>
              </div>
            </div>
          </div>
          <div class="row" id="qty-detail">
            <div class="col-md-12">
              <div class="row">
                <div class="col-lg-2">
                  <div class="form-group" id="qty_koli_k">
                    <label class="font-weight-bold">Qty Koli Kecil</label>
                    <input type="number" class="form-control" value="{{ $awb->qty_kecil }}" name="qty_kecil" placeholder="Input jumlah koli kecil. . ." value="0">
                  </div>
                </div>
                <div class="col-lg-2">
                  <div class="form-group" id="qty_koli_s">
                    <label class="font-weight-bold">Qty Koli Sedang</label>
                    <input type="number" class="form-control" value="{{ $awb->qty_sedang }}"  name="qty_sedang" placeholder="Input jumlah koli sedang. . ." value="0">
                  </div>
                </div>
                <div class="col-lg-2">
                  <div class="form-group" id="qty_koli_b">
                    <label class="font-weight-bold">Qty Koli Besar</label>
                    <input type="number" class="form-control" value="{{ $awb->qty_besar }}"  name="qty_besar" placeholder="Input jumlah koli besar. . ." value="0">
                  </div>
                </div>
                <div class="col-lg-2"> 
                  <div class="form-group" id="qty_koli_bb">
                    <label class="font-weight-bold">Qty Koli Besar Banget</label>
                    <input type="number" class="form-control" value="{{ $awb->qty_besarbanget }}"  name="qty_besar_banget" placeholder="Input jumlah koli besar_banget. . ." value="0">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row mb-0">
                <div class="col-lg-3">
                  <div class="form-group" id="qty_koli_kg" >
                    <label class="font-weight-bold">Qty Koli Kg</label>
                    <input type="number" class="form-control" value="{{ $awb->qty_kg }}"  name="qty_kg" placeholder="Input jumlah koli kg. . ." value="0">
                  </div>
                </div>
                <div class="col-lg-3" id="div-kg-pertama">
                  <div class="form-group">
                    <label class="font-weight-bold">Harga 2 Kg Pertama</label>
                    <input type="text" class="form-control rupiah" id="harga_kg_pertama" value="{{ $awb->harga_kg_pertama }}"  name="harga_kg_pertama" placeholder="Input harga 2 kg pertama. . ." value="0">
                  </div>
                </div>
                <div class="col-lg-3" id="div-kg-selanjutnya">
                  <div class="form-group">
                    <label class="font-weight-bold">Harga Kg Selanjutnya</label>
                    <input type="text" class="form-control rupiah" id="harga_kg_selanjutnya" value="{{ $awb->harga_kg_selanjutnya }}"  name="harga_kg_selanjutnya" placeholder="Input harga kg selanjutnya. . ." value="0">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row mb-0">
                <div class="col-lg-2">
                  <div class="form-group" id="qty_koli_doc" >
                    <label class="font-weight-bold">Qty Koli Dokumen</label>
                    <input type="number" class="form-control" value="{{ $awb->qty_doc }}"  name="qty_doc" placeholder="Input jumlah koli dokumen. . ." value="0">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row" id="customer-biasa">
              
            <div class="col-md-12">
              <div class="alert alert-custom alert-light-warning fade show mb-5" role="alert">
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
                <label class="font-weight-bold">Qty</label>
                <input type="number" class="form-control" id="qty_biasa" value="{{ $awb->qty }}" name="qty" placeholder="Input jumlah koli kecil. . .">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="font-weight-bold">Harga Total</label>
                <input type="text" class="form-control rupiah" id="harga_total" value="{{ $awb->total_harga }}" name="harga_total" placeholder="Input harga total. . ." >
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
                <label class="font-weight-bold">Nama Penerima</label>
                <input type="text" id="nama_penerima" class="form-control is_readonly" value="{{ $awb->nama_penerima }}" name="nama_penerima" placeholder="Input Nama Penerima. . ." required>
              </div>
              <div class="form-group">
                <label class="font-weight-bold">Alamat Tujuan Penerima</label>
                <select id="alamat_tujuan_auto" class="form-control mb-2 is_readonly" name="labelalamat"> 
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
              <input type="text" class="form-control is_readonly" maxlength="120" id="alamat_tujuan" value="{{ $awb->alamat_tujuan }}" name="alamat_tujuan" placeholder="Input Alamat tujuan. . ." required>
              </div>
            <div class="form-group">
              <label class="font-weight-bold">Kode Pos Penerima</label>
              <input type="text" id="kodepos_penerima" class="form-control is_readonly" value="{{ $awb->kodepos_penerima }}" name="kodepos_penerima" placeholder="Input Kode Pos. . ." required>
            </div>
            <div class="form-group">
              <label class="font-weight-bold">No Telp Penerima</label>
              <input type="text" id="notelp_penerima" class="form-control is_readonly" value="{{ $awb->notelp_penerima }}" name="notelp_penerima" placeholder="Input Nomor Telp Penerima. . ." required>
            </div>
          </div>
          <div class="col-lg-6">
              <div class="form-group">
                <label class="font-weight-bold">Nama Pengirim</label>
                <input type="text" id="nama_pengirim" class="form-control is_readonly" value="{{ $awb->nama_pengirim }}" name="nama_pengirim" placeholder="Input Nama Pengirim. . ." required>
              </div>
              <div class="form-group">
                <label class="font-weight-bold">Alamat Pengirim</label>
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
                <input type="text" id="alamat_pengirim" maxlength="120" class="form-control mb-2 is_readonly" value="{{ $awb->alamat_pengirim }}" name="alamat_pengirim" placeholder="Input Alamat Manual. . ." required>
              </div>
            <div class="form-group">
              <label class="font-weight-bold">Kode Pos Pengirim</label>
              <input type="text" id="kodepos_pengirim" class="form-control is_readonly" value="{{ $awb->kodepos_pengirim }}" name="kodepos_pengirim" placeholder="Input Kode Pos. . ." required>
            </div>
            <div class="form-group">
              <label class="font-weight-bold">No Telp Pengirim</label>
              <input type="text" id="notelp_pengirim" class="form-control is_readonly" value="{{ $awb->notelp_pengirim }}" name="notelp_pengirim" placeholder="Input Nomor Telp Pengirim. . ." required>
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
              <label class="font-weight-bold">Kota Asal</label><br>
              <select style="width:90%" class="select2 select_readonly form-control" id="kota_asal" name="id_kota_asal" readonly="true" required >
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
              <label class="font-weight-bold">Agen Asal</label>
              <select style="width:90%" class="select2 select_readonly form-control"  id="agen_asal" name="id_agen_asal" required>
                <option value="">--Pilih Kota Asal Terlebih Dahulu--</option>
                
                @if($id !== "0")
                  <option value="{{ $agen_asal->id }}" selected>{{ $agen_asal->nama }}</option>
                @endif
              </select>
              <span class="form-text text-warning">Opsi Agen Asal akan muncul otomatis sesuai dengan pilihan Kota Asal</span>
           
            </div> --}}
            <div class="form-group">
              <label class="font-weight-bold">Kota Transit</label>
              <select style="width:90%" class="select2 select_readonly form-control" name="id_kota_transit" >
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
          </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="font-weight-bold">Kota Tujuan</label>
                <select style="width:90%" class="select2 select_readonly form-control" id="kota_tujuan" name="id_kota_tujuan" required>
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
              <label class="font-weight-bold">Kecamatan Tujuan</label>
              <select style="width:90%" class="select2 select_readonly form-control" id="kecamatan_tujuan" name="id_kecamatan_tujuan" required>
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
              <label class="font-weight-bold">Agen Tujuan</label>
              <select style="width:90%" class="select2 select_readonly form-control" id="agen_tujuan" name="id_agen_penerima" required>
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
              <label class="font-weight-bold">Status Out Area </label>
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
              <label class="font-weight-bold">Keterangan tambahan (deskripsi):</label>
              <textarea name="keterangan" maxlength="20" rows="4" class="form-control"> {{ $awb->keterangan }}</textarea>
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
<input type="hidden" id="is_agen" value="{{ $awb->is_agen }}">
@endsection
@section('script')
<script>
  
  $('form').submit(function(){
      $('body').find('button[type=submit]').prop('disabled', true);
  });
  $('#customer-biasa').hide();
  $('#div-kg-pertama').hide();
  $('#div-kg-selanjutnya').hide();
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
        $("input[name=qty_kecil]").val(0)
        $("input[name=qty_sedang]").val(0)
        $("input[name=qty_besar]").val(0)
        $("input[name=qty_besar_banget]").val(0)
        $("input[name=qty_kg]").val(0)
        $("input[name=qty_doc]").val(0)
        $("input[name=harga_kg_pertama]").val(0)
        $("input[name=harga_kg_selanjutnya]").val(0)
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
          $('#row-jenis-koli').hide()
          $("#jenis_koli").removeAttr("required");
        }
        else{
          $('#customer-biasa').hide()
          $('#qty-detail').show()
          $("#harga_total").removeAttr("required");
          $("#qty_biasa").removeAttr("required");
          $('#row-jenis-koli').show()
          $("#jenis_koli").attr("required", "true");
          if(data.data.id == 26){
            $('#jenis_koli').val('kg').change();
            $('#div-kg-pertama').show();
            $('#div-kg-selanjutnya').show();
            $("#jenis_koli").attr("readonly", "true");
            // $('#harga_kg_pertama').val(data.data.harga_kg)
            // $('#harga_kg_selanjutnya').val(data.data.harga_kg)
          }
          else{
            $('#div-kg-pertama').hide();
            $('#div-kg-selanjutnya').hide();
            $("#jenis_koli").attr("readonly", "false");
          }
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

  $('#jenis_koli').on('change',function(){
    var value = $(this).val()
    console.log(value)
    if(value == "koli"){
      $('#qty_koli_k').show();
      $('#qty_koli_s').show();
      $('#qty_koli_b').show();
      $('#qty_koli_bb').show();
      $('#qty_koli_doc').hide();
      $('#qty_koli_kg').hide();
    }
    else if(value == "dokumen"){
      $('#qty_koli_k').hide();
      $('#qty_koli_s').hide();
      $('#qty_koli_b').hide();
      $('#qty_koli_bb').hide();
      $('#qty_koli_doc').show();
      $('#qty_koli_kg').hide();
    }
    else if(value == "kg"){
      $('#qty_koli_k').hide();
      $('#qty_koli_s').hide();
      $('#qty_koli_b').hide();
      $('#qty_koli_bb').hide();
      $('#qty_koli_doc').hide();
      $('#qty_koli_kg').show();
    }
    else{
      $('#qty_koli_k').hide();
      $('#qty_koli_s').hide();
      $('#qty_koli_b').hide();
      $('#qty_koli_bb').hide();
      $('#qty_koli_doc').hide();
      $('#qty_koli_kg').hide();
    }
  })

  $('#alamat_tujuan_auto').on('change',function(){
    var value = $(this).val()
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
          console.log(data)
          $('#nama_penerima').val(data.customer.nama_penerima)
          $('#notelp_penerima').val(data.customer.no_hp)
          $('#kodepos_penerima').val(data.customer.kodepos)
          $('#kota_tujuan').val(data.customer.idkota).trigger('change')
        }

      });
      // $('#nama_penerima').val('')
      // $('#notelp_penerima').val('')
      // $('#kodepos_penerima').val('')
    }
  })
  
  $(document).ready(function(){
    if($('#customer').val() == 26){
      $('#div-kg-pertama').show()
      $('#div-kg-selanjutnya').show()
    }
    if($('#check_alamat_tujuan').val() == 0){
      // $('#alamat_tujuan').show()
    }

    if($('#check_alamat_pengirim').val() == 0){
      // $('#alamat_pengirim').show()
    }

    if($('#is_agen').val() == 1){
      
          $('#customer-biasa').show()
          $('#qty-detail').hide()
          $("#harga_total").attr("required", "true");
          $("#qty_biasa").attr("required", "true");
          $('#row-jenis-koli').hide()
          $("#jenis_koli").removeAttr("required");
    }

    if($('#jenis_koli').val() == "koli"){
      $('#qty_koli_k').show();
      $('#qty_koli_s').show();
      $('#qty_koli_b').show();
      $('#qty_koli_bb').show();
      $('#qty_koli_doc').hide();
      $('#qty_koli_kg').hide();
    }
    else if($('#jenis_koli').val() == "dokumen"){
      $('#qty_koli_k').hide();
      $('#qty_koli_s').hide();
      $('#qty_koli_b').hide();
      $('#qty_koli_bb').hide();
      $('#qty_koli_doc').show();
      $('#qty_koli_kg').hide();
    }
    else if($('#jenis_koli').val() == "kg"){
      $('#qty_koli_k').hide();
      $('#qty_koli_s').hide();
      $('#qty_koli_b').hide();
      $('#qty_koli_bb').hide();
      $('#qty_koli_doc').hide();
      $('#qty_koli_kg').show();
    }
    else{
      $('#qty_koli_k').hide();
      $('#qty_koli_s').hide();
      $('#qty_koli_b').hide();
      $('#qty_koli_bb').hide();
      $('#qty_koli_doc').hide();
      $('#qty_koli_kg').hide();
    }
  })
</script>

@if($hilang == "hilang")
  <script>
    $('.is_readonly').attr('readonly', true);
    $('option').not(':selected').remove();
  </script>
@endif
@if($awb->created_by > 1)
  <script>
    
    $('#customer option').not(':selected').remove();
  </script>
@endif
@endsection