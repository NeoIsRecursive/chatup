@include('components.helpers.errors')
<form action="login" method="POST">
    <fieldset>
        <legend>login</legend>
        @csrf
        <div>
            <label for="name">username</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="password">password</label>
            <input type="password" name="password" id="password">
        </div>
        <button>login</button>
    </fieldset>
</form>

<a href="/register"><p>register</p></a>
