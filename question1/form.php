<?php
// Function to calculate age
function calculate_age($birthdate) {
    $birthDate = new DateTime($birthdate);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthDate);
    $ageInYears = $age->y + $age->m / 12 + $age->d / 365.25;
    return round($ageInYears, 1);
}

// Sanitize and validate user inputs
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$name = $birthdate = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["name"]) && !empty($_POST["birthday"])) {
        $name = sanitize_input($_POST["name"]);
        $birthdate = sanitize_input($_POST["birthday"]);

        // Validate date format (YYYY-MM-DD)
        $date_pattern = "/^\d{4}-\d{2}-\d{2}$/";
        if (preg_match($date_pattern, $birthdate)) {
            $age = calculate_age($birthdate);
            $message = "Hello, $name! You are $age years old.";
        } else {
            $message = "Invalid date format. Please use YYYY-MM-DD.";
        }
    } else {
        $message = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Age Calculator</title>
</head>
<body>
    <h1>Age Calculator</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br><br>
        <label for="birthday">Birthday (YYYY-MM-DD):</label>
        <input type="date" id="birthday" name="birthday" required>
        <br><br>
        <input type="submit" value="Submit">
    </form>
    <br>
    <?php
    if (!empty($message)) {
        echo "<p>$message</p>";
    }
    ?>
</body>
</html>