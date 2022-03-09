import Echo from "laravel-echo";
import pusherJs from "pusher-js";

window.Pusher = pusherJs;

window.echo = new Echo({
    broadcaster: "pusher",
    key: 1234,
    cluster: "mt1",
    forceTLS: false,
    wsHost: window.location.hostname,
    wsPort: 6001,
});

window.echo.private("test." + 1).listen("TestMessage", (e) => {
    console.log(e);
});
