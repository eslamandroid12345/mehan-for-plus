@extends('dashboard.core.app')
@section('title', __('titles.Create Non-Resident Seeker'))

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
                    <h1>@lang('dashboard.Non-Resident Seekers')</h1>
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
                        <form action="{{ route('non-resident-seekers.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Create Non-Resident Seeker')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputFile">@lang('dashboard.Image')</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="image" type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">@lang('dashboard.Name')</label>
                                    <input name="name" type="text" class="form-control" id="exampleInputName1" value="{{ old('name') }}" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">@lang('dashboard.Email')</label>
                                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" value="{{ old('email') }}" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPhone1">@lang('dashboard.Phone')</label>
                                    <input name="phone" type="text" class="form-control" id="exampleInputPhone1" value="{{ old('phone') }}" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">@lang('dashboard.Password')</label>
                                    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword2">@lang('dashboard.Confirm Password')</label>
                                    <input name="password_confirmation" type="password" class="form-control" id="exampleInputPassword2" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputGender1">@lang('dashboard.Gender')</label>
                                    <select name="gender" class="form-control" id="exampleInputGender1">
                                        <option value=""></option>
                                        <option @selected(old('gender') == 0) value="0">@lang('dashboard.Male')</option>
                                        <option @selected(old('gender') == 1) value="1">@lang('dashboard.Female')</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputNationality1">@lang('dashboard.Nationality')</label>
                                    <select name="nationality_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" id="exampleInputNationality1">
                                        <option value=""></option>
                                        @foreach($nationalities as $nationality)
                                            <option @selected(old('nationality_id') == $nationality->id) value="{{ $nationality->id }}">{{ $nationality->t('name') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCountry1">@lang('dashboard.Country')</label>
                                    <select name="country_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                                        <option value=""></option>
                                        @foreach($countries as $country)
                                            <option @selected(old('country_id') == $country->id) value="{{ $country->id }}">{{ $country->t('name') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCity1">@lang('dashboard.City')</label>
                                    <select name="city_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" id="exampleInputCity1">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputReligion1">@lang('dashboard.Religion')</label>
                                    <input name="religion" type="text" class="form-control" id="exampleInputReligion1" value="{{ old('religion') }}" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>@lang('dashboard.Job')</label>
                                    <select name="job_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                                        <option value=""></option>
                                        @foreach($jobs as $job)
                                            <option @selected(old('job_id') == $job->id) value="{{ $job->id }}">{{ $job->t('name') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>@lang('dashboard.Skills')</label>
                                    <select name="skills[]" class="select2 select2-hidden-accessible" multiple="" data-placeholder="" style="width: 100%;" data-select2-id="7" tabindex="0" aria-hidden="true">
                                        @foreach($skills as $skill)
                                            <option @selected(!is_null(old('skills')) && in_array($skill->id, old('skills'))) value="{{ $skill->id }}">{{ $skill->t('name') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>@lang('dashboard.Is worked before in KSA?')</label>
                                    <div class="row">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input custom-control-input-dark" type="radio" value="1" id="customRadio4" name="is_worked_before_in_ksa" @checked(old('is_worked_before_in_ksa') == 1)>
                                            <label for="customRadio4" class="custom-control-label">@lang('dashboard.Yes')</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input custom-control-input-dark custom-control-input-outline" type="radio" value="0" id="customRadio5" name="is_worked_before_in_ksa" @checked(old('is_worked_before_in_ksa') == 1)>
                                            <label for="customRadio5" class="custom-control-label">@lang('dashboard.No')</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">@lang('dashboard.CV')</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="cv" type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">@lang('dashboard.Create')</button>
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
                    searching: function() {},
                },
            });
            $('[name=country_id]').change(function () {
                $.ajax({
                    url: "{{ route('getCountryCities', '') }}" + '/' + $('[name=country_id]').val(),
                    success: function(result){
                        $('[name=city_id]').html('');
                        for ( var i = 0; i < result.data.length; i++ ) {
                            $('[name=city_id]').append('<option '+(result.data[i].id == {{old('city_id') ?? 0}} ? 'selected' : '')+' value='+result.data[i].id+'>'+result.data[i].name+'</option>');
                        }
                    },
                    error: function () {
                        $('[name=city_id]').html('');
                    },
                    headers: {"Accept-Language": "{{app()->getLocale()}}"}
                });
            });
            $.ajax({
                url: "{{ route('getCountryCities', '') }}" + '/' + $('[name=country_id]').val(),
                success: function(result){
                    $('[name=city_id]').html('');
                    for ( var i = 0; i < result.data.length; i++ ) {
                        $('[name=city_id]').append('<option '+(result.data[i].id == {{old('city_id') ?? 0}} ? 'selected' : '')+' value='+result.data[i].id+'>'+result.data[i].name+'</option>');
                    }
                },
                error: function () {
                    $('[name=city_id]').html('');
                },
                headers: {"Accept-Language": "{{app()->getLocale()}}"}
            });
        });
    </script>
@endsection
