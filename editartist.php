<?php
if (!empty($_GET['artistID'])){
    $pid = $_GET['artistID']; 
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SongCloud";
$conn = new mysqli($servername, $username, $password, $dbname) or die("Failed to connect to database: ".$conn->error);

echo '<body style="background-color: #f3dfc1;">';

// update logic
if(isset($_POST['updatebtn']))
{
    $stmt = $conn->prepare("UPDATE Artists SET name=?, genre=?, debut=?, country=? WHERE artist_id=?");
    $stmt->bind_param("ssssi", 
        $_POST['name'],
        $_POST['genre'],
        $_POST['debut'],
        $_POST['country'],
        $pid
    );
    
    if($stmt->execute()) {
        echo "Records updated successfully";
        header("Location: view_artists.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
}

// delete logic
if(isset($_POST['deletebtn'])) {
    $stmt = $conn->prepare("DELETE FROM Artists WHERE artist_id=?");
    $stmt->bind_param("i", $pid);
    
    if($stmt->execute()) {
        echo "Record deleted successfully";
        header("Location: view_artists.php");
        exit();
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
    $stmt->close();
}

$stmt = $conn->prepare("SELECT * FROM Artists WHERE artist_id=?");
$stmt->bind_param("i", $pid);
$stmt->execute();
$result = $stmt->get_result();
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

    while ($row = $result->fetch_assoc()){
        echo '<tr>
            <td><input type="text" name="pidtb" value="'.$row['artist_id'].'" readonly/></td>
            <td><input type="text" name="name" value="'.$row['name'].'"/></td>
            <td><input type="text" name="genre" value="'.$row['genre'].'"/></td>
            <td><input type="text" name="debut" value="'.$row['debut'].'"/></td>
            <td><input type="text" name="country" value="'.$row['country'].'"/></td>
        </tr>';
    }
    echo "</table>";
} else {
    echo "Artist not found";
}
$stmt->close();
?>
<input type="submit" value="Update" name="updatebtn"/>
<input type="submit" value="Delete" name="deletebtn" onclick="return confirm('Are you sure you want to delete this artist?')"/>
</form>

<?php
$conn->close();
?>