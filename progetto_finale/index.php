<?php include_once("php/top.php");

if (!isset($_SESSION["id"]))
    header("Location: login.php");
?>
<title>EasyChef</title>
<script type="module" src="js/controller/auth.js"></script>
<script type="module" src="js/controller/recipes.js"></script>
<script type="module" src="js/controller/ingredients.js"></script>
<script type="module" src="js/controller/cooking_methods.js"></script>
<?php include_once("php/navbar.php"); ?>

<header class="hero">
    <div class="hero-container">
        <div class="hero-text">
            <h2>EASY CHEF</h2>
            <h3>WHERE COOKING IS FUN</h3>
        </div>
    </div>
</header>

<section class="ingredients-container">
    <div class="tags-container">
        <h4>Search recipe by ingredients</h4>
        <div class="ingredients-list">
        </div>
    </div>
</section>

<section class="recipes-container">
    <div class="tags-container">
        <h4>Search recipe by cooking method</h4>
        <div class="tags-list">
        </div>
    </div>

    <div class="recipes-list">
    </div>
</section>

<?php
include_once("html/bottom.html");
?>