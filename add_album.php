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
    $album_id = intval($_POST['album_id'] ?? 0);
    $name = trim($_POST['name'] ?? '');
    $song_count = intval($_POST['num_songs'] ?? 0);
    $artist_id = intval($_POST['artist_id'] ?? 0);
    $release_year = intval($_POST['release_date'] ?? 0);
    
    if ($album_id <= 0 || empty($name) || $artist_id <= 0 || $release_year <= 0) {
        die("Error: Please enter valid data");
    }

    // TODO: FINISH
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
    <a href="home.php">
        Home
    </a>
</div>
<?php
$conn->close();
?>
