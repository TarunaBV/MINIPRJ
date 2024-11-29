<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Patient</title>
    <link rel="stylesheet" href="patient_update.css">
</head>
<body>
    <div class="container">
        <h1>Update Patient Record</h1>
        <form action="update_patient_record.php" method="post">
            <div class="inputBox">
                <input type="text" name="card_number" required>
                <label for="card_number">Card Number</label>
            </div>
            <input type="submit" class="btn" value="Next">
        </form>
    </div>
</body>
</html>
