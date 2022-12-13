$(() => {
    $("#alert .btn-close").click((event) => {
        $("#alert").fadeOut(500);
        event.preventDefault();
    });
});