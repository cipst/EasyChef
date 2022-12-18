import { Alert } from "./alert.js";
import { ALERT_TYPE } from "./constants.js";

$(() => {
    $("#alert ion-icon.close").on("click", (e) => {
        $("#alert").fadeOut(500);
        e.preventDefault();
    });

    $("nav ion-icon.close").on("click", () => {
        $("nav ion-icon.close").fadeOut(100);
        $("nav ion-icon.open").fadeIn(200);
        $("nav #expanded").slideUp(500);
        $("nav #collapsed").slideDown(500).css({ "display": "grid" });
    });

    $("nav ion-icon.open").on("click", () => {
        $("nav ion-icon.open").fadeOut(100);
        $("nav ion-icon.close").fadeIn(200);
        $("nav #expanded").slideDown(500).css({ "display": "grid" });
        $("nav #collapsed").slideUp(500);
    });

    // new Alert(ALERT_TYPE.WARNING, "Error", "This is an error message");
});