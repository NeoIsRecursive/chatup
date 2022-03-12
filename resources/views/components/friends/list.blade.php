<div>
    <h2>your friends</h2>
    <ul>
        @foreach($friends as $friend)
        <li style="display:flex; align-items:baseline;">
        @if($friend['accepted'])
            <a href="chat/{{$friend['id']}}">{{ $friend['name']}}</a>
            <form action="remove_friend/{{$friend['id']}}" method="post">
                @method('delete')
                @csrf
                <input type="hidden" name="friendship_id" value="{{$friend['id']}}">
                <button>remove friend</button>
            </form>
        @else
            @if(!$friend['from_auth'])
            <p>incoming friend request from {{ $friend['name']}}</p>
            <form action="accept_friend/{{$friend['id']}}" method="post">
                @method('patch')
                @csrf
                <button>accept</button>
            </form>
            <form action="decline_friend/{{$friend['id']}}" method="post">
                @method('delete')
                @csrf
                <button>decline</button>
            </form>
            @else
            <p>pending friendrequest to {{ $friend['name'] }}</p>
            @endif
        @endif
        </li>
        @endforeach
    </ul>
    @include('components.friends.add')
</fieldset>
</div>
