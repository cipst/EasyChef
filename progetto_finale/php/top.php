<?php

/**
 * Top part in commons between all pages
 */

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>TheGiftShop</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <link rel="icon" href="images/giftbox.ico" type="image/icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- My Styles -->
    <link href="style/index.css" rel="stylesheet">
</head>

<body>

    <div id="alert">
        <div class="alert-heading">
            <ion-icon class="alert-icon" name="alert-circle" size="large"></ion-icon>
            <h4 class="alert-title">
            </h4>
        </div>
        <p class="alert-message">
        </p>
        <ion-icon class="close" name="close" size="large"></ion-icon>
    </div>

    <nav>
        <ul id="expanded">
            <ion-icon class="close" name="close" size="large"></ion-icon>
            <li id="logo"><a href="index.php">
                    <img src="images/logo.png" alt="TheGiftShop">
                </a></li>
            <li id="product"><a href="products.php">Products</a></li>
            <li id="search">
                <form id="nav-search">
                    <input type="text" placeholder="Search">
                    <button class="btn" type="button" id="button-search">
                        <ion-icon name="search" size="small"></ion-icon>
                    </button>
                </form>
            </li>
            <li id="profile"><a href="profile.php">Profile</a></li>
            <li id="cart"><a href="cart.php">Cart</a></li>
        </ul>
        <ul id="collapsed">
            <ion-icon class="open" name="menu" size="large"></ion-icon>
            <li id="logo"><a href="index.php">
                    <img src="images/logo.png" alt="TheGiftShop">
                </a></li>
        </ul>
    </nav>

    <div class="content">
        <!-- HERE START THE CONTENT OF THE PAGE -->