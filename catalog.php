<?php
include 'nav.php';
$avocadosData = array(
    array(
        "name" => "האס",
        "description" => "צורתו קטן יחסית בצורה אליפטית, בעל קליפה מגובששת שמתקשה ומשחירה כשהפרי בשל. 
            תקופת הקטיף מדצמבר עד אפריל, ולפעמים הפרי מחזיק על העץ במצב טוב עד יוני. 
            טעמו קרמי ועשיר. 
            משקל ממוצע כ-200 גרם. 
            מקור השם שמו של רודולף האס, חקלאי ישראלי שביקש לקדם סוג זה.",
        "image" => "imgs/Catelog/hass.jpg",
        "price" => 15.5,
        "quantity" => 50
    ),
    array(
        "name" => "אטינגר",
        "description" => "צורתו מניב פרי בינוני-גדול ולעיתים גדול מאוד, צורתו אגסית, בעל קליפה חלקה וציפה חלקה וקרמית. 
            תקופת הקטיף קצרה יחסית, מאוקטובר עד דצמבר-ינואר. 
            טעמו פרי עם טעם פרי ישראלי. 
            משקל ממוצע כ-250 גרם. 
            מקור השם לכבוד פרופסור סולומון אטינגר, בוטנאי יהודי-גרמני.",
        "image" => "imgs/Catelog/etinger.jpg",
        "price" => 13.9,
        "quantity" => 30
    ),
    array(
        "name" => "ריד",
        "description" => "צורתו עגולה, קליפה ירוקה מחוספסת המתקלפת בקלות וזרע קטן יחסית. 
            תקופת הקטיף מחודש מרץ ועד סוף חודש מאי. 
            טעמו מתוק ומזוקק, עם טעם מיוחד. 
            משקל ממוצע כ-180 גרם. 
            מקור השם לא ברור, יתכן ונקרא על שם אדם שמצא את הזן הזה.",
        "image" => "imgs/Catelog/reed.jpg",
        "price" => 14.5,
        "quantity" => 20
    ),
    array(
        "name" => "פוארטה",
        "description" => "צורתו אליפטי אגסי וקצת קשה, עם קליפה ירוקה. 
            תקופת הקטיף קטיף מאמצע נובמבר עד מרץ. 
            טעמו פחות קרמי מהאבוקדו האס ומתוק. 
            משקל ממוצע כ-300 גרם. 
            מקור השם מתוך הספרדית, 'פווארטה' מתרגם ל'עזר' או 'תמיכה', על פי המראה המוצק שלו.",
        "image" => "imgs/Catelog/fuerta.jpg",
        "price" => 12.7,
        "quantity" => 40
    ),
    array(
        "name" => "גליל",
        "description" => "צורתו אגסית מאורכת, קליפה ירוקה מבריקה. 
            תקופת הקטיף בין סוף אוגוסט לסוף ספטמבר. 
            טעמו קרמי ומתוק, עם טעם עדין. 
            משקל ממוצע כ-300 גרם. 
            מקור השם נקרא על שם האזור הגלילי בישראל.",
        "image" => "imgs/Catelog/galil.jpg",
        "price" => 16.0,
        "quantity" => 25
    )
);
?>
<html>
<head>
<style>
body {
    margin-top: 4em;
    font-family: Arial, sans-serif;
}
.cardContainer {
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
    transform: scale(1.1);
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
<script>
function validateQuantity(stock, id) {
    const quantity = document.getElementById('quantity-' + id).value;
    if (quantity > stock) {
        alert('כמות המבוקשת גדולה מהמלאי הקיים!');
        return false;
    }
    alert('הכמות הוזנה בהצלחה!');
    return true;
}
</script>
</head>
<body dir="rtl">
<div class="cardContainer">
<?php
foreach ($avocadosData as $index => $avocado) {
    echo '<div class="card">
        <img class="card-img-top" src="' . $avocado["image"] . '" alt="' . $avocado["name"] . '">
        <div class="card-body">
            <h5 class="card-title">' . $avocado["name"] . '</h5>
            <p class="card-text">' . $avocado["description"] . '</p>
            <p class="card-text">מחיר: ₪' . $avocado["price"] . '</p>
            <p class="card-text">כמות במלאי: ' . $avocado["quantity"] . '</p>
            <input type="number" id="quantity-' . $index . '" placeholder="הכנס כמות" min="1">
            <button onclick="validateQuantity(' . $avocado["quantity"] . ', ' . $index . ')">הוסף לעגלה</button>
        </div>
    </div>';
}
?>
</div>

<div align="center" style="margin-top:2em">
    <form method="post" enctype="multipart/form-data">
        בחר קובץ להעלאה
        <input type="file" name ='test' id="fileToUpload">
        <br>
        <br>
            <!-- <input type="file" name="file2" id="fileToUpload"> -->
        <br>
        <input type="submit" value="השוואה" name="submit">
    </form>
</div>

<?php   
 
if(isset($_POST["submit"])){
    echo $_POST['test'];
    // $file1= fopen($_POST['file1'], "r");
    // $file2= fopen($_POST["file2"], "r");
    // echo $file1;
    // $flag=0;
    // while(!feof($file1) || !feof($file2)){
    //     if(strcasecmp(fgetc($file1) , fgetc($file2))!=0){
    //         echo '<p>לא זהים</p>';
    //         $flag=1;
    //         break;
    //     }
    // }
    // if($flag==0)
    //     echo '<p>קבצים זהים</p>';
    // fclose($file1);
    // fclose($file2);
}
?>
</body></html>
