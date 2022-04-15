<?php
// 7 rows total including id

$contact_name = $_POST['contact_name'];
$contact_email = $_POST['contact_email'];
$contact_subject = $_POST['contact_subject'];
$contact_message = $_POST['contact_message'];

//For Image Upload:

// Database connection
$conn = new mysqli('localhost','root','','dbmsproj');

if($conn->connect_error){
	echo "$conn->connect_error";
	die("Connection Failed : ". $conn->connect_error);
} 
else {

	$filename = addslashes($_FILES['bookimage']['name']);
	$tmpname = addslashes(file_get_contents($_FILES['bookimage']['tmp_name']));
	$filetype = addslashes($_FILES['bookimage']['type']);
	$filesize = addslashes($_FILES['bookimage']['size']);
	$array = array('jpg', 'jpeg');
	$ext = pathinfo($filename, PATHINFO_EXTENSION);

	if (!empty($filename)) {
		if (in_array($ext, $array)) {
			$sql = "Insert into testone(contact_name, contact_email, contact_subject, contact_message,name,bookimage) values('$contact_name','$contact_email','$contact_subject','$contact_message','$filename','$tmpname')";
			mysqli_query($conn, $sql);
			echo '<script>alert("Book Added Successfully")</script>';
			echo '<script>window.location = "index.html"</script>';
			// header("Location: index.html");
		} else {
			echo '<script>alert("Uploading was not successfull")</script>';
			echo '<script>window.location = "sell.html"</script>';
		}
	}
	
	$conn->close();
}
?>