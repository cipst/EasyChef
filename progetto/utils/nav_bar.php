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

<nav class="navbar  navbar-light bg-light p-0 px-3 justify-content-center align-items-center py-2">
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
            <div id="home-search"
                class="ps-3 pe-3 mx-auto d-flex flex-row justify-content-center align-items-center border border-secondary rounded-pill">
                <button class="fw-bolder">Anywhere</button>
                <div class="vr"></div>
                <button class="fw-bolder">Any time</button>
                <div class="vr"></div>
                <button class="">Add guests</button>
                <button class="btn btn-secondary rounded-circle ms-3" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $activeTab == "profile" ? "active" : "" ?>" href="profile.php">
                <i class="bi <?= $activeTab == "profile" ? "bi-person-fill" : "bi-person" ?>"></i>
            </a>
        </li>
    </ul>
    <!-- </div> -->
</nav>

<?php
}
?>