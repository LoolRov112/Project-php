<?php
include 'nav.php';
$avocadosDesc = array(
    "האס" => "צורתו קטן יחסית בצורה אליפטית, בעל קליפה מגובששת שמתקשה ומשחירה כשהפרי בשל. 
    תקופת הקטיף מדצמבר עד אפריל, ולפעמים הפרי מחזיק על העץ במצב טוב עד יוני. 
    טעמו קרמי ועשיר. 
    משקל ממוצע כ-200 גרם. 
    מקור השם שמו של רודולף האס, חקלאי ישראלי שביקש לקדם סוג זה.",
    
    "אטינגר" => "צורתו מניב פרי בינוני-גדול ולעיתים גדול מאוד, צורתו אגסית, בעל קליפה חלקה וציפה חלקה וקרמית. 
    תקופת הקטיף קצרה יחסית, מאוקטובר עד דצמבר-ינואר. 
    טעמו פרי עם טעם פרי ישראלי. 
    משקל ממוצע כ-250 גרם. 
    מקור השם לכבוד פרופסור סולומון אטינגר, בוטנאי יהודי-גרמני.",
    
    "ריד" => "צורתו עגולה, קליפה ירוקה מחוספסת המתקלפת בקלות וזרע קטן יחסית. 
    תקופת הקטיף מחודש מרץ ועד סוף חודש מאי. 
    טעמו מתוק ומזוקק, עם טעם מיוחד. 
    משקל ממוצע כ-180 גרם. 
    מקור השם לא ברור, יתכן ונקרא על שם אדם שמצא את הזן הזה.",
    
    "פוארטה" => "צורתו אליפטי אגסי וקצת קשה, עם קליפה ירוקה. 
    תקופת הקטיף קטיף מאמצע נובמבר עד מרץ. 
    טעמו פחות קרמי מהאבוקדו האס ומתוק. 
    משקל ממוצע כ-300 גרם. 
    מקור השם מתוך הספרדית, 'פווארטה' מתרגם ל'עזר' או 'תמיכה', על פי המראה המוצק שלו.",
    
    "גליל" => "צורתו אגסית מאורכת, קליפה ירוקה מבריקה. 
    תקופת הקטיף בין סוף אוגוסט לסוף ספטמבר. 
    טעמו קרמי ומתוק, עם טעם עדין. 
    משקל ממוצע כ-300 גרם. 
    מקור השם נקרא על שם האזור הגלילי בישראל."
);

$avocados = array(
    "imgs/Catelog/galil.jpg", 
    "imgs/Catelog/fuerta.jpg", 
    "imgs/Catelog/reed.jpg", 
    "imgs/Catelog/etinger.jpg", 
    "imgs/Catelog/hass.jpg"
);

echo '<html><head>
<style>
body {
    margin-top: 4em;
    font-family: Arial, sans-serif;
}

.cardContainer{
    display: flex;
    flex-wrap: wrap;  
    justify-content: center;
    gap: 20px;  
    margin: 0 auto; 
}

.card {
    width: 18rem;
    border-radius: 15px;
    border: 1px solid #ccc; 
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    display: flex;
    flex-direction: column;
    transition: transform 0.5s;
}
.card:hover {
    transform: scale(1.2);
}
.card-img-top {
    width: 100%;
}

.card-body {
    padding: 15px;
    background-color: beige;
}

.card-title {
    font-size: 1.5em;
    font-weight: bold;
}

.card-text {
    font-size: 14px;
    color: #333;
    line-height: 1.5;
    font-size: 1.3em;
}
</style>
</head><body dir="rtl">';

echo '<div class="cardContainer">';

for ($i = 0; $i < count($avocados); $i++) {
    $avocadoName = array_keys($avocadosDesc)[$i];  
    $avocadoDesc = $avocadosDesc[$avocadoName]; 
    $avocadoImage = $avocados[$i]; 
    echo '<div class="card">
        <img class="card-img-top" src="' . $avocadoImage . '" alt="' . $avocadoName . '">
        <div class="card-body">
            <h5 class="card-title">' . $avocadoName . '</h5>
            <p class="card-text">' . $avocadoDesc . '</p>
        </div>
    </div>';
}

echo '</div></body></html>';
?>
