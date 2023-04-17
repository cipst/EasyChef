import { Alert } from "../alert.js";
import { ALERT_TYPE } from "../constants.js";
import { makeRequest, sha256 } from "../common.js";

$(async () => {
    testLogin();
    testLogin("minnie");

    $(".form-container form#login").on("submit", (e) => {
        e.preventDefault();

        const f = new FormData(e.target);
        const email = f.get("email");
        const password = f.get("password");

        (async () => {
            const passwordHash = await sha256(password);

            makeRequest({
                type: "POST",
                url: "./api/auth/user.php",
                data: { email: email, password: passwordHash },
                onSuccess: (response) => {
                    const user = JSON.parse(response.user);
                    console.log(user);
                    if (user === null) {
                        new Alert(ALERT_TYPE.SUCCESS, "You have been logged out");
                        setTimeout(() => {
                            window.location.href = "./login.php";
                        }, 2000);
                    } else {
                        new Alert(ALERT_TYPE.SUCCESS, `Welcome back ${user.name}`);
                        setTimeout(() => {
                            window.location.href = "./index.php";
                        }, 2000);
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
        })();

    });

    $(".form-container form#signup").on("submit", (e) => {
        e.preventDefault();

        const f = new FormData(e.target);
        const name = f.get("name").trim().toLowerCase();
        const email = f.get("email").trim().toLowerCase();
        const password = f.get("password").trim().toLowerCase();

        (async () => {
            const passwordHash = await sha256(password);

            makeRequest({
                type: "POST",
                url: "./api/chefs/create.php",
                data: { name: name, email: email, password: passwordHash },
                onSuccess: (response) => {
                    console.log(response);
                    alert(response.ok);
                    new Alert(ALERT_TYPE.SUCCESS, response.ok);
                    window.location.href = "./index.php";
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
        })();
    });

    $("#logout").on("click", () => {
        makeRequest({
            type: "GET",
            url: "./api/auth/logout.php",
            onSuccess: (response) => {
                const user = JSON.parse(response.user);
                console.log(user);
                if (user === null) {
                    new Alert(ALERT_TYPE.SUCCESS, "You have been logged out");
                    setTimeout(() => {
                        window.location.href = "./login.php";
                    }, 2000);
                } else {
                    new Alert(ALERT_TYPE.SUCCESS, `Welcome back ${user.name}`);
                    setTimeout(() => {
                        window.location.href = "./index.php";
                    }, 2000);
                }
            },
            onError: (response) => {
                console.log("ERROR", response);
                const { error } = response.responseJSON;

                return new Alert(ALERT_TYPE.WARNING, error);
            }
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
                    const user = JSON.parse(response.user);
                    console.log(user);
                    if (user === null)
                        alert(`${who} LOGGED OUT`);
                    else
                        alert(`${who} LOGGED IN`);
                },
                onError: (response) => {
                    console.log("ERROR", response);
                }
            });
        });
    });
}
