<?php
// require_once("error.php");

function nav_bar(string $activeTab = "home")
{
    // if ($activeTab != "home" && $activeTab != "friends" && $activeTab != "profile") {
    //     // display_error("An error occurred while creating the navigation bar");
    //     return;
    // }
?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light p-0 px-3">
        <a class="navbar-brand" href="index.php">
            <img src="images/smile.ico" alt="Icon" width="30">
        </a>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav w-100 mx-auto d-flex justify-content-around">
                <li class="nav-item">
                    <a class="nav-link <?= $activeTab == "home" ? "active" : "" ?>" href="home.php">
                        <i class="bi <?= $activeTab == "home" ? "bi-house-fill" : "bi-house" ?>" style="font-size: 2rem;"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $activeTab == "friends" ? "active" : "" ?>" href="friends.php">
                        <i class="bi <?= $activeTab == "friends" ? "bi-people-fill" : "bi-people" ?>" style="font-size: 2rem;"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $activeTab == "profile" ? "active" : "" ?>" href="profile.php">
                        <i class="bi <?= $activeTab == "profile" ? "bi-person-fill" : "bi-person" ?>" style="font-size: 2rem;"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
<?php
}
?>