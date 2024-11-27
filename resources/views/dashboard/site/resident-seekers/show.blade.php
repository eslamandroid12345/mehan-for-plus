@extends('dashboard.core.app')
@section('title', __('titles.Resident Seeker'))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Resident Seekers')</h1>
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
                            <h3 class="card-title">@lang('dashboard.Show Resident Seeker')</h3>
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
                                    @if(!is_null($user->name))
                                        <td><b>@lang('dashboard.Name'):</b> {{ $user->name }}</td>
                                    @endif
                                </tr>
                                @if(!is_null($user->email))
                                    <tr>
                                        <td><b>@lang('dashboard.Email'):</b> {{ $user->email }}</td>
                                    </tr>
                                @endif
                                @if(!is_null($user->seeker->gender))
                                    <tr>
                                        <td><b>@lang('dashboard.Gender'):</b> {{ $user->seeker->gender == 0 ? __('dashboard.Male') : __('dashboard.Female') }}</td>
                                    </tr>
                                @endif
                                @if(!is_null($user->seeker->nationality))
                                    <tr>
                                        <td><b>@lang('dashboard.Nationality'):</b> {{ $user->seeker->nationality->t('name') }}</td>
                                    </tr>
                                @endif
                                @if(!is_null($user->seeker->city))
                                    <tr>
                                        <td><b>@lang('dashboard.City'):</b> {{ $user->seeker->city->t('name') }}</td>
                                    </tr>
                                @endif
                                @if(!is_null($user->seeker->residency_number))
                                    <tr>
                                        <td><b>@lang('dashboard.Residency Number'):</b> {{ $user->seeker->residency_number }}</td>
                                    </tr>
                                @endif
                                @if(!is_null($user->seeker->residency_expiration))
                                    <tr>
                                        <td><b>@lang('dashboard.Residency Expiration'):</b> {{ $user->seeker->residency_expiration }}</td>
                                    </tr>
                                @endif
                                @if(!is_null($user->seeker->religion))
                                    <tr>
                                        <td><b>@lang('dashboard.Religion'):</b> {{ $user->seeker->religion }}</td>
                                    </tr>
                                @endif
                                @if(!is_null($user->seeker->job))
                                    <tr>
                                        <td><b>@lang('dashboard.Job'):</b> {{ $user->seeker->job->t('name') }}</td>
                                    </tr>
                                @endif
                                @if(count($user->seeker->skills->toArray()) > 0)
                                    <tr>
                                        <td><b>@lang('dashboard.Skills'): </b>
                                            @foreach($user->seeker->skills as $skill)
                                                {{ $skill->t('name') }},
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif
                                @if(!is_null($user->seeker->cv))
                                    <tr>
                                        @if(!is_null($user->seeker->cv))
                                            <td>
                                                <a class="btn btn-dark" href="{{ url($user->seeker->cv) }}">@lang('dashboard.Download CV')</a>
                                            </td>
                                        @endif
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
