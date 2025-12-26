<?php
session_start();

// If user is not logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: customer login.html");
    exit();
}

$customer_id = $_SESSION['customer_id'];
$conn = new mysqli("localhost", "root", "", "swapsmart");
$sql = "SELECT * FROM customers WHERE id='$customer_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
$username = $user['username'];
$email    = $user['email'];
$phone    = $user['phone'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile - ShopSphere</title>
  <style>
    /* Body styling */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #a1c4fd; /* soft blue background */
    }

    /* Navbar */
    .navbar {
      background-color: #333;
      color: white;
      padding: 10px 20px;
    }
    .navbar a {
      color: white;
      text-decoration: none;
      margin-right: 15px;
    }
    .navbar a:hover {
      text-decoration: underline;
    }

    /* Profile container */
    .profile-container {
      max-width: 500px;
      margin: 30px auto;
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .profile-container h2 {
      text-align: center;
    }

    .profile-container p {
      font-size: 16px;
      margin: 10px 0;
    }

    .logout-btn {
      display: block;
      width: 100%;
      padding: 8px;
      background-color: red;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 15px;
    }
  </style>
</head>
<body>

 

  <!-- Profile Card -->
  <div class="profile-container">
    <h2>My Profile</h2>
    <p><b>Username:</b> <?php echo htmlspecialchars($username); ?></p>
    <p><b>Email:</b> <?php echo htmlspecialchars($email); ?></p>
    <p><b>Phone:</b> <?php echo htmlspecialchars($phone); ?></p>
    <button class="logout-btn" onclick="alert('Logged out successfully!'); window.location.href=' customer login.html';">Logout</button>
  </div>

</body>
</html>
