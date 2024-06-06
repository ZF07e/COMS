<?php
    require ('../../LandingPage/Functions/connectionDB.php');

    $database = new Database();
    $mysqli = $database->getConnection();

    $token = $_GET["token"];
    $token_hash = hash("sha256", $token);

    $sql = "SELECT * FROM users
            WHERE activation = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $token_hash);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    if ($user === null) {
        die("token not found");
    }
    $sql = "UPDATE users
            SET activation = NULL
            WHERE email = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $user["email"]);
    $stmt->execute();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Account Activated</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>

    <h1>Account Activated</h1>
    <?php
        echo $user['email'];
    ?>

    <p>Account activated successfully. You can now
       <a href="http://localhost/COMS/LandingPage/Index.php">log in</a>.</p>
</body>
</html>