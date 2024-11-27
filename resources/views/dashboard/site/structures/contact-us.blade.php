@extends('dashboard.core.app')
@section('title', __('titles.Contact Us Content'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Contact Us')</h1>
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
                        <form action="{{ route('contact-us.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Publish Contact Us Content')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle1">@lang('dashboard.Page Name En')</label>
                                            <input name="en[main_title]" value="{{$structure->en->main_title}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.Page Name Ar')</label>
                                            <input name="ar[main_title]" value="{{$structure->ar->main_title}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContactMessage1">@lang('dashboard.Contacts Message En')</label>
                                            <input name="en[content][contacts][message]" value="{{$structure->en->content->contacts->message}}" type="text" class="form-control" id="exampleInputContactMessage1" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContactMessage2">@lang('dashboard.Contacts Message Ar')</label>
                                            <input name="ar[content][contacts][message]" value="{{$structure->ar->content->contacts->message}}" type="text" class="form-control" id="exampleInputContactMessage2" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div id="contacts">
                                    @foreach($structure->en->content->contacts->content as $contact)
                                        @if($loop->first)
                                            <div class="row" style="height: 50px">
                                                <div class="col-11"></div>
                                                <div class="col-1">
                                                    <div id="add_contact" style="cursor: pointer;"><i class="nav-icon fas fa-plus-circle"></i></div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <select name="en[content][contacts][content][{{$loop->index}}][key]" class="form-control">
                                                        <option @selected($contact->key == 'phone') value="phone">@lang('dashboard.Phone')</option>
                                                        <option @selected($contact->key == 'whatsapp') value="whatsapp">@lang('dashboard.WhatsApp')</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="form-group">
                                                    <input name="en[content][contacts][content][{{$loop->index}}][value]" value="{{$contact->value}}" type="text" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="delete_contact" style="cursor: pointer;"><i class="nav-icon fas fa-minus-circle"></i></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputSocialMessage1">@lang('dashboard.Social Message En')</label>
                                            <input name="en[content][social][message]" value="{{$structure->en->content->social->message}}" type="text" class="form-control" id="exampleInputSocialMessage1" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputSocialMessage2">@lang('dashboard.Social Message Ar')</label>
                                            <input name="ar[content][social][message]" value="{{$structure->ar->content->social->message}}" type="text" class="form-control" id="exampleInputSocialMessage2" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div id="socials">
                                    @foreach($structure->en->content->social->content as $social)
                                        @if($loop->first)
                                            <div class="row" style="height: 50px">
                                                <div class="col-11"></div>
                                                <div class="col-1">
                                                    <div id="add_social" style="cursor: pointer;"><i class="nav-icon fas fa-plus-circle"></i></div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <select name="en[content][social][content][{{$loop->index}}][key]" class="form-control">
                                                        <option @selected($social->key == 'facebook') value="facebook">@lang('dashboard.Facebook')</option>
                                                        <option @selected($social->key == 'twitter') value="twitter">@lang('dashboard.Twitter')</option>
                                                        <option @selected($social->key == 'instagram') value="instagram">@lang('dashboard.Instagram')</option>
                                                        <option @selected($social->key == 'gmail') value="gmail">@lang('dashboard.Gmail')</option>
                                                        <option @selected($social->key == 'snapchat') value="snapchat">@lang('dashboard.Snapchat')</option>
                                                        <option @selected($social->key == 'linkedin') value="linkedin">@lang('dashboard.LinkedIn')</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="form-group">
                                                    <input name="en[content][social][content][{{$loop->index}}][value]" value="{{$social->value}}" type="text" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="delete_social" style="cursor: pointer;"><i class="nav-icon fas fa-minus-circle"></i></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">@lang('dashboard.Publish')</button>
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

@section('js_addons')
    <script>
        $(function () {
            let contacts_count = {{count($structure->en->content->contacts->content) - 1}};
            $('#add_contact').on('click', function (e) {
                contacts_count++;
                const contact = '<div class="row">' +
                    '<div class="col-3">' +
                    '<div class="form-group">' +
                    '<select name="en[content][contacts][content][' + contacts_count + '][key]" class="form-control">' +
                    '<option value="phone">@lang("dashboard.Phone")</option>' +
                    '<option value="whatsapp">@lang("dashboard.WhatsApp")</option>' +
                    '</select>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-8">' +
                    '<div class="form-group">' +
                    '<input name="en[content][contacts][content][' + contacts_count + '][value]" value="" type="text" class="form-control" placeholder="">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-1">' +
                    '<div class="delete_contact" style="cursor: pointer;"><i class="nav-icon fas fa-minus-circle"></i></div>' +
                    '</div>' +
                    '</div>';
                $('#contacts').append(contact);
            });
            $('.row').on('click', '.delete_contact', function (e) {
                $(this).parent().parent().remove();
            });

            let social_count = {{count($structure->en->content->social->content) - 1}};
            $('#add_social').on('click', function (e) {
                social_count++;
                const social = '<div class="row">' +
                    '<div class="col-3">' +
                    '<div class="form-group">' +
                    '<select name="en[content][social][content][' + social_count + '][key]" class="form-control">' +
                    '<option value="facebook">@lang('dashboard.Facebook')</option>' +
                    '<option value="twitter">@lang('dashboard.Twitter')</option>' +
                    '<option value="instagram">@lang('dashboard.Instagram')</option>' +
                    '<option value="gmail">@lang('dashboard.Gmail')</option>' +
                    '<option value="snapchat">@lang('dashboard.Snapchat')</option>' +
                    '<option value="linkedin">@lang('dashboard.LinkedIn')</option>' +
                    '</select>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-8">' +
                    '<div class="form-group">' +
                    '<input name="en[content][social][content][' + social_count + '][value]" value="" type="text" class="form-control" placeholder="">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-1">' +
                    '<div class="delete_social" style="cursor: pointer;"><i class="nav-icon fas fa-minus-circle"></i></div>' +
                    '</div>' +
                    '</div>';
                $('#socials').append(social);
            });
            $('.row').on('click', '.delete_social', function (e) {
                $(this).parent().parent().remove();
            });
        });
    </script>
@endsection
