
<?php $__env->startSection('content'); ?>

<div class="card card-custom gutter-b example example-compact">
  <div class="card-header">
    <h3 class="card-title">Form Pengisian AWB </h3>
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
<form class="form" method="POST" action="<?php echo e(url('awb/save')); ?>">
  <?php echo e(csrf_field()); ?>

  <input type="hidden" name="idawb" value="<?php echo e($id); ?>">
  <div class="card-body">
    <div class="row">
        <div class="card-body mb-5">
          <h6 class="panel-title txt-dark" style="border-bottom:1px solid #EBEDF3;"><i class="flaticon-profile-1"> </i> Data Umum Pengiriman</h6>
          <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label>Customer</label>
                  <select id="customer" style="width:90%" class="select2 form-control" name="id_customer" required>
                    <?php if(Auth::user()->level == 1): ?>
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
                    <label>Nomor AWB:</label>
                    <input name="noawb" type="text" class="form-control" value="<?php echo e($awb->noawb); ?>" placeholder="Input nomor awb. . . " required>
                  </div>
                </div>
                
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Tanggal:</label>
                    <div class="input-group date">
                      <input name="tanggal_awb" type="text" class="form-control datepicker" value="<?php echo e(date('m/d/Y')); ?>" readonly="true" placeholder="Select date">
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
        <div class="row">
          <?php if(Auth::user()->level !== 1 && $customer->can_access_satuan !== 1): ?>
          <div class="col-lg-4">
            <div class="form-group">
              <label>Qty</label>
              <input type="number" class="form-control" value="<?php echo e($awb->qty); ?>" name="qty" placeholder="Input jumlah koli kecil. . ." value="0">
            </div>
          </div>
          <?php else: ?>
          <div class="col-lg-4">
            <div class="form-group">
              <label>Qty Koli Kecil</label>
              <input type="number" class="form-control" value="<?php echo e($awb->qty_kecil); ?>" name="qty_kecil" placeholder="Input jumlah koli kecil. . ." value="0">
            </div>
          </div>
          <div class="col-lg-4">
            
            <div class="form-group">
              <label>Qty Koli Sedang</label>
              <input type="number" class="form-control" value="<?php echo e($awb->qty_sedang); ?>" name="qty_sedang" placeholder="Input jumlah koli sedang. . ." value="0">
            </div>
          </div>
          <div class="col-lg-4">
            
            <div class="form-group">
              <label>Qty Koli Besar</label>
              <input type="number" class="form-control" value="<?php echo e($awb->qty_besar); ?>" name="qty_besar" placeholder="Input jumlah koli besar. . ." value="0">
            </div>
          </div>
          <div class="col-lg-4">
            
            <div class="form-group">
              <label>Qty Koli Besar Banget</label>
              <input type="number" class="form-control" value="<?php echo e($awb->qty_besarbanget); ?>" name="qty_besar_banget" placeholder="Input jumlah koli besar_banget. . ." value="0">
            </div>
          </div>
          <div class="col-lg-4">
            
            <div class="form-group">
              <label>Qty Koli Kg</label>
              <input type="number" class="form-control" value="<?php echo e($awb->qty_kg); ?>" name="qty_kg" placeholder="Input jumlah koli kg. . ." value="0">
            </div>
          </div>
          <div class="col-lg-4">
            
            <div class="form-group">
              <label>Qty Koli Dokumen</label>
              <input type="number" class="form-control" value="<?php echo e($awb->qty_doc); ?>" name="qty_doc" placeholder="Input jumlah koli dokumen. . ." value="0">
            </div>
          </div>
          <?php endif; ?>
        </div>
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
                <input type="text" class="form-control" value="<?php echo e($awb->nama_penerima); ?>" name="nama_penerima" placeholder="Input Nama Penerima. . ." required>
              </div>
              <div class="form-group">
                <label>Alamat Tujuan Penerima</label>
                <select id="alamat_tujuan_auto" class="form-control mb-2" name="alamat_tujan_auto"> 
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
              <input type="text" class="form-control" id="alamat_tujuan" value="<?php echo e($awb->alamat_tujuan); ?>" name="alamat_tujuan" placeholder="Input Alamat tujuan. . ." required>
              </div>
            <div class="form-group">
              <label>Kode Pos Penerima</label>
              <input type="text" class="form-control" value="<?php echo e($awb->kodepos_penerima); ?>" name="kodepos_penerima" placeholder="Input Kode Pos. . ." required>
            </div>
            <div class="form-group">
              <label>No Telp Penerima</label>
              <input type="text" class="form-control" value="<?php echo e($awb->notelp_penerima); ?>" name="notelp_penerima" placeholder="Input Nomor Telp Penerima. . ." required>
            </div>
          </div>
          <div class="col-lg-6">
              <div class="form-group">
                <label>Nama Pengirim</label>
                <input type="text" id="nama_pengirim" class="form-control" value="<?php echo e($awb->nama_pengirim); ?>" name="nama_pengirim" placeholder="Input Nama Pengirim. . ." required>
              </div>
              <div class="form-group">
                <label>Alamat Pengirim</label>
                <select id="alamat_pengirim_auto" class="form-control mb-2" name="alamat_pengirim_auto"> 
                    <?php if($id == 0): ?>
                    <option value="manual">Input Alamat Manual</option>
                    <?php else: ?>
                      <?php $__currentLoopData = $master_alamat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>:
                        <?php if($a->alamat == $awb->alamat_pengirim): ?>
                          <option value="<?php echo e($a->alamat); ?>" selected><?php echo e($a->labelalamat); ?></option>
                        <?php else: ?>
                          <option value="<?php echo e($a->alamat); ?>"><?php echo e($a->labelalamat); ?> </option>
                        <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php if(!empty($alamat_pengirim_array)): ?>
                        <option value="manual">Input Alamat Manual</option>
                      <?php else: ?>
                        <option value="manual" selected>Input Alamat Manual</option>
                      <?php endif; ?>
                    <?php endif; ?>
                </select>
                <input type="text" id="alamat_pengirim" class="form-control mb-2" value="<?php echo e($awb->alamat_pengirim); ?>" name="alamat_pengirim" placeholder="Input Alamat Manual. . .">
              </div>
            <div class="form-group">
              <label>Kode Pos Pengirim</label>
              <input type="text" id="kodepos_pengirim" class="form-control" value="<?php echo e($awb->kodepos_pengirim); ?>" name="kodepos_pengirim" placeholder="Input Kode Pos. . ." required>
            </div>
            <div class="form-group">
              <label>No Telp Pengirim</label>
              <input type="text" id="notelp_pengirim" class="form-control" value="<?php echo e($awb->notelp_pengirim); ?>" name="notelp_pengirim" placeholder="Input Nomor Telp Pengirim. . ." required>
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
                <?php $__currentLoopData = $kota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($c->id == $awb->id_kota_asal): ?>
                    <option value="<?php echo e($c->id); ?>" selected><?php echo e($c->nama); ?></option>
                  <?php else: ?>
                  <option value="<?php echo e($c->id); ?>"><?php echo e($c->nama); ?></option>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            
            
            <?php if(Auth::user()->level == 1): ?>
            
            <div class="form-group">
              <label>Kota Transit</label>
              <select style="width:90%" class="select2 form-control" name="id_kota_transit" >
                <option value="">--Pilih Kota Transit--</option>
                <?php $__currentLoopData = $kota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($c->id == $awb->id_kota_transit): ?>
                    <option value="<?php echo e($c->id); ?>" selected><?php echo e($c->nama); ?></option>
                  <?php else: ?>
                  <option value="<?php echo e($c->id); ?>"><?php echo e($c->nama); ?></option>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            <?php endif; ?>
            
          </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Kota Tujuan</label>
                <select style="width:90%" class="select2 form-control" id="kota_tujuan" name="id_kota_tujuan" required>
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
              <label>Kecamatan Tujuan</label>
              <select style="width:90%" class="select2 form-control" id="kecamatan_tujuan" name="id_kecamatan_tujuan" required>
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
            <?php if(Auth::user()->level == 1): ?>
            <div class="form-group">
              <label>Agen Tujuan</label>
              <select style="width:90%" class="select2 form-control" id="agen_tujuan" name="id_agen_penerima" required>
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
              <label>Keterangan tambahan :</label>
              <textarea name="keterangan" rows="4" class="form-control"> <?php echo e($awb->keterangan); ?></textarea>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="card-footer d-flex justify-content-between">
    <button type="submit" class="btn btn-primary mr-2">SIMPAN</button>
    <input style="width:500px;" type="text" class="form-control" name="harga_total" id="harga_total" readonly="true" placeholder="0" >
  </div>
</form>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
  $('#alamat_pengirim').hide()
  $('#alamat_tujuan').hide()
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
        console.log(data);
        $('#nama_pengirim').val(data.data.nama)
        $('#alamat_pengirim_auto').html(data.alamat)
        $('#alamat_tujuan_auto').html(data.alamat)
        $('#alamat_tujuan').html(data.data.alamat)
        $('#alamat_pengirim').val(data.data.alamat)
        $('#kodepos_pengirim').val(data.data.kodepos)
        $('#notelp_pengirim').val(data.data.notelp)
        if(data.count_alamat == 0){
          $('#alamat_pengirim').show()
        }
        else{
          $('#alamat_pengirim').hide()
        }
      }
    })
  })

  $('#alamat_pengirim_auto').on('change',function(){
    var value = $(this).val()
    console.log(value)
    if(value == "manual"){
      $('#alamat_pengirim').show()
      $('#alamat_pengirim').val('')
    }
    else{
      $('#alamat_pengirim').hide()
      $('#alamat_pengirim').val(value)
    }
  })

  $('#alamat_tujuan_auto').on('change',function(){
    var value = $(this).val()
    console.log(value)
    if(value == "manual"){
      $('#alamat_tujuan').show()
      $('#alamat_tujuan').val('')
    }
    else{
      $('#alamat_tujuan').hide()
      $('#alamat_tujuan').val(value)
    }
  })
  
  $(document).ready(function(){
    if($('#check_alamat_tujuan').val() == 0){
      $('#alamat_tujuan').show()
    }

    if($('#check_alamat_pengirim').val() == 0){
      $('#alamat_pengirim').show()
    }
  })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/pages/awb/create.blade.php ENDPATH**/ ?>