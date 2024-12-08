<?php
include 'nav.php';
$imagesArr=array("imgs/avocadoMaayan.jpg","imgs/AvocadoTree.jpeg", "imgs/Avocado2.jpg");
echo '<html dir="rtl"><head>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Karantina:wght@300;400;700&family=IBM+Plex+Sans+Hebrew:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
<style>
body{
    margin-top:4em;
    }
#prev, #next {
    cursor: grab;
    padding: 1em;
    font-size: 3em;
    transition: transform 1.5s;
    color: #4b7f3f;
    }
.containerHome {
    display: flex;
    flex-direction:row-reverse;
    justify-content: center;
    align-items: center;
    padding-bottom: 2em;
}
#prev:hover, #next:hover {
    cursor: grab;
    padding: 1em;
    font-size: 3em;
    transform: scale(1.5);
    color:#6dbe45;
}
</style>
</head><body>';
echo '<div class="containerHome">
        <div id="prev" onclick="prev()">◀</div>
            <div><img src="imgs/avocadoMaayan.jpg"></div>
        <div id="next" onclick="next()">▶</div>';

echo '</div> <script src="script.js"></script>';
echo '</body></html>';
?>
