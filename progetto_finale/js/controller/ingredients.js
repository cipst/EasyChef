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
            createIngredient(ingredientName);
    });

});

/**
 * Handle the submit event of the form to add a new ingredient
 * 
 * @param {String} ingredientName 
 */
const createIngredient = (ingredientName) => {
    makeRequest({
        type: "POST",
        url: "./api/ingredients/create.php",
        data: { name: ingredientName.toLowerCase() },
        onSuccess: (response) => {
            Alert.init(ALERT_TYPE.SUCCESS, response.ok);
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

            Alert.init(ALERT_TYPE.ERROR, "Error", error);
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
                $("#ingredient-table").append(`<tr id="ingredient-${ingredient}">
                    <th scope="row">
                        <input type="text" class="form-control" id="ingredient-${ingredient}-name-input" value="${capitalize(ingredient)}">
                        <label id="ingredient-${ingredient}-error" class="label-error" for="ingredient-${ingredient}-name-input"></label>
                        <span id="ingredient-${ingredient}-name">${capitalize(ingredient)}</span>
                    </th>
                    <td>
                        <button id="delete-ingredient-${ingredient}" class="btn-action danger" type="button"><i
                                class="fa-solid fa-trash-can fa-2xl"></i></button>
                        <button id="update-ingredient-${ingredient}" class="btn-action success" type="button"><i
                                class="fa-solid fa-pen fa-2xl"></i></button>
                    </td>
                </tr>`);

                $(`#delete-ingredient-${ingredient}`).click(() => {
                    deleteIngredient(ingredient);
                });

                $(`#update-ingredient-${ingredient}`).click(() => {
                    $(`#ingredient-${ingredient}-name-input`).show().focus();
                    $(`#ingredient-${ingredient}-name`).hide();

                    $(`#ingredient-${ingredient}-name-input`).keypress((event) => {
                        if (event.key === "Enter") {
                            event.preventDefault();
                            const newIngredient = $(`#ingredient-${ingredient}-name-input`).val().trim().toLowerCase();

                            if (newIngredient === ingredient) {
                                Alert.init(ALERT_TYPE.ERROR, "Error", "New ingredient name is the same as the old one");
                                return;
                            }

                            if (isValid(newIngredient, `#ingredient-${ingredient}-name-input`, "Please enter an ingredient name!")) {
                                updateIngredient(ingredient, newIngredient);

                                $(`#ingredient-${ingredient}-name-input`).hide();
                                $(`#ingredient-${ingredient}-error`).hide();
                                $(`#ingredient-${ingredient}-name`).show();
                            }
                        }
                    });

                    $(`#ingredient-${ingredient}-name-input`).keyup((event) => {
                        if (event.key === "Escape") {
                            event.preventDefault();
                            $(`#ingredient-${ingredient}-name-input`).hide();
                            $(`#ingredient-${ingredient}-error`).hide();
                            $(`#ingredient-${ingredient}-name`).show();
                        }
                    });
                });
            }
        }
    });
}

const deleteIngredient = (ingredient) => {
    Alert.init(ALERT_TYPE.WARNING, "Are you sure?", "Are you sure you want to delete this ingredient?", () => {

        makeRequest({
            type: "POST",
            url: "./api/ingredients/delete.php",
            data: { name: ingredient },
            onSuccess: (response) => {
                Alert.init(ALERT_TYPE.SUCCESS, response.ok);
                $(`#ingredient-table #ingredient-${ingredient}`).remove();
            },
            onError: (response) => {
                Alert.init(ALERT_TYPE.ERROR, "Error", "Error deleting the ingredient");
            }
        });
    });
}

const updateIngredient = (oldIngredient, newIngredient) => {
    makeRequest({
        type: "POST",
        url: "./api/ingredients/update.php",
        data: { oldIngredient: oldIngredient, newIngredient: newIngredient },
        onSuccess: (response) => {
            Alert.init(ALERT_TYPE.SUCCESS, response.ok);
            $(`#ingredient-${oldIngredient}-name`).text(capitalize(newIngredient));
        },
        onError: (response) => {
            Alert.init(ALERT_TYPE.ERROR, "Error", "Error updating the ingredient");
        }
    });
}