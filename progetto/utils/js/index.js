import { makeRequest, validateUsername, validateEmail, validatePassword } from "./common.js";

$(() => {
    $("#alert .btn-close").click((event) => {
        $("#alert").fadeOut(500);
        event.preventDefault();
    });

    $("#changeToSignUp").click((event) => {
        $("#login").hide();
        $("#signUp").fadeIn(500).css({ "display": "flex" });
        event.preventDefault();
    });

    $("#changeToLogin").click((event) => {
        $("#signUp").hide();
        $("#login").fadeIn(500);
        event.preventDefault();
    });

    $("#loginSubmit").click((event) => {
        makeRequest({
            type: "POST",
            url: "./auth/login.php",
            data: {
                "password": $("#loginPassword").val(),
                "email": $("#loginEmail").val()
            }
        });
        event.preventDefault();
    });

    $("#signUpSubmit").click(signUp);

    $("#signUpUsername").on("input", checkUsername);

    $("#signUpEmail").on("input", checkEmail);

    $("#signUpPassword").on("input", () => {
        checkPassword();
        checkConfirmPassword();
    });

    $("#signUpConfirmPassword").on("input", checkConfirmPassword);
});

const signUp = (event) => {
    const username = $("#signUpUsername").val();
    const email = $("#signUpEmail").val();
    const password = $("#signUpPassword").val();
    const confirmPassword = $("#signUpConfirmPassword").val();

    if (!checkUsername() | !checkEmail() | !checkPassword() | !checkConfirmPassword())
        return;

    makeRequest({
        type: "POST",
        url: "./auth/sign_up.php",
        data: {
            username,
            email,
            password,
            confirmPassword
        }
    });

    event.preventDefault();
}

const checkUsername = () => {
    const username = $("#signUpUsername").val();
    const errorUsername = validateUsername(username);
    let check = true;

    if (errorUsername.length != 0) {
        $("#signUpUsername").removeClass("is-valid").addClass("is-invalid");
        check = false;
    }
    else
        $("#signUpUsername").removeClass("is-invalid").addClass("is-valid");

    $("#signUpUsernameError").text(errorUsername);

    return check;
}

const checkEmail = () => {
    const email = $("#signUpEmail").val();
    const errorEmail = validateEmail(email);
    let check = true;

    if (errorEmail.length != 0) {
        $("#signUpEmail").removeClass("is-valid").addClass("is-invalid");
        check = false;
    }
    else
        $("#signUpEmail").removeClass("is-invalid").addClass("is-valid");
    $("#signUpEmailError").text(errorEmail);

    return check;
}

const checkPassword = () => {
    const password = $("#signUpPassword").val();
    const errorPassword = validatePassword(password);
    let check = true;

    if (errorPassword.length != 0) {
        $("#signUpPassword").removeClass("is-valid").addClass("is-invalid");
        check = false;
    }
    else
        $("#signUpPassword").removeClass("is-invalid").addClass("is-valid");
    $("#signUpPasswordError").text(errorPassword);

    return check;
}

const checkConfirmPassword = () => {
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