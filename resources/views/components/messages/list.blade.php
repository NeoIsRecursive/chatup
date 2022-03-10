<div class="messages">
    @foreach ($messages as $message)
    <p>{{ $message->user_name }}: {{ $message->content }}</p>
    @endforeach
</div>
