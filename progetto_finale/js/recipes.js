import { makeRequest } from "./common.js";

$(() => {
    makeRequest({
        type: "GET",
        url: "./api/ingredients/getAll.php",
        data: {},
        onSuccess: (response) => {
            for (const ingredient of response.ingredients)
                $(".ingredients-list").append(`<a href="recipes-by-ingredient/${ingredient.toLowerCase()}.php">${ingredient}</a>`)
        }
    });
});