<?php
    session_start();
    
    // echo json_encode($_SESSION);

    if($_SESSION['authenticated'] === false) {
        echo "
            <script>
                window.location = 'index.php'
            </script>
        ";
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
</head>
<body>
    <?php include("usernav.php"); ?>
    <h1>Welcome <?php echo $_SESSION['username']; ?> ! Your Details Are: </h1>
    <ul>
        <li>Username: <?php echo $_SESSION['username']; ?></li>
        <li>Email: <?php echo $_SESSION['email']; ?></li>
        <li>Password: <?php echo $_SESSION['password'] ?></li>
    </ul>
</body>
</html>