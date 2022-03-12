@include('components.helpers.errors')
<form action="register" method="post">
    <fieldset>
        <legend>register</legend>
        @csrf
        <div>
            <label for="name">username</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="password">password</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label for="password_conf">password</label>
            <input type="password" name="password_confirmation" id="password_conf">
        </div>
        <button>register</button>
    </fieldset>
</form>
