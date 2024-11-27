@extends('dashboard.core.app')
@section('title', __('titles.Jobs'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Jobs and Skills')</h1>
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
                            <h3 class="card-title">@lang('dashboard.Jobs')</h3>
                            <div class="card-tools">
                                <a href="{{ route('jobs.create') }}" class="btn btn-dark">@lang('dashboard.Create')</a>
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
                                @forelse($jobs as $job)
                                    <tr>
                                        <td>{{ $job->id }}</td>
                                        <td>{{ $job->name_en }}</td>
                                        <td>{{ $job->name_ar }}</td>
                                        <td>
                                            <div class="operations-btns" style="">
                                                <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-dark">@lang('dashboard.Edit')</a>
                                                @can('delete-job', $job)
                                                    <form action="{{ route('jobs.destroy', $job->id) }}" method="post">
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
