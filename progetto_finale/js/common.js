import { ALERT_TYPE } from "./constants.js";
import { Alert } from "./alert.js";

export const makeRequest = async ({ type = "POST" || "GET", url, data, onSuccess = () => { }, onError = () => { } }) => {
    try {
        return await $.ajax({
            type: type,
            url: url,
            dataType: "json",
            data: data,
            success: onSuccess,
            error: onError
        });
    } catch (e) {
        console.log(e);
    }
};

export const capitalize = (string) => {
    return string.charAt(0).toUpperCase() + string.slice(1);
};

export const isValid = (target, id, text, text2 = "") => {
    if (target === undefined || target.length === 0) {
        $(`${id}`).css({ "border": "1px solid var(--error-color)" });
        $(`${id} + .label-error`).text(text);
        $(`${id} + .label-error`).css({ "display": "block" });
        return false;
    }

    if ((id.includes("portions") || id.includes("cookingTime")) && parseInt(target) < 1) {
        $(`${id}`).css({ "border": "1px solid var(--error-color)" });
        $(`${id} + .label-error`).text(text2);
        $(`${id} + .label-error`).css({ "display": "block" });
        return false;
    }

    $(`${id}`).css({ "border": "3px solid var(--success-color)" });
    $(`${id} + .label-error`).css({ "display": "none" });
    return true;
};

export const userLogged = async () => {
    return await makeRequest({
        type: "GET",
        url: "./api/auth/session.php",
        onError: (_) => {
            new Alert(ALERT_TYPE.ERROR, "Error", "An error occurred while checking if you are logged in");
        }
    }).then(response => {
        return JSON.parse(response.user);
    });
};

export const createRecipeCard = (recipe, chef_id, inProfile = false) =>
    `<div class="recipe" id="recipe_${recipe.id}" title="${recipe.title} - ${recipe.category}" key="${recipe.title.toLowerCase()}_${recipe.category.toLowerCase()}">
    <a href="single_recipe.php?id=${recipe.id}" class="recipe-link" id="recipe_${recipe.id}">
        <img src="./assets/images/recipes/${recipe.category}.jpg" class="img recipe-img" alt="${recipe.category}" />
        <h5>${recipe.title}</h5>
        <p>Portions : ${recipe.portions} | Cook : ${recipe.cooking_time} min</p>
    </a>
    ${chef_id !== recipe.chef_id ?
        `<h5 class="star-icon" id="like_recipe_${recipe.id}"></h5>`
        : ""
    }
    ${inProfile && chef_id === recipe.chef_id
        ? `<br/>
    <button class="btn btn-error-outline" id="deleterecipe_${recipe.id}">Delete Recipe <i class="far fa-trash-can fa-xl"></i></button>`
        : ""}
</div>`;

/**
* Check if the recipe is liked by the current chef
* If the recipe is liked, the star will be filled
* If the recipe is not liked, the star will be empty
* 
* @param {Object} recipe
*/
export const addLikeToRecipeCard = (recipe, chef_id) =>
    $(`#like_recipe_${recipe.id}`).html(`<i class="${recipe.likes.includes(chef_id) ? "fas fa-star" : "far fa-star"}"></i> ${recipe.likes.length}`);