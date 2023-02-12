<?php
include_once("php/top.php");
?>

<!-- My Styles -->
<link href="style/login.css" rel="stylesheet">

<?php

if (isset($_SESSION["id"]))
    header("Location: index.php");

?>
<title>Sign Up</title>
<script type="module" src="js/controller/auth.js"></script>

<div class="container" id="container">
    <div class="overlay-container">
        <div class="overlay signup">
            <div class="overlay-panel overlay-left">
                <h1>EASY CHEF</h1>
                <h4>WHERE COOKING IS FUN</h4>
                <p>Register and start sharing your recipes too!</p>
            </div>
        </div>
    </div>
    <div class="form-container sign-up-container">
        <form action="#">
            <h1>Sign Up</h1>
            <input type="text" placeholder="Name" name="name" required />
            <input type="email" placeholder="Email" name="email" required />
            <input type="password" placeholder="Password" name="password" required />
            <p>You already have an account? <br>
                <a href="./login.php">Login</a>
            </p>
            <button>Sign Up</button>
        </form>
    </div>
</div>


<?php
include_once("html/bottom.html");
?>