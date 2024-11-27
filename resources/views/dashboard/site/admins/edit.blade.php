@extends('dashboard.core.app')
@section('title', __('title.Edit Admin'))
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
                        <form action="{{ route('admins.update', $admin->id) }}" method="post" autocomplete="off">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Edit Admin')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="exampleInputName1">@lang('dashboard.Name')</label>
                                    <input name="name" type="text" class="form-control" id="exampleInputName1" value="{{ $admin->name }}" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">@lang('dashboard.Email')</label>
                                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" value="{{ $admin->email }}" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">@lang('dashboard.Password')  <code>@lang('dashboard.Optional if you dont want to change it')</code></label>
                                    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword2">@lang('dashboard.Confirm Password')</label>
                                    <input name="password_confirmation" type="password" class="form-control" id="exampleInputPassword2" placeholder="">
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

