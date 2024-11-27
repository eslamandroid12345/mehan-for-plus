@extends('dashboard.core.app')
@section('title', __('titles.Notifications'))

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
                    <h1>@lang('dashboard.Notifications')</h1>
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
                        <form action="{{ route('notifications.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Notifications')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="form-group">
                                    <label>@lang('dashboard.Push to ...')</label>
                                    <select name="to[]" class="select2 select2-hidden-accessible" multiple="" data-placeholder="" style="width: 100%;" data-select2-id="7" tabindex="0" aria-hidden="true">
                                        <option @selected(!is_null(old('to')) && in_array('0', old('to'))) value="0">@lang('dashboard.Companies')</option>
                                        <option @selected(!is_null(old('to')) && in_array('1', old('to'))) value="1">@lang('dashboard.Resident Seekers')</option>
                                        <option @selected(!is_null(old('to')) && in_array('2', old('to'))) value="2">@lang('dashboard.Non-Resident Seekers')</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">@lang('dashboard.Notification Title')</label>
                                    <input name="title" type="text" class="form-control" id="exampleInputName1" value="{{ old('title') }}" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">@lang('dashboard.Notification Description')</label>
                                    <input name="content" type="text" class="form-control" id="exampleInputName1" value="{{ old('description') }}" placeholder="">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">@lang('dashboard.Push')</button>
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
        });
    </script>
@endsection
