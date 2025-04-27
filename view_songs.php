<?php 
// connect to server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SongCloud";
$conn = new mysqli($servername, $username, $password, $dbname) or die ("Failed to connect to database". $conn -> error);

$search_artist = '';

// handle POST requests
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // sanitize input
    $search_artist = isset($_POST['artist']) ? $conn->real_escape_string($_POST['artist']) : '';
}

// logic for search feature
$sql = "SELECT s.song_id, s.title, 
               a.name as artist_name, a.artist_id,
               al.name as album_name, al.album_id,
               s.duration
        FROM Song s
        JOIN Artists a ON s.artist_id = a.artist_id
        LEFT JOIN Album al ON s.album_id = al.album_id
        WHERE 1=1";
if (!empty($search_artist)) {
    $sql .= " AND a.name LIKE '%$search_artist%'";
}
$result = $conn->query($sql);

echo '<body style="background-color: #f3dfc1;">';

// search form
echo '
<form method="POST" action="">
    <div style="margin: 20px 0; text-align: center;">
        <label for="genre">Search by Artist:</label>
        <input type="text" id="artist" name="artist" value="'.htmlspecialchars($search_artist).'" style="border: solid 1px black; border-radius: 3px;">
        
        
        <input type="submit" value="Search" style="margin-left: 10px;">
        <input type="button" value="Clear" onclick="window.location.href=window.location.pathname" style="margin-left: 10px;">

        <input type="button" value="Add Song" onclick="window.location.href=\'add_song.php\'" style="margin-left: 10px;">
    </div>
</form>
';

// table display
if($result->num_rows > 0) {
    echo "<table style='border: solid 3px black; margin-left: auto; margin-right: auto; background-color: white; border-radius: 10px;'>
        <tr>
            <th>Song ID</th>
            <th>Title</th>
            <th>Artist Name</th>
            <th>Duration</th>
            <th>Album Name</th>
        </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo '
        <tr>
            <td>'.$row['song_id'].'</td>
            <td>'.$row['title'].'</td>
            <td>'.$row['artist_name'].'</td>
            <td>'.$row['duration'].'</td>
            <td>'.($row['album_name'] ? $row['album_name'] : 'No Album').'</td>
            <td style="border: solid 1px black;"> <a href="editsong.php?songID='.$row['song_id'].'">Edit/Delete</a></td>
        </tr>';
    }
    echo "</table>";
} else {
    echo "<p>No artists found matching your criteria.</p>";
}

$conn->close();
?>