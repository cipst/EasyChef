import { Alert } from "../alert.js";
import { ALERT_TYPE, RESPONSE_STATUS } from "../constants.js";
import { makeRequest, userLogged } from "../common.js";

$(async () => {
    // const user = await userLogged();

    testLogin();
    testLogin("minnie");
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
