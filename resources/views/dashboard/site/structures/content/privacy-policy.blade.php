@extends('dashboard.core.app')
@section('title', __('titles.Privacy Policy Content'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Privacy Policy')</h1>
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
                        <form action="{{ route('privacy-policy.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Publish Privacy Policy Content')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle1">@lang('dashboard.Page Name En')</label>
                                            <input name="en[main_title]" value="{{$structure->en->main_title}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.Page Name Ar')</label>
                                            <input name="ar[main_title]" value="{{$structure->ar->main_title}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div id="content">
                                    @foreach($structure->en->content as $content)
                                    <hr>
                                    @if($loop->first)
                                        <div class="row" style="height: 50px">
                                            <div class="col-11"></div>
                                            <div class="col-1">
                                                <div id="add_content" style="cursor: pointer;"><i class="nav-icon fas fa-plus-circle"></i></div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputTitle1">@lang('dashboard.Title En')</label>
                                                        <input name="en[content][{{$loop->index}}][title]" value="{{$structure->en->content[$loop->index]->title}}" type="text" class="form-control" id="exampleInputTitle1" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputTitle2">@lang('dashboard.Title Ar')</label>
                                                        <input name="ar[content][{{$loop->index}}][title]" value="{{$structure->ar->content[$loop->index]->title}}" type="text" class="form-control" id="exampleInputTitle2" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputContent1">@lang('dashboard.Content En')</label>
                                                        <textarea name="en[content][{{$loop->index}}][content]" id="exampleInputContent1" class="form-control" rows="5" placeholder="">{{$structure->en->content[$loop->index]->content}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputContent2">@lang('dashboard.Content Ar')</label>
                                                        <textarea name="ar[content][{{$loop->index}}][content]" id="exampleInputContent2" class="form-control" rows="5" placeholder="">{{$structure->ar->content[$loop->index]->content}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <div class="delete_content" style="cursor: pointer;"><i class="nav-icon fas fa-minus-circle"></i></div>
                                        </div>
                                    </div>
                                @endforeach
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
    <script>
        $(function () {
            let content_count = {{count($structure->en->content) - 1}};
            $('#add_content').on('click', function (e) {
                content_count++;
                const content = '<hr>' +
                    '<div class="row">' +
                    '    <div class="col-11">' +
                    '        <div class="row">' +
                    '            <div class="col-6">' +
                    '                <div class="form-group">' +
                    '                    <label for="exampleInputTitle1">@lang('dashboard.Title En')</label>' +
                    '                    <input name="en[content]['+content_count+'][title]" value="" type="text" class="form-control" id="exampleInputTitle1" placeholder="">' +
                    '                </div>' +
                    '            </div>' +
                    '            <div class="col-6">' +
                    '                <div class="form-group">' +
                    '                    <label for="exampleInputTitle2">@lang('dashboard.Title Ar')</label>' +
                    '                    <input name="ar[content]['+content_count+'][title]" value="" type="text" class="form-control" id="exampleInputTitle2" placeholder="">' +
                    '                </div>' +
                    '            </div>' +
                    '        </div>' +
                    '        <div class="row">' +
                    '            <div class="col-6">' +
                    '                <div class="form-group">' +
                    '                    <label for="exampleInputContent1">@lang('dashboard.Content En')</label>' +
                    '                    <textarea name="en[content]['+content_count+'][content]" id="exampleInputContent1" class="form-control" rows="5" placeholder=""></textarea>' +
                    '                </div>' +
                    '            </div>' +
                    '            <div class="col-6">' +
                    '                <div class="form-group">' +
                    '                    <label for="exampleInputContent2">@lang('dashboard.Content Ar')</label>' +
                    '                    <textarea name="ar[content]['+content_count+'][content]" id="exampleInputContent2" class="form-control" rows="5" placeholder=""></textarea>' +
                    '                </div>' +
                    '            </div>' +
                    '        </div>' +
                    '    </div>' +
                    '    <div class="col-1">' +
                    '        <div class="delete_content" style="cursor: pointer;"><i class="nav-icon fas fa-minus-circle"></i></div>' +
                    '    </div>' +
                    '</div>' +
                    '';
                $('#content').append(content);
            });
            $('.row').on('click', '.delete_content', function (e) {
                $(this).parent().parent().remove();
            });
        });
    </script>
@endsection
