@extends('dashboard.core.app')
@section('title', __('titles.Publish Ad'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Ads')</h1>
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
                        <form action="{{ route('ads.update', $user->id) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Publish Ad')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                @method('put')
                                <input type="hidden" name="redirects_to" value="{{ URL::previous() }}">
                                <div class="form-group">
                                    <label for="exampleInputLinkedInAccount1">@lang('dashboard.LinkedIn Account')</label>
                                    <input name="linkedin_account" type="url" class="form-control" id="exampleInputLinkedInAccount1" value="{{ old('linkedin_account') ?? $user->seeker->ad?->linkedin_account }}" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputQualification1">@lang('dashboard.Qualification')</label>
                                    <select name="qualification_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                                        <option value=""></option>
                                        @foreach($qualifications as $qualification)
                                            <option @selected(!is_null(old('qualification_id')) ? old('qualification_id') == $qualification->id : $user->seeker->ad?->qualification_id == $qualification->id) value="{{ $qualification->id }}">{{ $qualification->t('name') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputWorkHours1">@lang('dashboard.Work Hours')</label>
                                    <select name="work_hours_type" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                                        <option @selected(!is_null(old('work_hours_type')) ? old('work_hours_type') == 0 : $user->seeker->ad?->work_hours_type == 0) value="0">@lang('db.work_hours.0')</option>
                                        <option @selected(!is_null(old('work_hours_type')) ? old('work_hours_type') == 1 : $user->seeker->ad?->work_hours_type == 1) value="1">@lang('db.work_hours.1')</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputMaritalStatus1">@lang('dashboard.Marital Status')</label>
                                    <select name="marital_status" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                                        <option @selected(!is_null(old('marital_status')) ? old('marital_status') == 0 : $user->seeker->ad?->marital_status == 0) value="0">@lang('db.marital_status.0')</option>
                                        <option @selected(!is_null(old('marital_status')) ? old('marital_status') == 1 : $user->seeker->ad?->marital_status == 1) value="1">@lang('db.marital_status.1')</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputYearsOfExperience1">@lang('dashboard.Years of Experience')</label>
                                    <select name="years_of_experience" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                                        <option @selected(!is_null(old('years_of_experience')) ? old('years_of_experience') == '1-' : $user->seeker->ad?->years_of_experience == '1-') value="1-">@lang('db.years_of_experience.1-')</option>
                                        <option @selected(!is_null(old('years_of_experience')) ? old('years_of_experience') == '3-' : $user->seeker->ad?->years_of_experience == '3-') value="3-">@lang('db.years_of_experience.3-')</option>
                                        <option @selected(!is_null(old('years_of_experience')) ? old('years_of_experience') == '10-' : $user->seeker->ad?->years_of_experience == '10-') value="10-">@lang('db.years_of_experience.10-')</option>
                                        <option @selected(!is_null(old('years_of_experience')) ? old('years_of_experience') == '10+' : $user->seeker->ad?->years_of_experience == '10+') value="10+">@lang('db.years_of_experience.10+')</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputBiography1">@lang('dashboard.Biography')</label>
                                    <textarea name="biography" id="exampleInputBiography1" class="form-control" placeholder="">{{ old('biography') ?? $user->seeker->ad?->biography }}</textarea>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input name="is_active" value="1" class="custom-control-input" type="checkbox" id="customCheckbox2" {{ old('is_active') ? 'checked' : ($user->seeker->ad?->is_active ? 'checked' : '') }}>
                                        <label for="customCheckbox2" class="custom-control-label">@lang('dashboard.Activate Ad')</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input name="renew" value="1" class="custom-control-input" type="checkbox" id="customCheckbox4" {{ old('renew') ? 'checked' : '' }}>
                                        <label for="customCheckbox4" class="custom-control-label">@lang('dashboard.Renew ad period')</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input name="silently" value="1" class="custom-control-input" type="checkbox" id="customCheckbox3" {{ old('silently') ? 'checked' : '' }}>
                                        <label for="customCheckbox3" class="custom-control-label">@lang('dashboard.Re-position the ad as a first result')</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">@lang('dashboard.Publish Ad')</button>
                            </div>
                        </form>
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

@section('js_addons')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
            $('.select2').select2({
                language: {
                    searching: function() {}
                },
            });
        });
    </script>
@endsection
