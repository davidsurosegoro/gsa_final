

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-center mb-5">
        <div class="col-lg-3 col-xl-3 col-sm-3">
        	<div class="card card-custom wave wave-animate-fast wave-info">
        		<div class="card-body text-center">
                <a href="<?php echo e(url('master/create')); ?>">
                        <span class="svg-icon svg-icon-primary svg-icon-4x">
                           <i class="icon-4x flaticon-upload text-info"> </i>
                        </span>
                        </a>
                        <br>
                        <a href="<?php echo e(url('master/create')); ?>" class="text-dark text-hover-danger font-weight-bold font-size-h4 mb-3">Upload Peta</a>
        		</div>
        	</div>
        </div>

        <div class="col-lg-3 col-xl-3 col-sm-3">
	        	<div class="card card-custom wave wave-animate-fast wave-info">
	        		<div class="card-body text-center">
	                <a href="<?php echo e(url('master/create-custom')); ?>">
	                        <span class="svg-icon svg-icon-primary svg-icon-4x">
	                           <i class="icon-4x flaticon-list text-info"> </i>
	                        </span>
	                        </a>
	                        <br>
	                        <a href="<?php echo e(url('master/create-custom')); ?>" class="text-dark text-hover-danger font-weight-bold font-size-h4 mb-3">Buat Peta</a>
	        		</div>
	        	</div>
        </div>

        <div class="col-lg-3 col-xl-3 col-sm-3">
        	<div class="card card-custom wave wave-animate-fast wave-info">
	        		<div class="card-body text-center">
	                <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-tag">
	                        <span class="svg-icon svg-icon-primary svg-icon-4x">
	                           <i class="icon-4x flaticon-notes text-info"> </i>
	                        </span>
	                        </a>
	                        <br>
	                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-tag" class="text-dark text-hover-danger font-weight-bold font-size-h4 mb-3">Tagging Peta</a>
	        		</div>
	        	</div>
        </div>

        <div class="col-lg-3 col-xl-3 col-sm-3">
        	<div class="card card-custom wave wave-animate-fast wave-info">
	        		<div class="card-body text-center">
	                <a href="<?php echo e(url('master/create-indikator')); ?>">
	                        <span class="svg-icon svg-icon-primary svg-icon-4x">
	                           <i class="icon-4x flaticon-upload-1 text-info"> </i>
	                        </span>
	                        </a>
	                        <br>
	                        <a href="<?php echo e(url('master/create-indikator')); ?>" class="text-dark text-hover-danger font-weight-bold font-size-h4 mb-3">Upload Peta Indikator</a>
	        		</div>
	        	</div>
        </div>
    </div>

    <div class="row justify-content-center">
    	<div class="col-md-12 col-xl-12">
            <div class="card card-custom">
                <div class="card-body text-left">
                	<div class="table-responsive">
                		<table id="datatables" class="table-striped table-hover table-bordered">
                			<thead>
                				<tr>
                					<th>ID</th>
                					<th>Nama Peta</th>
                					<th>Tipe Peta</th>
                					<th>Projection</th>
                					<th>Perangkat Daerah</th>
                					<th>Tahun</th>
                					<th>Total Data</th>
                					<th>Aksi</th>
                				</tr>
                			</thead>
                		</table>
                	</div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-tag" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myLargeModalLabel"><i class="zmdi zmdi-tag"> </i> Tag Layer </h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-horizontal">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">
                                                                    Pilih Layer :
                                                                </label>
                                                                <div class="col-md-6">
                                                                    <select class="form-control select2" id="cbo-tag" data-live-search="true">
                                                                        <?php $__currentLoopData = $map; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($m->id); ?>">
                                                                            <?php echo e($m->nama_peta); ?>

                                                                        </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        <div id="res-tag">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Layer Milik : </label>
                                                                <label class="control-label "> <strong id="res-tag-pd"> Badan Perencanaan Pembangunan </strong> </label>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">PD yang sudah ditagging di layer ini : </label>
                                                                <div class="col-md-10">
                                                                    <table class="table table-hovered table-striped table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th> Nama Perangkat Daerah</th>
                                                                                <th> Aksi </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="res-table-tag">
                                                                            <tr>
                                                                                <td>
                                                                                    
                                                                                </td>
                                                                                <td>
                                                                                    <button type="button" class="btn btn-danger-custom btn-xs" > <i class="fa fa-trash fa-fw"> </i> </button>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </form>
                                                        <div class="card-body exs" id="frm-tambah-tag">
                                                        <form class="form-horizontal"  method="POST" action="<?php echo e(url('ajax/master/save-tag')); ?>" >
                                                            <?php echo e(csrf_field()); ?>

                                                            <input type="hidden" name="map_tag" id="map_tag">
                                                            <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-tag mr-10"></i>Tambah Tagging</h6>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">
                                                                    Pilih PD :
                                                                </label>
                                                                <div class="col-md-6">
                                                                    <select class="form-control select2" name="pd" id="cbo-tambah-tag" data-live-search="true">
                                                    
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-offset-6">
                                                                    <button class="btn btn-primary" type="submit"> SIMPAN </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
<div class="modal fade modal-edit-attr-peta" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myLargeModalLabel">Kelola Attribut Peta <span id="title-kelola">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> </span> </h5>
                                                    </div>
                                                    <div class="modal-body">
                                        <ul role="tablist" class="nav nav-tabs nav-tabs-line mb-2" id="myTabs_13">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" aria-expanded="true" data-toggle="tab" role="tab" id="home_tab_13" href="#hapus_kolom">
                                                     <span class="nav-icon"><i class="flaticon-delete"></i></span>
                                                     <span class="nav-text">Hapus Kolom</span>
                                                </a>
                                            </li>
                                            <li class="nav-item"  role="presentation" class="">
                                                <a class="nav-link" data-toggle="tab" id="profile_tab_13" role="tab" href="#tambah_kolom" aria-expanded="false">
                                                 <span class="nav-icon"><i class="flaticon-add-circular-button"> </i></span>
                                                <span class="nav-text">Tambah Kolom</span>
                                                </a>
                                            </li>
                                            <?php if(Auth::user()->user_level == 7): ?>
                                            <li class="nav-item"  role="presentation" class="">
                                                <a class="nav-link" data-toggle="tab" id="profile_tab_13" role="tab" href="#edit_kolom" aria-expanded="false"> 

                                                 <span class="nav-icon"><i class="flaticon-edit"> </i></span>
                                                <span class="nav-text">Edit Kolom</span>
                                                </a>
                                            </li>
                                            <li class="nav-item"  role="presentation" class="">
                                                <a class="nav-link" data-toggle="tab" id="profile_tab_13" role="tab" href="#hapus_summary" aria-expanded="false">
                                                 <span class="nav-icon"><i class="flaticon-delete"></i></span>
                                                 <span class="nav-text">Hapus Summary</span>
                                         </a> 
                                         </li>
                                            <li class="nav-item"  role="presentation" class="">
                                                <a class="nav-link" data-toggle="tab" id="profile_tab_13" role="tab" href="#setting_summary" aria-expanded="false">
                                                 <span class="nav-icon"><i class="flaticon-add-circular-button"> </i></span>
                                                <span class="nav-text">Tambah Summary</span> 
                                            </a> 
                                         </li>
                                            <?php endif; ?>
                                        </ul>
                                        <div class="tab-content" id="myTabContent_13">
                                            <div id="hapus_kolom" class="tab-pane fade show active in" role="tabpanel">
                                                    <div class="table-responsive">
                                                            <table class="table table-striped table-bordered table-hovered">
                                                                <thead>
                                                                    <th> Nama Kolom </th>
                                                                    <th> Tipe Kolom </th>
                                                                    <th> Action </th>
                                                                </thead>
                                                                <tbody id="data-attr">
                                                                </tbody>
                                                            </table>
                                                        </div>
                                            </div>
                                            <div id="edit_kolom" class="tab-pane fade" role="tabpanel">

                                                <div class="alert alert-warning alert-dismissable alert-style-1 ">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="zmdi zmdi-alert-circle-o"></i>
                                                    <span > Silahkan Klik kolom yg ingin diedit akan otomatis keluar form edit pada kolom yang anda pilih </span>
                                                    </div>
                                                    <div class="table-responsive">
                                                            <table class="table table-striped table-bordered table-hovered">
                                                                <thead>
                                                                    <th> Nama Kolom </th>
                                                                </thead>
                                                                <tbody id="data-attr-edit">
                                                                </tbody>
                                                            </table>
                                                        </div>
                                            </div>
                                            <div id="hapus_summary" class="tab-pane fade" role="tabpanel">
                                                    <div class="table-responsive">
                                                            <table class="table table-striped table-bordered table-hovered">
                                                                <thead>
                                                                    <th> Judul Summary </th>
                                                                    <th> Attribut </th>
                                                                    <th>Metode Hitungan</th>
                                                                    <th>Filter Tambahan </th>
                                                                    <th>Hasil </th>
                                                                    <th> Action </th>
                                                                </thead>
                                                                <tbody id="data-summary">
                                                                </tbody>
                                                            </table>
                                                        </div>
                                            </div>
                                            <div id="setting_summary" class="tab-pane fade" role="tabpanel">
                                                <div class="alert alert-warning alert-dismissable alert-style-1 info-summary">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="zmdi zmdi-alert-circle-o"></i>
                                                    <span class="desc-summary"> Info! Summary akan muncul ketika layer sudah dioverlay </span>
                                                    </div>
                                                    <form class="form-horizontal" method="POST" id="frm-proses-query" action="<?php echo e(url('ajax/proses-query')); ?>">
                                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                            <input type="hidden" name="table_name" id="table_name" value="">
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">Judul : </label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="deskripsi_summary" id="deskripsi_summary" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">Attribut : </label>
                                                    <div class="col-md-8">
                                                        <select class="form-control" name="attribut_query" id="attribut_query" required>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">Hitungan : </label>
                                                    <div class="col-md-8">
                                                    <select name="hitungan" id="hitungan" class="form-control" required>
                                                        <option value="">
                                                            --Pilih Metode Hitungan--
                                                        </option> 
                                                        <option value="count_all">COUNT (Hitung semua data) </option>
                                                        <option value="sum">SUM </option>
                                                        <option value="avg">AVERAGE </option>
                                                        <option value="max">MAX </option>
                                                        <option value="min">MIN </option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">Group By Kecamatan : </label>
                                                    <div class="col-md-8">
                                                    <select name="group_kecamatan" id="group_kecamatan" class="select2 form-control" data-live-search="true" required>
                                                        <option value="null">
                                                            --Pilih Kecamatan--
                                                        </option> 
                                                        <?php $__currentLoopData = $master_kecamatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($kec->gid); ?>"> <?php echo e($kec->layer_1); ?> </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="card-body mb-2 exs">
                                                <h6 class="txt-dark capitalize-font">

                                                    <label class="checkbox checkbox-primary">
                                                        <input id="chk-filter-tambahan" type="checkbox" name="filter_query_is_aktif">
                                                        <span></span>
                                                         <i class="fa fa-filter"></i>  Aktifkan Filter Tambahan 
                                                    </label></h6>
                                                <div class="form-group">
                                                  <label class="control-label col-md-2">Attribut :</label>
                                                  <div class="col-md-8">
                                                    <select class="form-control" name="attribut_filter_query" data-live-search="true" id="attribut_filter_query" readonly="readonly"> </select>
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                  <label class="control-label col-md-2">Operator :</label>
                                                  <div class="col-md-8">
                                                    <select class="form-control" name="operator_filter_query" id="operator_filter_query" required="" tabindex="-98" readonly="readonly">
                                                        <option value="">--Pilih Operator-- </option>
                                                        <option value="<">Kurang Dari ( &lt; )</option>
                                                        <option value=">">Lebih Dari ( &gt; )</option>
                                                        <option value="=">Sama Dengan ( = )</option>
                                                        <option value="!=">Tidak Sama Dengan ( != )</option>
                                                        <option value="like">Mendekati String ( LIKE )</option>
                                                        <option value="<=">Kurang Dari Sama Dengan ( &lt;= )</option>
                                                        <option value=">=">Lebih Dari Sama Dengan ( &gt;= )</option>
                                                        <option value="IS NOT NULL">Tidak Kosong ( is not null )</option>
                                                        <option value="IS NULL">Kosong ( is null )</option>
                                                    </select>
                                                  </div>
                                                </div>

                                                <div class="form-group">
                                                  <label class="control-label col-md-2" >
                                                        Value :
                                                    </label>
                                                  <div class="col-md-6">
                                                      <input type="text" class="form-control" placeholder="nilai filter. . ." name="value_filter_query" id="value_filter_query" readonly="readonly">
                                                  </div>
                                                </div>
                                              </div>
                                                <div class="row">
                                                    <div class="col-md-offset-6">
                                                        <button class="btn btn-primary" type="submit"><i class="flaticon2-checkmark"></i> CHECK QUERY </button>
                                                        <button class="btn btn-outline-success" type="button" id="btn-summary-save"> <i class="zmdi zmdi-check"></i> SIMPAN </button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="row">
                                                <div class="col-md-offset-2">
                                                <br>
                                                <p> * <b> Catatan </b> Query SUM,AVG,MIN & MAX hanya dapat digunakan untuk tipe data <b>numeric/angka </b> </p>
                                                <p class="text-bold">  Hasil Query : <label class="label label-primary" id="hasil_query" style="font-size:16px; color:white; font-weight: bold;"> - </label> </p>
                                                </div>
                                            </div>
                                            </div>
                                            <div id="tambah_kolom" class="tab-pane fade" role="tabpanel">
                                                <form class="form-horizontal" method="POST" action="<?php echo e(url('setting-attribut')); ?>">
                                                    <div class="alert alert-custom alert-notice alert-light-danger fade show" role="alert">
    <div class="alert-icon"><i class="flaticon-warning"></i></div>
    <div class="alert-text">Anda hanya perlu menambahkan attribut yang belum ada pada peta. jika nama attribut yang anda tambahkan sama dengan attribut yang sudah ada maka attribut tidak akan ditambahkan.</div>
    <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="ki ki-close"></i></span>
        </button>
    </div>
</div>
                                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                                    <input type="hidden" name="map_name" id="map_name">
                                                <div id="frmattribut1" class="attributs">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Nama Attribut : </label>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <input type="text" name="attribut[1][nama_attribut]" id="nama_attribut1" class="form-control" placeholder="masukkan nama attribut. . ." required>
                                                                    </div>
                                                                    <div class="col-md-2">

                                                                <button type="button" class="btn btn-icon btn-danger btn-xs delete_attributs" id="delete_attribut1" style="margin-bottom:10px;"> <i class="flaticon-delete"></i> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Tipe Attribut : </label>
                                                                    <div class="col-md-6">
                                                                        <select class="form-control" name="attribut[1][tipe_attribut]" id="tipe_attribut1" required>
                                                                            <option value="character varying(254)">Character Varying </option>
                                                                            <option value="double precision">Decimal </option>
                                                                            <option value="bigint">Integer </option>
                                                                            <option value="date">Tanggal </option>
                                                                        </select>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                            <div class="form-group">
                                                                <button id="tambah-attribut" type="button" class="col-md-offset-6 btn btn-md btn-primary">
                                                                    <i class="fa fa-plus"> </i>Tambah Attribut
                                                                </button>
                                                            </div>
                                                            <hr>
                                                            <button type="submit" class="btn btn-outline-success mr-10">Simpan</button>
                                                        </form>
                                            </div>
                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>

   <div class="modal fade modal-edit-peta" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
                                            <div class="modal-dialog modal-lg">

                                                        <form class="form-horizontal" method="POST" action="<?php echo e(url('master/update')); ?>">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myLargeModalLabel">Peta <b id="title-peta">A </b> </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                                            <input type="hidden" name="map_id" id="map_id">
                                                            <input type="hidden" name="old_layer_name" id="old_layer_name">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-2">
                                                                Nama Peta :
                                                            </label>
                                                            <div class="input-group col-md-8">
                                                                <div class="input-group-addon"><i class="icon-map"></i></div>
                                                                <input class="form-control" type="text" name="nama_peta" id="nama_peta" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-2" for="exampleInputuname_1">Urusan : </label>
                                                            <div class="col-md-8">
                                                                <select name="urusan" class="form-control" id="urusan" data-live-search="true" required>
                                                                    <option value="">--Pilih Urusan-- </option>
                                                                    <?php $__currentLoopData = $urusan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($u->kode_urusan); ?>"><?php echo e($u->narasi_urusan); ?> </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-2" for="exampleInputEmail_1">Tahun : </label>
                                                            <div class="input-group col-md-4">
                                                                <div class="input-group-addon"><i class="icon-calender"></i></div>
                                                                <input type="number" name="tahun" id="tahun" class="form-control" id="exampleInputEmail_1" placeholder="2017" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-2" for="exampleInputpwd_1">Type : </label>
                                                            <div class="input-group col-md-4">
                                                                <div class="input-group-addon"><i class="icon-layers"></i></div>
                                                                <select class="form-control" name="type" id="type" readonly="true">
                                                                    <option value="Point">Point</option>
                                                                    <option value="Linestring">LineString</option>
                                                                    <option value="Polygon">Polygon</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <?php if(Auth::user()->id == 1): ?>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-2" for="exampleInputpwd_1">Sumber Data : </label>
                                                            <div class="input-group col-md-6">
                                                                <div class="input-group-addon"><i class="icon-people"></i></div>
                                                                <select class="form-control select2" name="skpd_kode" id="skpd_kode" data-live-search="true" required>
                                                                    <?php $__currentLoopData = $skpd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($pd->kode); ?>"> <?php echo e($pd->skpd_nama); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary text-left" >SIMPAN </button>
                                                        
                                                        <button type="button" class="btn btn-outline-danger text-left" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                                    </form>
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
   $('#datatables').DataTable({
	    processing: true,
	    serverSide: false,
	    paging:true,
	    ajax: '<?php echo e(url('master/datatables')); ?>',
	    columns: [
	    {data: 'id', name:'id'},
	    {data: 'nama_peta', name:'nama_peta'},
	    {data: 'tipe_peta', name:'tipe_peta'},
	    {data: 'projection', name:'projection'},
	    {data: 'pd', name:'pd'},
	    {data: 'tahun_data', name:'tahun_data'},
	    {data: 'total_data', name:'total_data'},
	    {data: 'aksi', name:'aksi'},
	],
	 "order": [[ 1, "asc" ]],
   });

$('#res-tag').hide();
var filter;
$('#frm-tambah-tag').hide();
$('#cbo-tag').on('change',function(){
    $.ajax({
        method:'POST',
        url:base_url+'ajax/master/tag',
        data:{
            id:$(this).val(),
            '_token': $('input[name=_token]').val(),
        },
        success:function(data){
            console.log(data.view_table_tagged);
            $('#res-tag').show();
            $('#frm-tambah-tag').show();
            $('#res-tag-pd').html(data.skpd);
            $('#res-table-tag').html(data.view_table_tagged);
            $('#cbo-tambah-tag').html(data.view_cbo_tagged);
            $('#map_tag').val(data.id);
        }
    })
});

    function deleteTag(id){
        Swal.fire({   
                      title: "Anda Yakin?",   
                      text: "Perangkat Daerah akan dihapus dari tag- tagan layer ini",   
                      icon: "question",   
                      showCancelButton: true,   
                      confirmButtonColor: "#e6b034",   
                      confirmButtonText: "Ya, Hapus Tag", 
                      }).then(function(result){
                        if(result.value){

                            $.ajax({
                            method:'POST',
                            url:base_url+'ajax/master/delete-tag',
                            data:{
                              id:id,
                              '_token': $('input[name=_token]').val()
                            },
                            success:function(data){
                                console.log(data);
                                Swal.fire({title:"Terhapus!", text:"Tag tagan sudah terhapus dari perangkat daerah ini", icon:"success"},function(){
                                }).then(function(result){
                                    location.reload()
                                })
                            }
                          })   
                        }
                  });
    }


    function editPeta(id,nama)
    {
        $('#title-peta').html(nama);
        $.ajax({
            method:'POST',
            url:base_url+'ajax/master/edit-peta',
            data:{
                id:id,
                '_token': $('input[name=_token]').val()
            },
            success:function(data){
                console.log(data.projeksi)
                $('#map_id').val(data.map.id);
                $('#nama_peta').val(data.map.nama_peta);
                $('#tahun').val(data.map.tahun);
                $('#urusan').val(data.map.kode_urusan);
                $('#type').val(data.map.type);
                $('#old_layer_name').val(data.map.table_name);
                $('#projeksi').val(data.projeksi);
            }
        })

    }
function exportMap(id){
  $.ajax({
    url:base_url+'export',
    method:'POST',
    data:{
      id:id,
      '_token': $('input[name=_token]').val()
    },
    success:function(data){
     console.log(data)
      //window.location.assign('https://sigis.surabaya.go.id/sigis3/download');
      window.location.assign( data.data.url, '', 'width=500, height=250' );
    }
  })
}


    function kelolaLayer(id,map_name){

        $.ajax({
            method:'POST',
            url:base_url+'ajax/master/kelola',
            data:{
                id:id,
                map_name:map_name,
                '_token': $('input[name=_token]').val()
            },
            success:function(data){
                $('#data-attr').html(data.view);
                $('#data-attr-edit').html(data.view_attribut_query_edit);
                $('#data-summary').html(data.view_summary);
                $('#title-kelola').html(map_name);
                $('#map_name').val(map_name);
                $('#attribut_query').html(data.view_attribut_query).selectpicker('refresh');
                $('#attribut_filter_query').html(data.view_attribut_query).selectpicker('refresh');
                $('#table_name').val(data.map_name);

    $('.txteditkolom').hide();
            }
        })
    }

    if ($('.attributs').length <= 1) {
            $('.delete_attributs').hide();
            $('#delete_attribut1').hide();
      }

       function removeAttribut(val,id){
        $(val).remove();
        $('input[name="delete_attribut[' + id + ']"]').val(id);
    }

    $('#tambah-attribut').click(function(){
        var numb = $('.attributs').length;

        var newNumb = numb + 1;
        var newElemb = $('#frmattribut' + numb).clone().attr('id', 'frmattribut' + newNumb);

        newElemb.find('#nama_attribut' + numb).attr('id', 'nama_attribut' + newNumb).attr('name', 'attribut[' + newNumb + '][nama_attribut]').val('');
        newElemb.find('#tipe_attribut' + numb).attr('id', 'tipe_attribut' + newNumb).attr('name', 'attribut[' + newNumb + '][tipe_attribut]').val('');

        newElemb.find('#delete_attribut' + numb).attr('id', 'delete_attribut' + newNumb).attr('onclick', 'removeAttribut("#frmattribut' + newNumb + '")').show();

        $('#frmattribut' + numb).after(newElemb);

      });


    $('#btn-summary-save').on('click',function(){

        if ($('#chk-filter-tambahan').is(':checked')) {
            filter = 'on';
        }
        else{
            filter = 'no';
        }
        $.ajax({
            method:'POST',
            url:base_url+'ajax/master/summary/save',
            data:{
                attribut_query:$('#attribut_query').val(),
                hitungan:$('#hitungan').val(),
                group_kecamatan:$('#group_kecamatan').val(),
                chk_filter_tambahan:filter,
                attribut_filter_query:$('#attribut_filter_query').val(),
                operator_filter_query:$('#operator_filter_query').val(),
                value_filter_query:$('#value_filter_query').val(),
                table_name:$('#table_name').val(),
                deskripsi_summary:$('#deskripsi_summary').val(),
                '_token': $('input[name=_token]').val()

            },
            success:function(data){
                Swal.fire({title:"Success!", text:"Peta "+$('#table_name').val()+" berhasil disetting summarynya", icon:"success"},function(){
                                $('.modal-edit-attr-peta').modal('toggle');
                                })
            }
        })
    })


    function deleteAttr(column_name, map_name){
        Swal.fire({   
                      title: "Anda Yakin?",   
                      text: "Kolom Attribut "+column_name+" akan terhapus dari sistem beserta data pada kolom tersebut",   
                      icon: "warning",   
                      showCancelButton: true,   
                      confirmButtonColor: "#e6b034",   
                      confirmButtonText: "Ya, Hapus Kolom",   
                      }).then(function(result) {
                        if (result.value) {
                               $.ajax({
                                    method:'POST',
                                    url:base_url+'ajax/master/delete-attr',
                                    data:{
                                      column_name:column_name,
                                      map_name:map_name,
                                      '_token': $('input[name=_token]').val()
                                    },
                                    success:function(data){
                                        console.log(data);
                                        Swal.fire({title:"Terhapus!", text:"Kolom Attribut "+column_name+" berhasil terhapus dari sistem", icon:"success"},function(){
                                        })
                                    }
                                  })   
                        }
                  });
    }

    function deletePeta(id,nama)
    {
         Swal.fire({   
                      title: "Anda Yakin?",   
                      text: "Peta "+nama+" akan terhapus dari sistem",   
                      icon: "warning",   
                      showCancelButton: true,   
                      confirmButtonColor: "#e6b034",   
                      confirmButtonText: "Ya, Hapus Peta" 
                       
                  }).then((result) => {
            if (result.value) {
                $.ajax({
                            method:'POST',
                            url:base_url+'ajax/master/delete',
                            data:{
                              id:id,
                              map_name:nama,
                              '_token': $('input[name=_token]').val()
                            },
                            success:function(data){
                                Swal.fire({title:"Terhapus!", text:"Peta "+nama+" berhasil terhapus dari sistem", icon:"success"}
                                ).then((result) => {
                                    location.reload()
                                })
                            }
                          }) 
            } 
         });
    }
</script>
<?php if(Session::get('message') == "updated_tag"): ?>
    <script type="text/javascript">
        toastr.success("Tagging Baru Berhasil ditambahkan!");
    </script>
<?php endif; ?>
<?php if(Session::get('message') == "created"): ?>
    <script type="text/javascript">
        toastr.success("Upload Peta Berhasil!");
    </script>
<?php endif; ?>
<?php if(Session::get('message') == "updated"): ?>
    <script type="text/javascript">
        toastr.success("Data Peta Berhasil diubah!");
    </script>
<?php endif; ?>
<?php if(Session::get('message') == "created_custom"): ?>
    <script type="text/javascript">
        toastr.success("Peta Baru Berhasil Terbuat!");
    </script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/master_peta/index.blade.php ENDPATH**/ ?>