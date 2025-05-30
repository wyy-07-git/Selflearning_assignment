<!DOCTYPE html>
<html>
<head>
  <title>Strata Management - Maintenance</title>
  <meta charset="utf-8" />
</head>
<body>
  <h1>Strata Management Portal</h1>

  <?php
    if (isset($_COOKIE["lastUnit"])) {
      echo "<p>Welcome back, Unit <strong>" . htmlspecialchars($_COOKIE["lastUnit"]) . "</strong>!</p>";
    }
  ?>

  <h2>Submit a Maintenance Request</h2>

  <form id="request-form">
    <label for="unit">Unit Number:</label><br>
    <input type="text" id="unit" name="unit" required><br><br>

    <label for="issue">Issue Description:</label><br>
    <textarea id="issue" name="issue" required></textarea><br><br>

    <input type="submit" value="Submit Request">
  </form>

  <p id="result" style="color: green;"></p>

  <script>
    document.getElementById('request-form').addEventListener('submit', async function (e) {
      e.preventDefault();
      
      const unit = document.getElementById('unit').value;
      const issue = document.getElementById('issue').value;
      document.cookie = `lastUnit=${unit}; max-age=3600; path=/`;

      const res = await fetch('/api/save-request', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ unit, issue })
      });

      const result = document.getElementById('result');
      if (res.ok) {
        result.textContent = '✅ Request saved successfully!';
        result.style.color = 'green';
        this.reset();
      } else {
        const err = await res.text();
        result.textContent = '❌ Error: ' + err;
        result.style.color = 'red';
      }
    });
  </script>
</body>
</html>
