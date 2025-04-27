<?php
if (!empty($_GET['songID'])){
    $song_id = $_GET['songID']; 
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SongCloud";
$conn = new mysqli($servername, $username, $password, $dbname) or die("Failed to connect to database: ".$conn->error);

echo '<body style="background-color: #f3dfc1;">';

// Update logic
if(isset($_POST['updatebtn'])) {
    $sql_update = "UPDATE Song SET 
                  title='".$conn->real_escape_string($_POST['title'])."', 
                  artist_id='".$conn->real_escape_string($_POST['artist_id'])."', 
                  duration='".$conn->real_escape_string($_POST['duration'])."', 
                  album_id='".$conn->real_escape_string($_POST['album_id'])."' 
                  WHERE song_id='".$conn->real_escape_string($song_id)."'";
    
    $resultupdate = $conn->query($sql_update);

    if($resultupdate) {
        echo "Song updated successfully";
        header("Location: view_songs.php");
        exit();
    } else {
        echo "Error updating song: ".$conn->error;
    }
}

// Delete logic
if(isset($_POST['deletebtn'])) {
    $sql_delete = "DELETE FROM Song WHERE song_id='".$conn->real_escape_string($song_id)."'";
    $resultdelete = $conn->query($sql_delete);
    
    if($resultdelete) {
        echo "Song deleted successfully";
        header("Location: view_songs.php");
        exit();
    } else {
        echo "Error deleting song: ".$conn->error;
    }
}

// Get current song data
$sql = "SELECT * FROM Song WHERE song_id='".$conn->real_escape_string($song_id)."'";
$result = $conn->query($sql);
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
            <td><input type="text" name="title" value="'.$row['title'].'"/></td>
            <td><input type="text" name="artist_id" value="'.$row['artist_id'].'"/></td>
            <td><input type="text" name="duration" value="'.$row['duration'].'"/></td>
            <td><input type="text" name="album_id" value="'.$row['album_id'].'"/></td>
        </tr>';
    }
    echo "</table>";
} else {
    echo "Song not found";
}
?>
<input type="submit" value="Update" name="updatebtn"/>
<input type="submit" value="Delete" name="deletebtn" onclick="return confirm('Are you sure you want to delete this song?')"/>
</form>