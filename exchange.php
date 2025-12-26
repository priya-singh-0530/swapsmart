<?php
session_start();

if (!isset($_SESSION['customer_id'])) {
    header("Location: customer_login.html");
    exit();
}

$pid = $_GET['pid'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Exchange Item</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            width: 400px;
            margin: 80px auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
        }

        label {
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        textarea {
            resize: none;
            height: 80px;
        }

        button {
            width: 100%;
            background-color: #1abc9c;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #16a085;
        }

        .product-id {
            text-align: center;
            margin-bottom: 15px;
            color: #555;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Exchange Request</h2>

    <p class="product-id">
        Exchanging Product ID: <b><?php echo $pid; ?></b>
    </p>

    <form method="post" action="exchange_submit.php" enctype="multipart/form-data">

        <input type="hidden" name="product_id" value="<?php echo $pid; ?>">

        <label>Your Item Name</label>
        <input type="text" name="your_item" required>

        <label>Your Item Photo</label>
        <input type="file" name="item_image" required>

        <label>Message</label>
        <textarea name="message"></textarea>

        <button type="submit">Submit Exchange Request</button>
    </form>

</div>

</body>
</html>
