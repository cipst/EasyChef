import { ALERT_TYPE } from "./constants.js";
import { Alert } from "./alert.js";

export const makeRequest = async ({ type = "POST" || "GET", url, data, onSuccess = () => { }, onError = () => { } }) => {
    try {
        return await $.ajax({
            type: type,
            url: url,
            dataType: "json",
            data: data,
            success: onSuccess,
            error: onError
        });
    } catch (e) {
        // console.log(e);
    }
};

export const capitalize = (string) => {
    return string.charAt(0).toUpperCase() + string.slice(1);
};

export const isValid = (target, id, text, text2 = "") => {
    if (target === undefined || target.length === 0) {
        $(`${id}`).css({ "border": "1px solid var(--error-color)" });
        $(`${id} + .label-error`).text(text);
        $(`${id} + .label-error`).css({ "display": "block" });
        return false;
    }

    if ((id.includes("portions") || id.includes("cookingTime")) && parseInt(target) < 1) {
        $(`${id}`).css({ "border": "1px solid var(--error-color)" });
        $(`${id} + .label-error`).text(text2);
        $(`${id} + .label-error`).css({ "display": "block" });
        return false;
    }

    $(`${id}`).css({ "border": "3px solid var(--success-color)" });
    $(`${id} + .label-error`).css({ "display": "none" });
    return true;
};

export const userLogged = async () => {
    return await makeRequest({
        type: "GET",
        url: "./api/auth/session.php",
        onError: (_) => {
            new Alert(ALERT_TYPE.ERROR, "Error", "An error occurred while checking if you are logged in");
        }
    }).then(response => {
        return JSON.parse(response.user);
    });
};