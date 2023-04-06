import { Alert } from "../alert.js";
import { makeRequest, capitalize, isValid } from "../common.js";
import { ALERT_TYPE } from "../constants.js";

$(() => {
    getAllIngredients();

    $("#ingredientName").keypress((event) => {
        if (event.key === "Enter") {
            event.preventDefault();
            $("#addIngredient").click();
        }
    });

    $("#ingredientName").on("input", (event) => {
        const ingredientName = $("#ingredientName").val().trim();
        isValid(ingredientName, "#ingredientName", "Please enter an ingredient name!");
    });

    $("#addIngredient").on("click", (event) => {
        event.preventDefault();
        const ingredientName = $("#ingredientName").val().trim();
        if (isValid(ingredientName, "#ingredientName", "Please enter an ingredient name!"))
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
            new Alert(ALERT_TYPE.SUCCESS, response.ok);
            $("#add-ingredients-list").append(`<p>${capitalize(ingredientName)}</p><hr>`);
        },
        onError: (response) => {
            console.log(response);
            let error;
            if (response.responseJSON.error.toLowerCase().includes("duplicate entry")) {
                error = "Ingredient already in the list";
            } else {
                error = "Error adding the ingredient";
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
            for (const [index, ingredient] of JSON.parse(response.ingredients).entries()) {
                $(".ingredients-list").append(`<a href="recipes_by_ingredient.php?ingredient=${ingredient.toLowerCase()}">${ingredient}</a>`);
                $(".ingredients.form-choice").append(`
                    <div key=${index}>
                        <input style="margin-right: .3em;" type="checkbox" id="ingredient-${ingredient}" name="ingredient" value="${ingredient}" />
                        <label for="ingredient-${ingredient}">${ingredient}</label>
                    </div>
                `);
                $("#add-ingredients-list").append(`<p>${capitalize(ingredient)}</p><hr>`);

                // Control Panel Admin - Ingredients
                $("#ingredient-table").append(`<tr>
                    <th scope="row">${capitalize(ingredient)}</th>
                    <td>
                        <button class="btn-action danger" type="button"><i
                                class="fa-solid fa-trash-can fa-2xl"></i></button>
                        <button class="btn-action success" type="button"><i
                                class="fa-solid fa-pen fa-2xl"></i></button>
                    </td>
                </tr>`);
            }
        }
    });
}