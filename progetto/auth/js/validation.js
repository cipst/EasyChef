import { REGEX } from "../../js/constants.js";

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

    if (!(REGEX.username.test(username)))
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

    if (!(REGEX.email.test(email)))
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

    if (!(REGEX.password.test(password)))
        return "Password must contains at least one lowercase letter, one uppercase letter, one digit and one special character.";

    return "";
}

export function checkInput(inputId, validateFunction) {
    const input = $(inputId).val();
    const error = validateFunction(input);
    let check = true;

    if (error.length != 0) {
        $(inputId).removeClass("is-valid").addClass("is-invalid");
        check = false;
    }
    else
        $(inputId).removeClass("is-invalid").addClass("is-valid");

    $(`${inputId}Error`).text(error);

    return check;
}

export function checkConfirmPassword() {
    const password = $("#signUpPassword").val();
    const confirmPassword = $("#signUpConfirmPassword").val();
    let errorConfirmPassword = "";
    let check = true;

    if (confirmPassword != password)
        errorConfirmPassword = "Passwords do not match.";

    if (errorConfirmPassword.length != 0) {
        $("#signUpConfirmPassword").removeClass("is-valid").addClass("is-invalid");
        check = false;
    }
    else
        $("#signUpConfirmPassword").removeClass("is-invalid").addClass("is-valid");
    $("#signUpConfirmPasswordError").text(errorConfirmPassword);

    return check;
}