
<?php $__env->startSection('content'); ?>

<div class="card card-custom gutter-b example example-compact" style="position: relative;">
  
  
  <div class="card-header"
    <?php if($hilang =="hilang"): ?>
        style="background-color:#f64e60;"        
    <?php endif; ?>
  >
    <h3 class="card-title">Form Pengisian AWB 
      <?php if($hilang =="hilang"): ?>
      <br>
        No Referensi AWB <?php echo e($awb->noawb); ?>

      <?php endif; ?>

    </h3>
  </div>
  <?php if(!empty($alamat_tujuan_array)): ?>
    <input type="hidden" id="check_alamat_tujuan" value="1">
  <?php else: ?>
    <input type="hidden" id="check_alamat_tujuan" value="0">
  <?php endif; ?>
  <?php if(!empty($alamat_pengirim_array)): ?>
    <input type="hidden" id="check_alamat_pengirim" value="1">
  <?php else: ?>
    <input type="hidden" id="check_alamat_pengirim" value="0">
  <?php endif; ?>
<form class="form" method="POST" action="<?php echo e(url('awb/save')); ?>" autocomplete="off">
  <input autocomplete="false" name="hidden" type="text" style="display:none;">
  <?php echo e(csrf_field()); ?>

  <input type="hidden" name="idawb" value="<?php echo e($id); ?>">
  <input type="hidden" name="hilang" value="<?php echo e($hilang); ?>">
  <?php if($hilang == "hilang"): ?>
  <input type="hidden" name="referensi" value="<?php echo e($awb->noawb); ?>">
  <?php else: ?>
  <input type="hidden" name="referensi" value="">
  <?php endif; ?>
  <div class="card-body">
    <div class="row">
        <div class="card-body mb-5">
          <h6 class="panel-title txt-dark" style="border-bottom:1px solid #EBEDF3;"><i class="flaticon-profile-1"> </i> Data Umum Pengiriman</h6>
          <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="font-weight-bold">Customer</label>
                  <select id="customer" style="width:90%" class="select2 select_readonly form-control" name="id_customer" required>
                    <?php if((int)Auth::user()->level == 1): ?>
                      <option value="">--Pilih Customer--</option>
                      <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($c->id == $awb->id_customer): ?>
                          <option value="<?php echo e($c->id); ?>" selected><?php echo e($c->nama); ?></option>
                        <?php else: ?>
                          <option value="<?php echo e($c->id); ?>"><?php echo e($c->nama); ?></option>
                        <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <option value="">--Pilih Customer--</option>
                      <?php if($id == 0): ?>
                        <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->nama); ?></option>
                      <?php else: ?>
                        <option value="<?php echo e($customer->id); ?>" selected><?php echo e($customer->nama); ?></option>
                      <?php endif; ?>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="font-weight-bold">Tanggal:</label>
                  <div class="input-group date" style="position: relative;">
                    <div style="width:100%; height:100%; position: absolute;  top:0px; left:0px;z-index:2;"></div>
                    <?php if($id == 0): ?>
                    <input name="tanggal_awb"  type="text" class="form-control datepicker_readonly" value="<?php echo e(date('m/d/Y')); ?>" placeholder="Select date">
                    <?php else: ?>
                      <?php if($hilang == "hilang"): ?>
                      <input name="tanggal_awb"  type="text" class="form-control" value="<?php echo e(date('m/d/Y',strtotime($awb->tanggal_awb))); ?>" readonly="true" placeholder="Select date">
                      <?php else: ?>
                      <input name="tanggal_awb"  type="text" class="form-control datepicker_readonly" value="<?php echo e(date('m/d/Y',strtotime($awb->tanggal_awb))); ?>" readonly="true" placeholder="Select date">
                      <?php endif; ?>
                    <?php endif; ?>
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
                    <?php if($awb->ada_faktur == 1): ?>
                    <input type="checkbox" name="ada_faktur" checked="checked" class="is_readonly">
                    <?php else: ?>
                    <input type="checkbox" name="ada_faktur" class="is_readonly">
                    <?php endif; ?>
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
        
        <?php if((int)$id !== 0 && $awb->id_agen_penerima == 0): ?>
        <div class="alert alert-warning" role="alert">Qty inputan customer berikut ini adalah <strong style="color:black; font-size:12pt;"> <?php echo e($awb->qty); ?></strong></div>
        <?php endif; ?>
          <?php if((int)Auth::user()->level !== 1 && (int)$customer->can_access_satuan !== 1): ?>
          <div class="row">
            <div class="col-lg-4">
              <div class="form-group">
                <label class="font-weight-bold">Qty <?php if($hilang =="hilang"): ?><span style="color:red;"> (barang hilang harus minus)</span> <?php endif; ?></label>
                <input type="number" <?php if($hilang =="hilang"): ?> max='0' <?php endif; ?>  class="form-control" value="<?php echo e($awb->qty); ?>" name="qty" placeholder="Input jumlah koli kecil. . ." >
              </div>
            </div>
          </div>
          <?php else: ?>
          <div class="row" id="row-jenis-koli">
            <div class="col-lg-6">
              <div class="form-group">
                  <select class="form-control" id="jenis_koli" name="jenis_koli" required>
                    <option value="">--Pilih Jenis Koli--</option>
                    <?php if($awb->jenis_koli == "koli"): ?>
                      <option value="dokumen">Dokumen</option>
                      <option value="kg">Kilogram (Kg)</option>
                      <option value="koli" selected>Koli</option>
                    <?php elseif($awb->jenis_koli == "dokumen"): ?>
                      <option value="dokumen" selected>Dokumen</option>
                      <option value="kg">Kilogram (Kg)</option>
                      <option value="koli">Koli</option>
                    <?php elseif($awb->jenis_koli == "kg"): ?>
                      <option value="dokumen">Dokumen</option>
                      <option value="kg" selected>Kilogram (Kg)</option>
                      <option value="koli">Koli</option>
                    <?php else: ?>
                      <option value="dokumen">Dokumen</option>
                      <option value="kg">Kilogram (Kg)</option>
                      <option value="koli">Koli</option>
                    <?php endif; ?>
                  </select>
              </div>
            </div>
          </div>
          <div class="row" id="qty-detail">
            <div class="col-md-12">
              <div class="row">
                <div class="col-lg-2">
                  <div class="form-group" id="qty_koli_k">
                    <label class="font-weight-bold">Qty Koli Kecil <?php if($hilang =="hilang"): ?><span style="color:red;"> (barang hilang harus minus)</span> <?php endif; ?></label>
                    <input type="number" <?php if($hilang =="hilang"): ?> max='0' <?php endif; ?> class="form-control" value="<?php echo e($awb->qty_kecil); ?>" name="qty_kecil" placeholder="Input jumlah koli kecil. . ." value="0">
                  </div>
                </div>
                <div class="col-lg-2">
                  <div class="form-group" id="qty_koli_s">
                    <label class="font-weight-bold">Qty Koli Sedang <?php if($hilang =="hilang"): ?><span style="color:red;"> (barang hilang harus minus)</span> <?php endif; ?></label>
                    <input type="number" <?php if($hilang =="hilang"): ?> max='0' <?php endif; ?> class="form-control" value="<?php echo e($awb->qty_sedang); ?>"  name="qty_sedang" placeholder="Input jumlah koli sedang. . ." value="0">
                  </div>
                </div>
                <div class="col-lg-2">
                  <div class="form-group" id="qty_koli_b">
                    <label class="font-weight-bold">Qty Koli Besar <?php if($hilang =="hilang"): ?><span style="color:red;"> (barang hilang harus minus)</span> <?php endif; ?></label>
                    <input type="number" <?php if($hilang =="hilang"): ?> max='0' <?php endif; ?> class="form-control" value="<?php echo e($awb->qty_besar); ?>"  name="qty_besar" placeholder="Input jumlah koli besar. . ." value="0">
                  </div>
                </div>
                <div class="col-lg-2"> 
                  <div class="form-group" id="qty_koli_bb">
                    <label class="font-weight-bold">Qty Koli Besar Banget <?php if($hilang =="hilang"): ?><span style="color:red;"> (barang hilang harus minus)</span> <?php endif; ?></label>
                    <input type="number" <?php if($hilang =="hilang"): ?> max='0' <?php endif; ?> class="form-control" value="<?php echo e($awb->qty_besarbanget); ?>"  name="qty_besar_banget" placeholder="Input jumlah koli besar_banget. . ." value="0">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row mb-0">
                <div class="col-lg-3">
                  <div class="form-group" id="qty_koli_kg" >
                    <label class="font-weight-bold">Qty Koli Kg <?php if($hilang =="hilang"): ?><span style="color:red;"> (barang hilang harus minus)</span> <?php endif; ?></label>
                    <input type="number" <?php if($hilang =="hilang"): ?> max='0' <?php endif; ?> class="form-control" value="<?php echo e($awb->qty_kg); ?>"  name="qty_kg" placeholder="Input jumlah koli kg. . ." value="0">
                  </div>
                </div>
                <div class="col-lg-3" id="div-kg-pertama">
                  <div class="form-group">
                    <label class="font-weight-bold">Harga 5 Kg Pertama</label>
                    <input type="text" class="form-control rupiah" id="harga_kg_pertama" value="<?php echo e($awb->harga_kg_pertama); ?>"  name="harga_kg_pertama" placeholder="Input harga 2 kg pertama. . ." value="0">
                  </div>
                </div>
                <div class="col-lg-3" id="div-kg-selanjutnya">
                  <div class="form-group">
                    <label class="font-weight-bold">Harga Kg Selanjutnya</label>
                    <input type="text" class="form-control rupiah" id="harga_kg_selanjutnya" value="<?php echo e($awb->harga_kg_selanjutnya); ?>"  name="harga_kg_selanjutnya" placeholder="Input harga kg selanjutnya. . ." value="0">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row mb-0">
                <div class="col-lg-2">
                  <div class="form-group" id="qty_koli_doc" >
                    <label class="font-weight-bold">Qty Koli Dokumen <?php if($hilang =="hilang"): ?><span style="color:red;"> (barang hilang harus minus)</span> <?php endif; ?></label>
                    <input type="number" <?php if($hilang =="hilang"): ?> max='0' <?php endif; ?> class="form-control" value="<?php echo e($awb->qty_doc); ?>"  name="qty_doc" placeholder="Input jumlah koli dokumen. . ." value="0">
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
                <label class="font-weight-bold">Qty <?php if($hilang =="hilang"): ?><span style="color:red;"> (barang hilang harus minus)</span> <?php endif; ?></label>
                <input type="number" class="form-control" id="qty_biasa" <?php if($hilang =="hilang"): ?> max='0' <?php endif; ?> value="<?php echo e($awb->qty); ?>" name="qty" placeholder="Input jumlah koli kecil. . .">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="font-weight-bold">Harga Total</label>
                <input type="text" class="form-control rupiah"  id="harga_total" value="<?php echo e($awb->total_harga); ?>" name="harga_total" placeholder="Input harga total. . ." >
              </div>
            </div>
          </div>
          <?php endif; ?>
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
                <input type="text" id="nama_penerima" class="form-control is_readonly" value="<?php echo e($awb->nama_penerima); ?>" name="nama_penerima" placeholder="Input Nama Penerima. . ." required>
              </div>
              <div class="form-group">
                <label class="font-weight-bold">Alamat Tujuan Penerima</label>
                <select id="alamat_tujuan_auto" class="form-control mb-2 is_readonly" name="labelalamat"> 
                  <?php if($id == 0): ?>
                  <option value="manual">Input Alamat Manual</option>
                  <?php else: ?>
                      <?php $__currentLoopData = $master_alamat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>:
                        <?php if($a->alamat == $awb->alamat_tujuan): ?>
                          <option value="<?php echo e($a->alamat); ?>" selected><?php echo e($a->labelalamat); ?></option>
                        <?php else: ?>
                          <option value="<?php echo e($a->alamat); ?>"><?php echo e($a->labelalamat); ?> </option>
                        <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php if(!empty($alamat_tujuan_array)): ?>
                        <option value="manual">Input Alamat Manual</option>
                      <?php else: ?>
                        <option value="manual" selected>Input Alamat Manual</option>
                      <?php endif; ?>
                  <?php endif; ?>
              </select>
              <input type="text" class="form-control is_readonly" maxlength="120" id="alamat_tujuan" value="<?php echo e($awb->alamat_tujuan); ?>" name="alamat_tujuan" placeholder="Input Alamat tujuan. . ." required>
              </div>
            <div class="form-group">
              <label class="font-weight-bold">Kode Pos Penerima</label>
              <input type="text" id="kodepos_penerima" class="form-control is_readonly" value="<?php echo e($awb->kodepos_penerima); ?>" name="kodepos_penerima" placeholder="Input Kode Pos. . ." required>
            </div>
            <div class="form-group">
              <label class="font-weight-bold">No Telp Penerima</label>
              <input type="text" id="notelp_penerima" class="form-control is_readonly" value="<?php echo e($awb->notelp_penerima); ?>" name="notelp_penerima" placeholder="Input Nomor Telp Penerima. . ." required>
            </div>
          </div>
          <div class="col-lg-6">
              <div class="form-group">
                <label class="font-weight-bold">Nama Pengirim</label>
                <input type="text" id="nama_pengirim" class="form-control is_readonly" value="<?php echo e($awb->nama_pengirim); ?>" name="nama_pengirim" placeholder="Input Nama Pengirim. . ." required>
              </div>
              <div class="form-group">
                <label class="font-weight-bold">Alamat Pengirim</label>
                
                <input type="text" id="alamat_pengirim" maxlength="120" class="form-control mb-2 is_readonly" value="<?php echo e($awb->alamat_pengirim); ?>" name="alamat_pengirim" placeholder="Input Alamat Manual. . ." required>
              </div>
            <div class="form-group">
              <label class="font-weight-bold">Kode Pos Pengirim</label>
              <input type="text" id="kodepos_pengirim" class="form-control is_readonly" value="<?php echo e($awb->kodepos_pengirim); ?>" name="kodepos_pengirim" placeholder="Input Kode Pos. . ." required>
            </div>
            <div class="form-group">
              <label class="font-weight-bold">No Telp Pengirim</label>
              <input type="text" id="notelp_pengirim" class="form-control is_readonly" value="<?php echo e($awb->notelp_pengirim); ?>" name="notelp_pengirim" placeholder="Input Nomor Telp Pengirim. . ." required>
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
                <?php $__currentLoopData = $kota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($id !== "0"): ?>
                    <?php if($c->id == $awb->id_kota_asal): ?>
                      <option value="<?php echo e($c->id); ?>" selected><?php echo e($c->nama); ?></option>
                    <?php else: ?>
                    <option value="<?php echo e($c->id); ?>"><?php echo e($c->nama); ?></option>
                    <?php endif; ?>
                  <?php else: ?>
                    <?php if($c->kode == "SUB"): ?>
                      <option value="<?php echo e($c->id); ?>" selected><?php echo e($c->nama); ?></option>
                    <?php else: ?>
                      <option value="<?php echo e($c->id); ?>"><?php echo e($c->nama); ?></option>
                    <?php endif; ?>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            <?php if((int)Auth::user()->level == 1): ?>
            
            <div class="form-group">
              <label class="font-weight-bold">Transit</label>
              <select style="width:95%" class="select2 select_readonly form-control" name="id_kota_transit" >
                <option value="">--Pilih Kota Transit--</option>
                  <?php if($awb->id_kota_transit): ?>
                    <option value="9479" selected>SURABAYA  </option>
                  <?php else: ?>
                  <option value="9479">SURABAYA</option>
                  <?php endif; ?>
              </select>
            </div>
            <?php endif; ?> 
          </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="font-weight-bold">Kota Tujuan</label>
                <select style="width:90%" class="select2 select_readonly form-control" id="kota_tujuan" name="id_kota_tujuan" required>
                  <option value="">--Pilih Kota Tujuan--</option>
                  <?php $__currentLoopData = $kota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($c->id == $awb->id_kota_tujuan): ?>
                      <option value="<?php echo e($c->id); ?>" selected><?php echo e($c->nama); ?></option>
                    <?php else: ?>
                    <option value="<?php echo e($c->id); ?>"><?php echo e($c->nama); ?></option>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
              
            <div class="form-group">
              <label class="font-weight-bold">Kecamatan Tujuan</label>
              <select style="width:90%" class="select2 select_readonly form-control" id="kecamatan_tujuan" name="id_kecamatan_tujuan" required>
                <option value="">--Pilih Kecamatan Tujuan--</option>
                <?php if($awb->id == 0): ?>
                  <option value="<?php echo e($awb->id_kecamatan_tujuan); ?>"><?php echo e($awb->nama_kecamatan_tujuan); ?> </option>
                <?php else: ?>
                  <?php $__currentLoopData = $kecamatan_tujuan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($k->id == $awb->id_kecamatan_tujuan): ?>
                    <option value="<?php echo e($k->id); ?>" selected><?php echo e($k->nama); ?> </option>
                    <?php else: ?>
                    <option value="<?php echo e($k->id); ?>"><?php echo e($k->nama); ?> </option>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              </select>
            </div>
            <?php if((int)Auth::user()->level == 1): ?>
            <div class="form-group">
              <label class="font-weight-bold">Agen Tujuan</label>
              <select style="width:90%" class="select2 select_readonly form-control" id="agen_tujuan" name="id_agen_penerima" required>
                <option value="">--Pilih  Kota Tujuan Terlebih Dahulu--</option>
                <?php if($id !== "0"): ?>
                <?php $__currentLoopData = $agen_master; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($awb->id_agen_penerima == $a->agen_id): ?>
                      <option value="<?php echo e($a->agen_id); ?>" selected><?php echo e($a->agen_nama); ?></option>
                      <?php else: ?>
                      <option value="<?php echo e($a->agen_id); ?>"><?php echo e($a->agen_nama); ?></option>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              </select>
              <span class="form-text text-warning">Opsi Agen Tujuan akan muncul otomatis sesuai dengan pilihan Kota Tujuan</span>
            </div>
            
            <?php endif; ?>
          </div>

        </div>
        
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <label class="font-weight-bold">Keterangan tambahan (deskripsi):</label>
              <textarea name="keterangan" maxlength="20" rows="4" class="form-control"> <?php echo e($awb->keterangan); ?></textarea>
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
<input type="hidden" id="is_agen" value="<?php echo e($awb->is_agen); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
  var _kecamatan_id_ = 0;
  $('form').submit(function(){
      $('body').find('button[type=submit]').prop('disabled', true);
  });
  $('#customer-biasa').hide();
  $('#div-kg-pertama').hide();
  $('#div-kg-selanjutnya').hide();
  // $('#kota_asal').on('change',function(){
  //   $.ajax({
  //     method:'POST',
  //     url:'<?php echo e(url("awb/filter-kota-agen")); ?>',
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
      url:'<?php echo e(url("awb/filter-kota-agen")); ?>',
      data:{
        kota_id: $(this).val(),
        '_token': $('input[name=_token]').val()
      },
      success:function(data){
        console.log(data);
        $('#agen_tujuan').html(data.view);
        $('#kecamatan_tujuan').html(data.view_kecamatan);        
        $('#kecamatan_tujuan').val(_kecamatan_id_).trigger('change')
        _kecamatan_id_ = 0;
      }
    })
  })

  $('#customer').on('change',function(){
    $.ajax({
      method:'POST',
      url:'<?php echo e(url("awb/filter-customer")); ?>',
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
        if(data.data.id == 26){
          $("#jenis_koli option[value='koli']").remove();
        }
        else{
          if($("#jenis_koli option[value='koli']").length == 0)
          {
            $("#jenis_koli").append('<option value="koli">Koli</option>');
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
        url:'<?php echo e(url("awb/filter-data-penerima")); ?>',
        data:{
          alamat: $(this).val(),
          '_token': $('input[name=_token]').val()
        },
        success:function(data){
          console.log('data')
          console.log(data)
          $('#nama_penerima').val(data.customer.nama_penerima)
          $('#notelp_penerima').val(data.customer.no_hp)
          $('#kodepos_penerima').val(data.customer.kodepos)
          $('#kota_tujuan').val(data.customer.idkota).trigger('change')
          _kecamatan_id_ = data.customer.id_kecamatan;
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

<?php if($hilang == "hilang"): ?>
  <script>
    $('.is_readonly').attr('readonly', true);
    $('option').not(':selected').remove();
      $("input[name=qty]").removeAttr('max')
  </script>
<?php endif; ?>
<?php if($awb->created_by > 1): ?>
  <script>
    
    $('#customer option').not(':selected').remove();
  </script>
<?php endif; ?>
<?php if((int) Auth::user()->level == 2): ?>
<script>
  $('#kota_asal option').not(':selected').remove();
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/pages/awb/create.blade.php ENDPATH**/ ?>