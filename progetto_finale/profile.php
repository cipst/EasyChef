<?php
include_once("php/dao/recipes.php");
include_once("php/dao/chefs.php");
include_once("php/top.php");

if (!isset($_SESSION["id"]))
    header("Location: login.php");
?>
<!-- My Styles -->
<link href="style/profile.css" rel="stylesheet">
<title>Recipe</title>
<script type="module" src="js/controller/profile.js"></script>
<script type="module" src="js/controller/auth.js"></script>
<?php include_once("php/navbar.php"); ?>

<section class="profile-page">
    <article>
        <h2>Personal Chef profile</h2>
        <h1 id="profile-name"></h1>
        <h3 id="profile-email"></h3>
        <button class="btn btn-error" id="logout">Logout <i class="fa-solid fa-arrow-right-from-bracket fa-xl"></i></button>
    </article>
    <figure>
        <img src="./assets/images/chef.jpg" alt="Chef Image" class="img profile-img" style="height: 300px" />
        <figcaption>
            Foto di
            <a href="https://unsplash.com/@tetrakiss?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText"
                target="_blank" rel="noopener noreferrer">Arseny
                Togulev
            </a> su <a
                href="https://unsplash.com/it/foto/lNip798LiIs?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText"
                target="_blank" rel="noopener noreferrer">Unsplash</a>
        </figcaption>
    </figure>
</section>

<?php
if (isset($_SESSION["id"]) && $_SESSION["role"] == "USER") {
    ?>
    <section class="featured-recipes">
        <h2 class="featured-title">My recipes</h2>
        <div class="recipes-list">
        </div>
    </section>
    <?php
}
?>

<section class="featured-recipes">
    <h2 class="featured-title">Recipes liked</h2>
    <div class="liked-recipes-list">
    </div>
</section>

<?php
include_once("html/bottom.html");
?>