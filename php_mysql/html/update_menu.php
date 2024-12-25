<?php
include 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM menu WHERE id = ?");
$stmt->execute([$id]);
$menu_item = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $stmt = $pdo->prepare("UPDATE menu SET name = ?, description = ?, price = ?, image = ? WHERE id = ?");
    $stmt->execute([$name, $description, $price, $image, $id]);

    header('Location: menu.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขเมนู</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>แก้ไขเมนู</h1>
        <form method="POST">
            <div class="form-group">
                <label for="name">ชื่อเมนู</label>
                <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($menu_item['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">รายละเอียด</label>
                <textarea class="form-control" name="description" required><?php echo htmlspecialchars($menu_item['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="price">ราคา</label>
                <input type="number" step="0.01" class="form-control" name="price" value="<?php echo htmlspecialchars($menu_item['price']); ?>" required>
            </div>
            <div class="form-group">
                <label for="image">URL ของรูปภาพ</label>
                <input type="text" class="form-control" name="image" value="<?php echo htmlspecialchars($menu_item['image']); ?>" required>
            </div>
            <button type="submit" class="btn btn-warning">อัปเดตเมนู</button>
        </form>
        <a href="menu.php" class="btn btn-link">กลับไปที่เมนู</a>
    </div>
</body>
</html>