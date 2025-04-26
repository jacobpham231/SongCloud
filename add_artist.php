<?php
echo '<body style="background-color: #f3dfc1;">';
// insert logic
if(isset($_POST['inserttb'])){ 

	$id=$_POST['artist_id'];
	$name = $_POST['name'];
	$genre = $_POST['genre'];
	$debut = $_POST['debut'];
    $country = $_POST['country'];

	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "SongCloud";
    $conn = new mysqli($servername, $username, $password, $dbname) or die ("Failed to connect to database". $conn -> error);
    
	$sql = "INSERT INTO Artists VALUES ('$id', '$name', '$genre', '$debut', '$country')";
	$result = $conn->query($sql);

	if($result)
	{
	echo "Records inserted successfully";
	}
}

?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div style="margin: 20px 0; text-align: center; margin-top: 50px; display: block;">
    ID : <input type="text" name="artist_id"/> 
    Name : <input type="text" name="name"/>
    Genre : <input type ="text" name ="genre"/>
    Debut : <input type ="text" name ="debut"/>
    Country : <input type ="text" name ="country"/>
    <input type ="submit" value="Insert" name="inserttb"/>
</div>
</form>

<div style="text-align: center; margin: 20px 0;">
    <input type="button" 
           value="View Artists" 
           onclick="window.location.href='view_artists.php'" 
           style="padding: 15px 30px;
                  font-size: 18px;
                  background-color: #0056b3;
                  color: white;
                  border: none;
                  border-radius: 8px;
                  cursor: pointer;
                  transition: background-color 0.3s ease;">
</div>