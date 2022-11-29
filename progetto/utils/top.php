<?php

require_once("alert.php");
require_once("alert_type.php");

session_start();
?>

<!-- common top between pages -->


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <title>&#127916; MoviesXChange &#127916;</title> -->
    <title>&#128218; Booking &#128218;</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Bootstrap Icon CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <!-- My Style -->
    <link href="styles/index.css" rel="stylesheet">
</head>

<body>

    <?php
    $_SESSION["alert"] = new Alert(AlertType::DANGER, "TITOLO", "MESSAGGIO", "DESCRIZIONE");
    if (isset($_SESSION["alert"])) {
    ?>
        <div class="alert alert-<?= $_SESSION["alert"]->get_type() ?> w-50 mt-5 position-fixed start-50 translate-middle-x alert-dismissible fade show" role="alert">

            <div class="d-flex align-items-center">
                <i class="bi <?= $_SESSION["alert"]->get_icon() ?> me-3 pb-2 fs-4 text-<?= $_SESSION["alert"]->get_type() ?>"></i>
                <h4 class="alert-heading"><?= $_SESSION["alert"]->get_title() ?></h4>
            </div>
            <p><?= $_SESSION["alert"]->get_message() ?></p>
            <hr>
            <p class="mb-0"><?= $_SESSION["alert"]->get_description() ?></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        unset($_SESSION["alert"]);
    }
    ?>