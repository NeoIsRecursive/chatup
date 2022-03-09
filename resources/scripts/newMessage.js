export default (res) => {
    const messages = document.querySelector(".messages");

    const message = document.createElement("p");
    message.textContent = `${res.message.content} - ${res.message.user_id}`;

    messages.appendChild(message);
};
