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

<nav class="navbar navbar-light bg-light p-0 px-3 py-2 position-fixed top-0 w-100">
    <!-- <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form> -->

    <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent"> -->
    <ul class="nav navbar-nav w-100 mx-auto d-flex justify-content-around align-items-center flex-row">
        <li class="nav-item">
            <a class="nav-link <?= $activeTab == "home" ? "active" : "" ?>" href="home.php">
                <i class="bi <?= $activeTab == "home" ? "bi-house-fill" : "bi-house" ?>"></i>
            </a>
        </li>
        <li class="nav-item">
            <form id="home-search"
                class="ps-3 pe-3 mx-auto d-flex flex-row justify-content-center align-items-center border border-secondary rounded-pill">
                <button class="search-where fw-bolder">Anywhere</button>
                <div class="vr"></div>
                <button class="search-when fw-bolder">Any time</button>
                <div class="vr"></div>
                <button class="search-add-guests fw-light">Add guests</button>
                <button class="btn btn-secondary rounded-circle" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </li>
        <li class="nav-item">
            <!-- <a class="nav-link <?= $activeTab == "profile" ? "active" : "" ?>" href="profile.php">
                <i class="bi <?= $activeTab == "profile" ? "bi-person-fill" : "bi-person" ?>"></i>
            </a> -->
            <div class="dropdown">
                <button class="d-flex btn rounded-pill border border-secondary align-items-center" type="button"
                    id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>

                    <img src="./images/no-pic.png" class="img-fluid img-thumbnail rounded-circle ms-2" alt="Profile picture">

                </button>
                <ul class="dropdown-menu position-absolute rounded-100" aria-labelledby="dropdownUser">
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
    <form id="home-search-expanded"
        class="pe-3 mx-auto mt-2 d-none flex-md-row flex-column justify-content-center align-items-center border border-secondary rounded-pill">
        <div class="search-where d-flex flex-column justify-content-center align-items-start rounded-pill">
            <span class="fw-bolder">Where</span>
            <input type="text" placeholder="Search destination" class="mt-1">
        </div>
        <!-- <span class="vr"></span> -->
        <hr>
        <div class="search-when d-flex flex-column justify-content-center align-items-start rounded-pill">
            <span class="fw-bolder">When</span>
            <span>Search date</span>
        </div>
        <span class="vr"></span>
        <div class="search-add-guests d-flex flex-column justify-content-center align-items-start rounded-pill">
            <span class="fw-bolder">Who</span>
            <span>Add guests</span>
        </div>
        <button class="btn btn-secondary rounded-pill ms-1" type="submit">
            <i class="bi bi-search pe-2"></i> Search
        </button>
    </form>
    <!-- </div> -->
</nav>

<?php
}
?>