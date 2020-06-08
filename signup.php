<!DOCTYPE html>
<html lang="en" class="flex-container">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="styles1.css">
    <title>Sign Up</title>
</head>
<body>
    <?php
        $username = $email = $pwd = $pwdRepeat = "";
        $usernameErr = $emailErr = $pwdErr = $pwdRepeatErr = $pwdMatchErr = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["username"])) {
                $usernameErr = "<p class='error'>Username Required</p>";
            } else {
                $username = testInput($_POST["username"]);
                if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
                    $usernameErr = "<p class='error'>Username Allows Only Letters and Numbers</p>";
                }
            }
            if (empty($_POST["email"])) {
                $emailErr = "<p class='error'>Email Required</p>";
            } else {
                $email = testInput($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "<p class='error'>Invalid Email Format</p>";
                }
            }
            if ($_POST["pwd"] !== $_POST["pwd-repeat"]) {
                $pwdMatchErr = "<p class='error'>Passwords must match</p>";
            } else {
                if (empty($_POST["pwd"])) {
                    $pwdErr = "<p class='error'>Password Required</p>";
                } else {
                    $pwd = testInput($_POST["pwd"]);
                }
                if (empty($_POST["pwd-repeat"])) {
                    $pwdRepeatErr = "<p class='error'>Repeat Password Required</p>";
                } else {
                    $pwdRepeat = testInput($_POST["pwd-repeat"]);
                }
            }
        }

        function testInput($input) {
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }
    ?>
    <div>
        <h2>Bug Informer</h2>
        <?php echo $usernameErr, $emailErr, $pwdMatchErr, $pwdErr, $pwdRepeatErr?>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            <input type="text" name="username" placeholder="Username"><br>
            <input type="text" name="email" placeholder="Email"><br>
            <input type="password" name="pwd" placeholder="Password"><br>
            <input type="password" name="pwd-repeat" placeholder="Repeat Password"><br>
            <button>Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Log In!</a></p>
    </div>
</body>
</html>