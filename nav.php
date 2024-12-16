<?php

$links = array(
    "דף הבית" => "home1.php",
    "צור קשר" => "contact.php",
    "קטלוג" => "catalog.php",
    "כניסה" => "login.php",
    "הרשמה" => "register.php"
);
$navOptions = array("דף הבית", "צור קשר", "קטלוג", "כניסה", "הרשמה");
echo '<link rel="stylesheet" href="styles.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Karantina:wght@300;400;700&family=IBM+Plex+Sans+Hebrew:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
<div class="navContainer">';
echo '<input type="hidden" id="userName" value="<?php echo $item_id; ?>" name="item_id"></p><nav><ul>';
for ($i = 0; $i < count($navOptions); $i++) {
    $currentOption = $navOptions[$i];
    $currentLink = $links[$currentOption];
    echo '<li><a href="' . $currentLink . '">' . $currentOption . '</a></li>';
}
echo '</ul></nav></div>';



?>
