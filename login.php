<?php
// server connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SongCloud";
$conn = new mysqli($servername, $username, $password, $dbname) or die ("Failed to connect to database". $conn -> error);

$given_username = '';
$given_password = '';
$success = '0';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $given_username = $_POST['username'] ?? '';
    $given_password = $_POST['password'] ?? '';
}

// sql logic
$sql = "SELECT * FROM user WHERE 1=1";
$types = '';
$params = [];

if (!empty($given_username)) {
    $sql .= "AND username = ?";
    $types .= 's';
    $params[] = "%$given_username%";
}
if (!empty($given_password)) {
    $sql .= "AND password = ?";
    $types .= "s";
    $params[] = "%$given_password%";
}

$stmt = $conn->prepare($sql);
if ($stmt == false) {
    die("Error preparing statement: " . $conn->error);
}

if (!empty($types)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

//login fields
echo '
<form method="POST" action="">
    <div style="margin: 20px 0; text-align: center;">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="'.htmlspecialchars($given_username).'" style="border: solid 1px black; border-radius: 3px;">

        <label for="password" style="margin-left: 10px;">Password</label>
        <input type="text" id="password" name="password" value="'.htmlspecialchars($given_password).'" style="border: solid 1px black; border-radius: 3px;">

        <input type="submit" value="Login" style="margin-left: 10px;">
    </div>
</form>
';

// success check
if ($result->num_rows > 0) {
    $updateSQL = "UPDATE user SET loggedIn = 1 WHERE username = '$given_username'";
    $conn->query($updateSQL);
    $success = '1';
}
else {
    echo "<p>Wrong username or password</p>";
}

if ($success == '1') {
    echo '
    <form method="POST" action="">
        <div style="margin: 20px 0; text-align: center;">
            <input type="button" value="Go to Home" onclick="window.location.href=\'home.php\'" style="margin-left: 10px;">
        </div>
    </form>
    ';
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <title>SongCloud Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background: #f3dfc1;
            margin: 0;
            padding: 50px;
        }
        h1 {
            font-size: 96px;
            margin-bottom: 40px;
            color: #083d77;
        }
        .btn {
            display: inline-block;
            padding: 15px 30px;
            margin: 10px;
            font-size: 18px;
            color: white;
            background-color: #0056b3;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #2e4057;
        }
    </style>
    </head>

    <body style="background-color: #f3dfc1;">
        <h1>SongCloud Login</h1>
    </body>

<!--
<head>
    <title>SongCloud Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background: #f3dfc1;
            margin: 0;
            padding: 50px;
        }
        h1 {
            font-size: 96px;
            margin-bottom: 40px;
            color: #083d77;
        }
        .btn {
            display: inline-block;
            padding: 15px 30px;
            margin: 10px;
            font-size: 18px;
            color: white;
            background-color: #0056b3;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #2e4057;
        }
    </style>
</head>

<body>

<h1>SongCloud Login</h1>

</body>
    -->
</html>
