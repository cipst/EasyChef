<?php include_once("php/top.php"); ?>
<title>Add Ingredient</title>
<script type="module" src="js/controller/ingredients.js"></script>
<?php include_once("php/navbar.php"); ?>

<section class="contact-container">
    <article class="contact-info">
        <h3>Insert new ingredient</h3>
        <p>
            If not in the list please add
        </p>
    </article>
    <article>
        <form class="form contact-form">
            <div class="form-row">
                <h5>Ingredient name</h5>
                <input type="text" name="ingredientname" id="ingredientName" class="form-input" />
            </div>

            </br>

            <button type="button" id="addIngredient" class="btn btn-block">
                submit
            </button>
        </form>
    </article>
</section>

<?php
include_once("html/bottom.html");
?>