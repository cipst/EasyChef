import { Alert } from "../alert.js";
import { makeRequest, capitalize, isValid } from "../common.js";
import { ALERT_TYPE, CHEF_ID } from "../constants.js";

$(() => {

    // IMPORTANT
    // BUG
    // TODO
    // get the chef id from the PHP session
    // const CHEF_ID = $("#chef_id").data("chef-id");
    // or doing a request to the server
    // then pass the chef id to getAllRecipes() and getRecipeById()
    // and removit from the constants.js file

    // if the current recipe is the one shown in the single recipe page, show the title and the description
    let searchParams = new URLSearchParams(window.location.search);
    if (searchParams.has("id"))
        getRecipeById(searchParams.get("id"));
    else
        getAllRecipes();

    getChefById(CHEF_ID); // get the name and email by the chef id

    // add recipe
    $("#submit-add-recipe").on("click", (event) => {
        event.preventDefault();
        const title = $("#title").val().trim();
        const procedure = $("#procedure").val().trim().replace(/\n/g, "<br>");
        const portions = $("#portions").val().trim();
        const cookingTime = $("#cookingTime").val().trim();
        const cookingMethod = $("#cookingMethod option:selected").val();
        const category = $("input[name='category']:checked").val();
        const ingredients = $("input[name='ingredient']:checked").serializeArray();

        const areValid = areDataValid(title, procedure, portions, cookingTime, cookingMethod, category, ingredients);

        if (!areValid) return;

        clearStatus();

        const ingredientNames = [];
        ingredients.forEach((ingredient) => {
            ingredientNames.push(ingredient.value);
        });

        handleSubmit({ title, procedure, portions, cooking_time: cookingTime, cooking_method: cookingMethod, category, ingredients: ingredientNames });
    });

    $("#title").on("input", (event) => {
        const title = $("#title").val().trim();
        isValid(title, "#title", "Title is required!");
    });

    $("#procedure").on("input", (event) => {
        const procedure = $("#procedure").val().trim();
        isValid(procedure, "#procedure", "Procedure is required!");
    });

    $("#portions").on("input", (event) => {
        const portions = $("#portions").val().trim();
        isValid(portions, "#portions", "Portions is required!", "Portions must be greater than 0");
    });

    $("#cookingTime").on("input", (event) => {
        const cookingTime = $("#cookingTime").val().trim();
        isValid(cookingTime, "#cookingTime", "Cooking time is required!", "Cooking time must be greater than 0");
    });

    $("#cookingMethod").on("input", (event) => {
        const cookingMethod = $("#cookingMethod option:selected").val();
        isValid(cookingMethod, "#cookingMethod", "Cooking method is required!");
    });

    $("input[name='category']").on("change", (event) => {
        const category = $("input[name='category']").val();
        isValid(category, ".categories", "Category is required!");
    });

    $(".ingredients.form-choice").change((event) => {
        const ingredients = $("input[name='ingredient']:checked").val();
        isValid(ingredients, ".ingredients", "At least one ingredient is required!");
    });
});

const areDataValid = (title, procedure, portions, cookingTime, cookingMethod, category, ingredients) => {
    let areValid = true;

    areValid &= isValid(title, "#title", "Title is required!");
    areValid &= isValid(procedure, "#procedure", "Procedure is required!");
    areValid &= isValid(portions, "#portions", "Portions is required!", "Portions must be greater than 0");
    areValid &= isValid(cookingTime, "#cookingTime", "Cooking time is required!", "Cooking time must be greater than 0");
    areValid &= isValid(cookingMethod, "#cookingMethod", "Cooking method is required!");
    areValid &= isValid(category, ".categories", "Category is required!");
    areValid &= isValid(ingredients, ".ingredients", "At least one ingredient is required!");

    return areValid;
};

const clearStatus = () => {
    $("#title").css({ "border-color": "var(--grey-500)" });
    $("#title + .label-error").text("");
    $("#title + .label-error").css({ "display": "none" });
    $("#procedure").css({ "border-color": "var(--grey-500)" });
    $("#procedure + .label-error").text("");
    $("#procedure + .label-error").css({ "display": "none" });
    $("#portions").css({ "border-color": "var(--grey-500)" });
    $("#portions + .label-error").text("");
    $("#portions + .label-error").css({ "display": "none" });
    $("#cookingTime").css({ "border-color": "var(--grey-500)" });
    $("#cookingTime + .label-error").text("");
    $("#cookingTime + .label-error").css({ "display": "none" });
    $("#cookingMethod option").css({ "border-color": "var(--grey-500)" });
    $("#cookingMethod + .label-error").text("");
    $("#cookingMethod + .label-error").css({ "display": "none" });
    $(".categories").css({ "border": "1px solid var(--grey-500)" });
    $(".categories + .label-error").text("");
    $(".categories + .label-error").css({ "display": "none" });
    $(".ingredients").css({ "border": "1px solid var(--grey-500)" });
    $(".ingredients + .label-error").text("");
    $(".ingredients + .label-error").css({ "display": "none" });
};

/**
 * Handle the submit event of the form to add a new ingredient
 * 
 * @param {String} ingredientName 
 */
const handleSubmit = ({ title, procedure, portions, cooking_time, cooking_method, category, ingredients }) => {
    makeRequest({
        type: "POST",
        url: "./api/recipes/create.php",
        data: {
            "title": title,
            "chef_id": CHEF_ID,
            "procedure": procedure,
            "portions": portions,
            "cooking_time": cooking_time,
            "cooking_method": cooking_method,
            "category": category,
            "ingredients": ingredients
        },
        onSuccess: (response) => {
            new Alert(ALERT_TYPE.SUCCESS, response.ok);
            // redirect to the home page
            setTimeout(() => {
                window.location.href = "./index.php";
            }, 5000);
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
    });
};

/**
 * Get the name and email by the chef id
 * 
 * @param {int} id 
 */
const getChefById = (id) => {
    makeRequest({
        type: "GET",
        url: `./api/chefs/getById.php?id=${id}`,
        onSuccess: (response) => {
            const { name } = JSON.parse(response.chef);
            $("#chefName").append(`<b>${name}</b>`);
        },
        onError: (response) => {
            console.log(response);
            window.location.href = "./not_found.php";
        }
    });
};

/**
 * Get the recipe info by id
 * 
 * @param {int} id 
 */
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
        },
        onError: (response) => {
            console.log(response.responseJSON);
            new Alert(ALERT_TYPE.ERROR, "An error occurred", response.responseJSON.error);
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
    if (true) {
        new Alert(ALERT_TYPE.INFO,
            "Registration required",
            `You must be logged in to like a recipe<br>
            <a href='./login.php'>Login</a> or <a href='./register.php'>Register</a>`
        );
        return;
    }

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