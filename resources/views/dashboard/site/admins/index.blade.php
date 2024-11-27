@extends('dashboard.core.app')
@section('title', __('titles.Admins'))
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
                        <div class="card-header">
                            <h3 class="card-title">@lang('dashboard.Admins')</h3>
                            <div class="card-tools">
                                <a href="{{ route('admins.create') }}" class="btn  btn-dark">@lang('dashboard.Create')</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('dashboard.Name')</th>
                                    <th>@lang('dashboard.Email')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->id }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>
                                            <div class="operations-btns" style="">
                                                <a href="{{ route('admins.edit', $admin->id) }}" class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                                @can('delete-admin', $admin->id)
                                                    <form action="{{ route('admins.destroy', $admin->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-dark">@lang('dashboard.Delete')</button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    @include('dashboard.core.includes.no-entries', ['columns' => 4])
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
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
