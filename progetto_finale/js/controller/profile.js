import { Alert } from "../alert.js";
import { makeRequest, capitalize, isValid, userLogged } from "../common.js";
import { ALERT_TYPE, RESPONSE_STATUS } from "../constants.js";

$(async () => {

    const user = await userLogged();

    if (user?.name !== undefined) $("#profile-name").append(`<b>${user.name}</b>`);
    if (user?.email !== undefined) $("#profile-email").append(`<b>${user.email}</b>`);

    // TODO: get all recipes liked by the user
    getRecipesByChefId(user?.id);

    // TODO: add event listener to DELETE buttons

});

/**
 * Get all recipes and append them to the recipes list
 * 
 * @param {int} chef_id the chef id of the current user
 */
const getRecipesByChefId = (chef_id) => {
    makeRequest({
        type: "GET",
        url: "./api/recipes/getByChefId.php",
        body: {
            "chef_id": chef_id,
        },
        onSuccess: (response) => {
            const recipes = JSON.parse(response.recipes);
            console.log("RECIPES: ", recipes);
            
            appendRecipesList(recipes.entries(), chef_id);

            $("#index-search").on("input", (e) => {
                filterRecipes(recipes, $(e.target).val().trim(), chef_id);
            });

            let searchParams = new URLSearchParams(window.location.search);
            if (searchParams.has("q"))
                filterRecipes(recipes, searchParams.get("q").trim(), chef_id);
        },
        onError: (response) => {
            console.log(response.responseJSON);
            new Alert(ALERT_TYPE.ERROR, "An error occurred", response.responseJSON.error);
        }
    });
};

const appendRecipesList = (recipes, chef_id) => {
    for (const [index, recipe] of recipes) {
        $(".recipes-list").append(`
            <div class="recipe" title="${recipe.title} - ${recipe.category}" key="${index}">
                <a href="single_recipe.php?id=${recipe.id}" class="recipe-link" id="recipe_${recipe.id}">
                    <img src="./assets/images/recipes/${recipe.category}.jpg" class="img recipe-img" alt="${recipe.category}" />
                    <h5>${recipe.title}</h5>
                    <p>Portions : ${recipe.portions} | Cook : ${recipe.cooking_time} min</p>
                </a>
                <h5 class="star-icon" id="like_recipe_${recipe.id}"></h5>
                <br/>
                <br/>
                <button class="btn btn-error" id="deleterecipe_${recipe.id}">Delete Recipe</button>
            </div>`
        );

        checkLiked(recipe, chef_id);

        $(`#like_recipe_${recipe.id}`).on('click', () => handleLike(recipe, chef_id));
    }
};

const filterRecipes = (recipes, value, chef_id) => {
    const recipesFiltered = recipes.filter(recipe => recipe.title.toLowerCase().includes(value.toLowerCase()) ||
        recipe.category.toLowerCase().includes(value.toLowerCase()) ||
        recipe.cooking_method.toLowerCase().includes(value.toLowerCase()) ||
        recipe.ingredients.some(ingredient => ingredient.toLowerCase().includes(value.toLowerCase())) ||
        `${recipe.cooking_time} min`.includes(value.toLowerCase()) ||
        recipe.portions.toString().includes(value)
    );

    $(".recipes-list div").remove(); // remove all recipes from the list

    $(".content").animate({ scrollTop: $('.recipes-list').offset().top - 100 }, 1000);

    // append the filtered recipes
    appendRecipesList(recipesFiltered.entries(), chef_id);
};

/**
 * Check if the recipe is liked by the current chef
 * If the recipe is liked, the star will be filled
 * If the recipe is not liked, the star will be empty
 * 
 * @param {Object} recipe
 */
const checkLiked = (recipe, chef_id) => {
    recipe.likes.includes(`${chef_id}`)
        ? $(`#like_recipe_${recipe.id}`).html(`<i class="fas fa-star"></i> ${recipe.likes.length}`)
        : $(`#like_recipe_${recipe.id}`).html(`<i class="far fa-star"></i> ${recipe.likes.length}`);
};


