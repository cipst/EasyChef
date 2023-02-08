import { Alert } from "./alert.js";
import { ALERT_TYPE } from "./constants.js";
import { makeRequest } from "./common.js";

$(() => {
    $("footer #year").text(new Date().getFullYear());

    $("#alert i.close").on("click", (e) => {
        $("#alert").fadeOut(200, () => {
            $("#alert .alert-icon").removeClass(alert.icon);
            $("#alert .alert-message").text("");
        });
        $("#mask").fadeOut(200);
        e.preventDefault();
    });

    $("#mask").on("click", (e) => {
        $("#alert").fadeOut(200, () => {
            $("#alert .alert-icon").removeClass(alert.icon);
            $("#alert .alert-message").text("");
        });
        $("#mask").fadeOut(200);
        e.preventDefault();
    });

    $("nav i.close").on("click", () => {
        $("nav i.close").fadeOut(100);
        $("nav i.open").fadeIn(200);
        $("nav #expanded").slideUp(500);
        $("nav #collapsed").slideDown(500).css({ "display": "grid" });
    });

    $("nav i.open").on("click", () => {
        $("nav i.open").fadeOut(100);
        $("nav i.close").fadeIn(200);
        $("nav #expanded").slideDown(500).css({ "display": "grid" });
        $("nav #collapsed").slideUp(500);
    });

    // let alert = new Alert(ALERT_TYPE.ERROR, "Error", "This is an error message");

    $(".content").on("scroll", () => {
        if ($(".content").scrollTop() > 0) {
            $("nav").css({ "box-shadow": "0px 2px 10px rgba(0, 0, 0, 0.3)" });
        } else {
            $("nav").css({ "box-shadow": "none" });
        }
    });


    //TODO: do this on login / reigster page
    if (sessionStorage.getItem("chef") === null) {
        const textAsBuffer = new TextEncoder().encode("topolino");
        window.crypto.subtle.digest('SHA-256', textAsBuffer).then((hashBuffer) => {
            const hashArray = Array.from(new Uint8Array(hashBuffer))
            const digest = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
            makeRequest({
                type: "POST",
                url: "./api/user.php",
                data: { email: "topolino@gmail.com", password: digest },
                onSuccess: (response) => {
                    console.log(response);
                    //set session storage
                    sessionStorage.setItem("chef", response.chef);
                    console.log(JSON.parse(response.chef));
                },
                onError: (response) => {
                    console.log(response);
                }
            });
        });
    }
});
