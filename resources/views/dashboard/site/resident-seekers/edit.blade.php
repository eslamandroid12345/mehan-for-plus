@extends('dashboard.core.app')
@section('title', __('titles.Edit Resident Seeker'))

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
                    <h1>@lang('dashboard.Resident Seekers')</h1>
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
                        <form action="{{ route('resident-seekers.update', $user->id) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Edit Resident Seeker')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                @method('put')
                                <input type="hidden" name="redirects_to" value="{{ URL::previous() }}">
                                <div class="form-group">
                                    <label for="exampleInputFile">@lang('dashboard.Image')  <code>@lang('dashboard.Optional if you dont want to change it')</code></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="image" type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">@lang('dashboard.Name')</label>
                                    <input name="name" type="text" class="form-control" id="exampleInputName1" value="{{ old('name') ?? $user->name }}" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">@lang('dashboard.Email')</label>
                                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" value="{{ old('email') ?? $user->email }}" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPhone1">@lang('dashboard.Phone')</label>
                                    <input name="phone" type="text" class="form-control" id="exampleInputPhone1" value="{{ old('phone') ?? $user->phone }}" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">@lang('dashboard.Password')  <code>@lang('dashboard.Optional if you dont want to change it')</code></label>
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
                                        <option @selected(!is_null(old('gender')) ? old('gender') == 0 : $user->seeker->gender == 0) value="0">@lang('dashboard.Male')</option>
                                        <option @selected(!is_null(old('gender')) ? old('gender') == 1 : $user->seeker->gender == 1) value="1">@lang('dashboard.Female')</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputNationality1">@lang('dashboard.Nationality')</label>
                                    <select name="nationality_id" class="form-control" id="exampleInputNationality1">
                                        <option value=""></option>
                                        @foreach($nationalities as $nationality)
                                            <option @selected(!is_null(old('nationality_id')) ? old('nationality_id') == $nationality->id : $user->seeker->nationality_id == $nationality->id) value="{{ $nationality->id }}">{{ $nationality->t('name') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCity1">@lang('dashboard.City')</label>
                                    <select name="city_id" class="form-control" id="exampleInputCity1">
                                        <option value=""></option>
                                        @foreach($cities as $city)
                                            <option @selected(!is_null(old('city_id')) ? old('city_id') == $city->id : $user->seeker->city_id == $city->id) value="{{ $city->id }}">{{ $city->t('name') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputResidencyNumber1">@lang('dashboard.Residency Number') <code>@lang('dashboard.Optional if you are Saudi')</code></label>
                                    <input name="residency_number" type="text" class="form-control" id="exampleInputResidencyNumber1" value="{{ old('residency_number') ?? $user->seeker->residency_number }}" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputResidencyExpiration1">@lang('dashboard.Residency Expiration') <code>@lang('dashboard.Optional if you are Saudi')</code></label>
                                    <input name="residency_expiration" type="date" min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" class="form-control" id="exampleInputResidencyExpiration1" value="{{ old('residency_expiration') ?? (!is_null($user->seeker->residency_expiration) ? \Carbon\Carbon::parse($user->seeker->residency_expiration)->format('Y-m-d') : '') }}" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputReligion1">@lang('dashboard.Religion')</label>
                                    <input name="religion" type="text" class="form-control" id="exampleInputReligion1" value="{{ old('religion') ?? $user->seeker->religion }}" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>@lang('dashboard.Job')</label>
                                    <select name="job_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                                        <option value=""></option>
                                        @foreach($jobs as $job)
                                            <option @selected(!is_null(old('job_id')) ? old('job_id') == $job->id : $user->seeker->job_id == $job->id) value="{{ $job->id }}">{{ $job->t('name') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>@lang('dashboard.Skills')</label>
                                    <select name="skills[]" class="select2 select2-hidden-accessible" multiple="" data-placeholder="" style="width: 100%;" data-select2-id="7" tabindex="0" aria-hidden="true">
                                        @foreach($skills as $skill)
                                            <option @selected(!is_null(old('skills')) ? in_array($skill->id, old('skills')) : in_array($skill->id, $user->seeker->skills->pluck('id')->toArray())) value="{{ $skill->id }}">{{ $skill->t('name') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">@lang('dashboard.CV')  <code>@lang('dashboard.Optional if you dont want to change it')</code></label>
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
                                <button type="submit" class="btn btn-dark">@lang('dashboard.Edit')</button>
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
