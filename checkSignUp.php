<?php
include 'usersArray.php';

function compareByFirstName($a, $b) {
    return strcmp($a['first_name'], $b['first_name']);
}

if (isset($_POST['sort'])) {
    usort($users, 'compareByFirstName');
} 


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

