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
?>

<div style="position: fixed; bottom: 20px; right: 20px;">
    <a href="home.php" style="display: inline-block; padding: 10px 20px; 
           background-color: #0056b3; color: white; text-decoration: none; 
           border-radius: 5px; font-weight: Arial;">
        Home
    </a>
</div>
