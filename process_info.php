<?php
// Get current year
$currentYear = date("2025");

// Capture form data safely
$fullname = $_POST['fullname'] ?? '';
$birthyear = $_POST['birthyear'] ?? '';
$sleep = $_POST['sleep'] ?? '';
$city = $_POST['city'] ?? '';

// Validation
$errors = [];

if (empty($fullname)) $errors[] = "Full Name is required.";
if (empty($birthyear) || !is_numeric($birthyear)) $errors[] = "Valid Birth Year is required.";
if (empty($sleep) || !is_numeric($sleep) || $sleep < 0 || $sleep > 24) $errors[] = "Sleeping hours must be between 0 and 24.";
if (empty($city)) $errors[] = "City is required.";

if (count($errors) > 0) {
    echo "<div style='color:red;'><strong>Form Errors:</strong><ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul></div>";
    echo "<a href='info_form.html'>Go back to form</a>";
    exit;
}

// Computation
$age = $currentYear - (int)$birthyear;
$totalSleepYears = ($sleep * 365 * $age) / 24;

// Display
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Processed Info</title>
  <style>
    .container {
      margin: 30px;
      padding: 20px;
      border: 2px solid #333;
      width: 400px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }
    th, td {
      border: 1px solid #555;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #eee;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Processed Information</h2>
    <table>
      <tr><th>Full Name</th><td><?= htmlspecialchars($fullname) ?></td></tr>
      <tr><th>City</th><td><?= htmlspecialchars($city) ?></td></tr>
      <tr><th>Birth Year</th><td><?= htmlspecialchars($birthyear) ?></td></tr>
      <tr><th>Age</th><td><?= $age ?></td></tr>
      <tr><th>Sleeping Hours/Day</th><td><?= $sleep ?></td></tr>
      <tr><th>Total Years Sleeping</th><td><?= round($totalSleepYears, 2) ?></td></tr>
    </table>
  </div>
</body>
</html>
