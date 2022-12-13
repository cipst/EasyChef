import { checkInput, checkConfirmPassword, validateUsername, validateEmail, validatePassword } from "./validation.js";
import { makeRequest } from "../../js/common.js";

$(() => {
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

    $("#loginSubmit").click(login);
    $("#signUpSubmit").click(signUp);

    addListeners();
});

function addListeners() {
    // SIGN UP LISTENERS
    $("#signUpUsername").on("input", () => checkInput("#signUpUsername", validateUsername));
    $("#signUpEmail").on("input", () => checkInput("#signUpEmail", validateEmail));
    $("#signUpPassword").on("input", () => {
        checkInput("#signUpPassword", validatePassword);
        checkConfirmPassword();
    });
    $("#signUpConfirmPassword").on("input", checkConfirmPassword);

    // LOGIN LISTENERS
    $("#loginEmail").on("input", () => checkInput("#loginEmail", validateEmail));
    $("#loginPassword").on("input", () => checkInput("#loginPassword", validatePassword));
}

const signUp = (event) => {
    const username = $("#signUpUsername").val();
    const email = $("#signUpEmail").val();
    const password = $("#signUpPassword").val();
    const confirmPassword = $("#signUpConfirmPassword").val();

    if (
        !checkInput("#signUpUsername", validateUsername) |
        !checkInput("#signUpEmail", validateEmail) |
        !checkInput("#signUpPassword", validatePassword) |
        !checkConfirmPassword()
    ) return;

    makeRequest({
        type: "POST",
        url: "./auth/php/sign_up.php",
        data: {
            username,
            email,
            password,
            confirmPassword
        }
    });

    event.preventDefault();
}

const login = (event) => {
    const email = $("#loginEmail").val();
    const password = $("#loginPassword").val();

    if (
        !checkInput("#loginEmail", validateEmail) |
        !checkInput("#loginPassword", validatePassword)
    ) return;

    makeRequest({
        type: "POST",
        url: "./auth/php/login.php",
        data: {
            email,
            password
        }
    });

    event.preventDefault();
}
