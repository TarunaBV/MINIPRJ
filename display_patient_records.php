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

// Fetch patient name
$sql = "SELECT patient_name FROM patients WHERE card_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $card_number);
$stmt->execute();
$stmt->bind_result($patient_name);
$stmt->fetch();
$stmt->close();

// Fetch patient records
$sql = "SELECT date, patient_details, patient_image FROM patient_updates WHERE card_number = ? ORDER BY date ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $card_number);
$stmt->execute();
$result = $stmt->get_result();
$records = [];

while ($row = $result->fetch_assoc()) {
    $records[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Records</title>
    <link rel="stylesheet" href="patient_update.css">
    <style>
        .image-container {
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease, max-height 0.5s ease;
            max-height: 0;
            overflow: hidden;
        }
        .image-container.show {
            display: block;
            opacity: 1;
            max-height: 1000px; /* adjust as needed */
        }
        .image-container img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .view-image {
            display: block;
            text-align: right;
            color: #f5f5dc;  /* Cream color */
            margin-top: 5px;
            margin-bottom: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Patient Records for: <?php echo htmlspecialchars($patient_name); ?></h1>
        <?php if (!empty($records)): ?>
            <div class="records">
                <?php foreach ($records as $record): ?>
                    <div class="record">
                        <div class="record-date">
                            <strong><?php echo htmlspecialchars($record['date']); ?></strong>
                        </div>
                        <?php if (!empty($record['patient_image'])): ?>
                            <a href="#" class="view-image" data-image="<?php echo htmlspecialchars($record['patient_image']); ?>">view_image</a>
                        <?php endif; ?>
                        <div class="record-details">
                            <?php echo nl2br(htmlspecialchars($record['patient_details'])); ?>
                        </div>
                        <?php if (!empty($record['patient_image'])): ?>
                            <div class="image-container">
                                <img src="<?php echo htmlspecialchars($record['patient_image']); ?>" alt="Patient Image">
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No records found for this patient.</p>
        <?php endif; ?>
    </div>

    <script>
        document.querySelectorAll('.view-image').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const container = this.nextElementSibling.nextElementSibling;
                container.classList.toggle('show');
            });
        });
    </script>
</body>
</html>
