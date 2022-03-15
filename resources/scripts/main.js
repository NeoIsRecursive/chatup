import Echo from "laravel-echo";
import pusherJs from "pusher-js";
import newMessage from "./newMessage.js";
import succesfullySent from "./succesfullySent.js";

const { VITE_PUSHER_APP_KEY: KEY, VITE_PUSHER_APP_CLUSTER: CLUSTER } =
    import.meta.env;
window.Pusher = pusherJs;

window.echo = new Echo({
    broadcaster: "pusher",
    key: KEY,
    cluster: CLUSTER,
    forceTLS: false,
    wsHost: window.location.hostname,
    wsPort: 6001,
});

// window.echo
//     .private("chat." + window.location.pathname.match(/([0-9])+/)[0])
//     .listen("TestMessage", (e) => {
//         newMessage(e);
//     });

let onlineUsers = 0;

function update_online_counter() {
    document.getElementById("online").textContent = "" + onlineUsers;
}

window.echo
    .join("chat." + window.location.pathname.match(/([0-9])+/)[0])
    .here((x) => {
        onlineUsers = x.length;
        update_online_counter();
    })
    .joining((x) => {
        onlineUsers++;
        update_online_counter();
    })
    .leaving((x) => {
        onlineUsers--;
        update_online_counter();
    })
    .listen("TestMessage", (e) => {
        newMessage(e);
    });

document.querySelector("form button").addEventListener("click", (e) => {
    e.preventDefault();
    const body = document.querySelector("form input").value;
    fetch(window.location.pathname, {
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-Token": document.querySelector("input[name=_token]").value,
        },
        method: "post",
        body: JSON.stringify({
            content: body,
        }),
    })
        .then((res) => res.json())
        .then((res) => succesfullySent(res));
});
