<form action="register" method="post">
    @csrf
    name
    <input type="text" name="name">

    passoword
    <input type="password" name="password">
    confirm
    <input type="passoword" name="password_confirmation">
    <button>register</button>
</form>
