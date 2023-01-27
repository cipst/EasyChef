<?php include_once("php/top.php"); ?>
<script type="module" src="js/controller/recipes.js"></script>
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
            </div>
            <div>
                <h5>Chef Name:</h5>
                <h5 html="chefName" id="chefName" class="text"><b>Mario Rossi</b></h5>
                <!-- TODO: prendere il nome dell'utente-->
            </div>
            <div class="form-row">
                <h5>Portions:</h5>
                <input type="number" min="1" name="portions" id="portions" class="form-input" placeholder="1" />
            </div>
            <div class="form-row">
                <h5>Cooking Time (in minutes):</h5>
                <input type="number" min="0" name="portions" id="cookingTime" class="form-input" placeholder="0" />
            </div>
            <div>
                <h5>Cooking Method</h5>
                <select class="form-input" name="cookingMethod">
                </select>
            </div>
            </br>
            <div>
                <h5>Recipe Category</h5>
                <div class="form-choice">
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
                    <div><input type="radio" id="sandwich" name="category" value="sandwich" /> <label
                            for="sandwich"> Sandwich </label></div>
                    <div><input type="radio" id="dessert" name="category" value="dessert" /> <label for="dessert">
                            Dessert </label></div>
                    <div><input type="radio" id="other" name="category" value="other" /> <label for="other"> Other
                        </label></div>
                </div>
            </div>
            </br>
            <div>
                <h5>Select Ingredients</h5> <!-- TODO: creare la lista facendo una get all degli ingredienti -->
                <div class="ingredients form-choice">
                </div>
                </br>
                <a href="add-ingredient.html"> If not present add new ingredient </a>
            </div>
            </br>
            <div class="form-row">
                <h5>Insert Preparation Procedure</h5>
                <textarea name="procedure" id="procedure" class="form-textarea"></textarea>
            </div>
            <button type="submit" class="btn btn-block">
                submit
            </button>
        </form>
    </article>
</section>

<?php
include_once("html/bottom.html");
?>