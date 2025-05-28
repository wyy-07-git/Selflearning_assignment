<?php

$submitted = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $unit = htmlspecialchars($_POST['unit']);
    $issue = htmlspecialchars($_POST['issue']);
    setcookie("lastUnit", $unit, time() + 3600); 
    $submitted = true;
}

// Welcome message based on cookie
$welcomeMsg = "";
if (isset($_COOKIE["lastUnit"])) {
    $welcomeMsg = "<p>Welcome back, Unit " . $_COOKIE["lastUnit"] . "!</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Strata Management - Maintenance</title>
</head>
<body>
    <h1>Strata Management Portal</h1>
    <?php echo $welcomeMsg; ?>
    
    <h2>Submit a Maintenance Request</h2>
    <form method="POST" action="">
        <label for="unit">Unit Number:</label><br>
        <input type="text" id="unit" name="unit" required><br><br>

        <label for="issue">Issue Description:</label><br>
        <textarea id="issue" name="issue" required></textarea><br><br>

        <input type="submit" value="Submit Request">
    </form>

    <?php if ($submitted): ?>
        <h3>Request Received</h3>
        <p><strong>Unit:</strong> <?php echo $unit; ?></p>
        <p><strong>Issue:</strong> <?php echo $issue; ?></p>
        <p>Your request has been logged. Thank you!</p>
    <?php endif; ?>
</body>
</html>
