<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patient Records</title>
    <link rel="stylesheet" href="patient_update.css">
</head>
<body>
    <div class="container">
        <h1>View Patient Records</h1>
        <form action="display_patient_records.php" method="post">
            <div class="inputBox">
                <input type="text" name="card_number" required>
                <label for="card_number">Card Number</label>
            </div>
            <input type="submit" class="btn" value="View Records">
        </form>
    </div>
</body>
</html>
