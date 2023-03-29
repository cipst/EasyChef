import { Alert } from "../alert.js";
import { makeRequest, capitalize, isValid, userLogged, createRecipeCard } from "../common.js";
import { ALERT_TYPE, RESPONSE_STATUS } from "../constants.js";

$(async () => {

    const user = await userLogged();

    if (user?.name !== undefined) $("#profile-name").append(`<b>${user.name}</b>`);
    if (user?.email !== undefined) $("#profile-email").append(`<b>${user.email}</b>`);

    getRecipesByChefId(user?.id);

    getRecipesLikedByChefId(user?.id);

    // TODO: add event listener to DELETE buttons

});

/**
 * Get all recipes and append them to the recipes list
 * 
 * @param {int} chef_id the chef id of the current user
 */
const getRecipesByChefId = (chef_id) => {
    makeRequest({
        type: "POST",
        url: "./api/recipes/getByChefId.php",
        data: {
            chef_id: chef_id,
        },
        onSuccess: (response) => {
            const recipes = JSON.parse(response.recipes);
            console.log("RECIPES: ", recipes);

            const className = "recipes-list";

            appendRecipesList(recipes.entries(), chef_id, className);

            $("#index-search").on("click", (e) => {
                $(".content").animate({ scrollTop: $(`.${className}`).offset().top - 200 }, 1000);
            });

            handleSearch(recipes, chef_id, className);
        },
        onError: (response) => {
            console.log(response);
            console.log(response.responseJSON);
            if (response.responseJSON.status == RESPONSE_STATUS.OK)
                $(".recipes-list").append(`<h4>${response.responseJSON.error}</h4>`);
            else
                new Alert(ALERT_TYPE.ERROR, "An error occurred", response.responseJSON.error);
        }
    });
};

const getRecipesLikedByChefId = (chef_id) => {
    makeRequest({
        type: "POST",
        url: "./api/recipes/getLikedByChefId.php",
        data: {
            chef_id: chef_id,
        },
        onSuccess: (response) => {
            const recipes = JSON.parse(response.recipes);
            console.log("RECIPES: ", recipes);

            const className = "liked-recipes-list";

            appendRecipesList(recipes.entries(), chef_id, className);

            handleSearch(recipes, chef_id, className);

        },
        onError: (response) => {
            console.log(response);
            console.log(response.responseJSON);
            if (response.responseJSON.status == RESPONSE_STATUS.OK)
                $(".liked-recipes-list").append(`<h4>${response.responseJSON.error}</h4>`);
            else
                new Alert(ALERT_TYPE.ERROR, "An error occurred", response.responseJSON.error);
        }
    });
}

const handleSearch = (recipes, chef_id, className) => {
    $("#index-search").on("input", (e) => {
        filterRecipes(recipes, $(e.target).val().trim(), chef_id, className);
    });

    let searchParams = new URLSearchParams(window.location.search);
    if (searchParams.has("q"))
        filterRecipes(recipes, searchParams.get("q").trim(), chef_id, className);
}

const appendRecipesList = (recipes, chef_id, className) => {
    for (const [index, recipe] of recipes) {
        console.log("RECIPE: ", recipe.id);
        $(`.${className}`).append(createRecipeCard(recipe, chef_id));

        checkLiked(recipe, chef_id);

        $(`#like_recipe_${recipe.id}`).on('click', () => handleLike(recipe, chef_id));
    }
};

const filterRecipes = (recipes, value, chef_id, className) => {
    const recipesFiltered = recipes.filter(recipe => recipe.title.toLowerCase().includes(value.toLowerCase()) ||
        recipe.category.toLowerCase().includes(value.toLowerCase()) ||
        recipe.cooking_method.toLowerCase().includes(value.toLowerCase()) ||
        recipe.ingredients.some(ingredient => ingredient.toLowerCase().includes(value.toLowerCase())) ||
        `${recipe.cooking_time} min`.includes(value.toLowerCase()) ||
        recipe.portions.toString().includes(value)
    );

    $(`.${className} div`).remove(); // remove all recipes from the list

    // append the filtered recipes
    appendRecipesList(recipesFiltered.entries(), chef_id, className);
};

/**
 * Handle the like of a recipe
 * This function make a request to the server to like or unlike a recipe
 * This function is called when the user clicks on the star icon
 * If the recipe is not liked, it will be liked (and the star will be filled)
 * If the recipe is liked, it will be unliked (and the star will be empty)
 * 
 * @param {Object} recipe
 */
const handleLike = (recipe, chef_id) => {
    if (chef_id === undefined)
        return new Alert(ALERT_TYPE.INFO,
            "Registration required",
            `You must be logged in to like a recipe<br>
            <a href='./login.php'>Login</a> or <a href='./sign_up.php'>Register</a>`
        );

    makeRequest({
        type: "POST",
        url: "./api/recipes/like.php",
        data: { recipe_id: recipe.id, chef_id: chef_id },
        onSuccess: (_) => {
            let newClass = "";
            let newText = "";

            if (!recipe.likes.includes(`${chef_id}`)) {
                // If the recipe is not liked, it will be liked
                recipe.likes.push(`${chef_id}`);
                newClass = "fas";
                newText = "Unlike recipe";

                console.log("NUMBER: ", $(`.liked-recipes-list div#recipe_${recipe.id}`).length);

                $(`.liked-recipes-list`).append(createRecipeCard(recipe, chef_id));

            } else {
                // If the recipe is liked, it will be unliked
                recipe.likes = recipe.likes.filter((like) => like != `${chef_id}`);
                newClass = "far";
                newText = "Like recipe";

                $(`.liked-recipes-list div#recipe_${recipe.id}`).remove()
            }

            $("#like_btn").html(newText);
            $(`#like_recipe_${recipe.id}`).html(`<i class="${newClass} fa-star"></i> ${recipe.likes.length}`);
        }
    });
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


