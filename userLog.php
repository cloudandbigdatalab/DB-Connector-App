<?php
include 'DbConnect.php';
function createNewUser() {
        $response = array();
        $latitude= $_POST["lat"];
        $longitude= $_POST["lng"];
        $event= $_POST["event"];
		$phone= $_POST["phoneNum"];
		$name= $_POST["name"];
		$helper= $_POST["helper"];
        $db = new DbConnect();
       // mysql query
		$query = "INSERT INTO user(Phone,Name,Latitude,Longitude,Event) VALUES('$phone','$name','$latitude','$longitude','$event') 
		ON DUPLICATE KEY UPDATE Name='$name',Latitude='$latitude',Longitude='$longitude',Event='$event'";	
        $result = mysql_query($query) or die(mysql_error());
		if($helper=="true"){
			$query2 = "INSERT INTO helper(Phone,Name,Latitude,Longitude,Event) VALUES('$phone','$name','$latitude','$longitude','$event') 
		ON DUPLICATE KEY UPDATE Name='$name',Latitude='$latitude',Longitude='$longitude',Event='$event'";
			mysql_query($query2) or die(mysql_error());
		}
        if ($result) {
            $response["error"] = false;
            $response["message"] = "Prediction added successfully!";
        } else {
            $response["error"] = true;
            $response["message"] = "Failed to add prediction!";
        }
       // echo json response
    echo json_encode($response);
}
createNewUser();
?>