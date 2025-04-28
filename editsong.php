<?php
if (!empty($_GET['songID'])){
    $song_id = intval($_GET['songID']); 
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SongCloud";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo '<body style="background-color: #f3dfc1;">';

// Update logic
if(isset($_POST['updatebtn'])) {
    $stmt = $conn->prepare("UPDATE Song SET 
                          title=?, 
                          artist_id=?, 
                          duration=?, 
                          album_id=? 
                          WHERE song_id=?");
    
    $stmt->bind_param("siiii", 
        $_POST['title'],
        $_POST['artist_id'],
        $_POST['duration'],
        $_POST['album_id'],
        $song_id
    );
    
    if($stmt->execute()) {
        echo "Song updated successfully";
        header("Location: view_songs.php");
        exit();
    } else {
        echo "Error updating song: " . $stmt->error;
    }
    $stmt->close();
}

// Delete logic
if(isset($_POST['deletebtn'])) {
    $stmt = $conn->prepare("DELETE FROM Song WHERE song_id=?");
    $stmt->bind_param("i", $song_id);
    
    if($stmt->execute()) {
        echo "Song deleted successfully";
        header("Location: view_songs.php");
        exit();
    } else {
        echo "Error deleting song: " . $stmt->error;
    }
    $stmt->close();
}

$stmt = $conn->prepare("SELECT * FROM Song WHERE song_id=?");
$stmt->bind_param("i", $song_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<form action="" method="post">
<?php
if($result->num_rows > 0){
    echo "<table style='border: solid 1px black;'>
        <tr>
            <th>Song ID</th>
            <th>Title</th>
            <th>Artist ID</th>
            <th>Duration</th>
            <th>Album ID</th>
        </tr>";
    
    while ($row = $result->fetch_assoc()){
        echo '<tr>
            <td><input type="text" name="song_id" value="'.$row['song_id'].'" readonly/></td>
            <td><input type="text" name="title" value="'.htmlspecialchars($row['title']).'"/></td>
            <td><input type="number" name="artist_id" value="'.$row['artist_id'].'" min="1"/></td>
            <td><input type="number" name="duration" value="'.$row['duration'].'" min="1"/></td>
            <td><input type="number" name="album_id" value="'.$row['album_id'].'" min="1"/></td>
        </tr>';
    }
    echo "</table>";
} else {
    echo "Song not found";
}
$stmt->close();
?>
<input type="submit" value="Update" name="updatebtn"/>
<input type="submit" value="Delete" name="deletebtn" onclick="return confirm('Are you sure you want to delete this song?')"/>
</form>

<?php
$conn->close();
?>