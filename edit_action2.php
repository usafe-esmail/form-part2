<?php
try {
    $mysqli = new mysqli("localhost", "root", "", "contact_form");
    if ($mysqli->connect_errno) {
        throw new Exception("فشل الاتصال بقاعدة البيانات: " . $mysqli->connect_error);
    }
} catch (Exception $e) {
    die($e->getMessage());
}
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];

$q = $mysqli->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
$q->bind_param("ssi", $name, $email, $id);
$q->execute();

if ($q->affected_rows > 0) {
    echo "seccuessfull";
    header("location:user_list.php");
    exit();
} else {
    echo "<script>alert('لم يتم التعديل أو لم تتغير البيانات'); window.location.href='user_list.php';</script>";
}

$q->close();
$mysqli->close();