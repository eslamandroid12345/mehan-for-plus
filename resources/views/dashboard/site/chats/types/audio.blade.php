@php use Carbon\Carbon; @endphp
<div class="{{ $whereTo }}-chats">
    <div class="{{ $whereTo }}-chats-img">
        <img
            src="{{ url($message->user->image) }}"
            alt="avatar"
            class="avatar"
        />
    </div>
    <div class="{{ $whereTo }}-msg">
        <div class="{{ $whereTo }}-msg-inbox">
            <audio controls id="myaudio">
                <source
                    src="{{ url($message->content) }}"
                />
            </audio>

            <span class="time">{{ Carbon::parse(($message->created_at))->diffForHumans() }}</span>
        </div>
    </div>
</div>
