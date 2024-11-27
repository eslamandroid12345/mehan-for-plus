@extends('dashboard.core.app')
@section('title', __('titles.Create Admin'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Administration')</h1>
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
                        <form action="{{ route('admins.store') }}" method="post" autocomplete="off">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Create Admin')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputName1">@lang('dashboard.Name')</label>
                                    <input name="name" type="text" value="{{ old('name') }}" class="form-control" id="exampleInputName1" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">@lang('dashboard.Email')</label>
                                    <input name="email" type="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">@lang('dashboard.Password')</label>
                                    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword2">@lang('dashboard.Confirm Password')</label>
                                    <input name="password_confirmation" type="password" class="form-control" id="exampleInputPassword2" placeholder="">
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

