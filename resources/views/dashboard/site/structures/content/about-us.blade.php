@extends('dashboard.core.app')
@section('title', __('titles.About Us Content'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.About Us')</h1>
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
                        <form action="{{ route('about.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Publish About Us Content')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle1">@lang('dashboard.Page Name En')</label>
                                            <input name="en[main_title]" value="{{$content->en->main_title}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.Page Name Ar')</label>
                                            <input name="ar[main_title]" value="{{$content->ar->main_title}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8" style="display: flex;align-items: center;">
                                        <div class="form-group" style="width: 100%;">
                                            <label for="exampleInputFile">@lang('dashboard.Image')</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="en[content][image]" type="hidden" value="file_0">
                                                    <input name="ar[content][image]" type="hidden" value="file_0">
                                                    <input name="file[0]" type="file" class="custom-file-input" id="exampleInputFile">
                                                    <input name="old_file[0]" type="hidden" value="{{ $content->en->content->image }}">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4" style="display: flex;">
                                        <img src="{{ $content->en->content->image }}" id="aboutUsImage" style="width: 60%;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputTitle1">@lang('dashboard.Title En')</label>
                                            <input name="en[content][title]" value="{{$content->en->content->title}}" type="text" class="form-control" id="exampleInputTitle1" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputTitle2">@lang('dashboard.Title Ar')</label>
                                            <input name="ar[content][title]" value="{{$content->ar->content->title}}" type="text" class="form-control" id="exampleInputTitle2" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent1">@lang('dashboard.Content En')</label>
                                            <textarea name="en[content][content]" id="exampleInputContent1" class="form-control" rows="8" placeholder="">{{$content->en->content->content}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent2">@lang('dashboard.Content Ar')</label>
                                            <textarea name="ar[content][content]" id="exampleInputContent2" class="form-control" rows="8" placeholder="">{{$content->ar->content->content}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">@lang('dashboard.Publish')</button>
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
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection
