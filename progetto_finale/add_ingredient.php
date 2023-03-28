<?php
include_once("php/top.php");

if (!isset($_SESSION["id"]))
    header("Location: index.php");

?>
<title>Add Ingredient</title>
<script type="module" src="js/controller/ingredients.js"></script>
<?php include_once("php/navbar.php"); ?>

<section class="contact-container">
    <article class="contact-info">
        <h3>Insert new ingredient</h3>
        <h5>Current ingredients: </h5>
        <div id="add-ingredients-list">
        </div>
    </article>
    <article>
        <form class="form contact-form">
            <div class="form-row">
                <h5>Ingredient name</h5>
                <input type="text" name="ingredientname" id="ingredientName" class="form-input" />
                <label id="add-ingredient-error" class="label-error" for="ingredientName"></label>
            </div>

            </br>

            <button type="button" id="addIngredient" class="btn">
                submit
            </button>
        </form>
    </article>
</section>

<?php
include_once("html/bottom.html");
?>