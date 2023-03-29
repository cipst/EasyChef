</head>

<body>

    <div id="alert">
        <div class="alert-heading">
            <i class="alert-icon fa-solid fa-xl"></i>
            <h4 class="alert-title">
            </h4>
        </div>
        <p class="alert-message">
        </p>
        <i class="close fa-solid fa-xmark fa-xl"></i>
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
            if (isset($_SESSION["id"])) {
                ?>
                <li id="add-recipe"><a href="add_recipe.php">Add Recipe</a></li>
                <li id="add-ingredient"><a href="add_ingredient.php">Add Ingredient</a></li>
                <?php
            }
            ?>
            <li id="search">
                <form id="nav-search">
                    <button class="input-icon" type="submit" id="button-search">
                        <i class="fa-solid fa-search fa-lg"></i>
                    </button>
                    <input type="text" class="input-with-icon" id="index-search" placeholder="Search Recipe" name="q">
                </form>
            </li>
            <!-- LOGIN or PROFILE (depends if the user is logged in or not) -->
            <?php
            if (isset($_SESSION['id'])) {
                ?>
                <li id="profile"><a href="profile.php">Profile</a></li>
                <?php
            } else {
                ?>
                <li id="login"><a href="login.php">Login</a></li>
                <?php
            }
            ?>

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