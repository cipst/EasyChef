import { Alert } from "../alert.js";
import { ALERT_TYPE, RESPONSE_STATUS } from "../constants.js";
import { makeRequest } from "../common.js";

$(async () => {
    testLogin();
    testLogin("minnie");

    $(".overlay-container").on("click", (_) => {
        window.location.href = "./index.php";
    });

    $(".form-container form#login").on("submit", (e) => {
        e.preventDefault();

        const f = new FormData(e.target);
        const email = f.get("email");
        const password = f.get("password");

        const textAsBuffer = new TextEncoder().encode(password);
        window.crypto.subtle.digest('SHA-256', textAsBuffer).then((hashBuffer) => {
            const hashArray = Array.from(new Uint8Array(hashBuffer));
            const digest = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');

            makeRequest({
                type: "POST",
                url: "./api/auth/user.php",
                data: { email: email, password: digest },
                onSuccess: (response) => {
                    const { status } = response;
                    switch (status) {
                        case RESPONSE_STATUS.REDIRECT:
                            // window.location.href = response.link;
                            break;

                        case RESPONSE_STATUS.OK:
                            const user = JSON.parse(response.user);
                            console.log(user);
                            if (user === null)
                                alert(`${email} LOGGED OUT`);
                            else
                                alert(`${email} LOGGED IN`);
                            window.location.href = "./index.php";
                            break;

                        default:
                            break;
                    }
                },
                onError: (response) => {
                    console.log("ERROR", response);
                    const { error } = response.responseJSON;

                    if (error.toLowerCase().includes("email")) {
                        $("#login-email").css({ "border": "1px solid var(--error-color)" });
                    }

                    if (error.toLowerCase().includes("password")) {
                        $("#login-password").css({ "border": "1px solid var(--error-color)" });
                    }

                    return new Alert(ALERT_TYPE.WARNING, error);
                }
            });
        });
    });

    $(".form-container form#signup").on("submit", (e) => {
        e.preventDefault();

        const f = new FormData(e.target);
        const name = f.get("name").trim().toLowerCase();
        const email = f.get("email").trim().toLowerCase();
        const password = f.get("password").trim().toLowerCase();

        const textAsBuffer = new TextEncoder().encode(password);
        window.crypto.subtle.digest('SHA-256', textAsBuffer).then((hashBuffer) => {
            const hashArray = Array.from(new Uint8Array(hashBuffer));
            const digest = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');

            makeRequest({
                type: "POST",
                url: "./api/chefs/create.php",
                data: { name: name, email: email, password: digest },
                onSuccess: (response) => {
                    const { status } = response;
                    switch (status) {
                        case RESPONSE_STATUS.REDIRECT:
                            // window.location.href = response.link;
                            break;

                        case RESPONSE_STATUS.OK:
                            console.log(response);
                            alert(response.ok);
                            window.location.href = "./index.php";
                            break;

                        default:
                            break;
                    }
                },
                onError: (response) => {
                    console.log("ERROR", response);
                    const { error } = response.responseJSON;

                    if (error.toLowerCase().includes("email")) {
                        $("#signup-email").css({ "border": "1px solid var(--error-color)" });
                    }

                    if (error.toLowerCase().includes("name")) {
                        $("#signup-name").css({ "border": "1px solid var(--error-color)" });
                    }

                    return new Alert(ALERT_TYPE.WARNING, error);
                }
            });
        });
    });
});

function testLogin(who = "topolino") {
    $(`#tmp-login-${who}`).on("click", () => {

        const textAsBuffer = new TextEncoder().encode(who);
        window.crypto.subtle.digest('SHA-256', textAsBuffer).then((hashBuffer) => {
            const hashArray = Array.from(new Uint8Array(hashBuffer));
            const digest = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');

            makeRequest({
                type: "POST",
                url: "./api/auth/user.php",
                data: { email: `${who}@gmail.com`, password: digest },
                onSuccess: (response) => {
                    const { status } = response;
                    switch (status) {
                        case RESPONSE_STATUS.REDIRECT:
                            // window.location.href = response.link;
                            break;

                        case RESPONSE_STATUS.OK:
                            const user = JSON.parse(response.user);
                            console.log(user);
                            if (user === null)
                                alert(`${who} LOGGED OUT`);
                            else
                                alert(`${who} LOGGED IN`);
                            break;

                        default:
                            break;
                    }
                },
                onError: (response) => {
                    console.log("ERROR", response);
                }
            });
        });
    });
}
