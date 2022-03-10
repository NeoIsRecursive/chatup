export default (res) => {
    const messages = document.querySelector(".messages");

    const message = document.createElement("p");
    message.textContent = `${res.user_id}: ${res.content}`;

    messages.appendChild(message);
};
