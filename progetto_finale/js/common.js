import { ALERT_TYPE } from "./constants.js";
import { Alert } from "./alert.js";

export const makeRequest = ({ type = "POST" || "GET", url, data, onSuccess = handleSuccessResponse, onError = handleErrorResponse }) => {
    $.ajax({
        type: type,
        url: url,
        dataType: "json",
        data: data,
        success: onSuccess,
        error: onError
    });
}

const handleSuccessResponse = (response) => {
    switch (response.status) {
        case "redirect":
            window.location.href = response.url;
            break;

        case "success":
            console.log(response);
            break;
    }
}

const handleErrorResponse = (response) => {
    console.log(response);
    const { errors } = $.parseJSON(response.responseText);
    let message = "";

    if (errors.length > 1) {
        errors.forEach(error => {
            message += `<li>${error}</li>`;
        });
        message = `<ul>${message}</ul>`;
    } else
        message = errors[0];

    new Alert(ALERT_TYPE.DANGER, "Error", `${message}`);
}
