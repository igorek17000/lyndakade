<div class="message-wrapper">
    <ul class="messages">
        @foreach($messages as $message)
            <li class="message clearfix">
                <div class="{{ $message->from == Auth::id() ? 'sent' : 'received' }}">
                    <p>{{ $message->message }}</p>
                    <p class="date"
                       style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
                        {{ date('d/m/Y, H:i', strtotime($message->created_at)) }}
                    </p>
                </div>
            </li>
        @endforeach
    </ul>
</div>

<div class="input-text">
    <input type="text" name="message" class="message-text">
{{--    <div class="btn btn-success btn-sm send-button">ارسال</div>--}}
</div>
