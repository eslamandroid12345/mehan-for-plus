@extends('dashboard.core.app')
@section('title', __('titles.Home'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
{{--                    <h1>@lang('dashboard.Home')</h1>--}}
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-dark"><i class="far fa-building"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">@lang('dashboard.Companies')</span>
                            <span class="info-box-number">{{ $count['companies'] }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-dark"><i class="far fa-user"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">@lang('dashboard.Resident Seekers')</span>
                            <span class="info-box-number">{{ $count['resident-seekers'] }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-dark"><i class="far fa-user"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">@lang('dashboard.Non-Resident Seekers')</span>
                            <span class="info-box-number">{{ $count['non-resident-seekers'] }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-dark"><i class="fas fa-ad"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">@lang('dashboard.Ads') (@lang('dashboard.Activated'))</span>
                            <span class="info-box-number">{{ $count['ads'] }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
