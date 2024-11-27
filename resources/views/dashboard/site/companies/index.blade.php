@extends('dashboard.core.app')
@section('title', __('titles.Companies'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Companies')</h1>
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
                            <h3 class="card-title">@lang('dashboard.Companies')</h3>
                            <div class="card-tools">
                                <a href="{{ route('companies.create') }}" class="btn  btn-dark">@lang('dashboard.Create')</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th style="width: 50px;">@lang('dashboard.Image')</th>
                                    <th>@lang('dashboard.Name')</th>
                                    <th>@lang('dashboard.Company Field')</th>
                                    <th>@lang('dashboard.Email')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($companies as $company)
                                    <tr>
                                        <td>{{ $company->user->id }}</td>
                                        <td><img src="{{ !is_null($company->user->image) ? url($company->user->image) : '' }}" style="width: 50px;" /></td>
                                        <td>{{ $company->user->name }}</td>
                                        <td>{{ $company->field->t('name') }}</td>
                                        <td>{{ $company->user->email }}</td>
                                        <td>
                                            <div class="operations-btns" style="">
                                                <a href="{{ route('companies.show', $company->user->id) }}" class="btn  btn-dark">@lang('dashboard.Show')</a>
                                                <a href="{{ route('companies.edit', $company->user->id) }}" class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                                <form action="{{ route('companies.destroy', $company->user->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-dark">@lang('dashboard.Delete')</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    @include('dashboard.core.includes.no-entries', ['columns' => 6])
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{ $companies->links() }}
                        </div>
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
