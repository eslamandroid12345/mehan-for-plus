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
            <div class="img">
                <img src="{{ url($message->content) }}" style="width: 50%;" alt="" />
            </div>

            <span class="time">{{ Carbon::parse(($message->created_at))->diffForHumans() }}</span>
        </div>
    </div>
</div>
