<?php
session_start();

if (!isset($_SESSION['customer_id'])) {
    header("Location: customer_login.html");
    exit();
}

$customer_id = $_SESSION['customer_id'];
$product_id  = $_POST['product_id'];
$your_item   = $_POST['your_item'];
$message     = $_POST['message'];

/* IMAGE UPLOAD */
$image_name = $_FILES['item_image']['name'];
$tmp_name   = $_FILES['item_image']['tmp_name'];

$upload_folder = "uploads/";

// create folder if not exists
if (!is_dir($upload_folder)) {
    mkdir($upload_folder, 0777, true);
}

move_uploaded_file($tmp_name, $upload_folder . $image_name);

/* DATABASE CONNECTION */
$conn = mysqli_connect("localhost", "root", "", "swapsmart");

if (!$conn) {
    die("Database connection failed");
}

/* INSERT DATA */
$sql = "INSERT INTO exchange_requests
(customer_id, product_id, your_item, item_image, message)
VALUES
('$customer_id', '$product_id', '$your_item', '$image_name', '$message')";

mysqli_query($conn, $sql);

/* SUCCESS ALERT + REDIRECT */
echo "<script>
        alert('Exchange request submitted successfully!');
        window.location.href = 'home.php';
      </script>";
?>
