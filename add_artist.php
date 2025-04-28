<?php
echo '<body style="background-color: #f3dfc1;">';

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SongCloud";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Failed to connect to database: " . $conn->connect_error);
}

// insert logic
if(isset($_POST['inserttb'])) { 
    $stmt = $conn->prepare("INSERT INTO Artists (artist_id, name, genre, debut, country) VALUES (?, ?, ?, ?, ?)");
    
    $stmt->bind_param("issss", 
        $_POST['artist_id'],
        $_POST['name'],
        $_POST['genre'],
        $_POST['debut'],
        $_POST['country']
    );
    
    if($stmt->execute()) {
        echo "<div style='text-align:center;color:green;'>Records inserted successfully</div>";
    } else {
        echo "<div style='text-align:center;color:red;'>Error: " . $stmt->error . "</div>";
    }
    
    $stmt->close();
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div style="margin: 20px 0; text-align: center; margin-top: 50px; display: block;">
    ID: <input type="text" name="artist_id" required/> 
    Name: <input type="text" name="name" required/>
    Genre: <input type="text" name="genre" required/>
    Debut: <input type="text" name="debut" required/>
    Country: <input type="text" name="country" required/>
    <input type="submit" value="Insert" name="inserttb"/>
</div>
</form>

<div style="text-align: center; margin: 20px 0;">
    <input type="button" 
           value="View Artists" 
           onclick="window.location.href='view_artists.php'" 
           style="padding: 15px 30px;
                  font-size: 18px;
                  background-color: #0056b3;
                  color: white;
                  border: none;
                  border-radius: 8px;
                  cursor: pointer;
                  transition: background-color 0.3s ease;">
</div>

<div style="position: fixed; bottom: 20px; right: 20px;">
    <a href="home.php" style="display: inline-block; padding: 10px 20px; 
           background-color: #0056b3; color: white; text-decoration: none; 
           border-radius: 5px; font-weight: Arial;">
        Home
    </a>
</div>
<?php
$conn->close();
?>