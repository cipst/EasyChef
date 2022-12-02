<?php

/**
 * Top part in commons between all pages
 */

require_once("alert.php");
require_once("alert_type.php");

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>SmileBook</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <link rel="icon" href="../images/smile.ico" type="image/icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Bootstrap Icon CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <!-- My Style -->
    <link href="../styles/index.css" rel="stylesheet">
</head>

<body class="bg-dark text-light">

    <?php
    if (isset($_SESSION["alert"])) {
    ?>
        <div class="overlay alert alert-<?= $_SESSION["alert"]->get_type() ?> w-25 mt-5 start-50 translate-middle-x position-fixed alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi <?= $_SESSION["alert"]->get_icon() ?> me-3 pb-2 pr-2 text-<?= $_SESSION["alert"]->get_type() ?>" style="font-size: 1.5em;"></i>
                <h4 class="alert-heading"><?= $_SESSION["alert"]->get_title() ?></h4>
            </div>
            <?php
            if ($_SESSION["alert"]->get_message()) {
            ?>
                <p><?= $_SESSION["alert"]->get_message() ?></p>
            <?php
            }

            if ($_SESSION["alert"]->get_description()) {
            ?>
                <hr>
                <p class="mb-0"><?= $_SESSION["alert"]->get_description() ?></p>
            <?php
            }
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        unset($_SESSION["alert"]);
    }
    ?>

    <div class="content">
        <!-- HERE START THE CONTENT OF THE PAGE -->