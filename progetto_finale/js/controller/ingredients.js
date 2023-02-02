import { Alert } from "../alert.js";
import { makeRequest } from "../common.js";
import { ALERT_TYPE } from "../constants.js";

$(() => {
    getAllIngredients();

    $("#ingredientName").keypress((event) => {
        if (event.key === "Enter") {
            event.preventDefault();
            $("#addIngredient").click();
        }
    });

    $("#addIngredient").on("click", (event) => {
        event.preventDefault();
        const ingredientName = $("#ingredientName").val().trim();
        handleSubmit(ingredientName);
    });

});

/**
 * Handle the submit event of the form to add a new ingredient
 * 
 * @param {String} ingredientName 
 */
const handleSubmit = (ingredientName) => {
    makeRequest({
        type: "POST",
        url: "./api/ingredients/create.php",
        data: { name: ingredientName.toLowerCase() },
        onSuccess: (response) => {
            alert(response.ok);
            new Alert(ALERT_TYPE.SUCCESS, response.ok);
        },
        onError: (response) => {
            console.log(response);
            let error;
            if (response.responseJSON.errors[0].toLowerCase().includes("duplicate entry")) {
                error = "Ingredient already in the list";
            } else {
                error = response.responseJSON.errors[0];
            }

            new Alert(ALERT_TYPE.ERROR, "Error", error);
        }
    })
}


/**
 * Get all ingredients and append them to the ingredients list
 */
const getAllIngredients = () => {
    makeRequest({
        type: "GET",
        url: "./api/ingredients/getAll.php",
        onSuccess: (response) => {
            console.log(JSON.parse(response.ingredients));
            for (const [index, ingredient] of JSON.parse(response.ingredients).entries()) {
                $(".ingredients-list").append(`<a href="recipes_by_ingredient.php?ingredient=${ingredient.toLowerCase()}">${ingredient}</a>`);
                $(".ingredients.form-choice").append(`
                    <div key=${index}>
                        <input style="margin-right: .3em;" type="checkbox" id="${ingredient}" name="ingredient" value="${ingredient}" />
                        <label for="${ingredient}">${ingredient}</label>
                    </div>
                `);
            }
        }
    });
}