
<?php
if (!empty($_GET['artistID'])){
$pid = $_GET['artistID']; 
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SongCloud";
$conn = new mysqli($servername, $username, $password, $dbname) or die ("Failed to connect to database". $conn -> error);

echo '<body style="background-color: #f3dfc1;">';
// update logic
if(isset($_POST['updatebtn']))
{
	$sql_update = "UPDATE Artists SET 
              name='".$conn->real_escape_string($_POST['name'])."', 
              genre='".$conn->real_escape_string($_POST['genre'])."', 
              debut='".$conn->real_escape_string($_POST['debut'])."', 
              country='".$conn->real_escape_string($_POST['country'])."' 
              WHERE artist_id='".$conn->real_escape_string($pid)."'";
    
	$resultupdate = $conn->query($sql_update);

	if($resultupdate) //if the update is done successfully
		{
		echo "Records updated successfully";
		header("Location: view_artists.php");
        exit();
		}
}
// delete logic
if(isset($_POST['deletebtn'])) {
    $sql_delete = "DELETE FROM Artists WHERE artist_id='".$conn->real_escape_string($pid)."'";
    $resultdelete = $conn->query($sql_delete);
    
    if($resultdelete) {
        echo "Record deleted successfully";
        // redirect after deleting
        header("Location: view_artists.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}


$sql = "SELECT * FROM Artists WHERE artist_id='$pid'";
$result = $conn->query($sql);
?>

<form action="" method="post">
<?php
if($result->num_rows > 0){
 echo "<table style='border: solid 1px black;'>
	<tr>
	    <th>Artist ID</th>
	    <th>Name</th>
	    <th>Genre</th>
	    <th>Debut</th>
        <th>Country</th>
	</tr>";
}

while ($row = $result -> fetch_assoc()){
	echo '<tr>
		<td><input type="text" name="pidtb" value="'.$row['artist_id'].'" readonly/></td>
		<td><input type="text" name="name" value="'.$row['name'].'"/></td>
		<td><input type="text" name="genre" value="'.$row['genre'].'"/></td>
		<td><input type="text" name="debut" value="'.$row['debut'].'"/></td>
        <td><input type="text" name="country" value="'.$row['country'].'"/></td>
	      <tr>';
}
 echo "</table>";

?>
<input type="submit" value="Update" name="updatebtn"/>
<input type="submit" value="Delete" name="deletebtn" onclick="return confirm('Are you sure you want to delete this artist?')"/>

</form>

