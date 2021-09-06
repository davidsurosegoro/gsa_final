<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>TRACKING | GLOBAL SERVICE ASIA</title>
        <link rel="stylesheet" href="{{asset('assets/gsa/fa/css/font-awesome.min.css')}}">
        <link href="{{asset('assets/gsa/css/boots.css')}}" rel="stylesheet" />
        <style>
            .track_tbl td.track_dot {
                width: 50px;
                position: relative;
                padding: 0;
                text-align: center;
            }
            .track_tbl td.track_dot:after {
                content: "\f111";
                font-family: FontAwesome;
                position: absolute;
                margin-left: -5px;
                top: 11px;
            }
            .track_tbl td.track_dot span.track_line {
                background: #000;
                width: 3px;
                min-height: 50px;
                position: absolute;
                height: 101%;
            }
            .track_tbl tbody tr:first-child td.track_dot span.track_line {
                top: 30px;
                min-height: 25px;
            }
            .track_tbl tbody tr:last-child td.track_dot span.track_line {
                top: 0;
                min-height: 25px;
                height: 10%;
            }
        </style>
    </head>
    <body>         
        <div class="p-4 container">  
                <div class="row"  style="background-color:rgb(198, 222, 255); padding:10px;border-radius:10px;box-shadow: -1px 1px 5px 0px rgba(0,0,0,0.37);
            -webkit-box-shadow: -1px 1px 5px 0px rgba(0,0,0,0.37);
            -moz-box-shadow: -1px 1px 5px 0px rgba(0,0,0,0.37);">   
                     <div class="col-sm-8 col-12 text-center" >
                        <div class="input-group text-center">
                        
                            <input type="text" onkeydown="search(this)" id="kodeawb" name="kode" class="form-control" placeholder="MASUKAN KODE AWB/RESI">
                            <span class="input-group-btn">
                                <button onclick="openlink()" class="btn btn-success" type="button">Cari!</button>
                            </span>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 --> 
                </div><!-- /.col-lg-6 --> <br> 
            <div class="row">  
                <h3 class="col-12">Order Tracking</h3>
                <table class="table table-bordered track_tbl col-12" style="background-color: rgb(243, 243, 243);">
                    <thead>
                        <tr>
                            <th></th>
                            <th width="5%">No</th>
                            <th width="50%">Status</th>
                            <th width="25%">Date/Time</th>
                            <th>Pengecek</th>
                        </tr>
                    </thead>                    
                        @foreach ($historyscanawb as $item)
                            <tr class="active">
                                <td class="track_dot">
                                    <span class="track_line"></span>
                                </td>
                                <td>{{ $loop->index+1 }}</td>
                                <td>
                                    {{$item->tipe}}

                                    @if ($item->tipe == 'complete')
                                        <br>diterima Oleh <b>{{$item->diterima_oleh}}</b>
                                    @endif
                                </td>
                                <td>{{$item->created_at->format('j-F-Y (H:i)')}}</td>
                                <td>{{$item->namauser}}</td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript"> 
        function search(kode){
            // openlink(kode)
            if(event.key === 'Enter') {
                // alert(kode.value); 
                openlink()       
            }
        } 
        function openlink(){
            window.open( "{{url('tracking/', '')}}"+"/"+$('#kodeawb').val(),"_self");   
        }
    </script>  
</html>  