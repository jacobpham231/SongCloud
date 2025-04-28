<?php 
// connect to server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SongCloud";
$conn = new mysqli($servername, $username, $password, $dbname) or die ("Failed to connect to database". $conn -> error);

$search_genre = '';
$search_country = '';

// handle POST requests
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search_genre = $_POST['genre'] ?? '';
    $search_country = $_POST['country'] ?? '';
}

// logic for search feature
$sql = "SELECT * FROM Artists WHERE 1=1";
$types = '';
$params = [];

// Add conditions for search
if (!empty($search_genre)) {
    $sql .= " AND genre LIKE ?";
    $types .= 's';
    $params[] = "%$search_genre%";
}
if (!empty($search_country)) {
    $sql .= " AND country LIKE ?";
    $types .= 's';
    $params[] = "%$search_country%";
}

// Prepare and execute the statement
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

if (!empty($types)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
echo '<body style="background-color: #f3dfc1;">';

// search form
echo '
<form method="POST" action="">
    <div style="margin: 20px 0; text-align: center;">
        <label for="genre">Search by Genre:</label>
        <input type="text" id="genre" name="genre" value="'.htmlspecialchars($search_genre).'" style="border: solid 1px black; border-radius: 3px;">
        
        <label for="country" style="margin-left: 10px;">Search by Country:</label>
        <input type="text" id="country" name="country" value="'.htmlspecialchars($search_country).'" style="border: solid 1px black; border-radius: 3px;">
        
        <input type="submit" value="Search" style="margin-left: 10px;">
        <input type="button" value="Clear" onclick="window.location.href=window.location.pathname" style="margin-left: 10px;">

        <input type="button" value="Add Artist" onclick="window.location.href=\'add_artist.php\'" style="margin-left: 10px;">
    </div>
</form>
';

// table display
if($result->num_rows > 0) {
    echo "<table style='border: solid 3px black; margin-left: auto; margin-right: auto; background-color: white; border-radius: 10px;'>
        <tr>
            <th>Artist ID</th>
            <th>Name</th>
            <th>Genre</th>
            <th>Debut</th>
            <th>Country</th>
        </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo '
        <tr>
            <td>'.$row['artist_id'].'</td>
            <td>'.$row['name'].'</td>
            <td>'.$row['genre'].'</td>
            <td>'.$row['debut'].'</td>
            <td>'.$row['country'].'</td>
            <td style="border: solid 1px black;"> <a href="editartist.php?artistID='.$row['artist_id'].'">Edit/Delete</a></td>
        </tr>';
    }
    echo "</table>";
} else {
    echo "<p>No artists found matching your criteria.</p>";
}

$conn->close();
?>
<div style="position: fixed; bottom: 20px; right: 20px;">
    <a href="home.php" style="display: inline-block; padding: 10px 20px; 
           background-color: #0056b3; color: white; text-decoration: none; 
           border-radius: 5px; font: Arial;">
        Home
    </a>
</div>