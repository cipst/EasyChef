import { Alert } from "../alert.js";
import { makeRequest, capitalize, isValid, userLogged, createRecipeCard, addLikeToRecipeCard } from "../common.js";
import { ALERT_TYPE } from "../constants.js";

class ProfileRequests {

    /**
     * Get all recipes and append them to the recipes list
     * 
     * @param {int} chef_id the chef id of the current user
     */
    static getRecipesByChefId = (chef_id) => {
        makeRequest({
            type: "POST",
            url: "./api/recipes/getByChefId.php",
            data: {
                chef_id: chef_id,
            },
            onSuccess: (response) => {
                const recipes = JSON.parse(response.recipes);

                const className = "recipes-list";

                appendRecipesList(recipes, chef_id, className);

                if ($(".recipes-list").offset() !== undefined) {
                    $("#index-search").on("click", (e) => {
                        $(".content").animate({ scrollTop: $(".recipes-list").offset().top - 200 }, 1000);
                    });
                    handleSearch(recipes, chef_id, "recipes-list");
                } else {
                    $("#index-search").on("click", (e) => {
                        $(".content").animate({ scrollTop: $(".liked-recipes-list").offset().top - 200 }, 1000);
                    });
                    handleSearch(recipes, chef_id, "liked-recipes-list");
                }

            },
            onError: (response) => {
                console.log(response);
                console.log(response.responseJSON);
                $(".recipes-list").append(`<h4>${response.responseJSON.error}</h4>`);
            }
        });
    };

    static getRecipesLikedByChefId = (chef_id) => {
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

                appendRecipesList(recipes, chef_id, className);

                handleSearch(recipes, chef_id, className);

            },
            onError: (response) => {
                console.log(response);
                console.log(response.responseJSON);
                $(".liked-recipes-list").append(`<h4>${response.responseJSON.error}</h4>`);
            }
        });
    }
    /**
     * Handle the like of a recipe
     * This function make a request to the server to like or unlike a recipe
     * This function is called when the user clicks on the star icon
     * If the recipe is not liked, it will be liked (and the star will be filled)
     * If the recipe is liked, it will be unliked (and the star will be empty)
     * 
     * @param {Object} recipe
     */
    static handleLike = (recipe, chef_id) => {
        if (chef_id === undefined)
            return Alert.init(ALERT_TYPE.INFO,
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
            },
            onError: (response) => {
                console.log(response.responseJSON);
                Alert.init(ALERT_TYPE.ERROR, response.responseJSON.error);
            }
        });
    };
    static deleteRecipe = (recipe_id) => {
        Alert.init(ALERT_TYPE.WARNING, "Are you sure?", "Are you sure you want to delete this recipe?", () => {
            makeRequest({
                type: "POST",
                url: "./api/recipes/delete.php",
                data: { id: recipe_id },
                onSuccess: (response) => {
                    Alert.init(ALERT_TYPE.SUCCESS, "Recipe deleted", response.message);
                    $(`#delete_recipe_${recipe_id}`).display = "none";
                },
                onError: (response) => {
                    Alert.init(ALERT_TYPE.ERROR, "An error occurred", response.responseJSON.error);
                }
            });
        });
    }
}

$(async () => {

    const user = await userLogged();

    if (user?.name !== undefined) $("#profile-name").append(`<b>${user.name}</b>`);
    if (user?.email !== undefined) $("#profile-email").append(`<b>${user.email}</b>`);

    ProfileRequests.getRecipesByChefId(user?.id);

    ProfileRequests.getRecipesLikedByChefId(user?.id);
});

const handleSearch = (recipes, chef_id, className) => {
    $("#index-search").on("input", (e) => {
        filterRecipes(recipes, $(e.target).val().trim(), chef_id, className);
    });

    let searchParams = new URLSearchParams(window.location.search);
    if (searchParams.has("q"))
        filterRecipes(recipes, searchParams.get("q").trim(), chef_id, className);
}

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
    appendRecipesList(recipesFiltered, chef_id, className);
};

const appendRecipesList = (recipes, chef_id, className) => {
    if (recipes.length === 0) {
        $(`.${className}`).html(`<h3 class="text-center">No recipes found!</h4>`);
        return;
    }

    $(`.${className}`).html("");
    for (const [index, recipe] of recipes.entries()) {
        $(`.${className}`).append(createRecipeCard(recipe, chef_id, true));

        addLikeToRecipeCard(recipe, chef_id);

        $(`#like_recipe_${recipe.id}`).on('click', () => ProfileRequests.handleLike(recipe, chef_id));
        $(`#delete_recipe_${recipe.id}`).on('click', () => ProfileRequests.deleteRecipe(recipe.id));
    }
};
