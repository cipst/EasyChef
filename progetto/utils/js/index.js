$("#alert .btn-close").click((event) => {

    $("#alert").fadeOut(500);
    event.preventDefault();
});

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

    $("#signUpSubmit").click((event) => {
        makeRequest({
            type: "POST",
            url: "./auth/sign_up.php",
            data: {
                "username": $("#signUpUsername").val(),
                "email": $("#signUpEmail").val(),
                "password": $("#signUpPassword").val(),
                "confirmPassword": $("#signUpConfirmPassword").val(),
            }
        });
        event.preventDefault();
    });
});
