<?php
    session_start();
    // echo json_encode($_SESSION);

    $email = $username = "";
    $emailErr = $usernameErr = "";

    if($_SESSION['authenticated'] === false) {
        echo "
            <script>
                window.location = 'index.php'
            </script>
        ";
        die();
    }

    $editSucNo = 0;

    if(isset($_POST['change'])) {
        if(empty($_POST['emailEdit'])) {
            $emailErr = 'Email Cannot Be Empty!'; // Incase the user somehow bypasses the html required check validation
        } else {
            $email = $_POST['emailEdit'];
            $email = test_input($email);
            $_SESSION['email'] = $email;
            $editSucNo += 1;
        }

        if(empty($_POST['usernameEdit'])) {
            $usernameErr = 'Username Cannot Be Empty!';
        } else {
            $username = $_POST['usernameEdit'];
            $username = test_input($username);
            $_SESSION['username'] = $username;
            $editSucNo += 1;
        }

        if($editSucNo == 2) {
            echo "
                <script>
                    alert('Congrats! Profile Successfully Updated!');
                </script>
            ";
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
    <title>Edit Profile</title>
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
    <?php include("usernav.php"); ?>
    <h1>Edit Profile</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="input-div">
            <label for="email">Email Address</label>
            <input type="email" name="emailEdit" required id="email" value="<?php echo $_SESSION['email']; ?>">
            <span class="error"><?php echo $emailErr; ?></span>
        </div>
        <div class="input-div">
            <label for="username">Username</label>
            <input type="username" name="usernameEdit" required id="username" value="<?php echo $_SESSION['username'] ?>">
            <span class="error"><?php echo $usernameErr; ?></span>
        </div>
        <div class="input-div">
            <input type="submit" name="change" value="Change Profile Details">
        </div>
    </form>
    
</body>
</html>