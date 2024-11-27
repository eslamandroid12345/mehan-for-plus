@extends('dashboard.core.app')
@section('title', __('titles.Ad Details'))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Ads Details')</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('dashboard.Ads Details')</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                @if(!is_null($ad->additional_phone))
                                    <tr>
                                        <td><b>@lang('dashboard.Additional Phone'):</b> {{ $ad->additional_phone }}</td>
                                    </tr>
                                @endif
                                @if(!is_null($ad->linkedin_account))
                                    <tr>
                                        <td><b>@lang('dashboard.LinkedIn Account'):</b> {{ $ad->linkedin_account }}</td>
                                    </tr>
                                @endif
                                @if(!is_null($ad->qualification_id))
                                    <tr>
                                        <td><b>@lang('dashboard.Qualification'):</b> {{ $ad->qualification->t('name') }}</td>
                                    </tr>
                                @endif
                                @if(!is_null($ad->work_hours_type))
                                    <tr>
                                        <td><b>@lang('dashboard.Work Hours'):</b> {{ __('db.work_hours.'.$ad->work_hours_type) }}</td>
                                    </tr>
                                @endif
                                @if(!is_null($ad->marital_status))
                                    <tr>
                                        <td><b>@lang('dashboard.Marital Status'):</b> {{ __('db.marital_status.'.$ad->marital_status) }}</td>
                                    </tr>
                                @endif
                                @if(!is_null($ad->years_of_experience))
                                    <tr>
                                        <td><b>@lang('dashboard.Years of Experience'):</b> {{ __('db.years_of_experience.'.$ad->years_of_experience) }}</td>
                                    </tr>
                                @endif
                                @if(!is_null($ad->biography))
                                    <tr>
                                        <td><b>@lang('dashboard.Biography'):</b> {{ $ad->biography }}</td>
                                    </tr>
                                @endif
                                @if(!is_null($ad->is_active))
                                    <tr>
                                        <td><b>@lang('dashboard.Activate Ad'):</b> {{ $ad->is_active ? __('dashboard.Yes') : __('dashboard.No') }}</td>
                                    </tr>
                                @endif

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
