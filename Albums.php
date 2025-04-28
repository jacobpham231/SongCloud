<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SongCloud";
$conn = new mysqli ($servername, $username, $password, $dbname) or die("Connect failed: %s\n". $conn -> error);

$sql = '';

$queried_album

if (isset($_POST['searchAlb'])) {
  $sql = $mysql->prepare("SELECT * FROM Albums WHERE name = ?");
  $sql->bind_param("ss", $_POST['album']);
  $sql->execute();

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

  $sql->close();
}


echo "</table>";

echo '
\<form method="POST" action="">
    <div style="margin: 20px 0; text-align: center;">
        <label for="album">Search by Album:</label>
        <input type="text" id="album" name="album" value="Enter Album Name" style="border: solid 1px black; border-radius: 3px;">
        
        <input type="submit" value="Search" style="margin-left: 10px name="searchAlb";">
        <input type="button" value="Clear" onclick="window.location.href=window.location.pathname" style="margin-left: 10px;">

        <input type="button" value="Add Album" onclick="window.location.href=\'add_album.php\'" style="margin-left: 10px;">
    </div>
</form>';
?>
