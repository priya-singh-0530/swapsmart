<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: customer login.html");
    exit();
}

$customer_id = $_SESSION['customer_id'];

// Connect to database
$conn = new mysqli("localhost", "root", "", "swapsmart");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user info
$sql = "SELECT * FROM customers WHERE id = $customer_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SwapSmart | Home</title>

    <style>
    body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
}

/* Header */
header {
    background-color: #2c3e50;
    color: white;
    text-align: center;
    padding: 20px;
}

/* Navbar */
nav {
    background-color: #1abc9c;
    padding: 10px;
    text-align: center;
}

nav a {
    color: white;
    margin: 0 15px;
    text-decoration: none;
    font-weight: bold;
}

nav a:hover {
    text-decoration: underline;
}

/* Categories */
.categories {
    padding: 30px;
    text-align: center;
}

.category-box {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
}

.box {
    background: white;
    padding: 20px;
    width: 220px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
}

/* Products */
.items {
    padding: 30px;
    text-align: center;
}

.product-card {
    display: inline-block;
    background-color: white;
    width: 220px;
    margin: 15px;
    padding: 15px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
}

.product-card img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

.buy-button {
    background-color: #1abc9c;
    color: white;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
    margin-top: 10px;
}

.buy-button:hover {
    background-color: #16a085;
}

/* Footer */
footer {
    background-color: #2c3e50;
    color: white;
    text-align: center;
    padding: 10px;
    margin-top: 30px;
}


    </style>
</head>
<body>

<header>
    <h1>SwapSmart</h1>
    <p>Exchange Books • Clothes • Electrical Devices</p>
</header>

<nav>
    <a href="#">Home</a>
    
    <a href="profile.php">My profile</a>
    <button class="logout-btn" onclick="alert('Logged out successfully!'); window.location.href=' customer login.html';">Logout</button>
</nav>

<section class="categories">
    <h2>Categories</h2>

    <div class="category-box">
        <div class="box">
            <h3>📚 Books</h3>
            <p>Exchange old and new books</p>
        </div>

        <div class="box">
            <h3>👕 Clothes</h3>
            <p>Exchange usable clothes</p>
        </div>

        <div class="box">
            <h3>🔌 Electrical</h3>
            <p>Exchange electronic devices</p>
        </div>
    </div>
</section>

<section class="items">
    <h2>Available Items</h2>

        <?php
    // Fetch products
    $products = $conn->query("SELECT * FROM products");

    if ($products && $products->num_rows > 0) {
        while ($row = $products->fetch_assoc()) {
            echo "<div class='product-card'>";
            echo "<h3>" . htmlspecialchars($row['product_name']) . "</h3>";
            echo "<img src='" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['product_name']) . "'>";
            echo "<p>Price: Rs. " . htmlspecialchars($row['price']) . "</p>";
          

            echo "<a href='exchange.php?pid=" . htmlspecialchars($row['product_id']) . "'>
        <button class='buy-button'>Exchange Now</button>
      </a>";

            echo "</div>";
        }
    } else {
        echo "<p>No products available.</p>";
    }

    $conn->close();
    ?>
    </div>
    </div>
</section>

<footer>
    <p>© 2025 SwapSmart | Mini Project</p>
</footer>

</body>
</html>
