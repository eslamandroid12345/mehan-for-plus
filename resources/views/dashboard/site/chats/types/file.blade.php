@php use Carbon\Carbon; @endphp
<div class="{{ $whereTo }}-chats">
    <div class="{{ $whereTo }}-chats-img ma-0">
        <img
            src="{{ url($message->user->image) }}"
            alt="avatar"
            class="avatar"
        />
    </div>
    <div class="{{ $whereTo }}-msg">
        <div class="{{ $whereTo }}-chats-msg">
            <!-- file to donwload --- replace href tag with the file path  -->
            <a
                href="{{ url($message->content) }}"
                target="_blank"
                download
                class="d-flex align-items-center"
            >
{{--                <img--}}
{{--                    src="./assets/imgs/folder.png"--}}
{{--                    alt="folder"--}}
{{--                    class="folder"--}}
{{--                />--}}
                <div><i class="fas fa-download"></i> @lang('dashboard.Download File')</div>
            </a>

            <span class="time">{{ Carbon::parse(($message->created_at))->diffForHumans() }}</span>
        </div>
    </div>
</div>
