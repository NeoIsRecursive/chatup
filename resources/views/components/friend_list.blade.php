<div>
    <h2>your friends</h2>
    @foreach($friends as $friend)

    <a href="chat/{{$friend['id']}}">{{ $friend['name']}}</a>

    @endforeach
</div>
