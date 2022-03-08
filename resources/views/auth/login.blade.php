@include('components.helpers.errors')
<form action="login" method="POST">
    login
    @csrf
    username
    <input type="text" name="name">
    password
    <input type="password" name="password">
    <button>login</button>
</form>
