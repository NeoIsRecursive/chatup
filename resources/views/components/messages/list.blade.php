<div class="messages">
    @foreach ($messages as $message)
    <p>{{ $message->content }} - {{ $message->user_id }}</p>
    @endforeach
</div>
