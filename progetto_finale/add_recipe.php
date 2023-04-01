<?php
include_once("php/top.php");

if (!isset($_SESSION["id"]))
    header("Location: login.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] == "ADMIN")
    header("Location: index.php");
    
?>
<title>Add Recipe</title>
<script type="module" src="js/controller/recipes.js"></script>
<script type="module" src="js/controller/ingredients.js"></script>
<script type="module" src="js/controller/cooking_methods.js"></script>
<?php include_once("php/navbar.php"); ?>

<section class="contact-container">
    <article class="contact-info">
        <h3>Create New Recipe</h3>
        <p>
            Insert here your newest recipe and share it with EasyChef community!
        </p>
        <img src="./assets/images/main.jpeg" alt="RecipeImage" class="img about-img" />
    </article>
    <article>
        <form class="form contact-form">
            <div class="form-row">
                <h5>Recipe Title</h5>
                <input type="text" name="name" id="title" class="form-input" />
                <label id="title-error" class="label-error" for="title">Title is required</label>
            </div>
            <div>
                <h5>Chef Name:</h5>
                <h4 html="chefName" id="chefName" class="text"></h4>
            </div>
            <div class="form-row">
                <h5>Portions:</h5>
                <input type="number" min="1" name="portions" id="portions" class="form-input" placeholder="1" />
                <label id="portions-error" class="label-error" for="portions">Portions is required</label>
            </div>
            <div class="form-row">
                <h5>Cooking Time (in minutes):</h5>
                <input type="number" min="0" name="cookingTime" id="cookingTime" class="form-input" placeholder="0" />
                <label id="cookingTime-error" class="label-error" for="cookingTime">Cooking time is required</label>
            </div>
            <div>
                <h5>Cooking Method</h5>
                <select class="form-input" name="cookingMethod" id="cookingMethod">
                </select>
                <label id="cookingMethod-error" class="label-error" for="cookingMethod">Cooking method is
                    required</label>
            </div>
            </br>
            <div>
                <h5>Recipe Category</h5>
                <div class="categories form-choice">
                    <div><input type="radio" id="pasta" name="category" value="pasta" /> <label for="pasta"> Pasta
                        </label></div>
                    <div><input type="radio" id="soup" name="category" value="soup" /> <label for="soup"> Soup
                        </label></div>
                    <div><input type="radio" id="fish" name="category" value="fish" /> <label for="fish"> Fish &
                            Seafood </label></div>
                    <div><input type="radio" id="meat" name="category" value="meat" /> <label for="meat"> Meat
                        </label></div>
                    <div><input type="radio" id="vegan" name="category" value="vegan" /> <label for="vegan"> Vegan
                        </label></div>
                    <div><input type="radio" id="ethnic" name="category" value="ethnic" /> <label for="ethnic">
                            Ethnic </label></div>
                    <div><input type="radio" id="sandwich" name="category" value="sandwich" /> <label for="sandwich">
                            Sandwich </label></div>
                    <div><input type="radio" id="dessert" name="category" value="dessert" /> <label for="dessert">
                            Dessert </label></div>
                    <div><input type="radio" id="other" name="category" value="other" /> <label for="other"> Other
                        </label></div>
                </div>
                <label id="categories-error" class="label-error" for="categories">Category is required</label>
            </div>
            </br>
            <div>
                <h5>Select Ingredients</h5>
                <div class="ingredients form-choice">
                </div>
                <label id="ingredients-error" class="label-error" for="ingredients">Ingredients are required</label>
                </br>
            </div>
            </br>
            <div class="form-row">
                <h5>Insert Preparation Procedure</h5>
                <textarea name="procedure" id="procedure" class="form-textarea"></textarea>
                <label id="procedure-error" class="label-error" for="procedure">Procedure is required</label>
            </div>
            <button type="click" id="submit-add-recipe" class="btn btn-success">
                submit
            </button>
        </form>
    </article>
</section>

<?php
include_once("html/bottom.html");
?>