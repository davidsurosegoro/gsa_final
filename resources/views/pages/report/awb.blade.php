@extends('layouts.app')
@section('content')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header border-0" style="padding-bottom:0px; padding-top:10px;">
          <div class="card-title font-weight-bolder">
            <div class="card-label">Report AWB</div>
          </div>
        </div>
        <div class="card-body">
          <form class="form" id="form">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-lg-3">
                <label>Customer:</label>
                <select class="form-control select2" name="id_customer" id="id_customer">
                  <option value="-">--Tampil Semua--</option>
                  @foreach($customer as $c)
                    <option value="{{ $c->id }}">{{ $c->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-lg-6">
                <label>Tanggal Awal - Akhir:</label>
                <input type="text" id="txtPeriod" class="form-control" name="tanggal" id="tanggal" required>
              </div>
              <div class="col-lg-3">
                <label>Status Tracking</label>
                <select class="form-control select2" name="status_tracking" id="status_tracking">
                  <option value="-">--Tampil Semua--</option>
                  <option value="booked">booked</option>
                  <option value="at-manifest">at-manifest</option>
                  <option value="loaded">loaded</option>
                  <option value="at-agen">at-agen</option>
                  <option value="delivery-by-courier">delivery-by-courier</option>
                  <option value="complete">complete</option>
                  <option value="cancel">cancel</option>
                </select>
              </div>
              <div class="col-lg-3">
                <label>Agen Tujuan</label>
                <select class="form-control select2" name="id_agen_penerima" id="id_agen_penerima">
                  <option value="-">--Tampil Semua--</option>
                  @foreach($agen as $a)
                    <option value="{{ $a->id }}">{{ $a->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-lg-3">
                <label>Kode Awb </label>
                <input type="text" name="noawb" id="noawb" class="form-control">
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
@endsection
@section('script')
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
                url : "{{ url('report/awb-grid') }}",
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
                fileName: "Laporan AWB",
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
                    caption: "Noawb",
                    dataField: "noawb",
                    dataType: "string",
                    width:200,
                },
                {
                    caption: "Ada Faktur",
                    dataField: "ada_faktur",
                    dataType: "string",
                    cellTemplate: function (container, options) {
                      console.log(options.data.ada_faktur)
                      if(options.data.ada_faktur == 0){
                        $(container).html(`<span class="badge badge-danger">Tidak Ada</span>`)
                      }
                      else{
                        $(container).html(`<span class="badge badge-success">Ada</span>`)
                      }
                    },
                    width:150,
                },
                {
                    caption: "Pengirim",
                    dataField: "pengirim",
                    dataType: "string",
                    width:200,
                },
                {
                    caption: "Tanggal",
                    dataField: "tanggal_awb",
                    dataType: "datetime",
                    format:"shortDateShortTime",
                    width:170,
                },
                {
                    caption: "Kota Asal",
                    dataField: "kota_asal",
                    dataType: "string",
                },
                {
                    caption: "Kota Transit",
                    dataField: "kota_transit",
                    dataType: "string",
                    width:175,
                },
                {
                    caption: "Kota Tujuan",
                    dataField: "kota_tujuan",
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
                    caption: "Nama Penerima",
                    dataField: "nama_penerima",
                    dataType: "string",
                    width:170,
                },
                {
                    caption: "Label Alamat",
                    dataField: "labelalamat",
                    dataType: "string",
                    width:170,
                },
                {
                    caption: "Kodepos Penerima",
                    dataField: "kodepos_penerima",
                    dataType: "string",
                    width:170,
                },
                {
                    caption: "Alamat Penerima",
                    dataField: "alamat_tujuan",
                    dataType: "string",
                    width:170,
                },
                {
                    caption: "Kecamatan",
                    dataField: "kecamatan",
                    dataType: "string",
                    width:170,
                },
                {
                    caption: "No Hp Penerima",
                    dataField: "notelp_penerima",
                    dataType: "string",
                    width:170,
                },
                {
                    caption: "Tanggal Diterima",
                    dataField: "tanggal_diterima",
                    dataType: "datetime",
                    format:"shortDateShortTime",
                    width:170,
                },
                {
                    caption: "Diterima Oleh",
                    dataField: "diterima_oleh",
                    dataType: "string",
                    width:170,
                },
                {
                    caption: "Status",
                    dataField: "status_tracking",
                    dataType: "string",
                    width:170,
                },
                {
                    caption: "QTY",
                    dataField: "qty",
                    dataType: "number",
                    width:170,
                },
                {
                    caption: "koli kecil",
                    dataField: "qty_kecil",
                    dataType: "number",
                    width:150,
                },
                {
                    caption: "koli sedang",
                    dataField: "qty_sedang",
                    dataType: "number",
                    width:150,
                },
                {
                    caption: "koli besar",
                    dataField: "qty_besar",
                    dataType: "number",
                    width:150,
                },
                {
                    caption: "koli bb",
                    dataField: "qty_besarbanget",
                    dataType: "number",
                    width:150,
                },
                {
                    caption: "koli kg",
                    dataField: "qty_kg",
                    dataType: "number",
                    width:150,
                },
                {
                    caption: "koli doc",
                    dataField: "qty_doc",
                    dataType: "number",
                    width:150,
                },
                {
                    caption: "Total Harga",
                    dataField: "total_harga",
                    dataType: "number",
                    format:"#,##0",
                    width:150,
                },
                {
                    caption: "Kode Manifest",
                    dataField: "kode_manifest",
                    dataType: "number",
                    width:150,
                },
                {
                    caption: "Kode Invoice",
                    dataField: "kode_invoice",
                    dataType: "number",
                    width:150,
                },
                
            ],
        }).dxDataGrid("instance");
    return dataGrid;
  }
</script>
@endsection