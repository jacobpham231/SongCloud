<?php

// connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SongCloud";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("An error occured while connecting to the database: " . $conn->connect_error);
}

if(isset($_POST['inserttb'])) { 
    $stmt = $conn->prepare("INSERT INTO album (album_id, name, num_songs, artist_id, release_date) VALUES (?, ?, ?, ?, ?)");
    
    $stmt->bind_param("isiii", 
        $_POST['album_id'],
        $_POST['name'],
        $_POST['num_songs'],
        $_POST['artist_id'],
        $_POST['release_date']
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
    ID: <input type="text" name="album_id" required/> 
    Title: <input type="text" name="name" required/>
    Song Count: <input type="text" name="num_songs" required/>
    Artist: <input type="text" name="artist_id" required/>
    Release Year: <input type="text" name="release_date" required/>
    <input type="submit" value="Insert" name="inserttb"/>
</div>
</form>

<div style="text-align: center; margin: 20px 0;">
    <input type="button" 
           value="View Albums" 
           onclick="window.location.href='Albums.php'" >
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
