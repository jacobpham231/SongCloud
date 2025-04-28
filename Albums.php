<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SongCloud";
$conn = new mysqli ($servername, $username, $password, $dbname) or die("Connect failed: %s\n". $conn -> error);

$sql = "SELECT * FROM album";

$result = $conn -> query($sql);

if ($result->num_rows > 0) {
  echo "<table style='border: solid 1px black;'>
          <tr>
              <th>album_id</th>
              <th>name</th>
              <th>song count</th>
              <th>release date</th>
          </tr>";
}

while ($row = $result -> fetch_assoc()) {
  echo '<tr>
          <td> '.$row['album_id'].' </td>
          <td> '.$row['name'].' </td>
          <td> '.$row['num_songs'].' </td>
          <td> '.$row['release_date'].' </td>
        </tr>';
}

echo "</table>";

echo '
\<form method="POST" action="">
    <div style="margin: 20px 0; text-align: center;">
        <label for="artist">Search by Artist:</label>
        <input type="text" id="artist" name="artist" value="'.htmlspecialchars($search_artist).'" style="border: solid 1px black; border-radius: 3px;">
        
        <input type="submit" value="Search" style="margin-left: 10px;">
        <input type="button" value="Clear" onclick="window.location.href=window.location.pathname" style="margin-left: 10px;">

        <input type="button" value="Add Song" onclick="window.location.href=\'add_album.php\'" style="margin-left: 10px;">
    </div>
</form>';
?>
