import { makeRequest, capitalize } from "../common.js";
import { CHEF_ID } from "../constants.js";

$(() => {

    // IMPORTANT
    // BUG
    // TODO
    // get the chef id from the PHP session
    // const CHEF_ID = $("#chef_id").data("chef-id");
    // or doing a request to the server
    // then pass the chef id to getAllRecipes() and getRecipeById()
    // and removit from the constants.js file

    getAllIngredients();
    getAllRecipes();

    // if the current recipe is the one shown in the single recipe page, show the title and the description
    if (undefined !== $(".recipe-page").data("recipe-id")) {
        getRecipeById($(".recipe-page").data("recipe-id"));
    }

});

const getRecipeById = (id) => {
    makeRequest({
        type: "GET",
        url: `./api/recipes/getById.php?id=${id}`,
        onSuccess: (response) => {
            console.log(JSON.parse(response.recipe));
            const recipe = JSON.parse(response.recipe);
            $("#recipe-title").html(recipe.title);
            $("#recipe-chef").html(recipe.chef);
            $("#recipe-procedure").html(recipe.procedure);
            $("#recipe-portions").html(recipe.portions);
            $("#recipe-cooking-time").html(`${recipe.cooking_time} min`);
            $("#recipe-method").html(capitalize(recipe.cooking_method));
            $("#recipe-category").html(recipe.category);
            $("#recipe-img").attr("src", `./assets/images/recipes/${recipe.category}.jpg`);
            $("#recipe-img").attr("alt", recipe.category);
            $("#recipe-img").attr("title", recipe.category);

            for (const ingredient of recipe.ingredients) {
                $("#recipe-ingredients").append(`<p class="single-ingredient">${capitalize(ingredient)}</p>`);
            };

            recipe.likes.includes(`${CHEF_ID}`) ? $("#like_btn").html("Unlike recipe") : $("#like_btn").html("Like recipe");
            $("#like_btn").on("click", () => handleLike(recipe));
        },
        onError: (response) => {
            console.log(response);
            window.location.href = "./not_found.php";
        }
    });
};

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

/**
 * Get all recipes and append them to the recipes list
 */
const getAllRecipes = () => {
    makeRequest({
        type: "GET",
        url: "./api/recipes/getAll.php",
        onSuccess: (response) => {
            console.log(JSON.parse(response.recipes));
            for (const [index, recipe] of JSON.parse(response.recipes).entries()) {
                $(".recipes-list").append(`
                <div class="recipe">
                    <a href="single_recipe.php?id=${recipe.id}" class="recipe-link" id="recipe_${recipe.id}">
                        <img src="./assets/images/recipes/${recipe.category}.jpg" class="img recipe-img" alt="${recipe.category}" />
                        <h5>${recipe.title}</h5>
                        <p>Portions : ${recipe.portions} | Cook : ${recipe.cooking_time} min</p>
                    </a>
                    <h5 class="star-icon" id="like_recipe_${recipe.id}"></h5>
                </div>`
                );
                checkLiked(recipe);

                $(`#like_recipe_${recipe.id}`).on('click', () => handleLike(recipe));
            }
        }
    });
}

/**
 * Check if the recipe is liked by the current chef
 * If the recipe is liked, the star will be filled
 * If the recipe is not liked, the star will be empty
 */
const checkLiked = (recipe) => {
    recipe.likes.includes(`${CHEF_ID}`)
        ? $(`#like_recipe_${recipe.id}`).html(`<i class="fas fa-star"></i> ${recipe.likes.length}`)
        : $(`#like_recipe_${recipe.id}`).html(`<i class="far fa-star"></i> ${recipe.likes.length}`);
};

/**
 * Handle the like of a recipe
 * This function make a request to the server to like or unlike a recipe
 * This function is called when the user clicks on the star icon
 * If the recipe is not liked, it will be liked (and the star will be filled)
 * If the recipe is liked, it will be unliked (and the star will be empty)
 * 
 * 
 * @param {Object} recipe
 */
const handleLike = (recipe) => {
    makeRequest({
        type: "POST",
        url: "./api/recipes/like.php",
        data: { recipe_id: recipe.id, chef_id: CHEF_ID },
        onSuccess: (_) => {
            let newClass = "";
            let newText = "";

            if (!recipe.likes.includes(`${CHEF_ID}`)) {
                // If the recipe is not liked, it will be liked
                recipe.likes.push(`${CHEF_ID}`);
                newClass = "fas";
                newText = "Unlike recipe";
            } else {
                // If the recipe is liked, it will be unliked
                recipe.likes = recipe.likes.filter((like) => like != `${CHEF_ID}`);
                newClass = "far";
                newText = "Like recipe";
            }

            $("#like_btn").html(newText);
            $(`#like_recipe_${recipe.id}`).html(`<i class="${newClass} fa-star"></i> ${recipe.likes.length}`);
        }
    });
};