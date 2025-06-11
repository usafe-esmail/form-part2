<?php
$error_fields = array();
if (!isset($_POST['name']) || empty($_POST['name'])) {
    $error_fields[] = "name";
}

if (!isset($_POST['email']) || 
    !filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
    $error_fields[] = "email";
}

if (!isset($_POST['password']) || strlen($_POST['password']) < 5) {
    $error_fields[] = "password";
}

if ($error_fields) {
    header("Location: form.php?error_fields=" . implode(",", $error_fields));
    exit;
}
$mysqli = new mysqli("localhost", "root", "", "contact_form");
if ($mysqli->connect_errno) {
    die("فشل الاتصال بقاعدة البيانات: " . $mysqli->connect_error);
}
$createTableSQL = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
)";
if (!$mysqli->query($createTableSQL)) {
    die("connection error  " . $mysqli->error);
}
$stmt = $mysqli->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
if (!$stmt) {
    die("query error " . $mysqli->error);
}
$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$stmt->bind_param("sss", $_POST['name'], $_POST['email'], $hashed_password);
if($stmt->execute()){
    echo "data added successfully!";
} 
else{
    echo "error occure when adding the data " . $stmt->error;
}
if(empty($error_fields)){
    header("location:login.php");
    exit;
}
$stmt->close();
$mysqli->close();
?>