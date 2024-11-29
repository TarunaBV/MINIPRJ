<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Patient</title>
    <link rel="stylesheet" href="patient_registration.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Register Patient</h1>
        <form action="process_patient_registration.php" method="post">
            <div class="inputBox">
                <input type="text" name="patient_name" required>
                <label for="patient_name">Patient's Name</label>
            </div>
            <div class="inputBox">
                <input type="text" name="card_number" required>
                <label for="card_number">Card Number</label>
            </div>
            <div class="inputBox">
                <input type="date" name="date_of_birth" required>
                <label for="date_of_birth">Date of Birth</label>
            </div>
            <div class="inputBox">
                <select name="gender" required>
                    <option value="" disabled selected>Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                <label for="gender">Gender</label>
            </div>
            <div class="inputBox">
                <select name="blood_group" required>
                    <option value="" disabled selected>Select Blood Group</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
                <label for="blood_group">Blood Group</label>
            </div>
            <input type="submit" class="btn" value="Register">
        </form>
    </div>
</body>
</html>
