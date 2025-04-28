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
    $song_id = intval($_POST['song_id'] ?? 0);
    $title = trim($_POST['title'] ?? '');
    $artist_id = intval($_POST['artist_id'] ?? 0);
    $duration = intval($_POST['duration'] ?? 0);
    $album_id = !empty($_POST['album_id']) ? intval($_POST['album_id']) : NULL;

    if ($song_id <= 0 || empty($title) || $artist_id <= 0 || $duration <= 0) {
        die("Error: Invalid or missing required fields");
    }

    $stmt = $conn->prepare("SELECT 1 FROM Artists WHERE artist_id = ?");
    $stmt->bind_param("i", $artist_id);
    $stmt->execute();
    if ($stmt->get_result()->num_rows == 0) {
        die("Error: Artist ID $artist_id does not exist");
    }
    $stmt->close();

    if ($album_id !== NULL) {
        $stmt = $conn->prepare("SELECT 1 FROM Album WHERE album_id = ?");
        $stmt->bind_param("i", $album_id);
        $stmt->execute();
        if ($stmt->get_result()->num_rows == 0) {
            die("Error: Album ID $album_id does not exist");
        }
        $stmt->close();
    }

    $stmt = $conn->prepare("INSERT INTO Song (song_id, title, artist_id, duration, album_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isiii", $song_id, $title, $artist_id, $duration, $album_id);
    
    if($stmt->execute()) {
        echo "<div style='color:green; text-align:center;'>Song added successfully!</div>";
    } else {
        echo "<div style='color:red; text-align:center;'>Error: " . $stmt->error . "</div>";
    }
    $stmt->close();
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div style="margin: 20px 0; text-align: center; margin-top: 50px; display: block;">
    Song ID: <input type="number" name="song_id" required min="1"/> 
    Title: <input type="text" name="title" required maxlength="255"/>
    Artist ID: <input type="number" name="artist_id" required min="1"/>
    Duration (seconds): <input type="number" name="duration" required min="1"/>
    Album ID: <input type="number" name="album_id" min="1"/>
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

<div style="position: fixed; bottom: 20px; right: 20px;">
    <a href="home.php" style="display: inline-block; padding: 10px 20px; 
           background-color: #0056b3; color: white; text-decoration: none; 
           border-radius: 5px; font: Arial;">
        Home
    </a>
</div>
<?php
$conn->close();
?>
