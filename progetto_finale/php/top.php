<?php

/**
 * Top part in commons between all pages
 */

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>EasyChef</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <link rel="icon" href="images/icon.ico" type="image/icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awesome local -->
    <link href="assets/css/all.css" rel="stylesheet">

    <!-- My Styles -->
    <link href="style/index.css" rel="stylesheet">
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

    <nav>
        <ul id="expanded">
            <i class="close fa-solid fa-xmark fa-2xl"></i>
            <li id="logo">
                <a href="index.php">
                    <img src="images/final_logo.png" alt="EasyChef">
                </a>
            </li>
            <li id="recipe"><a href="recipes.php">Recipes</a></li>
            <li id="search">
                <form id="nav-search">
                    <input type="text" placeholder="Search">
                    <button class="btn" type="button" id="button-search">
                        <i class="fa-solid fa-search fa-lg"></i>
                    </button>
                </form>
            </li>
            <li id="chefs"><a href="chefs.php">Chefs</a></li>
            <!-- LOGIN or PROFILE (depends if the user is logged in or not) -->
            <!-- <li id="profile"><a href="profile.php">Profile</a></li> -->
            <li id="login"><a href="login.php">login</a></li>

        </ul>
        <ul id="collapsed">
            <i class="open fa-solid fa-bars fa-2xl"></i>
            <li id="logo">
                <a href="index.php">
                    <img src="images/final_logo.png" alt="EasyChef">
                </a>
            </li>
        </ul>
    </nav>

    <div class="content">
        <!-- HERE START THE CONTENT OF THE PAGE -->