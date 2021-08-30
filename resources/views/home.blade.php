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
    </div>
@endsection
