@extends('dashboard.core.app')
@section('title', __('titles.Countries'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Countries and Cities')</h1>
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
                            <h3 class="card-title">@lang('dashboard.Countries')</h3>
                            <div class="card-tools">
                                <a href="{{ route('countries.create') }}" class="btn btn-dark">@lang('dashboard.Create')</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('dashboard.Name En')</th>
                                    <th>@lang('dashboard.Name Ar')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($countries as $country)
                                    <tr>
                                        <td>{{ $country->id }}</td>
                                        <td>{{ $country->name_en }}</td>
                                        <td>{{ $country->name_ar }}</td>
                                        <td>
                                            <div class="operations-btns" style="">
                                                @can('edit-country', $country)
                                                    <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-dark">@lang('dashboard.Edit')</a>
                                                @endcan
                                                @can('delete-country', $country)
                                                    <form action="{{ route('countries.destroy', $country->id) }}" method="post">
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
