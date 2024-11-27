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
            <p>{{ $message->content }}</p>

            <span class="time">{{ Carbon::parse(($message->created_at))->diffForHumans() }}</span>
        </div>
    </div>
</div>
