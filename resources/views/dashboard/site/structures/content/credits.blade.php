@extends('dashboard.core.app')
@section('title', __('titles.Credits Content'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Credits')</h1>
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
                        <form action="{{ route('credits.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Publish Credits Content')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div id="content">
                                    @foreach($structure->en as $content)
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
                                                        <label for="exampleInputTitle1">@lang('dashboard.Credit URL')</label>
                                                        <input name="en[{{$loop->index}}][url]" value="{{$structure->en[$loop->index]->url}}" type="text" class="form-control" id="exampleInputTitle1" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-11">
                                                            <div class="form-group" style="width: 100%;">
                                                                <label for="exampleInputFile">@lang('dashboard.Credit Image')</label>
                                                                <div class="input-group">
                                                                    <div class="custom-file">
                                                                        <input name="image_{{ $loop->index }}" type="file" class="custom-file-input" id="exampleInputFile">
                                                                        @if(!is_null($structure->en[$loop->index]))
                                                                            <input name="old_image_{{ $loop->index }}" type="hidden" value="{{ $structure->en[$loop->index]->image }}">
                                                                        @endif
                                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-1">
                                                            <img src="{{ $structure->en[$loop->index]?->image }}" style="width: 100%;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <div class="delete_content" style="cursor: pointer;"><i class="nav-icon fas fa-minus-circle"></i></div>
                                        </div>
                                    </div>
                                    <hr>
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
            let content_count = {{count($structure->en) - 1}};
            $('#add_content').on('click', function (e) {
                content_count++;
                const content =
                    '<hr>' +
                    '<div class="row">' +
                    '    <div class="col-11">' +
                    '        <div class="row">' +
                    '            <div class="col-6">' +
                    '                <div class="form-group">' +
                    '                    <label for="exampleInputTitle1">@lang("dashboard.Credit URL")</label>' +
                    '                    <input name="en['+ content_count +'][url]" type="text" class="form-control" id="exampleInputTitle1" placeholder="">' +
                    '                </div>' +
                    '            </div>' +
                    '            <div class="col-6">' +
                    '                <div class="row">' +
                    '                    <div class="col-11">' +
                    '                        <div class="form-group" style="width: 100%;">' +
                    '                            <label for="exampleInputFile">@lang("dashboard.Credit Image")</label>' +
                    '                            <div class="input-group">' +
                    '                                <div class="custom-file">' +
                    '                                    <input name="image_'+ content_count +'" type="file" class="custom-file-input" id="exampleInputFile">' +
                    '                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>' +
                    '                                </div>' +
                    '                            </div>' +
                    '                        </div>' +
                    '                    </div>' +
                    '                    <div class="col-1">' +
                    '                    </div>' +
                    '                </div>' +
                    '            </div>' +
                    '        </div>' +
                    '    </div>' +
                    '    <div class="col-1">' +
                    '        <div class="delete_content" style="cursor: pointer;"><i class="nav-icon fas fa-minus-circle"></i></div>' +
                    '    </div>' +
                    '</div>';
                $('#content').append(content);
            });
            $('.row').on('click', '.delete_content', function (e) {
                $(this).parent().parent().remove();
            });
        });
    </script>
@endsection
