<?php
include_once("php/dao/recipes.php");
include_once("php/dao/chefs.php");
include_once("php/top.php");
?>
<script type="module" src="js/controller/recipes.js"></script>
<?php include_once("php/navbar.php"); ?>

<div class="recipe-page" data-recipe-id="<?= $_GET["id"] ?>">
    <section class="recipe-hero">
        <img src='' class="img recipe-hero-img" alt="" title="" id="recipe-img"/>
        <article class="recipe-info">
            <h2 id="recipe-title">
            </h2>
            <div class="recipe-chef">
                <i class="fas fa-utensils fa-2xl"></i>
                <h4 id="recipe-chef">
                </h4>
                </h4>
            </div>
            <div class="recipe-icons">
                <article>
                    <i class="far fa-clock"></i>
                    <h5>cooking time</h5>
                    <p id="recipe-cooking-time">
                    </p>
                </article>
                <article>
                    <i class="fa fa-thermometer-half" aria-hidden="true"></i>
                    <h5>Cooking method</h5>
                    <p id="recipe-method">
                    </p>
                </article>
                <article>
                    <i class="fas fa-user-friends"></i>
                    <h5>portions</h5>
                    <p id="recipe-portions">
                    </p>
                </article>
            </div>
        </article>
    </section>
    <!-- content -->
    <section class="recipe-content">
        <article>
            <h3>instructions</h3>
            <p id="recipe-procedure">
            </p>
            <btn class="btn" id="like_btn"></btn>
        </article>
        <article class="second-column">
            <div>
                <h3>ingredients</h3>
                <div id="recipe-ingredients">
                </div>
            </div>
        </article>
    </section>
</div>

<?php
include_once("html/bottom.html");
?>