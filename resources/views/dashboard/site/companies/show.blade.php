@extends('dashboard.core.app')
@section('title', __('titles.Company Details'))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Companys Details')</h1>
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
                            <h3 class="card-title">@lang('dashboard.Show Company')</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    @if(!is_null($user->image))
                                        <td style="width: 200px;" rowspan="11">
                                            <img style="width: 200px;" src="{{ url($user->image) }}" />
                                        </td>
                                    @endif
                                    @if(!is_null($user->company->field))
                                        <td><b>@lang('dashboard.Company Field'):</b> {{ $user->company->field->t('name') }}</td>
                                    @endif
                                </tr>
                                @if(!is_null($user->name))
                                    <tr>
                                        <td><b>@lang('dashboard.Name'):</b> {{ $user->name }}</td>
                                    </tr>
                                @endif
                                @if(!is_null($user->email))
                                    <tr>
                                        <td><b>@lang('dashboard.Email'):</b> {{ $user->email }}</td>
                                    </tr>
                                @endif

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
