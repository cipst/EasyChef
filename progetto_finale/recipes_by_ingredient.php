<?php include_once("php/top.php");

if (!isset($_SESSION["id"]))
    header("Location: login.php");
?>
<title>Recipes</title>
<script type="module" src="js/controller/recipes.js"></script>
<?php include_once("php/navbar.php"); ?>

<div class="featured-recipes">
    <h3>Recipes containing </h3>
    <div class="recipes-list">
    </div>
</div>

<?php
include_once("html/bottom.html");
?>