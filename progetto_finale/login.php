<?php
include_once("php/top.php");
?>

<!-- My Styles -->
<link href="style/login.css" rel="stylesheet">

<?php

if (isset($_SESSION["id"]))
    header("Location: index.php");

include_once("php/navbar.php");
?>
<title>Login</title>
<script type="module" src="js/controller/auth.js"></script>

<div class="container" id="container">
    <div class="form-container log-in-container">
        <form id="login">
            <h1>Login</h1>
            <input type="email" id="login-email" placeholder="Email" name="email" required />
            <input type="password" id="login-password" placeholder="Password" name="password" required />
            <p>You don't have an account? <br>
                <a href="./sign_up.php">Register now</a>
            </p>
            <button type="submit" id="login" class="btn">Log In</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <h1>EASY CHEF</h1>
                <h4>WHERE COOKING IS FUN</h4>
                <p>Register and start sharing your recipes too!</p>
            </div>
        </div>
    </div>
</div>


<?php
include_once("html/bottom.html");
?>