@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-4 col-xl-4 mb-5">
                                        <!--begin::Iconbox-->
                                        <div class="card card-custom wave wave-animate-fast wave-primary">
                                            <div class="card-body text-center">
                                                <a href="{{ url('master/agen') }}">
                                                        <span class="svg-icon svg-icon-primary svg-icon-6x">
                                                           <i class="icon-6x flaticon-profile-1 text-info"> </i>
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
                                    <div class="col-lg-4 col-xl-4 mb-5">
                                        <!--begin::Iconbox-->
                                        <div class="card card-custom wave wave-animate-fast wave-primary">
                                            <div class="card-body text-center">
                                                <a href="{{ url('master/customer') }}">
                                                        <span class="svg-icon svg-icon-primary svg-icon-6x">
                                                           <i class="icon-6x flaticon-users text-info"> </i>
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
                                    
                                    <div class="col-lg-4 col-xl-4 mb-5">
                                        <!--begin::Iconbox-->
                                        <div class="card card-custom wave wave-animate-fast wave-primary">
                                            <div class="card-body text-center">
                                                <a href="{{ url('master/customer') }}">
                                                        <span class="svg-icon svg-icon-primary svg-icon-6x">
                                                           <i class="icon-6x flaticon-truck text-info"> </i>
                                                        </span>
                                                        </a>
                                                        <br>
                                                        <a href="{{ url('master/customer') }}" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">AWB</a>
                                            </div>
                                        </div>
                                        <!--end::Iconbox-->
                                        <!--begin::Code example-->
                                        <!--end::Code example-->
                                    </div>
    </div>
@endsection
