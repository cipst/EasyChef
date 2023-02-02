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
            <li id="add-recipe"><a href="add_recipe.php">Add Recipe</a></li>
            <li id="add-ingredient"><a href="add_ingredient.php">Add Ingredient</a></li>
            <li id="search">
                <form id="nav-search">
                    <input type="text" placeholder="Search">
                    <button class="btn" type="button" id="button-search">
                        <i class="fa-solid fa-search fa-lg"></i>
                    </button>
                </form>
            </li>
            <!-- LOGIN or PROFILE (depends if the user is logged in or not) -->
            <!-- <li id="profile"><a href="profile.php">Profile</a></li> -->
            <li id="login"><a href="login.php">login</a></li>

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