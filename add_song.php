<?php
echo '<body style="background-color: #f3dfc1;">';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SongCloud";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// insert logic
if(isset($_POST['inserttb'])) { 
    // validate form data types
    $song_id = intval($_POST['song_id'] ?? 0);
    $title = $conn->real_escape_string($_POST['title'] ?? '');
    $artist_id = intval($_POST['artist_id'] ?? 0);
    $duration = intval($_POST['duration'] ?? 0);
    $album_id = !empty($_POST['album_id']) ? intval($_POST['album_id']) : NULL;

    // validate required fields
    if ($song_id <= 0 || empty($title) || $artist_id <= 0 || $duration <= 0) {
        die("Error: Invalid or missing required fields");
    }

    // check if artist exists
    $check_artist = $conn->query("SELECT 1 FROM Artists WHERE artist_id = $artist_id");
    if ($check_artist->num_rows == 0) {
        die("Error: Artist ID $artist_id does not exist");
    }

    // check if album exists
    if ($album_id !== NULL) {
        $check_album = $conn->query("SELECT 1 FROM Album WHERE album_id = $album_id");
        if ($check_album->num_rows == 0) {
            die("Error: Album ID $album_id does not exist");
        }
        $album_sql = "'$album_id'";
    } else {
        $album_sql = "NULL";
    }

    // Prepare and execute SQL with proper NULL handling
    $sql = "INSERT INTO Song (song_id, title, artist_id, duration, album_id) 
            VALUES ($song_id, '$title', $artist_id, $duration, $album_sql)";
    $result = $conn->query($sql);
    if($result)
	{
	echo "Records inserted successfully";
	}
    else {
        echo "Error adding entry";
    }
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div style="margin: 20px 0; text-align: center; margin-top: 50px; display: block;">
    Song ID: <input type="number" name="song_id" required/> 
    Title: <input type="text" name="title" required/>
    Artist ID: <input type="number" name="artist_id" required/>
    Duration: <input type="number" name="duration" required/>
    Album ID: <input type="number" name="album_id"/>
    <input type="submit" value="Insert" name="inserttb"/>
</div>
</form>

<div style="text-align: center; margin: 20px 0;">
    <input type="button" 
           value="View Songs" 
           onclick="window.location.href='view_songs.php'" 
           style="padding: 15px 30px;
                  font-size: 18px;
                  background-color: #0056b3;
                  color: white;
                  border: none;
                  border-radius: 8px;
                  cursor: pointer;">
</div>