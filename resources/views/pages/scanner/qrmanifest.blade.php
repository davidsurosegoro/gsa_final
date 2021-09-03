@extends('layouts.app')
@section('content')
<div class="card card-custom gutter-b example example-compact">
<div class="card-header">
    <h3 class="card-title">SCANNER MANIFEST <br>ke status -> {{Crypt::decrypt($status)}} </h3>
</div> 
<input type='hidden' id='statusmanifest' value='{{$status}}' > 
<div class=" ">
    <div class="container">
        <div class="row">
            <audio id="myAudio">
                <source src="{{asset('assets/gsa/scanner/beep-06.mp3')}}" type="audio/ogg"> 
                Your browser does not support the audio element.
            </audio>
            <div class="col-sm-2" style="padding:1px;"> </div>
            <div class="col-md-8 col-sm-12 border" style=" position:relative;"> 
                <video id="qr-video"  class="col-sm-12"></video>
                <img src="{{asset('assets/gsa/img/face-loader.gif')}}" style="position: absolute;z-index:10; top:0; bottom:0;left:0;right:0; margin:auto; width:50%;">
                <select id="cam-list" class="form-control col-12 col-sm-5"  style="position: absolute;z-index:10; top:0;  right:0; margin:auto; ">
                    <option value="environment" selected>Pilih Kamera (default)</option>
                    <option value="user">User Facing</option>
                </select>
            </div>
            <div class='col-12 text-center'> 
                <span style="border:1px solid black;">
                    <b>Device has camera: </b>
                    <span id="cam-has-camera"></span>
                </span>
                <span style="border:1px solid black;">
                    <b>Camera has flash: </b>
                    <span id="cam-has-flash"></span>
                </span>
                <span id="cam-qr-result" class="d-none">None</span>
                <button id="flash-toggle">📸 Flash: <span id="flash-state">off</span></button>
                <div> 
                    <button class="btn btn-sm btn-success" id="start-button">Buka Kamera</button>
                    <button class="btn btn-sm btn-danger" id="stop-button">Tutup Kamera</button>
                </div>
            </div>
            <div class="col-12 text-center">
                <div class="btn-group   mb-5"  >
                    <label class="btn btn-info" data-toggle="modal" data-target="#modalkodemanual" style="cursor: pointer;">
                        Input MANIFEST Manual
                    </label> 
                </div>
            </div>    
        </div> 
    </div>  
</div> 
<div class="modal " id="modalkodemanual" data-backdrop="dismiss"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input kode MANIFEST manual</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                <input type="text" required class="form-control" name="kode_manifest" id="kode_manifest" value="" placeholder="kode Manifest"/>               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id='simpankodemanual' >Simpan</button> 
            </div>
        </div>
    </div>
</div> 
 
@endsection
@section('script')

<div style="position: fixed; width:100%;height:100%; z-index:200000;background-color:rgba(0,0,0,0.6);" class="d-none" id="loading">
    <img src="{{asset('assets/gsa/img/loading.gif')}}" style="position: absolute;z-index:10; top:0; bottom:0;left:0;right:0; margin:auto; width:5%;">
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="{{asset('assets/gsa/scanner2/qr-scanner.umd.min.js')}}"></script>
<script type="text/javascript">  
    $(document) .ajaxStart(function () {
        $('#loading').removeClass('d-none')
    })          .ajaxStop(function () {
        $('#loading').addClass('d-none')
    }); 
    
    QrScanner.WORKER_PATH = "{{asset('assets/gsa/scanner2/qr-scanner-worker.min.js')}}"  ;

    function setResult(label, result) {
        label.textContent = result; 
        label.style.color = 'teal';
        clearTimeout(label.highlightTimeout);
        label.highlightTimeout = setTimeout(() => label.style.color = 'inherit', 100); 
        if(result){
            xs.play();   
            scanner.stop();
            scan_update_status(result);
        }
    }
 
    
    function scan_update_status(kode_manifest){
        $.ajax({
            method  :'POST',
            url     :'{{ url('awb/updatemanifestqr') }}',
            data    :{
                kode        : kode_manifest,
                status      : $('#statusmanifest').val(),
                '_token'    : "{{ csrf_token() }}" 
            },
            success:function(data){
                $('#kode_manifest').val('')
                if(data.statuserror)    {toastr.error( data.statuserror)}
                if(data.statuswarning)  {
                    $('#modalkodemanual').modal('hide');
                    toastr.warning( data.statuswarning)
                    $('.modal-backdrop').remove();
                }
                if(data.statussuccess)  {
                    toastr.success( data.statussuccess)
                    $('#modalkodemanual').modal('hide');
                    $('.modal-backdrop').remove();
                }                  
                scanner.start()
             
            }
        }) 
    } 
	
</script> 
<script src="{{asset('assets/gsa/scanner/custom-js-scanner.js')}}"></script> 
@endsection 