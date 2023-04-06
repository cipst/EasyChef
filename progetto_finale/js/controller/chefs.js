import { createChefEntries, makeRequest } from "../common.js";

$(() => {
    makeRequest({
        type: "GET",
        url: "./api/chefs/getAll.php",
        onSuccess: (response) => {
            const chefs = JSON.parse(response.chefs);

            // Control Panel Admin - Chefs
            createChefEntries(chefs.entries());
        },
        onError: (response) => {
            console.log(response.responseJSON);
            new Alert(ALERT_TYPE.ERROR, "An error occurred", response.responseJSON.error);
        }
    });
});