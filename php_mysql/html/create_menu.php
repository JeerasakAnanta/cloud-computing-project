<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $stmt = $pdo->prepare("INSERT INTO menu (name, description, price, image) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $description, $price, $image]);

    header('Location: menu.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มเมนู</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>เพิ่มเมนูใหม่</h1>
        <form method="POST">
            <div class="form-group">
                <label for="name">ชื่อเมนู</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">รายละเอียด</label>
                <textarea class="form-control" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">ราคา</label>
                <input type="number" step="0.01" class="form-control" name="price" required>
            </div>
            <div class="form-group">
                <label for="image">URL ของรูปภาพ</label>
                <input type="text" class="form-control" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">เพิ่มเมนู</button>
        </form>
        <a href="menu.php" class="btn btn-link">กลับไปที่เมนู</a>
    </div>
</body>

</html>