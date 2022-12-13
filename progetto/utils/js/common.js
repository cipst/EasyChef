import { regex } from "./constants.js";
import { Alert, AlertType } from "./alert.js";

export const makeRequest = ({ type = "POST" || "GET", url, data }) => {
    $.ajax({
        type: type,
        url: url,
        dataType: "json",
        data: data,
        success: handleSuccessResponse,
        error: handleErrorResponse
    });
}

const handleSuccessResponse = (response) => {
    switch (response.status) {
        case "redirect":
            window.location.href = response.url;
            break;

        case "success":
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

    new Alert(AlertType.DANGER, "Error", `${message}`);
}

export function validateUsername(username) {
    if (username === null || username === undefined)
        return "Username cannot be empty.";

    username = username.trim();

    if (username.length == 0)
        return "Username cannot be empty.";

    if (username.length < 3)
        return "Username must be at least 3 characters long.";

    if (username.length > 20)
        return "Username cannot be longer than 20 characters.";

    if (!(regex.username.test(username)))
        return "Username can only contain letters.";

    return "";
}

export function validateEmail(email) {
    if (email === null || email === undefined)
        return "Email cannot be empty.";

    email = email.trim();

    if (email.length == 0)
        return "Email cannot be empty.";

    if (email.length < 3)
        return "Email must be at least 3 characters long.";

    if (email.length > 50)
        return "Email cannot be longer than 50 characters.";

    if (!(regex.email.test(email)))
        return "Email is not valid.";

    return "";
}

export function validatePassword(password) {
    if (password === null || password === undefined)
        return "Password cannot be empty.";

    password = password.trim();

    if (password.length == 0)
        return "Password cannot be empty.";

    if (password.length < 8)
        return "Password must be at least 8 characters long.";

    if (password.length > 50)
        return "Password cannot be longer than 50 characters.";

    if (!(regex.password.test(password)))
        return "Password must contains at least one lowercase letter, one uppercase letter, one digit and one special character.";

    return "";
}