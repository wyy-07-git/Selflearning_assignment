<?php
$submitted = false;
$unit = "";
$issue = "";
$errorMsg = "";


$host = 'db.okifoudbgckzncmsoemw.supabase.co';     
$db   = 'postgres';
$user = 'postgres';
$pass = '20061202Bb';                   
$port = '5432';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $unit = htmlspecialchars($_POST['unit']);
    $issue = htmlspecialchars($_POST['issue']);
    setcookie("lastUnit", $unit, time() + 3600); 
    $submitted = true;

    try {
        $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO maintenance_requests (unit, issue) VALUES (:unit, :issue)");
        $stmt->execute(['unit' => $unit, 'issue' => $issue]);
    } catch (PDOException $e) {
        $errorMsg = "❌ Database error: " . $e->getMessage();
    }
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

    <?php if ($submitted && !$errorMsg): ?>
        <h3>Request Received</h3>
        <p><strong>Unit:</strong> <?php echo $unit; ?></p>
        <p><strong>Issue:</strong> <?php echo $issue; ?></p>
        <p>Your request has been saved to the database. ✅</p>
    <?php elseif ($errorMsg): ?>
        <p style="color:red;"><?php echo $errorMsg; ?></p>
    <?php endif; ?>
</body>
</html>
