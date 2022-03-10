<div>
    <h2>your friends</h2>
    <ul>
        @foreach($friends as $friend)

        <a href="chat/{{$friend['id']}}"><li>{{ $friend['name']}}</li></a>

        @endforeach
    </ul>
    @include('components.add_friend')
</div>
