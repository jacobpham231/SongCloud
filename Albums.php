<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SongCloud";
$conn = new mysqli ($servername, $username, $password, $dbname) or die("Connect failed: %s\n." $conn -> error);

$sql = "SELECT * FROM album";

$result = $conn -> query($sql);

while ($row = $result -> fetch_assoc()) {
  echo "album_id : ".$row['album_id']."<br>";
  echo "name : ".$row['name']."<br>";
  echo "song count : ".$row['num_songs']."<br>";
  echo "release date : ".$row['release_date']."<br>";
}
?>
