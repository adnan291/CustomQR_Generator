<?php

// Define the directory where uploaded files will be stored
$target_dir = "uploads/";

// Check if the form has been submitted
if(isset($_POST["submit"])) {
  
  // Get the file type and name
  $fileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
  $fileName = uniqid() . "." . $fileType;
  
  // Move the uploaded file to the target directory
  if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $fileName)) {
    
    // Generate a QR code for the uploaded file
    $qrCodeUrl = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=" . urlencode($target_dir . $fileName);
    
    // Output the QR code image and URL
    echo "<img src='" . $qrCodeUrl . "' />";
    echo "<p>File URL: " . $target_dir . $fileName . "</p>";
    
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
  
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Upload and Generate QR Code</title>
    <link rel="stylesheet" type="text/css" href="style.css">
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	
		
</head>
<body>

	<form method="post" enctype="multipart/form-data">
		Select file to upload:
		<input type="file" name="fileToUpload" id="fileToUpload">
		<input type="submit" value="Upload File" name="submit">
	</form>

</body>
</html>
