import { ALERT_TYPE } from "./constants.js";
import { Alert } from "./alert.js";

export const makeRequest = ({ type = "POST" || "GET", url, data, onSuccess, onError }) => {
    $.ajax({
        type: type,
        url: url,
        dataType: "json",
        data: data,
        success: onSuccess,
        error: onError
    });
}

export const capitalize = (string) => {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

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