<?php
include_once("php/top.php");

if (!isset($_SESSION["id"]))
    header("Location: login.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "ADMIN")
    header("Location: index.php");

?>
<!-- My Styles -->
<link href="style/control_panel.css" rel="stylesheet">
<title>Dashboard</title>
<!-- <script type="module" src="js/controller/recipes.js"></script>
<script type="module" src="js/controller/ingredients.js"></script>
<script type="module" src="js/controller/cooking_methods.js"></script> -->
<?php include_once("php/navbar.php"); ?>

<section class="">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center">Chefs</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
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
                        <tr>
                            <th scope="row">1</th>
                            <td>USER</td>
                            <td>Topolino</td>
                            <td>topolino@gmail.com</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere </td>
                            <td>
                                <button class="btn-action btn-danger" type="button"><i
                                        class="fa-solid fa-trash-can fa-2xl"></i></button>
                                <button class="btn-action btn-success" type="button"><i
                                        class="fa-solid fa-pen fa-2xl"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h2 class="text-center">Recipes</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
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
    <div class="row">
        <div class="col-12">
            <h2 class="text-center">Ingredients</h2>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-5 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
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
    </div>
</section>

<?php
include_once("html/bottom.html");
?>