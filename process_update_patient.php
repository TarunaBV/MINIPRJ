<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "healthcardDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$card_number = $_POST['card_number'];
$date = $_POST['date'];
$patient_details = $_POST['patient_details'];

// Handle image upload
$target_dir = "uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
}
$target_file = $target_dir . basename($_FILES["patient_image"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$uploadOk = 1;

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["patient_image"]["tmp_name"]);
if ($check !== false) {
    $uploadOk = 1;
} else {
    echo "File is not an image.";
    $uploadOk = 0;
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["patient_image"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["patient_image"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars(basename($_FILES["patient_image"]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$sql = "INSERT INTO patient_updates (card_number, date, patient_details, patient_image) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$image_path = $uploadOk == 1 ? $target_file : null;
$stmt->bind_param("ssss", $card_number, $date, $patient_details, $image_path);

if ($stmt->execute()) {
    echo "Patient record updated successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
