@extends('dashboard.core.app')
@section('title', __('titles.Create City'))
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
                        <form action="{{ route('cities.store') }}" method="post" autocomplete="off">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Create City')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputName1">@lang('dashboard.Country')</label>
                                    <select name="country_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" data-select2-id="{{ $country->id }}">{{ $country->t('name') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName2">@lang('dashboard.Name En')</label>
                                    <input name="name_en" type="text" class="form-control" id="exampleInputName2" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName3">@lang('dashboard.Name Ar')</label>
                                    <input name="name_ar" type="text" class="form-control" id="exampleInputName3" placeholder="">
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
