<?php
    session_start();
    // echo json_encode($_SESSION);

    $password = $username = "";
    $error = $passwordErr = $usernameErr = "";

    if(isset($_POST['login'])) {
        if(empty($_POST['password'])) {
            $passwordErr = 'Password Is Required!'; // Incase the user somehow bypasses the html required check validation
        } else {
            $password = $_POST['password'];
            $password = test_input($password);
        }

        if(empty($_POST['username'])) {
            $usernameErr = 'Username Is Required!';
        } else {
            $username = $_POST['username'];
            $username = test_input($username);
        }

        if(strtolower($username) == strtolower($_SESSION['username']) && $password == $_SESSION['password']) {
            $_SESSION['authenticated'] = true;
            echo "
                <script>
                    window.location = 'profile.php'
                </script>
            ";
        } else {
            $error = "Invalid Login Details Please Check And Try Again!";
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication Sidehustle Internship (Login)</title>

    <style>
        .error {
            color: red;
            display: block;
        }
        .input-div {
            margin: 2% 0;
        }
        .input-div label {
            display: block;
        }
    </style>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <h3>Welcome to This Authentication Sidehustle Internship Task Please Login Using The Form Below </h3>
        <div class="input-div">
            <label for="username">Username</label>
            <input type="username" required name="username" id="username">
            <span class="error"><?php echo $usernameErr; ?></span>
        </div>
        <div class="input-div">
            <label for="password">Password</label>
            <input type="password" required name="password" id="password">
            <span class="error"><?php echo $passwordErr; ?></span>
        </div>
        <span class="error"><?php echo $error; ?></span>
        <div class="input-div">
            <input type="submit" name="login" value="Login">
        </div>
    </form>
    <span>Don't Have an account? <a href="signup.php">Register Here</a></span>
</body>
</html>