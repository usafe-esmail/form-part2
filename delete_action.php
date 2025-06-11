<?php
//require 'db_connection.php';
try {
    $mysqli = new mysqli("localhost", "root", "", "contact_form");
    if($mysqli->connect_errno) {
        throw new Exception("فشل الاتصال بقاعدة البيانات: " . $mysqli->connect_error);
    }
} catch (Exception $e) {
    die($e->getMessage());
}
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $q=$mysqli->prepare("delete from users where id=?");
    $q->bind_param("i",$id);
    $q->execute();
    $q->close();
    header("location:user_list.php");
    exit();
}
else{
    echo "no action done";
}

?>