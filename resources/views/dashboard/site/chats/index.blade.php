@php use Carbon\Carbon; @endphp
@extends('dashboard.core.app')
@section('title', __('titles.Chats'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
    @import url("https://fonts.googleapis.com/css2?family=Roboto&display=swap");
    * {
        box-sizing: border-box;
        font-family: "Roboto", sans-serif;
    }

    .top-form .input-group {
        width: 100% !important;
    }

    .img {
        max-width: 100%;
        display: flex;
    }

    .received-chats-msg .img {
        justify-content: start;
    }

    .outgoing-chats-msg .img {
        justify-content: end;
    }

    .img img {
        width: 100%;
    }

    img.folder {
        width: 23px;
        margin: 10px;
    }

    p {
        max-width: 500px;
    }

    /* Styling the main container */
    .container {
        width: 80%;
        margin: auto;
        margin-top: 2rem;
        letter-spacing: 0.5px;
        height: 80%;
    }

    img.avatar {
        width: 50px;
        vertical-align: middle;
        border-style: none;
        border-radius: 100%;
    }
    /* Styling the msg-header container */
    .msg-header {
        border: 1px solid #ccc;
        width: 100%;
        height: 10%;
        border-bottom: none;
        display: inline-block;
        background-color: #efefef;
        margin: 0;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }
    /* Styling the profile picture */
    .msgimg {
        margin-left: 2%;
        float: left;
    }

    .container1 {
        width: 270px;
        height: auto;
        float: left;
        margin: 0;
    }

    /* styling user-name */
    .active {
        width: 150px;
        float: left;
        color: black;
        font-weight: bold;
        margin: 0 0 0 5px;
        height: 10%;
    }
    /* Styling the inbox */
    .chat-page {
        padding: 0 0 50px 0;
    }

    .msg-inbox {
        border: 1px solid #ccc;
        overflow: hidden;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
    }

    .chats {
        padding: 30px 15px 0 25px;
    }

    .msg-page {
        max-height: 500px;
        overflow-y: auto;
    }

    /* Styling the msg-bottom container */
    .msg-bottom {
        border-top: 1px solid #ccc;
        position: relative;
        height: 11%;
        background-color: rgb(239 239 239);
    }
    /* Styling the input field */
    .input-group {
        float: right;
        margin-top: 13px;
        margin-right: 20px;
        outline: none !important;
        border-radius: 20px;
        width: 61% !important;
        background-color: #fff;
        position: relative;
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
    }

    /*.input-group > .form-control {*/
    /*    position: relative;*/
    /*    flex: 1 1 auto;*/
    /*    width: 1%;*/
    /*    margin-bottom: 0;*/
    /*}*/

    /*.form-control {*/
    /*    border: none !important;*/
    /*    border-radius: 20px !important;*/
    /*    display: block;*/
    /*    height: calc(2.25rem + 2px);*/
    /*    padding: 0.375rem 0.75rem;*/
    /*    font-size: 1rem;*/
    /*    line-height: 1.5;*/
    /*    color: #495057;*/
    /*    background-color: #fff;*/
    /*    background-clip: padding-box;*/
    /*    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;*/
    /*}*/

    .input-group-text {
        background: transparent !important;
        border: none !important;
        display: flex;
        align-items: center;
        padding: 0.375rem 0.75rem;
        margin-bottom: 0;
        font-size: 1.5rem;
        font-weight: b;
        line-height: 1.5;
        color: #495057;
        text-align: center;
        white-space: nowrap;
        background-color: #e9ecef;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        font-weight: bold !important;
        cursor: pointer;
    }

    input:focus {
        outline: none;
        border: none !important;
        box-shadow: none !important;
    }

    .send-icon {
        font-weight: bold !important;
    }

    /* Styling the avatar  */
    .received-chats-img {
        display: inline-block;
        width: 50px;
        float: left;
    }

    .received-chats {
        overflow: hidden;
        margin: 26px 20px;
        display: flex;
    }

    .received-msg {
        display: inline-block;
        padding: 0 15px;
        vertical-align: top;
        /*width: 92%;*/
    }
    .received-msg-inbox {
        width: 57%;
    }

    .received-chats-msg p {
        background: #efefef none repeat scroll 0 0;
        border-radius: 10px;
        color: #646464;
        font-size: 14px;
        margin-left: 1rem;
        padding: 1rem;
        width: 100%;
        box-shadow: rgb(0 0 0 / 25%) 0px 5px 5px 2px;
    }
    p {
        overflow-wrap: break-word;
    }

    /* Styling the msg-sent time  */
    .time {
        color: #777;
        display: block;
        font-size: 12px;
        margin: 8px 0 0;
    }

    .received-chats-msg .time {
        text-align: start;
    }

    .outgoing-chats-msg .time {
        text-align: end;
    }

    .outgoing-chats {
        overflow: hidden;
        margin: 26px 20px;
        display: flex;
        flex-direction: row-reverse;
    }

    .outgoing-msg {
        padding: 0 15px;
    }

    .outgoing-chats-msg p {
        background-color: #343a40;
        /*background-image: linear-gradient(*/
        /*    45deg,*/
        /*    #ee087f 0%,*/
        /*    #dd2a7b 25%,*/
        /*    #9858ac 50%,*/
        /*    #8134af 75%,*/
        /*    #515bd4 100%*/
        /*);*/
        color: #fff;
        border-radius: 10px;
        font-size: 14px;
        color: #fff;
        padding: 5px 10px 5px 12px;
        width: 100%;
        padding: 1rem;
        box-shadow: rgb(0 0 0 / 25%) 0px 2px 5px 2px;
    }
    /* .outgoing-chats-msg {
      float: right;
      width: 46%;
    } */

    /* Styling the avatar */
    .outgoing-chats-img {
        display: inline-block;
        width: 50px;
        float: right;
    }
    @media only screen and (max-device-width: 850px) {
        *,
        .time {
            font-size: 28px;
        }
        img {
            width: 65px;
        }
        .msg-header {
            height: 5%;
        }
        .msg-page {
            max-height: none;
        }
        .received-msg-inbox p {
            font-size: 28px;
        }
        .outgoing-chats-msg p {
            font-size: 28px;
        }
    }

    @media only screen and (max-device-width: 450px) {
        *,
        .time {
            font-size: 28px;
        }
        img {
            width: 65px;
        }
        .msg-header {
            height: 5%;
        }
        .msg-page {
            max-height: none;
        }
        .received-msg-inbox p {
            font-size: 28px;
        }
        .outgoing-chats-msg p {
            font-size: 28px;
        }
    }

</style>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Chats')</h1>
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
                            <h3 class="card-title">@lang('dashboard.Chats')</h3>
                        </div>
                        <div class="card-body">
                            <div class="top-form container mt-5">
                                <form action="{{ route('chats.search') }}" method="post" class="row justify-space-between">
                                    @csrf
                                    <div class="input-group mb-3 w-100">

                                        <div class="row w-100">
                                            <div class="col-5">
                                                <label>@lang('dashboard.Company')</label>
                                                <select name="company_id" class="form-control select2 select2-hidden-accessible" style="width: 100%">
                                                    <option value=""></option>
                                                    @foreach($companies as $company)
                                                        <option @selected(isset($room) && in_array($company->user_id, $roomUsers)) value="{{ $company->user_id }}">{{ $company->user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-5">
                                                <label>@lang('dashboard.Seeker')</label>
                                                <select name="seeker_id" class="form-control select2 select2-hidden-accessible" style="width: 100%">
                                                    <option value=""></option>
                                                    @foreach($seekers as $seeker)
                                                        <option @selected(isset($room) && in_array($seeker->user_id, $roomUsers)) value="{{ $seeker->user_id }}">{{ $seeker->user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2 d-flex align-content-end flex-wrap">
                                                <div class="input-group-append" style="display: inline-block;">
                                                    <button class="btn btn-dark" type="submit">@lang('dashboard.Search')</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6"></div>
                                </form>
                            </div>
                            <!-- ============== -->
                            <!-- caht -->
                            <!-- ============== -->
                            @if(isset($room))
                                <div class="container">
                                    <!-- Chat inbox  -->
                                    <div class="chat-page" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                                        <div class="msg-inbox">
                                            <div class="chats">
                                                <!-- Message container -->
                                                <div class="msg-page">
                                                    @forelse($room->messages()->get()->reverse() as $message)
                                                        @include('dashboard.site.chats.types.'.strtolower($message->type), ['whereTo' => $message->user->user_type == 0 ? 'outgoing' : 'received', 'message' => $message])
                                                    @empty
                                                        <h2 class="text-center">@lang('dashboard.The conversation is just started, no messages')</h2>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
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

@section('js_addons')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.select2').select2({
                language: {
                    searching: function() {}
                },
            });
            $('.msg-page').scrollTop(1E10);
        });
    </script>
@endsection
