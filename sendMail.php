<?php 

function sendMail($to, $subject, $message, $from) {
   echo "<html>
       <head>
           <title>Sending HTML email using PHP</title>
       </head>
       <body>";
   
   $header = "From: $from \r\n";
   $header .= "MIME-Version: 1.0\r\n";
   $header .= "Content-type: text/html\r\n";

   $retval = mail($to, $subject, $message, $header);

   if ($retval == true) {
       echo "Message sent successfully...";
   } else {
       echo "Message could not be sent...";
   }
}

?>

</body>
</html>



