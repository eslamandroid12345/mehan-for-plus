@extends('dashboard.core.app')
@section('title', __('titles.Ads'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Ads')</h1>
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
                            <h3 class="card-title">@lang('dashboard.Ads')</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th style="width: 50px;">@lang('dashboard.Image')</th>
                                    <th>@lang('dashboard.Name')</th>
                                    <th>@lang('dashboard.Activated')</th>
                                    <th>@lang('dashboard.Expiration Date')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($seekers as $seeker)
                                    <tr>
                                        <td>{{ $seeker->user->id }}</td>
                                        <td><img
                                                src="{{ !is_null($seeker->user->image) ? url($seeker->user->image) : '' }}"
                                                style="width: 50px;"/></td>
                                        <td>{{ $seeker->user->name }}</td>
                                        <td {{ is_null($seeker->ad) || !$seeker->ad->is_active ? 'colspan=2' : '' }} class="text-center">{{ $seeker->ad?->is_active ? __('dashboard.Yes') : __('dashboard.No') }}</td>
                                        @if($seeker->ad?->is_active)
                                            <td>{{ adExpiration($seeker->ad?->expiration_date) }}</td>
                                        @endif
                                        <td>
                                            <div class="operations-btns" style="">
                                                @can('admin-publish-ad', $seeker)
                                                    <a href="{{ route('ads.edit', $seeker->user->id) }}"
                                                       class="btn btn-dark">@lang('dashboard.Publish Ad')</a>
                                                @endcan
                                                @if($seeker->ad?->is_active)
                                                    <a href="{{ route('ads.show', $seeker->user->id) }}"
                                                       class="btn btn-dark">@lang('dashboard.Show')</a>
                                                @endif
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
                            {{ $seekers->links() }}
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
