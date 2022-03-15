@include('components.head')
@vite
<h2>chatroom</h2>
<p>users present: <span id="online"></span></p>
@include('components.messages.list')
@include('components.messages.new')
