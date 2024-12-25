<?php
include 'db.php';

$stmt = $pdo->query("SELECT * FROM menu");
$menu_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เมนู</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">เมนูอาหาร</h1>
        <a href="create_menu.php" class="btn btn-primary mb-3">เพิ่มเมนูใหม่</a>
        <div class="row">
            <?php foreach ($menu_items as $item): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?php echo $item['image']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($item['description']); ?></p>
                            <p class="card-text">ราคา: <?php echo htmlspecialchars($item['price']); ?> บาท</p>
                            <a href="update_menu.php?id=<?php echo $item['id']; ?>" class="btn btn-warning">แก้ไข</a>
                            <a href="delete_menu.php?id=<?php echo $item['id']; ?>" class="btn btn-danger" onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบเมนูนี้?');">ลบ</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>