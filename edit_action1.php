<?php
try {
    $mysqli = new mysqli("localhost", "root", "", "contact_form");
    if($mysqli->connect_errno) {
        throw new Exception("فشل الاتصال بقاعدة البيانات: " . $mysqli->connect_error);
    }
} catch (Exception $e) {
    die($e->getMessage());
}

$id = $_GET['id'];
$q = $mysqli->prepare("SELECT * FROM users WHERE id = ?");
$q->bind_param("i", $id);
$q->execute();
$result = $q->get_result();
$user = $result->fetch_assoc();
?>

<form action="update_action.php" method="POST">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">
    <label>الاسم: <input type="text" name="name" value="<?= $user['name'] ?>"></label><br>
    <label>الإيميل: <input type="email" name="email" value="<?= $user['email'] ?>"></label><br>
    <button type="submit">update</button>
</form>