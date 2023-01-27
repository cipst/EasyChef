import { makeRequest } from "../common.js";

$(() => {
    makeRequest({
        type: "GET",
        url: "./api/chefs/getAll.php",
        data: {},
        onSuccess: (response) => {
            console.log(JSON.parse(response.chefs));
        }
    });
});