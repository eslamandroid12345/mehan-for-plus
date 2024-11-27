@extends('dashboard.core.app')
@section('title', __('titles.Edit Nationality'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Nationalities')</h1>
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
                        <form action="{{ route('nationalities.update', $nationality->id) }}" method="post" autocomplete="off">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Edit Nationality')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="exampleInputName1">@lang('dashboard.Name En')</label>
                                    <input name="name_en" type="text" class="form-control" id="exampleInputName1" value="{{ $nationality->name_en }}" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName2">@lang('dashboard.Name Ar')</label>
                                    <input name="name_ar" type="text" class="form-control" id="exampleInputName2" value="{{ $nationality->name_ar }}" placeholder="">
                                </div>
                                <code><b>@lang('dashboard.This change will be effective on all seekers assigned to this nationality')</b></code>
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
