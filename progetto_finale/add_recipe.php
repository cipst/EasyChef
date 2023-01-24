<?php
include_once("php/top.php");
include_once("php/common.php");



?>

<section class="contact-container">
    <article class="contact-info">
        <h3>Create New Recipe</h3>
        <p>
            Insert here your newest recipe and share it with EasyChef community!
        </p>
        <img src="./images/main.jpeg" alt="RecipeImage" class="img about-img" />
    </article>
    <article>
        <form class="form contact-form">
            <div class="form-row">
                <h5>Recipe Title</h5>
                <input type="text" name="name" id="title" class="form-input" />
            </div>
            <div>
                <h5>Chef Name:</h5>
                <label html="chefName" id="chefName" class="form-label text">Mario
                    Rossi</label><!-- TODO: prendere il nome dell'utente-->
            </div>
            <div class="form-row">
                <h5>Portions:</h5>
                <input type="number" value="1" min="1" name="portions" id="portions" class="form-input" />
            </div>
            <div class="form-row">
                <h5>Cooking Time (in minutes):</h5>
                <input type="number" value="0" min="0" name="portions" id="cookingTime" class="form-input" />
            </div>
            <div>
                <h5>Cooking Method</h5>
                <input type="radio" id="cookingMethod1" name="cookingMethod" value="cookingMethod"><label> Oven</label>
                <input type="radio" id="cookingMethod2" name="cookingMethod" value="cookingMethod"><label>
                    Cooker</label>
                <input type="radio" id="cookingMethod3" name="cookingMethod" value="cookingMethod"><label> Fryer</label>
                <input type="radio" id="cookingMethod4" name="cookingMethod" value="cookingMethod"><label> Grill</label>
                <input type="radio" id="cookingMethod5" name="cookingMethod" value="cookingMethod"
                    checked="checked"><label> No-cooking</label>
            </div>
            </br>
            <div>
                <h5>Recipe Category</h5>
                <input type="radio" id="category1" name="category" value="category"> Pasta
                <input type="radio" id="category2" name="category" value="category"> Soup
                <input type="radio" id="category3" name="category" value="category"> Fish & Seafood
                <input type="radio" id="category4" name="category" value="category"> Meat
                <input type="radio" id="category5" name="category" value="category"> Vegan
                <input type="radio" id="category6" name="category" value="category"> Ethnic
                <input type="radio" id="category7" name="category" value="category"> Sandwich
                <input type="radio" id="category8" name="category" value="category"> Dessert
                <input type="radio" id="category9" name="category" value="category" checked="checked"> Other
            </div>
            </br>
            <div>
                <h5>Select Ingredients</h5> <!-- TODO: creare la lista facendo una get all degli ingredienti -->
                <input type="checkbox" id="ingredient1" name="ingredient" value="ingredient"> Zucchero
                <input type="checkbox" id="ingredient2" name="ingredient" value="ingredient"> Farina
                <input type="checkbox" id="ingredient3" name="ingredient" value="ingredient"> Sale
                <input type="checkbox" id="ingredient4" name="ingredient" value="ingredient"> Zucca
                <input type="checkbox" id="ingredient5" name="ingredient" value="ingredient"> Formaggio
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