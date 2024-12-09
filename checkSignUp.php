<?php
include 'usersArray.php';
if(isset($_POST["submit"]))
{
$newUser = array();
$newUser['user_name'] = $_POST['user_name'];
$newUser['first_name'] = $_POST['first_name'];
$newUser['last_name'] = $_POST['last_name'];
$newUser['password'] = $_POST['password'];
$newUser['email'] = $_POST['email'];
$newUser['phone'] = $_POST['phone'];
$newUser['address'] = $_POST['address'];
$users[] = $newUser;
}
echo "<pre>";
print_r($users);
echo "</pre>";
function compareByFirstName($a, $b) {
    return ($a['user_name']<$b['user_name'])?-1:1;
}

if (isset($_POST['sort'])) {
    usort($users, 'compareByFirstName');
    echo "<pre>";
print_r($users);
echo "</pre>";
} 

?>
<form method="post" >
    <input type="submit" name='sort' value="מיין את המשתמשים">
</form>

