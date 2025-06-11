<?php
try {
    $mysqli = new mysqli("localhost", "root", "", "contact_form");
    if($mysqli->connect_errno) {
        throw new Exception("فشل الاتصال بقاعدة البيانات: " . $mysqli->connect_error);
    }
} catch (Exception $e) {
    die($e->getMessage());
}
$list="select * from users";
$q=$mysqli->prepare($list);
$q->execute();
$result=$q->get_result();
?>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th><th>Name</th><th>Email</th><th>Actions</th>
    </tr>
<?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['id']) ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td>
            <a href="edit_action.php?id=<?= $row['id'] ?>">Edit</a> |
            <a href="delete_action.php?id=<?= $row['id'] ?>" onclick="return confirm('هل أنت متأكد من الحذف؟')">Delete</a>
        </td>
    </tr>
<?php endwhile; ?>
</table>
<?php
$q->close();
$mysqli->close();
?>