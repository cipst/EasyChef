<?php
include_once("../utils/top.php");
include_once("../utils/nav_bar.php");

if (isset($_SESSION["logged"]) && $_SESSION["logged"] == true)
    header("Location: home.php");

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['confirmPassword'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == "admin" && $password == "l0G3In") {
        header("location: home.php");
    } else {
        $_SESSION["alert"] = new Alert(AlertType::DANGER, "ERROR", "Invalid username or password!");
    }
}

$fields = [
    "username" => [
        "icon" => "bi-person-fill",
        "type" => "text",
        "placeholder" => "Username",
    ],
    "email" => [
        "icon" => "bi-envelope-fill",
        "type" => "email",
        "placeholder" => "Email",
    ],
    "password" => [
        "icon" => "bi-key-fill",
        "type" => "password",
        "placeholder" => "Password",
    ],
    "confirmPassword" => [
        "icon" => "bi-key-fill",
        "type" => "password",
        "placeholder" => "Confirm Password",
    ],
];

?>

<!-- <div class="form-floating text-dark">
    <input type="email" class="form-control is-valid is-invalid" id="floatingInputInvalid" placeholder="name@example.com" value="test@example.com">
    <label for="floatingInputInvalid">Invalid input</label>
</div> -->

<div class="d-flex flex-column pt-5">
    <h1 class="mx-auto my-4">SIGN UP</h1>
    <form class="text-dark w-50 d-flex flex-column mx-auto py-3 mt-5" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <?php
        foreach ($fields as $name => $f) {
        ?>
            <div class="input-group my-3 d-flex justify-content-center">
                <span class="input-group-text px-4" id="label-<?= $name ?>" style="border-radius: 20em 0 0 20em">
                    <i class="bi <?= $f["icon"] ?>" style="font-size:1.5em;"></i>
                </span>
                <div class="form-floating w-50">
                    <input type=<?= $f["type"] ?> class="form-control" id=<?= $name ?> name=<?= $name ?> placeholder="" style="border-radius: 0 20em 20em 0">
                    <label for=<?= $name ?>><?= $f["placeholder"] ?></label>
                </div>
            </div>
        <?php
        }
        ?>
        <input class="btn btn-light mx-auto mt-4 px-5 py-2 rounded-pill" type="submit" value="Sign Up" />
        <p class="text-light mx-auto mt-3">You already have an account? <a class="link-light" href="login.php">Login</a></p>
    </form>
</div>

<?php
?>
<?php include_once("../utils/bottom.html"); ?>