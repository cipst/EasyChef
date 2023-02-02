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