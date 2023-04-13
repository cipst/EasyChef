<?php
include_once("php/top.php");

if (!isset($_SESSION["id"]))
    header("Location: login.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "ADMIN")
    header("Location: index.php");

?>
<!-- My Styles -->
<link href="style/control_panel.css" rel="stylesheet">
<title>Control Panel</title>
<script type="module" src="js/controller/recipes.js"></script>
<script type="module" src="js/controller/chefs.js"></script>
<script type="module" src="js/controller/ingredients.js"></script>
<script type="module" src="js/controller/cooking_methods.js"></script>
<?php include_once("php/navbar.php"); ?>

<section class="dashboard-page">
<h1>Dashboard</h1>
</section>

<?php
include_once("html/bottom.html");
?>