import { Alert } from "../alert.js";
import { ALERT_TYPE } from "../constants.js";
import { makeRequest, sha256 } from "../common.js";

$(async () => {
    $(".form-container form#login").on("submit", (e) => {
        e.preventDefault();

        const f = new FormData(e.target);
        const email = f.get("email");
        const password = f.get("password");

        makeRequest({
            type: "POST",
            url: "./api/auth/user.php",
            data: { email: email, password: password },
            onSuccess: (response) => {
                const user = JSON.parse(response.user);
                console.log(user);
                if (user === null) {
                    Alert.init(ALERT_TYPE.SUCCESS, "You have been logged out");
                    setTimeout(() => {
                        window.location.href = "./login.php";
                    }, 2000);
                } else {
                    Alert.init(ALERT_TYPE.SUCCESS, `Welcome back ${user.name}`);
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

                return Alert.init(ALERT_TYPE.WARNING, error);
            }
        });
    });

    $(".form-container form#signup").on("submit", (e) => {
        e.preventDefault();

        const f = new FormData(e.target);
        const name = f.get("name").trim().toLowerCase();
        const email = f.get("email").trim().toLowerCase();
        const password = f.get("password");

        makeRequest({
            type: "POST",
            url: "./api/chefs/create.php",
            data: { name: name, email: email, password: password },
            onSuccess: (response) => {
                console.log(response);
                Alert.init(ALERT_TYPE.SUCCESS, response.ok);
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

                return Alert.init(ALERT_TYPE.WARNING, error);
            }
        });
    });

    $("#logout").on("click", () => {
        makeRequest({
            type: "GET",
            url: "./api/auth/logout.php",
            onSuccess: (response) => {
                const user = JSON.parse(response.user);
                console.log(user);
                if (user === null) {
                    Alert.init(ALERT_TYPE.SUCCESS, "You have been logged out");
                    setTimeout(() => {
                        window.location.href = "./login.php";
                    }, 2000);
                } else {
                    Alert.init(ALERT_TYPE.SUCCESS, `Welcome back ${user.name}`);
                    setTimeout(() => {
                        window.location.href = "./index.php";
                    }, 2000);
                }
            },
            onError: (response) => {
                console.log("ERROR", response);
                const { error } = response.responseJSON;

                return Alert.init(ALERT_TYPE.WARNING, error);
            }
        });
    });
});

