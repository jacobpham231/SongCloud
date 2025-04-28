<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SongCloud";
$conn = new mysqli ($servername, $username, $password, $dbname) or die("Connect failed: %s\n". $conn -> error);

if (

$sql = "SELECT * FROM album";

$result = $conn -> query($sql);

echo '
\<form method="POST" action="">
    <div style="margin: 20px 0; text-align: center;">
        <input type="button" value="Add Album" onclick="window.location.href=\'add_album.php\'" style="margin-left: 10px;">
    </div>
</form>';

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
?>
