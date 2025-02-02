<?php
session_start(); 

$links = array(
    "דף הבית" => "home1.php",
    "צור קשר" => "contact.php",
    "קטלוג" => "catalog.php",
    "כניסה" => "login.php",
    "הרשמה" => "register.php",
);
$navOptions = array("דף הבית", "קטלוג");

echo '<link rel="stylesheet" href="styles.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Karantina:wght@300;400;700&family=IBM+Plex+Sans+Hebrew:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
<div class="navContainer">';

echo '<nav dir="rtl"><ul>';

if (isset($_SESSION['fName']) && isset($_SESSION['lName'])) {
    if( $_SESSION['isManager']==0){
    echo "<li class='usergreet'>שלום " . $_SESSION['fName'] . ' ' . $_SESSION['lName'] . "</li>";
    echo '<li><a href="logout.php">יציאה</a></li>';
    echo '<li><a href="basket.php">סל קניות</a></li>';
    echo '<li><a href="oldorders.php">הזמנות קודמות</a></li>';
    echo '<li><a href="contact.php">צור קשר</a></li>';
    }
    else{
        echo "<li class='usergreet'>שלום " . $_SESSION['fName'] . ' ' . $_SESSION['lName'] . "</li>";
        echo '<li><a href="logout.php">יציאה</a></li>';
        echo '<li><a href="users.php">צפיייה במשתמשים</a></li>';
        echo '<li><a href="invantions.php">צפיייה בהזמנות</a></li>';
        echo '<li><a href="contactResponse.php">צפייה בפניות </a></li>';
    }
} 
else if (!isset($_SESSION['fName']) && !isset($_SESSION['lName'])) {
    echo '<li><a href="login.php">כניסה</a></li>';
    echo '<li><a href="register.php">הרשמה</a></li>';
    echo '<li><a href="contact.php">צור קשר</a></li>';
}
for ($i = 0; $i < count($navOptions); $i++) {
        $currentOption = $navOptions[$i];
        $currentLink = $links[$currentOption];
        echo '<li><a href="' . $currentLink . '">' . $currentOption . '</a></li>';
    
    
}

echo '</ul></nav></div>';
?>
