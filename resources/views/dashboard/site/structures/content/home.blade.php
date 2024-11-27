@extends('dashboard.core.app')
@section('title', __('titles.Home Content'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Home')</h1>
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
                        <form action="{{ route('home.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Publish Home Content')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle1">@lang('dashboard.Section 1 Title En')</label>
                                            <input name="en[section_1][title]" value="{{$content->en->section_1->title}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.Section 1 Title Ar')</label>
                                            <input name="ar[section_1][title]" value="{{$content->ar->section_1->title}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent1">@lang('dashboard.Section 1 Content En')</label>
                                            <textarea name="en[section_1][content]" id="exampleInputContent1" class="form-control" rows="5" placeholder="">{{$content->en->section_1->content}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent2">@lang('dashboard.Section 1 Content Ar')</label>
                                            <textarea name="ar[section_1][content]" id="exampleInputContent2" class="form-control" rows="5" placeholder="">{{$content->ar->section_1->content}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-10">
                                        <div class="form-group">
{{--                                            <label for="exampleInputMainTitle1">@lang('dashboard.Section 1 Video')</label>--}}
{{--                                            <input name="en[section_1][video]" value="{{$content->en->section_1->video}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">--}}
                                            <div class="form-group" style="width: 100%;">
                                                <label for="exampleInputFile">@lang('dashboard.Section 1 Video')</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input name="en[section_1][video]" type="hidden" value="file_0">
                                                        <input name="ar[section_1][video]" type="hidden" value="file_0">
                                                        <input name="file[0]" type="file" class="custom-file-input" id="exampleInputFile">
                                                        <input name="old_file[0]" type="hidden" value="{{ $content->en->section_1->video }}">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
{{--                                        <video src="{{ $content->en->section_1->video }}" style="width: 80%"></video>--}}
                                        <video style="width: 100%;" controls>
                                            <source src="{{ $content->en->section_1->video }}" type="video/mp4">
                                        </video>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-10">
                                        <div class="form-group" style="width: 100%;">
                                            <label for="exampleInputFile">@lang('dashboard.Section 1 Image')</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="en[section_1][image]" type="hidden" value="file_1">
                                                    <input name="ar[section_1][image]" type="hidden" value="file_1">
                                                    <input name="file[1]" type="file" class="custom-file-input" id="exampleInputFile">
                                                    <input name="old_file[1]" type="hidden" value="{{ $content->en->section_1->image }}">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <img src="{{ $content->en->section_1->image }}" style="width: 60%">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle1">@lang('dashboard.Section 2 Title En')</label>
                                            <input name="en[section_2][title]" value="{{$content->en->section_2->title}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.Section 2 Title Ar')</label>
                                            <input name="ar[section_2][title]" value="{{$content->ar->section_2->title}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-group" style="width: 100%;">
                                                    <label for="exampleInputFile">@lang('dashboard.Section 2 Image 1')</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input name="en[section_2][content][][image]" type="hidden" value="file_2">
                                                            <input name="ar[section_2][content][][image]" type="hidden" value="file_2">
                                                            <input name="file[2]" type="file" class="custom-file-input" id="exampleInputFile">
                                                            <input name="old_file[2]" type="hidden" value="{{ $content->en->section_2->content[0]->image }}">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <img src="{{ $content->en->section_2->content[0]->image }}" style="width: 100%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-group" style="width: 100%;">
                                                    <label for="exampleInputFile">@lang('dashboard.Section 2 Image 2')</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input name="en[section_2][content][][image]" type="hidden" value="file_3">
                                                            <input name="ar[section_2][content][][image]" type="hidden" value="file_3">
                                                            <input name="file[3]" type="file" class="custom-file-input" id="exampleInputFile">
                                                            <input name="old_file[3]" type="hidden" value="{{ $content->en->section_2->content[1]->image }}">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <img src="{{ $content->en->section_2->content[1]->image }}" style="width: 100%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-group" style="width: 100%;">
                                                    <label for="exampleInputFile">@lang('dashboard.Section 2 Image 3')</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input name="en[section_2][content][][image]" type="hidden" value="file_4">
                                                            <input name="ar[section_2][content][][image]" type="hidden" value="file_4">
                                                            <input name="file[4]" type="file" class="custom-file-input" id="exampleInputFile">
                                                            <input name="old_file[4]" type="hidden" value="{{ $content->en->section_2->content[2]->image }}">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <img src="{{ $content->en->section_2->content[2]->image }}" style="width: 100%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-group" style="width: 100%;">
                                                    <label for="exampleInputFile">@lang('dashboard.Section 2 Image 4')</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input name="en[section_2][content][][image]" type="hidden" value="file_5">
                                                            <input name="ar[section_2][content][][image]" type="hidden" value="file_5">
                                                            <input name="file[5]" type="file" class="custom-file-input" id="exampleInputFile">
                                                            <input name="old_file[5]" type="hidden" value="{{ $content->en->section_2->content[3]->image }}">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <img src="{{ $content->en->section_2->content[3]->image }}" style="width: 100%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle1">@lang('dashboard.Section 2 Image 1 Title En')</label>
                                            <input name="en[section_2][content][0][title]" value="{{$content->en->section_2->content[0]->title}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                            <input name="en[section_2][content][0][number]" value="1" type="hidden" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle1">@lang('dashboard.Section 2 Image 2 Title En')</label>
                                            <input name="en[section_2][content][1][title]" value="{{$content->en->section_2->content[1]->title}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                            <input name="en[section_2][content][1][number]" value="2" type="hidden" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle1">@lang('dashboard.Section 2 Image 3 Title En')</label>
                                            <input name="en[section_2][content][2][title]" value="{{$content->en->section_2->content[2]->title}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                            <input name="en[section_2][content][2][number]" value="3" type="hidden" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle1">@lang('dashboard.Section 2 Image 4 Title En')</label>
                                            <input name="en[section_2][content][3][title]" value="{{$content->en->section_2->content[3]->title}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                            <input name="en[section_2][content][3][number]" value="4" type="hidden" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle1">@lang('dashboard.Section 2 Image 1 Title Ar')</label>
                                            <input name="ar[section_2][content][0][title]" value="{{$content->ar->section_2->content[0]->title}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                            <input name="ar[section_2][content][0][number]" value="1" type="hidden" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle1">@lang('dashboard.Section 2 Image 2 Title Ar')</label>
                                            <input name="ar[section_2][content][1][title]" value="{{$content->ar->section_2->content[1]->title}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                            <input name="ar[section_2][content][1][number]" value="2" type="hidden" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle1">@lang('dashboard.Section 2 Image 3 Title Ar')</label>
                                            <input name="ar[section_2][content][2][title]" value="{{$content->ar->section_2->content[2]->title}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                            <input name="ar[section_2][content][2][number]" value="3" type="hidden" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle1">@lang('dashboard.Section 2 Image 4 Title Ar')</label>
                                            <input name="ar[section_2][content][3][title]" value="{{$content->ar->section_2->content[3]->title}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                            <input name="ar[section_2][content][3][number]" value="4" type="hidden" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle1">@lang('dashboard.Section 3 Title En')</label>
                                            <input name="en[section_3][title]" value="{{$content->en->section_3->title}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.Section 3 Title Ar')</label>
                                            <input name="ar[section_3][title]" value="{{$content->ar->section_3->title}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent1">@lang('dashboard.Section 3 Content En')</label>
                                            <textarea name="en[section_3][content]" id="exampleInputContent1" class="form-control" rows="5" placeholder="">{{$content->en->section_3->content}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent2">@lang('dashboard.Section 3 Content Ar')</label>
                                            <textarea name="ar[section_3][content]" id="exampleInputContent2" class="form-control" rows="5" placeholder="">{{$content->ar->section_3->content}}</textarea>
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
