import { makeRequest } from "./common.js";

$(() => {
    makeRequest({
        type: "GET",
        url: "./api/cooking_methods/getAll.php",
        data: {},
        onSuccess: (response) => {
            for (const method of response.methods)
                $(".tags-list").append(`<a href="recipes-by-cooking-method/${method.toLowerCase()}.php">${method}</a>`)
        }
    });
});