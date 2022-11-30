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

    <link rel="icon" href="./images/smile.ico" type="image/icon type">

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Bootstrap Icon CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <!-- My Style -->
    <link href="styles/index.css" rel="stylesheet">
</head>

<body class="bg-dark text-light">

    <?php
    // $_SESSION["alert"] = new Alert(AlertType::DANGER, "TITOLO", "MESSAGGIO", "DESCRIZIONE");
    if (isset($_SESSION["alert"])) {
    ?>
        <div class="overlay alert alert-<?= $_SESSION["alert"]->get_type() ?> w-50 mt-5 position-fixed alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi <?= $_SESSION["alert"]->get_icon() ?> me-3 pb-2 pr-2 text-<?= $_SESSION["alert"]->get_type() ?>" style="font-size: 2em;"></i>
                <h4 class="alert-heading"><?= $_SESSION["alert"]->get_title() ?></h4>
            </div>
            <p><?= $_SESSION["alert"]->get_message() ?></p>
            <hr>
            <p class="mb-0"><?= $_SESSION["alert"]->get_description() ?></p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
        unset($_SESSION["alert"]);
    }
    ?>

    <div class="content">
        <!-- HERE START THE CONTENT OF THE PAGE -->