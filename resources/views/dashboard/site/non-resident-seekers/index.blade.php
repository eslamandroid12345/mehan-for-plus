@extends('dashboard.core.app')
@section('title', __('titles.Non-Resident Seekers'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Non-Resident Seekers')</h1>
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
                            <h3 class="card-title">@lang('dashboard.Non-Resident Seekers')</h3>
                            <div class="card-tools">
                                <a href="{{ route('non-resident-seekers.create') }}" class="btn  btn-dark">@lang('dashboard.Create')</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th style="width: 50px;">@lang('dashboard.Image')</th>
                                    <th>@lang('dashboard.Name')</th>
                                    <th>@lang('dashboard.Email')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($seekers as $seeker)
                                    <tr>
                                        <td>{{ $seeker->user->id }}</td>
                                        <td><img src="{{ !is_null($seeker->user->image) ? url($seeker->user->image) : '' }}" style="width: 50px;" /></td>
                                        <td>{{ $seeker->user->name }}</td>
                                        <td>{{ $seeker->user->email }}</td>
                                        <td>
                                            <div class="operations-btns" style="">
                                                <a href="{{ route('non-resident-seekers.show', $seeker->user->id) }}" class="btn btn-dark">@lang('dashboard.Show')</a>
                                                <a href="{{ route('non-resident-seekers.edit', $seeker->user->id) }}" class="btn btn-dark">@lang('dashboard.Edit')</a>
                                                @can('delete-seeker', $seeker)
                                                    <form action="{{ route('non-resident-seekers.destroy', $seeker->user->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-dark">@lang('dashboard.Delete')</button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    @include('dashboard.core.includes.no-entries', ['columns' => 5])
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
