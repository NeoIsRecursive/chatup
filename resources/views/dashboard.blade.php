<h1>dashboard</h1>
<p>logged in as {{ auth()->user()->name }}</p>
@include('components.helpers.errors')
@include('components.add_friend')
@include('components.friend_list')

