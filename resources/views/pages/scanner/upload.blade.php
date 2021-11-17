@extends('layouts.app')
@section('content')
<div class="card card-custom"> 
  <div class="card-body">
    {{-- <input type="file" id="input_img" onchange="fileChange()" accept="image/*"> --}}
    
    <button onclick="fileChange()">UPLOAD</button>

    <div id="results">Your captured image will appear here...</div>
    <h1>WebcamJS Test Page</h1>
    <h3>Demonstrates 320x240 capture &amp; display with preview mode</h3>
    
    <div id="my_camera"></div>
    
    <!-- First, include the Webcam.js JavaScript Library -->
        <script type="text/javascript" src="{{ asset('assets/gsa/js/webcam.min.js')}}"></script>
    {{-- <script type="text/javascript" src="../webcam.min.js"></script> --}}
    
    <!-- Configure a few settings and attach camera -->
    <script language="JavaScript">
      Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
      });
      Webcam.attach( '#my_camera' );
    </script>
    
    <!-- A button for taking snaps -->
    <form>
      <div id="pre_take_buttons">
        <input type=button value="Take Snapshot" onClick="preview_snapshot()">
      </div>
      <div id="post_take_buttons" style="display:none">
        <input type=button value="&lt; Take Another" onClick="cancel_preview()">
        <input type=button value="Save Photo &gt;" onClick="save_photo()" style="font-weight:bold;">
      </div>
    </form>
  </div>
</div> 


@endsection
@section('script')
<script language="JavaScript">
    function fileChange(){
        // var file  = document.getElementById('input_img');
        // const file2 = '';
        var form  = new FormData();
        const img = document.getElementById('testimg')

        fetch(img.src).then(res => res.blob()).then(blob => {
            const filez = new File([blob], 'dot.png', blob) 
            form.append("image", filez)
            var settings = {
                "url"           : "https://api.imgbb.com/1/upload?key=82e97c4aab55b312415ada652068bdae",
                "method"        : "POST",
                "timeout"       : 0,
                "processData"   : false,
                "mimeType"      : "multipart/form-data",
                "contentType"   : false,
                "data"          : form
            };


            $.ajax(settings).done(function (response) {
                console.log(response);
                var jx = JSON.parse(response);
                console.log(jx.data.url);
            });
        }) 


        
    }
  function preview_snapshot() {
    // freeze camera so user can preview pic
    Webcam.freeze();
    
    // swap button sets
    document.getElementById('pre_take_buttons').style.display = 'none';
    document.getElementById('post_take_buttons').style.display = '';
  }
  
  function cancel_preview() {
    // cancel preview freeze and return to live camera feed
    Webcam.unfreeze();
    
    // swap buttons back
    document.getElementById('pre_take_buttons').style.display = '';
    document.getElementById('post_take_buttons').style.display = 'none';
  }
  
  function save_photo() {
    // actually snap photo (from preview freeze) and display it
    Webcam.snap( function(data_uri) {
      // display results in page
      document.getElementById('results').innerHTML = 
        '<h2>Here is your image:</h2>' + 
        '<img id="testimg" src="'+data_uri+'"/>';
      
      // swap buttons back
      document.getElementById('pre_take_buttons').style.display = '';
      document.getElementById('post_take_buttons').style.display = 'none';
    } );
  }
</script>

  
@if(Session::get('message') == "created")
    <script type="text/javascript">
        toastr.success("User Baru Berhasil ditambahkan!");
    </script>
@endif
@if(Session::get('message') == "updated")
    <script type="text/javascript">
        toastr.success("Data User Berhasil diubah!");
    </script>
@endif
@endsection
