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
        <h1 class="text-center">เมนูอาหาร</h1>
        <a href="create_menu.php" class="btn btn-primary mb-3">เพิ่มเมนูใหม่</a>
        <div class="row">
            <?php foreach ($menu_items as $item): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($item['description']); ?></p>
                            <p class="card-text">ราคา: <?php echo htmlspecialchars($item['price']); ?> บาท</p>
                            <a href="update_menu.php?id=<?php echo $item['id']; ?>" class="btn btn-warning">แก้ไข</a>
                            <a href="delete_menu.php?id=<?php echo $item['id']; ?>" class="btn btn-danger"
                                onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบเมนูนี้?');">ลบ</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>