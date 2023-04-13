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

<section class="control-panel-page">

    <!-- CHEFS -->
    <div class="row mt-5">
        <div class="col-12">
            <h2 class="text-center">Chefs</h2>
        </div>
    </div>
    <div class="row pb-5">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Role</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Hashed Password</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="chef-table">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- RECIPES -->
    <div class="row mt-5">
        <div class="col-12">
            <h2 class="text-center">Recipes</h2>
        </div>
    </div>
    <div class="row pb-5">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Chef ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Cooking Method</th>
                            <th scope="col">Portions</th>
                            <th scope="col">Cooking Time</th>
                            <th scope="col">Procedure</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="recipe-table">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- INGREDIENTS + COOKING METHODS -->
    <div class="row d-flex justify-content-around">
        <div class="col-md-5 col-xs-6">
            <h2 class="text-center">Ingredients</h2>
            <div class="table-responsive">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="ingredient-table">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-5 col-xs-6">
            <h2 class="text-center">Cooking Methods</h2>
            <div class="table-responsive">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="cooking-method-table">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>

<?php
include_once("html/bottom.html");
?>