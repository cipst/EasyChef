<?php
include_once("php/top.php");

if (!isset($_SESSION["id"]))
    header("Location: login.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "ADMIN")
    header("Location: index.php");

?>
<!-- My Styles -->
<link href="style/chart.css" rel="stylesheet">
<title>Dashboard</title>
<script type="module" src="js/controller/chart.js"></script>
<?php include_once("php/navbar.php"); ?>

<section class="dashboard-page">
    <div class="chart-container">
        <canvas id="chartNumberRecipesByChef" class="chart"></canvas>
        <canvas id="chartNumberLikesPerRecipeByChef" class="chart"></canvas>
        <canvas id="chartNumberRecipesContainigIngredients" class="chart"></canvas>
    </div>
</section>

<?php
include_once("html/bottom.html");
?>