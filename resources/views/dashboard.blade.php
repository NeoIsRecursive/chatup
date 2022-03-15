@include('components.head')
<h1>dashboard</h1>
<p>logged in as {{ auth()->user()->name }}</p>
<p><a href="/logout">Log out</a>, but please don't it's more fun here</p>
@include('components.helpers.errors')
@include('components.friends.list')

