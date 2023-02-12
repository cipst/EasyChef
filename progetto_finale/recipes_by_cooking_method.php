<?php include_once("php/top.php"); ?>
<title>Recipes</title>
<script type="module" src="js/controller/recipes.js"></script>
<?php include_once("php/navbar.php"); ?>

<div class="featured-recipes"> <!-- TODO: inserire nel seguente tag l'ingrediente selezionato -->
    <h3>Recipes containing </h3>
    <!-- recipes list -->
    <div class="recipes-list">
    </div>
    <!-- end of recipe list -->
</div>

<?php
include_once("html/bottom.html");
?>