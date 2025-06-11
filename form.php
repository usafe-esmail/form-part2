<?php
$error_arr = array();

if (isset($_GET['error_fields'])) {
    $error_arr = explode(",", $_GET['error_fields']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Validation Form</title>
</head>
<body>

<form method="POST" action="validation_of_form.php">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name">
    <?php if (in_array("name", $error_arr)) echo "<p style='color:red;'>Please enter your name!</p>"; ?>

    <br><br>

    <label for="email">Email:</label>
    <input type="text" name="email" id="email">
    <?php if (in_array("email", $error_arr)) echo "<p style='color:red;'>Please enter a valid email!</p>"; ?>

    <br><br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password">
    <?php if (in_array("password", $error_arr)) echo "<p style='color:red;'>Password must be at least 5 characters!</p>"; ?>

    <br><br>

    <input type="submit" value="Submit">
</form>

</body>
</html>