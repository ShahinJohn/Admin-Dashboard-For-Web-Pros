<?php






if(isset($_POST['select_table']) && $_POST['select_table'] == "inventory"){
	include('../Includes/admin_login.php'); 

	$sql = "SELECT * FROM `inventory`";
	$result = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_array($result))
	{

			echo "<tr>";
			echo "<td>" . $row['category'] . "</td>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>" . $row['brand'] . "</td>";
			echo "<td>" . $row['unit'] . "</td>";
			echo "<td>" . $row['quanity'] . "</td>";
			echo "<td>" . $row['cost'] . "</td>";
			echo "<td>" . $row['pricing'] . "</td>";
			echo "<td>" . $row['image'] . "</td>";
			echo "<td>" . $row['description'] . "</td>";
			echo "<td>" . $row['sku'] . "</td>";
			echo "<td>" . $row['supplier'] . "</td>";
			echo "</tr>";
	
	}
	
	mysqli_close($conn);			
}










if(isset($_POST['select_table']) && $_POST['select_table'] == "menu"){
	include('../Includes/admin_login.php'); 

	$sql = "SELECT * FROM `inventory`";
	$result = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_array($result))
	{
	    
            echo '<div class="card" style="width: 18rem;">';
            echo '<img src="/FlatFileDB/Products/'.$row['image'].'" class="card-img-top" alt="...">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">'.$row['name'].'</h5>';
            echo '<p class="card-text">'.$row['description'].'</p>';
            echo '<a href="#" class="btn btn-primary">Order Now!</a>';
            echo '</div>';
            echo '</div>';


	}
	
	mysqli_close($conn);			
}

if(isset($_POST["submit"])) {
$nam = trim($_POST['name']);
if(!file_exists($nam)){ mkdir($nam); }
if(file_exists($nam)){
	

	

$uploadOk = 1;
$path = $_FILES['image']['name'];
$imageFileType = pathinfo($path, PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
  $check = getimagesize($_FILES["image"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }




// Check file size
if ($_FILES["image"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

$newUploadedFile = $nam."/".uniqid().".".$imageFileType;
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $newUploadedFile)) {
    echo "Image Uploaded";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

	$cat = trim($_POST['category']);  
	$bra = trim($_POST['brand']); 
	$uni = trim($_POST['unit']); 
	$qua = trim($_POST['quantity']); 
	$cos = trim($_POST['cost']); 
	$pri = trim($_POST['pricing']); 
	$ima = trim($newUploadedFile); 
	$des = trim($_POST['description']); 
	$sku = trim($_POST['sku']); 
	$sup = trim($_POST['supplier']); 

	include('../Includes/admin_login.php'); 
	$sql = "INSERT INTO `inventory`( `category`, `name`, `brand`, `unit`, `quanity`, `cost`, `pricing`, `image`, `description`, `sku`, `supplier`) VALUES ('$cat','$nam','$bra','$uni','$qua','$cos','$pri','$ima','$des','$sku','$sup')";
	if (mysqli_query($conn, $sql)) {
		echo "Inventory Added";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
}
}




?>
