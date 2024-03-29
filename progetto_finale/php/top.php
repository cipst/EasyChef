<?php

/**
 * Top part in commons between all pages
 */

session_start();

require_once("common.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <link rel="icon" href="assets/images/icon.ico" type="image/icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awesome local -->
    <link href="assets/css/fontawesome.css" rel="stylesheet">

    <!-- Chart CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>


    <!-- My Styles -->
    <link href="style/index.css" rel="stylesheet">

    <!-- Title and Eventual script go here -->