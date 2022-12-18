<?php

/**
 * Navigation bar
 * @param string $activeTab can be "home" | "friends" | "profile"
 * @return void
 */
function nav_bar(string $activeTab = "home" | "friends" | "profile")
{
    if (isset($_SESSION["admin"]))
        $isAdmin = $_SESSION["admin"];
?>

<nav>
    <ul>
        <li>
            <a class="<?= $activeTab == "home" ? "active" : "" ?>" href="home.php">
                <i class="bi <?= $activeTab == "home" ? "bi-house-fill" : "bi-house" ?>"></i>
            </a>
        </li>
        <li>
            <form id="home-search">
                <button class="search-where fw-bolder">Anywhere</button>
                <div class="vr"></div>
                <button class="search-when fw-bolder">Any time</button>
                <div class="vr"></div>
                <button class="search-add-guests fw-light">Add guests</button>
                <button class="btn" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </li>
        <li>
            <div class="dropdown">
                <button type="button" id="dropdownUser">
                    <span class="navbar-toggler-icon"></span>
                    <img src="./images/no-pic.png" alt="Profile picture">
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="profile.php">
                            <i class="bi bi-person me-3"></i> Account
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-heart-fill me-3"></i> Wishlist
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li id="logout">
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-box-arrow-right me-3"></i> Log out
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
    <form id="home-search-expanded">
        <div class="search-where">
            <span class="fw-bolder">Where</span>
            <input type="text" placeholder="Search destination" class="mt-1">
        </div>
        <div class="search-when">
            <span class="fw-bolder">When</span>
            <span>Search date</span>
        </div>
        <div class="search-add-guests">
            <span class="fw-bolder">Who</span>
            <span>Add guests</span>
        </div>
        <button class="btn btn-secondary rounded-pill ms-1" type="submit">
            <i class="bi bi-search pe-2"></i> Search
        </button>
    </form>
</nav>

<?php
}
?>