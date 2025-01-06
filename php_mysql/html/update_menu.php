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

    $stmt = $pdo->prepare("UPDATE menu SET name = ?, description = ?, price = ? WHERE id = ?");
    $stmt->execute([$name, $description, $price, $id]);

    header('Location: menu.php');
    exit;
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

    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
        <a class="navbar-brand" href="/index.php">หน้าเเรก</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/menu.php">ดูเมนู <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/contact.php">จัดการเมนู <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="container mt-5">
        <h1>แก้ไขเมนู</h1>
        <form method="POST">
            <div class="form-group">
                <label for="name">ชื่อเมนู</label>
                <input type="text" class="form-control" name="name"
                    value="<?php echo htmlspecialchars($menu_item['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">รายละเอียด</label>
                <textarea class="form-control" name="description"
                    required><?php echo htmlspecialchars($menu_item['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="price">ราคา</label>
                <input type="number" step="0.01" class="form-control" name="price"
                    value="<?php echo htmlspecialchars($menu_item['price']); ?>" required>
            </div>

            <button type="submit" class="btn btn-warning">อัปเดตเมนู</button>
        </form>
        <a href="menu.php" class="btn btn-link">กลับไปที่เมนู</a>
    </div>
</body>

</html>