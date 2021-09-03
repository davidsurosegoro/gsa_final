@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-6 col-lg-3 col-xl-3 mb-5">
                                        <!--begin::Iconbox-->
                                        <div class="card card-custom wave wave-animate-fast wave-primary">
                                            <div class="card-body text-center">
                                                <a href="{{ url('master/agen') }}">
                                                        <span class="svg-icon svg-icon-primary svg-icon-6x">
                                                            <i class="icon-6x text-info mb-10 mt-10 fa fa-user-circle-o" aria-hidden="true"></i>
                                                        </span>
                                                        </a>
                                                        <br>
                                                        <a href="{{ url('master/agen') }}" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">Master Agen</a>
                                            </div>
                                        </div>
                                        <!--end::Iconbox-->
                                        <!--begin::Code example-->
                                        <!--end::Code example-->
                                    </div>
                                    <div class="col-6 col-lg-3 col-xl-3 mb-5">
                                        <!--begin::Iconbox-->
                                        <div class="card card-custom wave wave-animate-fast wave-primary">
                                            <div class="card-body text-center">
                                                <a href="{{ url('master/customer') }}">
                                                        <span class="svg-icon svg-icon-primary svg-icon-6x">
                                                            <i class="icon-6x text-info mb-10 mt-10 fa fa-users" aria-hidden="true"></i>
                                                        </span>
                                                        </a>
                                                        <br>
                                                        <a href="{{ url('master/customer') }}" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">Master Customer</a>
                                            </div>
                                        </div>
                                        <!--end::Iconbox-->
                                        <!--begin::Code example-->
                                        <!--end::Code example-->
                                    </div>
                                    
                                    <div class="col-6 col-lg-3 col-xl-3 mb-5">
                                        <!--begin::Iconbox-->
                                        <div class="card card-custom wave wave-animate-fast wave-primary">
                                            <div class="card-body text-center">
                                                <a href="{{ url('awb') }}">
                                                        <span class="svg-icon svg-icon-primary svg-icon-6x">
                                                            <i class="icon-6x text-info mb-10 mt-10 fa fa-truck" aria-hidden="true"></i>
                                                        </span>
                                                        </a>
                                                        <br>
                                                        <a href="{{ url('awb') }}" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">AWB</a>
                                            </div>
                                        </div>
                                        <!--end::Iconbox-->
                                        <!--begin::Code example-->
                                        <!--end::Code example-->
                                    </div>
                                    <div class="col-6 col-lg-3 col-xl-3 mb-5"> 
                                        <div class="card card-custom wave wave-animate-fast wave-primary">
                                            <div class="card-body text-center">
                                                <a href="{{ url('master/users') }}">
                                                    <span class="svg-icon svg-icon-primary svg-icon-6x">
                                                        <i class="icon-6x text-info mb-10 mt-10 fa  fa-id-card-o" aria-hidden="true"></i>
                                                    </span>
                                                    </a>
                                                    <br>
                                                    <a href="{{ url('master/users') }}" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">Users</a>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-6 col-lg-3 col-xl-3 mb-5"> 
                                        <div class="card card-custom wave wave-animate-fast wave-primary">
                                            <div class="card-body text-center">
                                                <a href="{{ url('master/manifest') }}">
                                                    <span class="svg-icon svg-icon-primary svg-icon-6x"> 
                                                        <i class="icon-6x text-info mb-10 mt-10 fa fa-file-text-o" aria-hidden="true"></i>
                                                    </span>
                                                    </a>
                                                    <br>
                                                    <a href="{{ url('master/manifest') }}" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">Manifest</a>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-6 col-lg-3 col-xl-3 mb-5"> 
                                        <div class="card card-custom wave wave-animate-fast wave-primary">
                                            <div class="card-body text-center">
                                                <a href="{{ url('master/invoice') }}">
                                                    <span class="svg-icon svg-icon-primary svg-icon-6x"> 
                                                        <i class="icon-6x text-info mb-10 mt-10 fa fa-usd" aria-hidden="true"></i>
                                                    </span>
                                                    </a>
                                                    <br>
                                                    <a href="{{ url('master/invoice') }}" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">Invoice</a>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-6 col-lg-3 col-xl-3 mb-5"> 
                                        <div class="card card-custom wave wave-animate-fast wave-primary">
                                            <div class="card-body text-center">
                                                <a href="{{ url('master/kota') }}">
                                                    <span class="svg-icon svg-icon-primary svg-icon-6x">
                                                        {{-- <i class="icon-6x flaticon-truck "> </i> --}}
                                                        <i class="icon-6x text-info mb-10 mt-10 fa fa-industry" aria-hidden="true"></i>
                                                    </span>
                                                    </a>
                                                    <br>
                                                    <a href="{{ url('master/kota') }}" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">Kota</a>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-6 col-lg-3 col-xl-3 mb-5"> 
                                        <div class="card card-custom wave wave-animate-fast wave-primary">
                                            <div class="card-body text-center">
                                                <a href="{{ url('master/alamat') }}">
                                                    <span class="svg-icon svg-icon-primary svg-icon-6x">
                                                        {{-- <i class="icon-6x flaticon-truck "> </i> --}}
                                                        <i class="icon-6x text-info mb-10 mt-10 fa fa-home" aria-hidden="true"></i>
                                                    </span>
                                                    </a>
                                                    <br>
                                                    <a href="{{ url('master/alamat') }}" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">Alamat</a>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-6 col-lg-3 col-xl-3 mb-5" data-toggle="modal" data-target="#modalscanner" style="cursor: pointer;"> 
                                        <div class="card card-custom wave wave-animate-fast wave-primary">
                                            <div class="card-body text-center"> 
                                                <span class="svg-icon svg-icon-primary svg-icon-6x"> 
                                                    <i class="icon-6x text-info mb-10 mt-10 fa fa-qrcode" aria-hidden="true"></i>
                                                </span> 
                                                <br>
                                                <div class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">Scanner AWB</div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-6 col-lg-3 col-xl-3 mb-5" data-toggle="modal" data-target="#modalscannermanifest" style="cursor: pointer;"> 
                                        <div class="card card-custom wave wave-animate-fast wave-primary">
                                            <div class="card-body text-center"> 
                                                <span class="svg-icon svg-icon-primary svg-icon-6x"> 
                                                    <i class="icon-6x text-info mb-10 mt-10 fa fa-qrcode" aria-hidden="true"></i>
                                                </span> 
                                                <br>
                                                <div class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">Scanner Manifest</div>
                                            </div>
                                        </div> 
                                    </div>
    </div>

    <div class="modal fade" id="modalscanner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Jenis Scan AWB</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <a  href="{{ url('scannerawb/'.Crypt::encrypt('at-manifest').'') }}"            class="btn btn-primary btn-lg btn-block"><i class="fa fa-building-o" aria-hidden="true"></i>&nbsp;Scan tiba di-manifest</a>  --}}
                    <a  href="{{ url('scannerawb/'.Crypt::encrypt('loaded').'') }}"                 class="btn btn-primary btn-lg btn-block"><i class="fa fa-truck" aria-hidden="true"></i>&nbsp;Scan Loading ke truck</a> 
                    <a  href="{{ url('scannerawb/'.Crypt::encrypt('delivery-by-courier').'') }}"    class="btn btn-primary btn-lg btn-block"><i class="fa fa-motorcycle" aria-hidden="true"></i> &nbsp;Scan pengantaran ke tujuan</a> 
                    <a  href="{{ url('scannerawb/'.Crypt::encrypt('complete').'') }}"               class="btn btn-primary btn-lg btn-block"><i class="fa fa-check-square" aria-hidden="true"></i>&nbsp;Scan sudah tiba di tujuan</a> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalscannermanifest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Jenis Scan Manifest</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <a  href="{{ url('scannermanifest/'.Crypt::encrypt('delivering').'') }}"  class="btn btn-primary btn-lg btn-block"><i class="fa fa-truck" aria-hidden="true"></i>&nbsp;Scan Loading ke truck</a> 
                    <a  href="{{ url('scannermanifest/'.Crypt::encrypt('arrived').'') }}" class="btn btn-primary btn-lg btn-block"><i class="fa fa-check-square" aria-hidden="true"></i> &nbsp;Scan tiba di agen</a> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                </div>
            </div>
        </div>
    </div>
@endsection
