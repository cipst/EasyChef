import { makeRequest } from "./common.js";

$(() => {
    makeRequest({
        type: "GET",
        url: "./api/ingredients/getAll.php",
        onSuccess: (response) => {
            console.log(JSON.parse(response.ingredients));
            for (const [index, ingredient] of JSON.parse(response.ingredients).entries()) {
                $(".ingredients-list").append(`<a href="recipes-by-ingredient.php?ingredient=${ingredient.toLowerCase()}">${ingredient}</a>`);
                $(".ingredients.form-choice").append(`
                    <div key=${index}>
                        <input style="margin-right: .3em;" type="checkbox" id="${ingredient}" name="ingredient" value="${ingredient}" />
                        <label for="${ingredient}">${ingredient}</label>
                    </div>
                `);
            }
        }
    });
});