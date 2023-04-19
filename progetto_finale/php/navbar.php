</head>

<?php
function isActive(string $page)
{
    return strpos($_SERVER['REQUEST_URI'], $page) ? "active" : "nav";
}
?>

<body>

    <!-- ALERT -->
    <div id="alert">
        <div class="alert-heading">
            <i class="alert-icon fa-solid fa-xl"></i>
            <h4 class="alert-title">
            </h4>
        </div>
        <p class="alert-message">
        </p>
        <i class="close fa-solid fa-xmark fa-xl"></i>
        <div class="alert-buttons">
            <button class="btn btn-error" id="alert-button-cancel">No</button>
            <button class="btn btn-success" id="alert-button-confirm">Yes</button>
        </div>
    </div>

    <div id="mask">
    </div>

    <nav>
        <ul id="expanded">
            <i class="close fa-solid fa-xmark fa-2xl"></i>
            <li id="logo">
                <a href="index.php">
                    <img src="assets/images/final_logo.png" alt="EasyChef">
                </a>
            </li>
            <?php
            if (isset($_SESSION["id"]) && $_SESSION["role"] == "USER") {
                ?>
                <li id="add-recipe"><a class="btn <?= isActive("add_recipe") ?>" href="add_recipe.php">Add Recipe <i
                            class="fas fa-receipt fa-xl"></i>
                    </a></li>
                <li id="add-ingredient"><a class="btn <?= isActive("add_ingredient") ?>" href="add_ingredient.php">Add
                        Ingredient <i class="fas fa-wheat-awn fa-xl"></i></a></li>
                <?php
            }
            if (isset($_SESSION["id"]) && $_SESSION["role"] == "ADMIN") {
                ?>
                <li id="admin-dashboard"><a class="btn <?= isActive("dashboard") ?>" href="dashboard.php">Dashboard <i
                            class="fa-solid fa-magnifying-glass-chart fa-xl"></i></a></li>
                <li id="admin-control-panel"><a class="btn <?= isActive("control_panel") ?>"
                        href="control_panel.php">Control
                        Panel <i class="fa-solid fa-wrench fa-xl"></i></a></li>
                <?php
            }
            ?>
            <?php
            if (!strpos($_SERVER['REQUEST_URI'], "control_panel.php")) {
                ?>
                <li id="search">
                    <form id="nav-search">
                        <button class="input-icon" type="submit" id="button-search">
                            <i class="fa-solid fa-search fa-lg"></i>
                        </button>
                        <input type="text" class="input-with-icon" id="index-search" placeholder="Search Recipe" name="q">
                    </form>
                </li>
                <?php
            }
            ?>

            <li id="profile"><a class="btn btn-outline" href="profile.php">Profile <i class="far fa-user fa-xl"></i></a>
            </li>
        </ul>
        <ul id="collapsed">
            <i class="open fa-solid fa-bars fa-2xl"></i>
            <li id="logo">
                <a href="index.php">
                    <img src="assets/images/final_logo.png" alt="EasyChef">
                </a>
            </li>
        </ul>
    </nav>

    <div class="content">
        <!-- HERE START THE CONTENT OF THE PAGE -->