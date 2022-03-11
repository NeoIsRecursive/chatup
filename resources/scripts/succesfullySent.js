export default (res) => {
    if (res.errors) {
        console.log(res.message);
        return;
    }
    document.querySelector("form input").value = "";
};
