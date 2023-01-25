import { makeRequest } from "./common.js";

$(() => {
    makeRequest({
        type: "GET",
        url: "./api/cooking_methods/getAll.php",
        data: {},
        onSuccess: (response) => {
            for (const [index, method] of JSON.parse(response.methods).entries()) {
                $(".tags-list").append(`<a href="recipes-by-cooking-method.php?method=${method.toLowerCase()}">${method}</a>`);
                $("select.form-input").append(`<option key=${index} value=${method}>${method}</option>`);
            }
        }
    });
});