<?php include_once("php/top.php"); ?>
<script type="module" src="js/recipes.js"></script>
<script type="module" src="js/cooking_methods.js"></script>
<script type="module" src="js/chefs.js"></script>
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
            <!-- <a href="recipes-by-ingredient.html">Carote</a> -->
        </div>
    </div>
</section>

<section class="recipes-container">
    <div class="tags-container">
        <h4>Search recipe by cooking method</h4>
        <div class="tags-list">
            <!-- <a href="recipes-by-cooking-method.html">Oven</a>
            <a href="recipes-by-cooking-method.html">Cooker</a>
            <a href="recipes-by-cooking-method.html">Fryer</a>
            <a href="recipes-by-cooking-method.html">Grill</a>
            <a href="recipes-by-cooking-method.html">No-cooking</a> -->
        </div>
    </div>

    <div class="recipes-list">
        <a href="single-recipe.html" class="recipe">
            <img src="./assets/images/recipes/pasta.jpg" class="img recipe-img" alt="" />
            <h5>Spaghetti al sugo</h5>
            <p>Portions : 2 | Cook : 5min</p>
            <h5 class="star-icon"> <i class="far fa-star"></i> 35</h5>
            <!-- TODO: inserire il numero di like contando il numero di id nell'array-->
        </a>

        <a href="single-recipe.html" class="recipe">
            <img src="./assets/images/recipes/meat.jpg" class="img recipe-img" alt="" />
            <h5>Bistecca alla griglia</h5>
            <p>Portions : 1 | Cook : 5min</p>
            <h5 class="star-icon"> <i class="far fa-star"></i> 25</h5>
            <!-- TODO: inserire il numero di like contando il numero di id nell'array-->
        </a>


        <a href="single-recipe.html" class="recipe">
            <img src="./assets/images/recipes/soup.jpg" class="img recipe-img" alt="" />
            <h5>Zuppa di pomodoro</h5>
            <p>Portions : 4 | Cook : 5min</p>
            <h5 class="star-icon"> <i class="far fa-star"></i> 22</h5>
            <!-- TODO: inserire il numero di like contando il numero di id nell'array-->
        </a>


        <a href="single-recipe.html" class="recipe">
            <img src="./assets/images/recipes/vegan.jpg" class="img recipe-img" alt="" />
            <h5>Zucchine al forno</h5>
            <p>Portions : 6 | Cook : 15min</p>
            <h5 class="star-icon"> <i class="far fa-star"></i> 15</h5>
            <!-- TODO: inserire il numero di like contando il numero di id nell'array-->
        </a>


        <a href="single-recipe.html" class="recipe">
            <img src="./assets/images/recipes/other.jpg" class="img recipe-img" alt="" />
            <h5>Focaccia di farro</h5>
            <p>Portions : 3 | Cook : 25min</p>
            <h5 class="star-icon"> <i class="far fa-star"></i> 15</h5>
            <!-- TODO: inserire il numero di like contando il numero di id nell'array-->
        </a>


        <a href="single-recipe.html" class="recipe">
            <img src="./assets/images/recipes/dessert.jpg" class="img recipe-img" alt="" />
            <h5>Torta ai mirtilli</h5>
            <p>Portions : 6 | Cook : 35min</p>
            <h5 class="star-icon"> <i class="far fa-star"></i> 8</h5>
            <!-- TODO: inserire il numero di like contando il numero di id nell'array-->
        </a>


        <a href="single-recipe.html" class="recipe">
            <img src="./assets/images/recipes/ethnic.jpg" class="img recipe-img" alt="" />
            <h5>Cous cous al curry</h5>
            <p>Portions : 3 | Cook : 25min</p>
            <h5 class="star-icon"> <i class="far fa-star"></i> 7</h5>
            <!-- TODO: inserire il numero di like contando il numero di id nell'array-->
        </a>


        <a href="single-recipe.html" class="recipe">
            <img src="./assets/images/recipes/fish.jpg" class="img recipe-img" alt="" />
            <h5>Fritto di pesce</h5>
            <p>Portions : 3 | Cook : 25min</p>
            <h5 class="star-icon"> <i class="far fa-star"></i> 5</h5>
            <!-- TODO: inserire il numero di like contando il numero di id nell'array-->
        </a>
    </div>
</section>

<?php
include_once("html/bottom.html");
?>