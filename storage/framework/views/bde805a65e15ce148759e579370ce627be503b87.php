
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header border-0" style="padding-bottom:0px; padding-top:10px;">
          <div class="card-title font-weight-bolder">
            <div class="card-label">Report Komisi</div>
          </div>
        </div>
        <div class="card-body">
          <form class="form" id="form">
            <?php if((int) Auth::user()->level == 3): ?>
              <input type="hidden" name="id_agen_asal" value="-">
              <input type="hidden" name="id_agen_tujuan" value="-">
            <?php endif; ?>
            <?php echo e(csrf_field()); ?>

            <div class="row">
              <div class="col-lg-3 
              <?php if((int) Auth::user()->level == 3): ?>
              
              d-none
              <?php endif; ?>
              ">
                <label>Agen Asal:</label>
                <select class="form-control select2" name="id_agen_asal" id="id_agen_asal">
                  <option value="-">--Tampil Semua--</option>
                  <?php $__currentLoopData = $agen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($k['id']); ?>"><?php echo e($k['nama']); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
              <div class="col-lg-6">
                <label>Tanggal Awal - Akhir:</label>
                <input type="text" id="txtPeriod" class="form-control" name="tanggal" id="tanggal" required>
              </div>
              <div class="col-lg-3 
              <?php if((int) Auth::user()->level == 3): ?>
              d-none
              <?php endif; ?>
              ">
                <label>Agen Tujuan</label>
                <select class="form-control select2" name="id_agen_tujuan" id="id_agen_tujuan">
                  <option value="-">--Tampil Semua--</option>
                  <?php $__currentLoopData = $agen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($k['id']); ?>"><?php echo e($k['nama']); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>

              <div class="col-lg-3 
              <?php if((int) Auth::user()->level == 3): ?>
              d-none
              <?php endif; ?>
              ">
                <label>Kota Tujuan</label>
                <select class="form-control select2" name="id_kota_tujuan" id="id_kota_tujuan">
                  <option value="-">--Tampil Semua--</option>
                  <?php $__currentLoopData = $kota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($k->id); ?>"><?php echo e($k->nama); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-lg-3">
                <button type="button" class="btn btn-lg btn-outline-primary" id="btnproses"><i class="flaticon-search"></i> Cari</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div  class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div id="awb"></div>
          <div class="loadpanel"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
  
  $(document).on({
      ajaxStart: function() { loadPanel.show(); },
      ajaxStop: function() { loadPanel.hide(); }    
  });
  $(document).ready(function() {
        //Initialize Select2 Elements

        $('#txtPeriod').daterangepicker({
            locale: {
                format: "DD/MM/YYYY",
            }
        });

        $("#txtPeriod").val('')
        show_grid(null)
    });

    $("#btnproses").on('click',function(){
        if($("#txtPeriod").val() != ''){
            $.ajax({
                type : "POST",
                url : "<?php echo e(url('report/bonus-grid')); ?>",
                dataType : "json",
                data :  $("#form").serialize(),
                success : function(response) {
                    console.log(response)
                    show_grid(response.data)
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown)
                }
            });
        }
    })
  function show_grid(data){
    var dataGrid = $("#awb").dxDataGrid({
            dataSource: data,
            height:470,
            paging: {
                pageSize: 10,
            },
            pager: {
                visible: true,
                showNavigationButtons: true,
                showInfo: true,
                showPageSizeSelector: true,
                allowedPageSizes: [10, 25, 50, 100]
            },
            filterRow: {
                visible: true,
                applyFilter: "auto"
            },
            headerFilter: {
                visible: true
            },
            hoverStateEnabled: true,
            groupPanel: {
                visible: true
            },
            grouping: {
                autoExpandAll: false
            },
            scrolling: {
                // mode: "virtual",
                rowRenderingMode: 'virtual'
            },
            columnAutoWidth: true,
            export: {
                enabled: false,
                fileName: "Laporan Invoice",
                allowExportSelectedData: true
            },
            onToolbarPreparing: function (e) {
                e.toolbarOptions.items.push({
                    widget: 'dxButton',
                    showText: 'always',
                    options: {
                        icon: 'export',
                        // text: 'Export to Excel',
                        onClick: function () {
                            e.component.exportToExcel(true);
                        }
                    },
                    location: 'after'
                });
            },
            allowColumnReordering: true,
            allowColumnResizing: true,
            showBorders: true,
            wordWrapEnabled:true,
            columns: [
                // {
                //     caption: "No",
                //     dataType: "number",
                //     alignment: 'center',
                //     width: 70,
                //     cellTemplate: function(container, row) {
                //         $(container).html(row.rowIndex + 1);
                //     }
                // },
                {
                    caption: "Kode AWB",
                    dataField: "noawb",
                    dataType: "string",
                    width:200,
                },
                {
                    caption: "Kota Asal",
                    dataField: "kota_asal",
                    dataType: "string",
                    width:170,
                },
                {
                    caption: "Kota Tujuan",
                    dataField: "kota_tujuan",
                    dataType: "string",
                    format:"shortDateShortTime",
                    width:170,
                },
                {
                    caption: "Agen Asal",
                    dataField: "pengirim",
                    dataType: "string",
                    width:175,
                },
                {
                    caption: "Agen Tujuan",
                    dataField: "agen_tujuan",
                    dataType: "string",
                    width:175,
                },
                {
                    caption: "Transit Surabaya",
                    dataField: "kota_transit",
                    dataType: "string",
                    width:170,
                },
                {
                    caption: "Status AWB",
                    dataField: "status_tracking",
                    dataType: "string",
                    width:170,
                },
                {
                    caption: "Total OA",
                    dataField: "idr_oa",
                    dataType: "number",
                    format:"#,##0",
                    width:170,
                },
                {
                    caption: "Total Harga",
                    dataField: "total_harga",
                    dataType: "number",
                    format:"#,##0",
                    width:170,
                },
                {
                    caption: "Komisi Agen Asal",
                    dataField: "bonus_agen_asal",
                    dataType: "number",
                    format:"#,##0",
                    width:170,
                },
                {
                    caption: "Komisi GSA",
                    dataField: "bonus_gsa",
                    dataType: "number",
                    format:"#,##0",
                    width:170,
                },
                {
                    caption: "Komisi Agen Tujuan",
                    dataField: "bonus_agen_tujuan",
                    dataType: "number",
                    format:"#,##0",
                    width:170,
                },
                
            ],
        }).dxDataGrid("instance");
    return dataGrid;
  }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/pages/report/bonus.blade.php ENDPATH**/ ?>