$(() => {
    $("#alert .btn-close").click((event) => {
        $("#alert").fadeOut(500);
        event.preventDefault();
    });

    $(window).scroll(() => {
        $("#home-search-expanded").fadeOut(200, () => {
            $("#home-search-expanded").removeClass("d-flex").addClass("d-none");
        });
    })

    $(".search-where").click((event) => {
        openSearch(".search-where");
        event.preventDefault();
    });

    $(".search-when").click((event) => {
        openSearch(".search-when");
        event.preventDefault();
    });

    $(".search-add-guests").click((event) => {
        openSearch(".search-add-guests");
        event.preventDefault();
    });
});

function openSearch(tag) {
    $("#home-search-expanded").children().removeClass("active");
    $(`#home-search-expanded ${tag}`).addClass("active");
    $("#home-search-expanded").fadeIn(500).removeClass("d-none").addClass("d-flex");
}