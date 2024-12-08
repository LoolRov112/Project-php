<?php
include 'usersArray.php';

function compareByFirstName($a, $b) {
    // השוואת שני המשתמשים לפי השם הפרטי
    return strcmp($a['first_name'], $b['first_name']);
}

// אם הכפתור נלחץ, נבצע מיון
if (isset($_POST['sort'])) {
    // מיון המערך לפי שם פרטי (first_name) של כל משתמש
    usort($users, 'compareByFirstName');
}   qwe45


$newUser = array();
$newUser['user_name'] = $_POST['user_name'];
$newUser['first_name'] = $_POST['first_name'];
$newUser['last_name'] = $_POST['last_name'];
$newUser['password'] = $_POST['password'];
$newUser['email'] = $_POST['email'];
$newUser['phone'] = $_POST['phone'];
$newUser['address'] = $_POST['address'];
$users[] = $newUser;

echo "<pre>";
print_r($users);
echo "</pre>";
?>
<form method="post">
    <input type="submit" name='sort' value="מיין את המשתמשים">
</form>

