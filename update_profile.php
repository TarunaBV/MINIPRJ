<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: connect.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "healthcardDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT * FROM doctors WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$doctor = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $qualification = $_POST['qualification'];

    $stmt = $conn->prepare("UPDATE doctors SET name = ?, phone_number = ?, qualification = ? WHERE username = ?");
    $stmt->bind_param("ssss", $name, $phone_number, $qualification, $username);

    if ($stmt->execute()) {
        header("Location: home.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Update Profile</h1>
    </header>
    <div class="container">
        <form action="update_profile.php" method="post">
            <div class="inputBox">
                <input type="text" name="name" value="<?php echo htmlspecialchars($doctor['name']); ?>" placeholder="Full Name" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="inputBox">
                <input type="text" name="phone_number" value="<?php echo htmlspecialchars($doctor['phone_number']); ?>" placeholder="Phone Number" required>
                <i class='bx bxs-phone'></i>
            </div>
            <div class="inputBox">
                <input type="text" name="qualification" value="<?php echo htmlspecialchars($doctor['qualification']); ?>" placeholder="Qualification" required>
                <i class='bx bxs-graduation'></i>
            </div>
            <input type="submit" class="btn" value="Update Profile">
        </form>
    </div>
</body>
</html>
